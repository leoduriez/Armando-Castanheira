<?php
/**
 * Custom Post Types Registration
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Type: Réalisations
 */
function ac_register_realisation_cpt() {
    $labels = array(
        'name'                  => _x( 'Réalisations', 'Post type general name', 'armando-castanheira' ),
        'singular_name'         => _x( 'Réalisation', 'Post type singular name', 'armando-castanheira' ),
        'menu_name'             => _x( 'Réalisations', 'Admin Menu text', 'armando-castanheira' ),
        'name_admin_bar'        => _x( 'Réalisation', 'Add New on Toolbar', 'armando-castanheira' ),
        'add_new'               => __( 'Ajouter', 'armando-castanheira' ),
        'add_new_item'          => __( 'Ajouter une réalisation', 'armando-castanheira' ),
        'new_item'              => __( 'Nouvelle réalisation', 'armando-castanheira' ),
        'edit_item'             => __( 'Modifier la réalisation', 'armando-castanheira' ),
        'view_item'             => __( 'Voir la réalisation', 'armando-castanheira' ),
        'all_items'             => __( 'Toutes les réalisations', 'armando-castanheira' ),
        'search_items'          => __( 'Rechercher une réalisation', 'armando-castanheira' ),
        'not_found'             => __( 'Aucune réalisation trouvée.', 'armando-castanheira' ),
        'not_found_in_trash'    => __( 'Aucune réalisation dans la corbeille.', 'armando-castanheira' ),
        'featured_image'        => _x( 'Image principale', 'Overrides the "Featured Image" phrase', 'armando-castanheira' ),
        'set_featured_image'    => _x( 'Définir l\'image principale', 'Overrides the "Set featured image" phrase', 'armando-castanheira' ),
        'remove_featured_image' => _x( 'Retirer l\'image principale', 'Overrides the "Remove featured image" phrase', 'armando-castanheira' ),
        'use_featured_image'    => _x( 'Utiliser comme image principale', 'Overrides the "Use as featured image" phrase', 'armando-castanheira' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projet', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-images-alt2',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true, // Enable Gutenberg editor
    );

    register_post_type( 'realisation', $args );
}
add_action( 'init', 'ac_register_realisation_cpt' );

/**
 * Register Custom Post Type: Matières
 */
function ac_register_matiere_cpt() {
    $labels = array(
        'name'                  => _x( 'Matières', 'Post type general name', 'armando-castanheira' ),
        'singular_name'         => _x( 'Matière', 'Post type singular name', 'armando-castanheira' ),
        'menu_name'             => _x( 'Matières', 'Admin Menu text', 'armando-castanheira' ),
        'name_admin_bar'        => _x( 'Matière', 'Add New on Toolbar', 'armando-castanheira' ),
        'add_new'               => __( 'Ajouter', 'armando-castanheira' ),
        'add_new_item'          => __( 'Ajouter une matière', 'armando-castanheira' ),
        'new_item'              => __( 'Nouvelle matière', 'armando-castanheira' ),
        'edit_item'             => __( 'Modifier la matière', 'armando-castanheira' ),
        'view_item'             => __( 'Voir la matière', 'armando-castanheira' ),
        'all_items'             => __( 'Toutes les matières', 'armando-castanheira' ),
        'search_items'          => __( 'Rechercher une matière', 'armando-castanheira' ),
        'not_found'             => __( 'Aucune matière trouvée.', 'armando-castanheira' ),
        'not_found_in_trash'    => __( 'Aucune matière dans la corbeille.', 'armando-castanheira' ),
        'featured_image'        => _x( 'Photo de la matière', 'Overrides the "Featured Image" phrase', 'armando-castanheira' ),
        'set_featured_image'    => _x( 'Définir la photo', 'Overrides the "Set featured image" phrase', 'armando-castanheira' ),
        'remove_featured_image' => _x( 'Retirer la photo', 'Overrides the "Remove featured image" phrase', 'armando-castanheira' ),
        'use_featured_image'    => _x( 'Utiliser comme photo', 'Overrides the "Use as featured image" phrase', 'armando-castanheira' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'type-matiere', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-admin-appearance',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'matiere', $args );
}
add_action( 'init', 'ac_register_matiere_cpt' );

/**
 * Flush rewrite rules on theme activation
 */
function ac_rewrite_flush() {
    ac_register_realisation_cpt();
    ac_register_matiere_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'ac_rewrite_flush' );
