<?php
/**
 * Chargement des scripts et styles
 * 
 * Ce fichier gère le chargement conditionnel de tous les CSS et JavaScript du thème.
 * Les styles et scripts sont chargés uniquement sur les pages qui en ont besoin
 * pour optimiser les performances.
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Charger les feuilles de style CSS
 * 
 * Charge les styles de manière conditionnelle selon le type de page.
 * Inclut Google Fonts, le style principal et les styles spécifiques aux pages.
 */
function ac_enqueue_styles() {
    // Google Fonts - Archivo & Cormorant (optimisé avec display=swap pour un rendu plus rapide)
    wp_enqueue_style(
        'ac-google-fonts',
        'https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&family=Cormorant:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap',
        array(),
        null,
        'all'
    );

    // Feuille de style principale du thème
    wp_enqueue_style(
        'ac-main-style',
        AC_THEME_URI . '/style.css',
        array( 'ac-google-fonts' ),
        AC_THEME_VERSION,
        'all'
    );

    // Styles spécifiques à la page d'accueil
    if ( is_front_page() || is_page_template( 'page-templates/template-accueil.php' ) ) {
        wp_enqueue_style(
            'ac-home-style',
            AC_THEME_URI . '/assets/css/pages/home.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    // Styles pour la page des réalisations
    if ( is_page( 'marbre-sur-mesure' ) || is_page_template( 'page-realisations.php' ) || is_page_template( 'page-templates/template-realisations.php' ) ) {
        wp_enqueue_style(
            'ac-realisations-style',
            AC_THEME_URI . '/assets/css/pages/realisations.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    if ( is_page_template( 'page-templates/template-matieres.php' ) || is_post_type_archive( 'matiere' ) ) {
        wp_enqueue_style(
            'ac-matieres-style',
            AC_THEME_URI . '/assets/css/pages/matieres.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
        wp_enqueue_style(
            'ac-matieres-header-style',
            AC_THEME_URI . '/assets/css/pages/page-matieres.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    if ( is_page_template( 'page-templates/template-contact.php' ) || is_page_template( 'page-templates/template-devis.php' ) ) {
        wp_enqueue_style(
            'ac-contact-style',
            AC_THEME_URI . '/assets/css/pages/contact.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
        wp_enqueue_style(
            'ac-contact-header-style',
            AC_THEME_URI . '/assets/css/pages/page-contact.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    if ( is_page_template( 'page-templates/template-savoir-faire.php' ) ) {
        wp_enqueue_style(
            'ac-savoir-faire-style',
            AC_THEME_URI . '/assets/css/pages/savoir-faire.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    // Styles pour la page d'erreur 404
    if ( is_404() ) {
        wp_enqueue_style(
            'ac-404-style',
            AC_THEME_URI . '/assets/css/pages/404.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    // Styles pour les pages légales (CGU et Politique de confidentialité)
    if ( is_page_template( 'page-cgu.php' ) || is_page_template( 'page-confidentialite.php' ) ) {
        wp_enqueue_style(
            'ac-legal-style',
            AC_THEME_URI . '/assets/css/pages/legal.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ac_enqueue_styles' );

/**
 * Charger les scripts JavaScript
 * 
 * Charge les scripts de manière conditionnelle selon le type de page.
 * Tous les scripts utilisent du JavaScript Vanilla (pas de jQuery).
 */
function ac_enqueue_scripts() {
    // JavaScript principal - Vanilla JS uniquement, pas de jQuery
    wp_enqueue_script(
        'ac-main-script',
        AC_THEME_URI . '/assets/js/main.js',
        array(), // Aucune dépendance - pur Vanilla JS
        AC_THEME_VERSION,
        true // Charger dans le footer
    );

    // Localiser le script pour les requêtes AJAX (passer des variables PHP vers JS)
    wp_localize_script( 'ac-main-script', 'acAjax', array(
        'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'ac_ajax_nonce' ),
        'themeUrl'     => AC_THEME_URI,
        'homeUrl'      => home_url(),
        'heroVideoUrl' => get_theme_mod( 'ac_hero_video_url', '' ),
    ) );

    // Script de filtrage pour la page des matières
    if ( is_page_template( 'page-templates/template-matieres.php' ) || is_post_type_archive( 'matiere' ) ) {
        wp_enqueue_script(
            'ac-filter-script',
            AC_THEME_URI . '/assets/js/modules/filter.js',
            array( 'ac-main-script' ),
            AC_THEME_VERSION,
            true
        );
        
        // Script d'interaction pour les cartes de matières
        wp_enqueue_script(
            'ac-matieres-script',
            AC_THEME_URI . '/assets/js/matieres.js',
            array( 'ac-main-script' ),
            AC_THEME_VERSION,
            true
        );
    }

    // Script de gestion des formulaires pour la page de contact
    if ( is_page_template( 'page-templates/template-contact.php' ) ) {
        wp_enqueue_script(
            'ac-forms-script',
            AC_THEME_URI . '/assets/js/modules/forms.js',
            array( 'ac-main-script' ),
            AC_THEME_VERSION,
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ac_enqueue_scripts' );

/**
 * Ajouter preconnect pour Google Fonts
 * Améliore les performances en établissant une connexion anticipée
 */
function ac_preconnect_google_fonts( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'ac_preconnect_google_fonts', 10, 2 );

/**
 * Ajouter l'attribut defer aux scripts pour de meilleures performances
 * Les scripts se chargent en parallèle sans bloquer le rendu de la page
 */
function ac_defer_scripts( $tag, $handle, $src ) {
    // Liste des scripts à différer
    $defer_scripts = array(
        'ac-main-script',
        'ac-filter-script',
        'ac-forms-script',
        'ac-matieres-script',
    );

    if ( in_array( $handle, $defer_scripts, true ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'ac_defer_scripts', 10, 3 );
