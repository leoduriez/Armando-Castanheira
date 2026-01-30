<?php
/**
 * Metaboxes pour le Custom Post Type Réalisations
 * 
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Ajouter les metaboxes pour les réalisations
 */
function ac_add_realisation_metaboxes() {
    add_meta_box(
        'ac_realisation_images',
        'Images de la réalisation',
        'ac_realisation_images_callback',
        'realisation',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'ac_add_realisation_metaboxes' );

/**
 * Callback pour la metabox des images
 */
function ac_realisation_images_callback( $post ) {
    wp_nonce_field( 'ac_save_realisation_meta', 'ac_realisation_meta_nonce' );
    
    $image2_id = get_post_meta( $post->ID, '_ac_realisation_image2_id', true );
    $is_compare = get_post_meta( $post->ID, '_ac_realisation_is_compare', true );
    
    ?>
    <p>
        <label>
            <input type="checkbox" name="ac_realisation_is_compare" value="1" <?php checked( $is_compare, '1' ); ?>>
            <strong>Mode comparaison Avant/Après</strong>
        </label>
        <br><small>Si coché, affiche 2 images côte à côte (avant/après)</small>
    </p>
    
    <div id="ac-compare-section" style="<?php echo $is_compare ? '' : 'display:none;'; ?>">
        <hr>
        <p><strong>Image "Avant"</strong><br><small>Utilisez l'image à la une pour l'image "Avant"</small></p>
        
        <p><strong>Image "Après"</strong></p>
        <?php ac_render_image_field( $post->ID, '_ac_realisation_image2_id', $image2_id, 'ac_realisation_image2_id' ); ?>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('input[name="ac_realisation_is_compare"]').on('change', function() {
            if ($(this).is(':checked')) {
                $('#ac-compare-section').slideDown();
            } else {
                $('#ac-compare-section').slideUp();
            }
        });
    });
    </script>
    
    <style>
    .ac-image-field { margin-top: 10px; }
    .ac-image-preview img { max-width: 100%; height: auto; margin-bottom: 10px; }
    </style>
    <?php
}

/**
 * Sauvegarder les metaboxes des réalisations
 */
function ac_save_realisation_meta( $post_id ) {
    // Vérifier le nonce
    if ( ! isset( $_POST['ac_realisation_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ac_realisation_meta_nonce'], 'ac_save_realisation_meta' ) ) {
        return;
    }
    
    // Vérifier l'autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    // Vérifier les permissions
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    // Sauvegarder le mode comparaison
    $is_compare = isset( $_POST['ac_realisation_is_compare'] ) ? '1' : '0';
    update_post_meta( $post_id, '_ac_realisation_is_compare', $is_compare );
    
    // Sauvegarder l'image 2
    if ( isset( $_POST['ac_realisation_image2_id'] ) ) {
        $image2_id = absint( $_POST['ac_realisation_image2_id'] );
        update_post_meta( $post_id, '_ac_realisation_image2_id', $image2_id );
    }
}
add_action( 'save_post_realisation', 'ac_save_realisation_meta' );

/**
 * Personnaliser les colonnes de la liste des réalisations
 */
function ac_realisation_columns( $columns ) {
    $new_columns = array();
    
    foreach ( $columns as $key => $value ) {
        $new_columns[ $key ] = $value;
        
        // Ajouter la colonne image après le titre
        if ( $key === 'title' ) {
            $new_columns['featured_image'] = __( 'Image', 'armando-castanheira' );
            $new_columns['type'] = __( 'Type', 'armando-castanheira' );
        }
    }
    
    return $new_columns;
}
add_filter( 'manage_realisation_posts_columns', 'ac_realisation_columns' );

/**
 * Afficher le contenu des colonnes personnalisées
 */
function ac_realisation_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'featured_image':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 60, 60 ) );
            } else {
                echo '—';
            }
            break;
            
        case 'type':
            $terms = get_the_terms( $post_id, 'type_realisation' );
            if ( $terms && ! is_wp_error( $terms ) ) {
                $term_names = wp_list_pluck( $terms, 'name' );
                echo implode( ', ', $term_names );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_realisation_posts_custom_column', 'ac_realisation_column_content', 10, 2 );

/**
 * Rendre les colonnes triables
 */
function ac_realisation_sortable_columns( $columns ) {
    $columns['type'] = 'type_realisation';
    return $columns;
}
add_filter( 'manage_edit-realisation_sortable_columns', 'ac_realisation_sortable_columns' );
