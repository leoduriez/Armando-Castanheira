<?php
/**
 * Custom Taxonomies Registration
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Taxonomy: Type de Réalisation
 */
function ac_register_type_realisation_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Types de réalisation', 'Taxonomy general name', 'armando-castanheira' ),
        'singular_name'              => _x( 'Type de réalisation', 'Taxonomy singular name', 'armando-castanheira' ),
        'search_items'               => __( 'Rechercher un type', 'armando-castanheira' ),
        'all_items'                  => __( 'Tous les types', 'armando-castanheira' ),
        'parent_item'                => __( 'Type parent', 'armando-castanheira' ),
        'parent_item_colon'          => __( 'Type parent :', 'armando-castanheira' ),
        'edit_item'                  => __( 'Modifier le type', 'armando-castanheira' ),
        'update_item'                => __( 'Mettre à jour le type', 'armando-castanheira' ),
        'add_new_item'               => __( 'Ajouter un nouveau type', 'armando-castanheira' ),
        'new_item_name'              => __( 'Nom du nouveau type', 'armando-castanheira' ),
        'menu_name'                  => __( 'Types', 'armando-castanheira' ),
        'not_found'                  => __( 'Aucun type trouvé.', 'armando-castanheira' ),
        'back_to_items'              => __( '← Retour aux types', 'armando-castanheira' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Like categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'type-realisation', 'with_front' => false ),
    );

    register_taxonomy( 'type_realisation', array( 'realisation' ), $args );

    // Insert default terms on first activation
    ac_insert_default_realisation_types();
}
add_action( 'init', 'ac_register_type_realisation_taxonomy' );

/**
 * Insert default realisation types
 */
function ac_insert_default_realisation_types() {
    $default_terms = array(
        'cuisine'       => 'Cuisine',
        'salle-de-bain' => 'Salle de bain',
        'autres'        => 'Autres',
    );

    foreach ( $default_terms as $slug => $name ) {
        if ( ! term_exists( $slug, 'type_realisation' ) ) {
            wp_insert_term( $name, 'type_realisation', array( 'slug' => $slug ) );
        }
    }
}

/**
 * Register Taxonomy: Type de Matière
 */
function ac_register_type_matiere_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Types de matière', 'Taxonomy general name', 'armando-castanheira' ),
        'singular_name'              => _x( 'Type de matière', 'Taxonomy singular name', 'armando-castanheira' ),
        'search_items'               => __( 'Rechercher un type', 'armando-castanheira' ),
        'all_items'                  => __( 'Tous les types', 'armando-castanheira' ),
        'parent_item'                => __( 'Type parent', 'armando-castanheira' ),
        'parent_item_colon'          => __( 'Type parent :', 'armando-castanheira' ),
        'edit_item'                  => __( 'Modifier le type', 'armando-castanheira' ),
        'update_item'                => __( 'Mettre à jour le type', 'armando-castanheira' ),
        'add_new_item'               => __( 'Ajouter un nouveau type', 'armando-castanheira' ),
        'new_item_name'              => __( 'Nom du nouveau type', 'armando-castanheira' ),
        'menu_name'                  => __( 'Types', 'armando-castanheira' ),
        'not_found'                  => __( 'Aucun type trouvé.', 'armando-castanheira' ),
        'back_to_items'              => __( '← Retour aux types', 'armando-castanheira' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'type-matiere', 'with_front' => false ),
    );

    register_taxonomy( 'type_matiere', array( 'matiere' ), $args );

    // Insert default terms on first activation
    ac_insert_default_matiere_types();
}
add_action( 'init', 'ac_register_type_matiere_taxonomy' );

/**
 * Insert default matière types
 */
function ac_insert_default_matiere_types() {
    $default_terms = array(
        'marbre'    => 'Marbre',
        'granite'   => 'Granite',
        'quartzite' => 'Quartzite',
    );

    foreach ( $default_terms as $slug => $name ) {
        if ( ! term_exists( $slug, 'type_matiere' ) ) {
            wp_insert_term( $name, 'type_matiere', array( 'slug' => $slug ) );
        }
    }
}
