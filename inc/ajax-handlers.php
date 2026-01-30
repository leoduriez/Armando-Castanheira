<?php
/**
 * AJAX Handlers for filtering
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * AJAX handler for filtering matières
 */
function ac_filter_matieres() {
    // Verify nonce
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
 * Email de destination pour les formulaires
 */
define( 'AC_CONTACT_EMAIL', 'leo.duriezj@gmail.com' );

/**
 * AJAX handler pour le formulaire de contact/devis
 */
function ac_submit_contact_form() {
    // Vérifier le nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ac_ajax_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Erreur de sécurité. Veuillez rafraîchir la page.' ) );
    }

    // Récupérer le type de formulaire
    $form_type = isset( $_POST['form_type'] ) ? sanitize_text_field( $_POST['form_type'] ) : 'contact';

    // Récupérer et nettoyer les données
    $data = array(
        'prenom'    => sanitize_text_field( $_POST['prenom'] ?? '' ),
        'nom'       => sanitize_text_field( $_POST['nom'] ?? '' ),
        'email'     => sanitize_email( $_POST['email'] ?? '' ),
        'telephone' => sanitize_text_field( $_POST['telephone'] ?? '' ),
        'message'   => sanitize_textarea_field( $_POST['message'] ?? '' ),
    );

    // Champs spécifiques au formulaire de devis
    if ( $form_type === 'devis' ) {
        $data['piece']   = sanitize_text_field( $_POST['piece'] ?? '' );
        $data['taille']  = sanitize_text_field( $_POST['taille'] ?? '' );
        $data['matiere'] = sanitize_text_field( $_POST['matiere'] ?? '' );
    } else {
        // Champ spécifique au formulaire de contact
        $data['adresse'] = sanitize_text_field( $_POST['adresse'] ?? '' );
    }

    // Validation des champs obligatoires
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

    // Validation email
    if ( ! is_email( $data['email'] ) ) {
        wp_send_json_error( array( 
            'message' => 'Veuillez saisir une adresse e-mail valide.',
            'field'   => 'email'
        ) );
    }

    // Envoyer l'email
    $sent = ac_send_form_email( $data, $form_type );

    if ( $sent ) {
        wp_send_json_success( array( 
            'message' => 'Votre message a été envoyé avec succès. Nous vous recontacterons rapidement.'
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
 * @param array  $data      Données du formulaire.
 * @param string $form_type Type de formulaire (contact/devis).
 * @return bool
 */
function ac_send_form_email( $data, $form_type ) {
    $to = AC_CONTACT_EMAIL;
    
    if ( $form_type === 'devis' ) {
        $subject = 'Nouvelle demande de devis – Site Marbre';
    } else {
        $subject = 'Nouveau message de contact – Site Marbre';
    }

    // Construire le contenu de l'email
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

    // En-têtes
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Site Armando Castanheira <noreply@' . parse_url( get_site_url(), PHP_URL_HOST ) . '>',
        'Reply-To: ' . $data['prenom'] . ' ' . $data['nom'] . ' <' . $data['email'] . '>',
    );

    return wp_mail( $to, $subject, $message, $headers );
}
