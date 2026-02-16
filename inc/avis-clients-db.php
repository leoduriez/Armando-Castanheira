<?php
/**
 * Gestion de la base de données pour les avis clients
 * 
 * Ce fichier gère toutes les opérations en base de données pour les avis clients :
 * - Création de la table personnalisée
 * - Ajout, récupération, suppression d'avis
 * - Gestion de l'approbation des avis
 * - Statistiques des avis
 * 
 * Les avis sont stockés dans une table personnalisée wp_avis_clients
 *
 * @package Armando_Castanheira
 */

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Créer la table des avis clients lors de l'activation du thème
 * 
 * Structure de la table :
 * - id : Identifiant unique
 * - prenom : Prénom du client
 * - commentaire : Texte de l'avis
 * - rating : Note de 1 à 5 étoiles
 * - date_creation : Date de création
 * - ip_address : Adresse IP (pour prévenir le spam)
 * - is_approved : Statut d'approbation (1 = approuvé)
 */
function ac_create_avis_clients_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'avis_clients';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        prenom varchar(50) NOT NULL,
        commentaire text NOT NULL,
        rating tinyint(1) NOT NULL,
        date_creation datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45) DEFAULT NULL,
        is_approved tinyint(1) DEFAULT 1 NOT NULL,
        PRIMARY KEY  (id),
        KEY rating (rating),
        KEY date_creation (date_creation),
        KEY is_approved (is_approved)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
    // Ajouter une option pour suivre la version de la table (utile pour les migrations)
    add_option( 'ac_avis_clients_db_version', '1.0' );
}

// Créer la table automatiquement au chargement du thème
add_action( 'after_setup_theme', 'ac_create_avis_clients_table' );

/**
 * Récupérer tous les avis approuvés
 * 
 * Retourne uniquement les avis qui ont été approuvés (is_approved = 1).
 * Les avis sont triés du plus récent au plus ancien.
 *
 * @param int $limit Nombre maximum d'avis à récupérer (défaut: 50)
 * @return array Liste des avis avec tous leurs champs
 */
function ac_get_avis_clients( $limit = 50 ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'avis_clients';
    $limit = absint( $limit );
    
    $results = $wpdb->get_results( 
        $wpdb->prepare(
            "SELECT id, prenom, commentaire, rating, date_creation 
            FROM $table_name 
            WHERE is_approved = 1 
            ORDER BY date_creation DESC 
            LIMIT %d",
            $limit
        ),
        ARRAY_A
    );
    
    return $results ? $results : array();
}

/**
 * Ajouter un nouvel avis client
 * 
 * Valide les données et insère un nouvel avis dans la base de données.
 * L'avis est automatiquement approuvé (is_approved = 1).
 * L'adresse IP est enregistrée pour prévenir le spam.
 *
 * @param string $prenom Prénom du client (max 50 caractères)
 * @param string $commentaire Commentaire du client (max 500 caractères)
 * @param int $rating Note de 1 à 5 étoiles
 * @return int|false ID de l'avis inséré ou false en cas d'erreur
 */
function ac_add_avis_client( $prenom, $commentaire, $rating ) {
    global $wpdb;
    
    // Validation des données avant insertion
    if ( empty( $prenom ) || empty( $commentaire ) || $rating < 1 || $rating > 5 ) {
        return false;
    }
    
    $table_name = $wpdb->prefix . 'avis_clients';
    
    // Récupérer l'adresse IP du visiteur
    $ip_address = ac_get_client_ip();
    
    // Insérer l'avis dans la base de données
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'prenom'       => sanitize_text_field( $prenom ),
            'commentaire'  => sanitize_textarea_field( $commentaire ),
            'rating'       => absint( $rating ),
            'ip_address'   => $ip_address,
            'is_approved'  => 1, // Auto-approuvé par défaut
        ),
        array( '%s', '%s', '%d', '%s', '%d' )
    );
    
    if ( $inserted ) {
        return $wpdb->insert_id;
    }
    
    return false;
}

/**
 * Supprimer un avis
 * 
 * Supprime définitivement un avis de la base de données.
 *
 * @param int $id ID de l'avis à supprimer
 * @return bool True si supprimé avec succès, false sinon
 */
function ac_delete_avis_client( $id ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'avis_clients';
    
    $deleted = $wpdb->delete(
        $table_name,
        array( 'id' => absint( $id ) ),
        array( '%d' )
    );
    
    return $deleted !== false;
}

/**
 * Approuver ou désapprouver un avis
 * 
 * Permet de modérer les avis en changeant leur statut d'approbation.
 * Seuls les avis approuvés sont affichés sur le site.
 *
 * @param int $id ID de l'avis
 * @param bool $approved True pour approuver, false pour désapprouver
 * @return bool True si mis à jour avec succès, false sinon
 */
function ac_update_avis_approval( $id, $approved ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'avis_clients';
    
    $updated = $wpdb->update(
        $table_name,
        array( 'is_approved' => $approved ? 1 : 0 ),
        array( 'id' => absint( $id ) ),
        array( '%d' ),
        array( '%d' )
    );
    
    return $updated !== false;
}

/**
 * Obtenir l'adresse IP du client
 * 
 * Gère les différentes configurations de serveur (proxy, load balancer, etc.).
 * Vérifie plusieurs en-têtes HTTP pour obtenir la vraie IP.
 *
 * @return string Adresse IP du client
 */
function ac_get_client_ip() {
    $ip_address = '';
    
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    
    return sanitize_text_field( $ip_address );
}

/**
 * Obtenir les statistiques des avis
 * 
 * Calcule et retourne les statistiques globales :
 * - Nombre total d'avis
 * - Note moyenne
 * - Répartition par nombre d'étoiles (1 à 5)
 *
 * @return array Tableau associatif avec toutes les statistiques
 */
function ac_get_avis_stats() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'avis_clients';
    
    $stats = $wpdb->get_row(
        "SELECT 
            COUNT(*) as total,
            AVG(rating) as moyenne,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as cinq_etoiles,
            SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as quatre_etoiles,
            SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as trois_etoiles,
            SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as deux_etoiles,
            SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as une_etoile
        FROM $table_name 
        WHERE is_approved = 1",
        ARRAY_A
    );
    
    return $stats ? $stats : array(
        'total' => 0,
        'moyenne' => 0,
        'cinq_etoiles' => 0,
        'quatre_etoiles' => 0,
        'trois_etoiles' => 0,
        'deux_etoiles' => 0,
        'une_etoile' => 0,
    );
}
