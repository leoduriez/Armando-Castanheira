<?php
/**
 * Theme Customizer
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add customizer settings
 */
function ac_customize_register( $wp_customize ) {
    
    // ==========================================================================
    // SECTION: Réseaux Sociaux
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_social_section', array(
        'title'    => __( 'Réseaux Sociaux', 'armando-castanheira' ),
        'priority' => 30,
    ) );
    
    // Instagram URL
    $wp_customize->add_setting( 'ac_instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'ac_instagram_url', array(
        'label'   => __( 'URL Instagram', 'armando-castanheira' ),
        'section' => 'ac_social_section',
        'type'    => 'url',
    ) );
    
    // Facebook URL
    $wp_customize->add_setting( 'ac_facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'ac_facebook_url', array(
        'label'   => __( 'URL Facebook', 'armando-castanheira' ),
        'section' => 'ac_social_section',
        'type'    => 'url',
    ) );
    
    // ==========================================================================
    // SECTION: Page d'accueil - Origines
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_home_origines', array(
        'title'    => __( 'Accueil - Section Origines', 'armando-castanheira' ),
        'priority' => 40,
    ) );
    
    // Origines Text
    $wp_customize->add_setting( 'ac_origines_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    $wp_customize->add_control( 'ac_origines_text', array(
        'label'   => __( 'Texte Origines', 'armando-castanheira' ),
        'section' => 'ac_home_origines',
        'type'    => 'textarea',
    ) );
    
    // Origines Image
    $wp_customize->add_setting( 'ac_origines_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ac_origines_image', array(
        'label'   => __( 'Image Origines', 'armando-castanheira' ),
        'section' => 'ac_home_origines',
    ) ) );
    
    // ==========================================================================
    // SECTION: Page d'accueil - Réalisations Preview
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_home_realisations', array(
        'title'    => __( 'Accueil - Section Réalisations', 'armando-castanheira' ),
        'priority' => 41,
    ) );
    
    // Réalisations Preview Text
    $wp_customize->add_setting( 'ac_realisations_preview_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    $wp_customize->add_control( 'ac_realisations_preview_text', array(
        'label'   => __( 'Texte Section Réalisations', 'armando-castanheira' ),
        'section' => 'ac_home_realisations',
        'type'    => 'textarea',
    ) );
    
    // Réalisations Image
    $wp_customize->add_setting( 'ac_realisations_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ac_realisations_image', array(
        'label'   => __( 'Image Réalisations', 'armando-castanheira' ),
        'section' => 'ac_home_realisations',
    ) ) );
    
    // ==========================================================================
    // SECTION: Page d'accueil - Savoir-Faire Preview
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_home_savoir_faire', array(
        'title'    => __( 'Accueil - Section Savoir-Faire', 'armando-castanheira' ),
        'priority' => 42,
    ) );
    
    // Savoir-Faire Preview Text
    $wp_customize->add_setting( 'ac_savoir_faire_preview_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    
    $wp_customize->add_control( 'ac_savoir_faire_preview_text', array(
        'label'   => __( 'Texte Section Savoir-Faire', 'armando-castanheira' ),
        'section' => 'ac_home_savoir_faire',
        'type'    => 'textarea',
    ) );
    
    // Savoir-Faire Image
    $wp_customize->add_setting( 'ac_savoir_faire_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ac_savoir_faire_image', array(
        'label'   => __( 'Image Savoir-Faire', 'armando-castanheira' ),
        'section' => 'ac_home_savoir_faire',
    ) ) );
    
    // ==========================================================================
    // SECTION: Hero
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_hero_section', array(
        'title'    => __( 'Accueil - Hero', 'armando-castanheira' ),
        'priority' => 39,
    ) );
    
    // Hero Video File (MP4 pour fond)
    $wp_customize->add_setting( 'ac_hero_video_file', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'ac_hero_video_file', array(
        'label'       => __( 'Vidéo de fond Hero (MP4)', 'armando-castanheira' ),
        'section'     => 'ac_hero_section',
        'description' => __( 'Vidéo en fond du hero. Format MP4 recommandé, max 10-15 Mo pour les performances.', 'armando-castanheira' ),
        'mime_type'   => 'video',
    ) ) );
    
    // Hero Background Image (fallback)
    $wp_customize->add_setting( 'ac_hero_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ac_hero_bg_image', array(
        'label'       => __( 'Image de fond Hero (fallback)', 'armando-castanheira' ),
        'section'     => 'ac_hero_section',
        'description' => __( 'Image affichée si pas de vidéo ou sur mobile.', 'armando-castanheira' ),
    ) ) );
    
    // Hero Video URL (pour le bouton play)
    $wp_customize->add_setting( 'ac_hero_video_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    
    $wp_customize->add_control( 'ac_hero_video_url', array(
        'label'       => __( 'URL Vidéo popup (YouTube/Vimeo)', 'armando-castanheira' ),
        'section'     => 'ac_hero_section',
        'type'        => 'url',
        'description' => __( 'URL de la vidéo à afficher au clic sur le bouton play (optionnel).', 'armando-castanheira' ),
    ) );
    
    // ==========================================================================
    // SECTION: Contact
    // ==========================================================================
    
    $wp_customize->add_section( 'ac_contact_section', array(
        'title'    => __( 'Informations de Contact', 'armando-castanheira' ),
        'priority' => 50,
    ) );
    
    // Phone
    $wp_customize->add_setting( 'ac_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    
    $wp_customize->add_control( 'ac_phone', array(
        'label'   => __( 'Téléphone', 'armando-castanheira' ),
        'section' => 'ac_contact_section',
        'type'    => 'text',
    ) );
    
    // Email
    $wp_customize->add_setting( 'ac_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ) );
    
    $wp_customize->add_control( 'ac_email', array(
        'label'   => __( 'Email', 'armando-castanheira' ),
        'section' => 'ac_contact_section',
        'type'    => 'email',
    ) );
    
    // Address
    $wp_customize->add_setting( 'ac_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    
    $wp_customize->add_control( 'ac_address', array(
        'label'   => __( 'Adresse', 'armando-castanheira' ),
        'section' => 'ac_contact_section',
        'type'    => 'textarea',
    ) );
}
add_action( 'customize_register', 'ac_customize_register' );

/**
 * Output custom CSS from customizer
 */
function ac_customizer_css() {
    $hero_bg = get_theme_mod( 'ac_hero_bg_image', '' );
    
    if ( ! $hero_bg ) {
        return;
    }
    
    $css = sprintf(
        '.hero__background { background-image: url(%s); }',
        esc_url( $hero_bg )
    );
    
    wp_add_inline_style( 'ac-home-style', $css );
}
add_action( 'wp_enqueue_scripts', 'ac_customizer_css', 20 );
