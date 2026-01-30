<?php
/**
 * Enqueue scripts and styles
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles
 */
function ac_enqueue_styles() {
    // Google Fonts - Archivo & Cormorant (optimized with display=swap for faster rendering)
    wp_enqueue_style(
        'ac-google-fonts',
        'https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&family=Cormorant:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap',
        array(),
        null,
        'all'
    );

    // Main stylesheet
    wp_enqueue_style(
        'ac-main-style',
        AC_THEME_URI . '/style.css',
        array( 'ac-google-fonts' ),
        AC_THEME_VERSION,
        'all'
    );

    // Home page styles
    if ( is_front_page() || is_page_template( 'page-templates/template-accueil.php' ) ) {
        wp_enqueue_style(
            'ac-home-style',
            AC_THEME_URI . '/assets/css/pages/home.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    // Page Réalisations
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
            AC_THEME_URI . '/assets/css/page-matieres.css',
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
            AC_THEME_URI . '/assets/css/page-contact.css',
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

    // 404 page styles
    if ( is_404() ) {
        wp_enqueue_style(
            'ac-404-style',
            AC_THEME_URI . '/assets/css/pages/404.css',
            array( 'ac-main-style' ),
            AC_THEME_VERSION
        );
    }

    // Legal pages styles (CGU & Confidentialité)
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
 * Enqueue scripts
 */
function ac_enqueue_scripts() {
    // Main JavaScript - Vanilla JS only, no jQuery
    wp_enqueue_script(
        'ac-main-script',
        AC_THEME_URI . '/assets/js/main.js',
        array(), // No dependencies - pure Vanilla JS
        AC_THEME_VERSION,
        true // Load in footer
    );

    // Localize script for AJAX
    wp_localize_script( 'ac-main-script', 'acAjax', array(
        'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
        'nonce'        => wp_create_nonce( 'ac_ajax_nonce' ),
        'themeUrl'     => AC_THEME_URI,
        'homeUrl'      => home_url(),
        'heroVideoUrl' => get_theme_mod( 'ac_hero_video_url', '' ),
    ) );

    // Filter script for Matières page
    if ( is_page_template( 'page-templates/template-matieres.php' ) || is_post_type_archive( 'matiere' ) ) {
        wp_enqueue_script(
            'ac-filter-script',
            AC_THEME_URI . '/assets/js/modules/filter.js',
            array( 'ac-main-script' ),
            AC_THEME_VERSION,
            true
        );
        
        // Matières card interaction script
        wp_enqueue_script(
            'ac-matieres-script',
            AC_THEME_URI . '/assets/js/matieres.js',
            array( 'ac-main-script' ),
            AC_THEME_VERSION,
            true
        );
    }

    // Forms script for Contact page
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
 * Add preconnect for Google Fonts
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
 * Add defer attribute to scripts for better performance
 */
function ac_defer_scripts( $tag, $handle, $src ) {
    // Scripts to defer
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
