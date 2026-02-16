<?php
/**
 * Gestionnaires AJAX pour le filtrage et les formulaires
 * 
 * Ce fichier contient tous les gestionnaires AJAX du thème :
 * - Filtrage des matières
 * - Soumission du formulaire de contact/devis
 * - Gestion des avis clients (récupération, ajout, statistiques)
 *
 * @package Armando_Castanheira
 */

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Gestionnaire AJAX pour le filtrage des matières
 * 
 * Permet de filtrer dynamiquement les matières par type (granit, marbre, quartzite)
 * sans recharger la page. Utilisé sur la page des matières.
 */
function ac_filter_matieres() {
    // Vérifier le nonce pour la sécurité
    if ( ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Nonce invalide' ) );
    }

    $type = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ) : 'toutes';
    
    $matieres = ac_get_matieres( $type );
    
    ob_start();
    
    if ( $matieres->have_posts() ) {
        echo '<div class="matieres-grid grid grid--3-cols">';
        while ( $matieres->have_posts() ) {
            $matieres->the_post();
            get_template_part( 'template-parts/content/content', 'matiere' );
        }
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p class="no-results">Aucune matière trouvée.</p>';
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_filter_matieres', 'ac_filter_matieres' );
add_action( 'wp_ajax_nopriv_filter_matieres', 'ac_filter_matieres' );

/**
 * Adresse email de destination pour les formulaires de contact et devis
 * Tous les messages des formulaires seront envoyés à cette adresse
 */
define( 'AC_CONTACT_EMAIL', 'leo.duriezj@gmail.com' );

/**
 * Gestionnaire AJAX pour le formulaire de contact et de devis
 * 
 * Gère la soumission des formulaires de contact et de demande de devis.
 * Valide les données, enregistre en base de données (pour les devis)
 * et envoie un email de notification.
 */
function ac_submit_contact_form() {
    // Vérifier le nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Erreur de sécurité. Veuillez rafraîchir la page.' ) );
    }

    // Récupérer le type de formulaire (contact ou devis)
    $form_type = isset( $_POST['form_type'] ) ? sanitize_text_field( $_POST['form_type'] ) : 'contact';

    // Récupérer et nettoyer toutes les données du formulaire
    $data = array(
        'prenom'    => sanitize_text_field( $_POST['prenom'] ?? '' ),
        'nom'       => sanitize_text_field( $_POST['nom'] ?? '' ),
        'email'     => sanitize_email( $_POST['email'] ?? '' ),
        'telephone' => sanitize_text_field( $_POST['telephone'] ?? '' ),
        'message'   => sanitize_textarea_field( $_POST['message'] ?? '' ),
    );

    // Champs spécifiques au formulaire de devis (pièce, taille, matière)
    if ( $form_type === 'devis' ) {
        $data['piece']   = sanitize_text_field( $_POST['piece'] ?? '' );
        $data['taille']  = sanitize_text_field( $_POST['taille'] ?? '' );
        $data['matiere'] = sanitize_text_field( $_POST['matiere'] ?? '' );
    } else {
        // Champ spécifique au formulaire de contact (adresse)
        $data['adresse'] = sanitize_text_field( $_POST['adresse'] ?? '' );
    }

    // Validation des champs obligatoires selon le type de formulaire
    $required = array( 'prenom', 'nom', 'email', 'telephone' );
    if ( $form_type === 'devis' ) {
        $required = array_merge( $required, array( 'piece', 'taille', 'matiere' ) );
    } else {
        $required[] = 'adresse';
    }

    foreach ( $required as $field ) {
        if ( empty( $data[ $field ] ) ) {
            wp_send_json_error( array( 
                'message' => 'Veuillez remplir tous les champs obligatoires.',
                'field'   => $field
            ) );
        }
    }

    // Validation du format de l'adresse email
    if ( ! is_email( $data['email'] ) ) {
        wp_send_json_error( array( 
            'message' => 'Veuillez saisir une adresse e-mail valide.',
            'field'   => 'email'
        ) );
    }

    // Sauvegarder la demande de devis dans la base de données (uniquement pour les devis)
    if ( $form_type === 'devis' ) {
        $devis_id = ac_add_demande_devis( $data );
        if ( ! $devis_id ) {
            error_log( 'Erreur lors de la sauvegarde du devis en base de données' );
        }
    }

    // Envoyer l'email de notification au propriétaire du site
    $sent = ac_send_form_email( $data, $form_type );

    if ( $sent ) {
        $message = 'Votre message a été envoyé avec succès. Nous vous recontacterons rapidement.';
        if ( $form_type === 'devis' && $devis_id ) {
            $message = 'Votre demande de devis a été enregistrée avec succès. Nous vous recontacterons rapidement.';
        }
        wp_send_json_success( array( 
            'message' => $message,
            'devis_id' => $form_type === 'devis' ? $devis_id : null
        ) );
    } else {
        wp_send_json_error( array( 
            'message' => 'Une erreur est survenue lors de l\'envoi. Veuillez réessayer.'
        ) );
    }
}
add_action( 'wp_ajax_submit_contact_form', 'ac_submit_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'ac_submit_contact_form' );

/**
 * Envoyer l'email du formulaire
 * 
 * Construit et envoie un email avec les informations du formulaire.
 * Le format de l'email change selon qu'il s'agit d'un contact ou d'un devis.
 *
 * @param array  $data      Données du formulaire (prénom, nom, email, etc.)
 * @param string $form_type Type de formulaire (contact ou devis)
 * @return bool True si l'email a été envoyé, false sinon
 */
function ac_send_form_email( $data, $form_type ) {
    $to = AC_CONTACT_EMAIL;
    
    if ( $form_type === 'devis' ) {
        $subject = 'Nouvelle demande de devis – Site Marbre';
    } else {
        $subject = 'Nouveau message de contact – Site Marbre';
    }

    // Construire le contenu de l'email avec mise en forme
    $message = ( $form_type === 'devis' ? 'Nouvelle demande de devis' : 'Nouveau message de contact' );
    $message .= " reçu le " . date_i18n( 'd/m/Y à H:i' ) . "\n\n";
    $message .= "═══════════════════════════════════════\n";
    $message .= "INFORMATIONS DU CLIENT\n";
    $message .= "═══════════════════════════════════════\n\n";
    $message .= "Prénom : " . $data['prenom'] . "\n";
    $message .= "Nom : " . $data['nom'] . "\n";
    $message .= "E-mail : " . $data['email'] . "\n";
    $message .= "Téléphone : " . $data['telephone'] . "\n";

    if ( $form_type === 'devis' ) {
        $message .= "\n═══════════════════════════════════════\n";
        $message .= "DÉTAILS DU PROJET\n";
        $message .= "═══════════════════════════════════════\n\n";
        $message .= "Pièce de la maison : " . $data['piece'] . "\n";
        $message .= "Taille (L x l x H) : " . $data['taille'] . "\n";
        $message .= "Matière : " . $data['matiere'] . "\n";
    } else {
        $message .= "Adresse : " . $data['adresse'] . "\n";
    }

    if ( ! empty( $data['message'] ) ) {
        $message .= "\n═══════════════════════════════════════\n";
        $message .= "MESSAGE\n";
        $message .= "═══════════════════════════════════════\n\n";
        $message .= $data['message'] . "\n";
    }

    $message .= "\n═══════════════════════════════════════\n";
    $message .= "Email envoyé depuis le site Armando Castanheira\n";

    // Définir les en-têtes de l'email (expéditeur, réponse à)
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Site Armando Castanheira <noreply@' . parse_url( get_site_url(), PHP_URL_HOST ) . '>',
        'Reply-To: ' . $data['prenom'] . ' ' . $data['nom'] . ' <' . $data['email'] . '>',
    );

    return wp_mail( $to, $subject, $message, $headers );
}

/* ==========================================================================
   GESTIONNAIRES AJAX POUR LES AVIS CLIENTS
   Gestion complète des avis clients : récupération, ajout, statistiques
   ========================================================================== */

/**
 * Gestionnaire AJAX pour récupérer les avis clients
 * 
 * Retourne la liste des avis clients approuvés depuis la base de données.
 * Utilisé pour afficher les avis dans le carousel de la page d'accueil.
 */
function ac_ajax_get_avis_clients() {
    // Vérifier le nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Erreur de sécurité.' ) );
    }
    
    $limit = isset( $_POST['limit'] ) ? absint( $_POST['limit'] ) : 50;
    $avis = ac_get_avis_clients( $limit );
    
    wp_send_json_success( array( 'avis' => $avis ) );
}
add_action( 'wp_ajax_get_avis_clients', 'ac_ajax_get_avis_clients' );
add_action( 'wp_ajax_nopriv_get_avis_clients', 'ac_ajax_get_avis_clients' );

/**
 * Gestionnaire AJAX pour ajouter un avis client
 * 
 * Permet aux visiteurs d'ajouter un avis avec leur prénom, commentaire et note.
 * Valide toutes les données avant l'insertion en base de données.
 */
function ac_ajax_add_avis_client() {
    // Vérifier le nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Erreur de sécurité.' ) );
    }
    
    // Récupérer et valider les données du formulaire d'avis
    $prenom = isset( $_POST['prenom'] ) ? sanitize_text_field( $_POST['prenom'] ) : '';
    $commentaire = isset( $_POST['commentaire'] ) ? sanitize_textarea_field( $_POST['commentaire'] ) : '';
    $rating = isset( $_POST['rating'] ) ? absint( $_POST['rating'] ) : 0;
    
    // Validation
    if ( empty( $prenom ) ) {
        wp_send_json_error( array( 'message' => 'Le prénom est obligatoire.' ) );
    }
    
    if ( empty( $commentaire ) ) {
        wp_send_json_error( array( 'message' => 'Le commentaire est obligatoire.' ) );
    }
    
    if ( $rating < 1 || $rating > 5 ) {
        wp_send_json_error( array( 'message' => 'Veuillez sélectionner une note entre 1 et 5 étoiles.' ) );
    }
    
    if ( strlen( $prenom ) > 50 ) {
        wp_send_json_error( array( 'message' => 'Le prénom est trop long (maximum 50 caractères).' ) );
    }
    
    if ( strlen( $commentaire ) > 500 ) {
        wp_send_json_error( array( 'message' => 'Le commentaire est trop long (maximum 500 caractères).' ) );
    }
    
    // Ajouter l'avis dans la base de données
    $avis_id = ac_add_avis_client( $prenom, $commentaire, $rating );
    
    if ( $avis_id ) {
        wp_send_json_success( array( 
            'message' => 'Merci pour votre avis ! Il a été ajouté avec succès.',
            'avis_id' => $avis_id
        ) );
    } else {
        wp_send_json_error( array( 'message' => 'Une erreur est survenue lors de l\'ajout de votre avis.' ) );
    }
}
add_action( 'wp_ajax_add_avis_client', 'ac_ajax_add_avis_client' );
add_action( 'wp_ajax_nopriv_add_avis_client', 'ac_ajax_add_avis_client' );

/**
 * Gestionnaire AJAX pour obtenir les statistiques des avis
 * 
 * Retourne les statistiques globales des avis : nombre total, moyenne,
 * répartition par nombre d'étoiles.
 */
function ac_ajax_get_avis_stats() {
    // Vérifier le nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Erreur de sécurité.' ) );
    }
    
    $stats = ac_get_avis_stats();
    
    wp_send_json_success( array( 'stats' => $stats ) );
}
add_action( 'wp_ajax_get_avis_stats', 'ac_ajax_get_avis_stats' );
add_action( 'wp_ajax_nopriv_get_avis_stats', 'ac_ajax_get_avis_stats' );
