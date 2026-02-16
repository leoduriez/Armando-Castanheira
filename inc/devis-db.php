<?php
/**
 * Gestion de la base de données pour les demandes de devis
 * 
 * Ce fichier gère toutes les opérations en base de données pour les demandes de devis :
 * - Création de la table personnalisée
 * - Ajout, récupération, suppression de demandes
 * - Gestion des statuts (nouveau, en cours, traité)
 * - Statistiques des demandes
 * 
 * Les demandes sont stockées dans une table personnalisée wp_demandes_devis
 *
 * @package Armando_Castanheira
 */

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Créer la table des demandes de devis lors de l'activation du thème
 * 
 * Structure de la table :
 * - id : Identifiant unique
 * - prenom, nom, email, telephone : Informations du client
 * - piece : Type de pièce (cuisine, salle de bain, etc.)
 * - taille : Dimensions du projet
 * - matiere : Type de matière souhaité
 * - message : Message optionnel
 * - date_creation : Date de la demande
 * - ip_address : Adresse IP
 * - statut : État de la demande (nouveau, en_cours, traite)
 */
function ac_create_devis_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        prenom varchar(50) NOT NULL,
        nom varchar(50) NOT NULL,
        email varchar(100) NOT NULL,
        telephone varchar(20) NOT NULL,
        piece varchar(100) NOT NULL,
        taille varchar(100) NOT NULL,
        matiere varchar(100) NOT NULL,
        message text DEFAULT NULL,
        date_creation datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        ip_address varchar(45) DEFAULT NULL,
        statut varchar(20) DEFAULT 'nouveau' NOT NULL,
        PRIMARY KEY  (id),
        KEY email (email),
        KEY date_creation (date_creation),
        KEY statut (statut)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    
    // Ajouter une option pour suivre la version de la table
    add_option( 'ac_devis_db_version', '1.0' );
}

// Créer la table automatiquement au chargement du thème
add_action( 'after_setup_theme', 'ac_create_devis_table' );

/**
 * Récupérer toutes les demandes de devis
 * 
 * Permet de récupérer les demandes avec filtrage optionnel par statut.
 * Les demandes sont triées de la plus récente à la plus ancienne.
 *
 * @param int $limit Nombre maximum de devis à récupérer (défaut: 100)
 * @param string $statut Filtrer par statut (nouveau, en_cours, traite, tous)
 * @return array Liste des demandes avec tous leurs champs
 */
function ac_get_demandes_devis( $limit = 100, $statut = 'tous' ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    $limit = absint( $limit );
    
    if ( $statut === 'tous' ) {
        $results = $wpdb->get_results( 
            $wpdb->prepare(
                "SELECT * FROM $table_name 
                ORDER BY date_creation DESC 
                LIMIT %d",
                $limit
            ),
            ARRAY_A
        );
    } else {
        $results = $wpdb->get_results( 
            $wpdb->prepare(
                "SELECT * FROM $table_name 
                WHERE statut = %s 
                ORDER BY date_creation DESC 
                LIMIT %d",
                $statut,
                $limit
            ),
            ARRAY_A
        );
    }
    
    return $results ? $results : array();
}

/**
 * Ajouter une nouvelle demande de devis
 * 
 * Valide les champs obligatoires et insère la demande dans la base de données.
 * Le statut initial est toujours "nouveau".
 *
 * @param array $data Données du formulaire (prenom, nom, email, telephone, piece, taille, matiere, message)
 * @return int|false ID du devis inséré ou false en cas d'erreur
 */
function ac_add_demande_devis( $data ) {
    global $wpdb;
    
    // Validation des champs obligatoires
    $required_fields = array( 'prenom', 'nom', 'email', 'telephone', 'piece', 'taille', 'matiere' );
    foreach ( $required_fields as $field ) {
        if ( empty( $data[ $field ] ) ) {
            return false;
        }
    }
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    
    // Récupérer l'adresse IP du visiteur
    $ip_address = ac_get_client_ip();
    
    // Insérer la demande de devis dans la base de données
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'prenom'      => sanitize_text_field( $data['prenom'] ),
            'nom'         => sanitize_text_field( $data['nom'] ),
            'email'       => sanitize_email( $data['email'] ),
            'telephone'   => sanitize_text_field( $data['telephone'] ),
            'piece'       => sanitize_text_field( $data['piece'] ),
            'taille'      => sanitize_text_field( $data['taille'] ),
            'matiere'     => sanitize_text_field( $data['matiere'] ),
            'message'     => isset( $data['message'] ) ? sanitize_textarea_field( $data['message'] ) : '',
            'ip_address'  => $ip_address,
            'statut'      => 'nouveau',
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
    );
    
    if ( $inserted ) {
        return $wpdb->insert_id;
    }
    
    return false;
}

/**
 * Supprimer une demande de devis
 * 
 * Supprime définitivement une demande de la base de données.
 *
 * @param int $id ID de la demande à supprimer
 * @return bool True si supprimé avec succès, false sinon
 */
function ac_delete_demande_devis( $id ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    
    $deleted = $wpdb->delete(
        $table_name,
        array( 'id' => absint( $id ) ),
        array( '%d' )
    );
    
    return $deleted !== false;
}

/**
 * Mettre à jour le statut d'une demande de devis
 * 
 * Permet de suivre l'avancement du traitement des demandes.
 * Statuts possibles : nouveau, en_cours, traite
 *
 * @param int $id ID de la demande
 * @param string $statut Nouveau statut (nouveau, en_cours, traite)
 * @return bool True si mis à jour avec succès, false sinon
 */
function ac_update_statut_devis( $id, $statut ) {
    global $wpdb;
    
    $statuts_valides = array( 'nouveau', 'en_cours', 'traite' );
    if ( ! in_array( $statut, $statuts_valides, true ) ) {
        return false;
    }
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    
    $updated = $wpdb->update(
        $table_name,
        array( 'statut' => $statut ),
        array( 'id' => absint( $id ) ),
        array( '%s' ),
        array( '%d' )
    );
    
    return $updated !== false;
}

/**
 * Obtenir les statistiques des demandes de devis
 * 
 * Calcule et retourne les statistiques globales :
 * - Nombre total de demandes
 * - Répartition par statut (nouveaux, en cours, traités)
 * - Nombre de jours avec activité
 *
 * @return array Tableau associatif avec toutes les statistiques
 */
function ac_get_devis_stats() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    
    $stats = $wpdb->get_row(
        "SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN statut = 'nouveau' THEN 1 ELSE 0 END) as nouveaux,
            SUM(CASE WHEN statut = 'en_cours' THEN 1 ELSE 0 END) as en_cours,
            SUM(CASE WHEN statut = 'traite' THEN 1 ELSE 0 END) as traites,
            COUNT(DISTINCT DATE(date_creation)) as jours_actifs
        FROM $table_name",
        ARRAY_A
    );
    
    return $stats ? $stats : array(
        'total' => 0,
        'nouveaux' => 0,
        'en_cours' => 0,
        'traites' => 0,
        'jours_actifs' => 0,
    );
}

/**
 * Obtenir une demande de devis par ID
 * 
 * Récupère toutes les informations d'une demande spécifique.
 *
 * @param int $id ID de la demande
 * @return array|null Tableau associatif avec les données ou null si non trouvé
 */
function ac_get_demande_devis_by_id( $id ) {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'demandes_devis';
    
    $result = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            absint( $id )
        ),
        ARRAY_A
    );
    
    return $result;
}
