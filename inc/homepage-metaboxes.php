<?php
/**
 * Custom Fields natifs WordPress pour la Page d'Accueil
 * 
 * Ce fichier enregistre des metaboxes natives WordPress
 * pour rendre le contenu de la page d'accueil administrable.
 * 
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Ajouter les metaboxes pour la page d'accueil
 */
function ac_add_homepage_metaboxes() {
    // Vérifier qu'on est bien sur la page d'accueil
    $screen = get_current_screen();
    if ( ! $screen || $screen->id !== 'page' ) {
        return;
    }
    
    // Récupérer l'ID de la page en cours d'édition
    global $post;
    if ( ! $post ) {
        return;
    }
    
    // Vérifier si c'est la page d'accueil
    $front_page_id = get_option( 'page_on_front' );
    if ( ! $front_page_id || $post->ID != $front_page_id ) {
        return;
    }
    
    add_meta_box(
        'ac_hero_section',
        'Section Hero',
        'ac_hero_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'ac_origines_section',
        'Section "Votre Marbrier"',
        'ac_origines_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'ac_realisations_section',
        'Section "Réalisations"',
        'ac_realisations_section_callback',
        'page',
        'normal',
        'high'
    );
    
    add_meta_box(
        'ac_savoir_faire_section',
        'Section "Savoir-Faire"',
        'ac_savoir_faire_section_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ac_add_homepage_metaboxes' );

/**
 * Callback pour la section Hero
 */
function ac_hero_section_callback( $post ) {
    wp_nonce_field( 'ac_save_homepage_meta', 'ac_homepage_meta_nonce' );
    
    $hero_video_url = get_post_meta( $post->ID, '_ac_hero_video_url', true );
    $hero_image_id = get_post_meta( $post->ID, '_ac_hero_image_id', true );
    $hero_logo_id = get_post_meta( $post->ID, '_ac_hero_logo_id', true );
    $hero_cta_primary_text = get_post_meta( $post->ID, '_ac_hero_cta_primary_text', true );
    $hero_cta_primary_url = get_post_meta( $post->ID, '_ac_hero_cta_primary_url', true );
    $hero_cta_secondary_text = get_post_meta( $post->ID, '_ac_hero_cta_secondary_text', true );
    $hero_cta_secondary_url = get_post_meta( $post->ID, '_ac_hero_cta_secondary_url', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ac_hero_video_url">URL Vidéo de fond (MP4)</label></th>
            <td>
                <input type="url" id="ac_hero_video_url" name="ac_hero_video_url" value="<?php echo esc_attr( $hero_video_url ); ?>" class="large-text">
                <p class="description">URL complète de la vidéo MP4 (ex: <?php echo AC_THEME_URI; ?>/assets/videos/hero.mp4)</p>
            </td>
        </tr>
        <tr>
            <th><label>Image de fond (fallback)</label></th>
            <td>
                <?php ac_render_image_field( $post->ID, '_ac_hero_image_id', $hero_image_id, 'ac_hero_image_id' ); ?>
            </td>
        </tr>
        <tr>
            <th><label>Logo Hero</label></th>
            <td>
                <?php ac_render_image_field( $post->ID, '_ac_hero_logo_id', $hero_logo_id, 'ac_hero_logo_id' ); ?>
            </td>
        </tr>
        <tr>
            <th><label for="ac_hero_cta_primary_text">Texte bouton principal</label></th>
            <td>
                <input type="text" id="ac_hero_cta_primary_text" name="ac_hero_cta_primary_text" value="<?php echo esc_attr( $hero_cta_primary_text ); ?>" class="regular-text" placeholder="Demander un devis">
            </td>
        </tr>
        <tr>
            <th><label for="ac_hero_cta_primary_url">URL bouton principal</label></th>
            <td>
                <input type="url" id="ac_hero_cta_primary_url" name="ac_hero_cta_primary_url" value="<?php echo esc_attr( $hero_cta_primary_url ); ?>" class="large-text" placeholder="/contact/">
            </td>
        </tr>
        <tr>
            <th><label for="ac_hero_cta_secondary_text">Texte bouton secondaire</label></th>
            <td>
                <input type="text" id="ac_hero_cta_secondary_text" name="ac_hero_cta_secondary_text" value="<?php echo esc_attr( $hero_cta_secondary_text ); ?>" class="regular-text" placeholder="Voir les réalisations">
            </td>
        </tr>
        <tr>
            <th><label for="ac_hero_cta_secondary_url">URL bouton secondaire</label></th>
            <td>
                <input type="url" id="ac_hero_cta_secondary_url" name="ac_hero_cta_secondary_url" value="<?php echo esc_attr( $hero_cta_secondary_url ); ?>" class="large-text" placeholder="/realisations/">
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback pour la section Origines
 */
function ac_origines_section_callback( $post ) {
    $origines_title = get_post_meta( $post->ID, '_ac_origines_title', true );
    $origines_content = get_post_meta( $post->ID, '_ac_origines_content', true );
    $origines_image_id = get_post_meta( $post->ID, '_ac_origines_image_id', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ac_origines_title">Titre de la section</label></th>
            <td>
                <input type="text" id="ac_origines_title" name="ac_origines_title" value="<?php echo esc_attr( $origines_title ); ?>" class="regular-text" placeholder="Votre Marbrier">
            </td>
        </tr>
        <tr>
            <th><label for="ac_origines_content">Contenu</label></th>
            <td>
                <?php 
                wp_editor( $origines_content, 'ac_origines_content', array(
                    'textarea_name' => 'ac_origines_content',
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                    'teeny' => false,
                ) );
                ?>
            </td>
        </tr>
        <tr>
            <th><label>Image</label></th>
            <td>
                <?php ac_render_image_field( $post->ID, '_ac_origines_image_id', $origines_image_id, 'ac_origines_image_id' ); ?>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback pour la section Réalisations
 */
function ac_realisations_section_callback( $post ) {
    $realisations_title = get_post_meta( $post->ID, '_ac_realisations_title', true );
    $realisations_content = get_post_meta( $post->ID, '_ac_realisations_content', true );
    $realisations_image_id = get_post_meta( $post->ID, '_ac_realisations_image_id', true );
    $realisations_cta_text = get_post_meta( $post->ID, '_ac_realisations_cta_text', true );
    $realisations_cta_url = get_post_meta( $post->ID, '_ac_realisations_cta_url', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ac_realisations_title">Titre de la section</label></th>
            <td>
                <input type="text" id="ac_realisations_title" name="ac_realisations_title" value="<?php echo esc_attr( $realisations_title ); ?>" class="regular-text" placeholder="Réalisations">
            </td>
        </tr>
        <tr>
            <th><label for="ac_realisations_content">Contenu</label></th>
            <td>
                <?php 
                wp_editor( $realisations_content, 'ac_realisations_content', array(
                    'textarea_name' => 'ac_realisations_content',
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                    'teeny' => false,
                ) );
                ?>
            </td>
        </tr>
        <tr>
            <th><label>Image</label></th>
            <td>
                <?php ac_render_image_field( $post->ID, '_ac_realisations_image_id', $realisations_image_id, 'ac_realisations_image_id' ); ?>
            </td>
        </tr>
        <tr>
            <th><label for="ac_realisations_cta_text">Texte du bouton</label></th>
            <td>
                <input type="text" id="ac_realisations_cta_text" name="ac_realisations_cta_text" value="<?php echo esc_attr( $realisations_cta_text ); ?>" class="regular-text" placeholder="Voir plus">
            </td>
        </tr>
        <tr>
            <th><label for="ac_realisations_cta_url">URL du bouton</label></th>
            <td>
                <input type="url" id="ac_realisations_cta_url" name="ac_realisations_cta_url" value="<?php echo esc_attr( $realisations_cta_url ); ?>" class="large-text" placeholder="/realisations/">
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Callback pour la section Savoir-Faire
 */
function ac_savoir_faire_section_callback( $post ) {
    $savoir_faire_title = get_post_meta( $post->ID, '_ac_savoir_faire_title', true );
    $savoir_faire_content = get_post_meta( $post->ID, '_ac_savoir_faire_content', true );
    $savoir_faire_image_id = get_post_meta( $post->ID, '_ac_savoir_faire_image_id', true );
    $savoir_faire_cta_text = get_post_meta( $post->ID, '_ac_savoir_faire_cta_text', true );
    $savoir_faire_cta_url = get_post_meta( $post->ID, '_ac_savoir_faire_cta_url', true );
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ac_savoir_faire_title">Titre de la section</label></th>
            <td>
                <input type="text" id="ac_savoir_faire_title" name="ac_savoir_faire_title" value="<?php echo esc_attr( $savoir_faire_title ); ?>" class="regular-text" placeholder="Une Pierre d'Exception">
            </td>
        </tr>
        <tr>
            <th><label for="ac_savoir_faire_content">Contenu</label></th>
            <td>
                <?php 
                wp_editor( $savoir_faire_content, 'ac_savoir_faire_content', array(
                    'textarea_name' => 'ac_savoir_faire_content',
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                    'teeny' => false,
                ) );
                ?>
            </td>
        </tr>
        <tr>
            <th><label>Image</label></th>
            <td>
                <?php ac_render_image_field( $post->ID, '_ac_savoir_faire_image_id', $savoir_faire_image_id, 'ac_savoir_faire_image_id' ); ?>
            </td>
        </tr>
        <tr>
            <th><label for="ac_savoir_faire_cta_text">Texte du bouton</label></th>
            <td>
                <input type="text" id="ac_savoir_faire_cta_text" name="ac_savoir_faire_cta_text" value="<?php echo esc_attr( $savoir_faire_cta_text ); ?>" class="regular-text" placeholder="Voir plus">
            </td>
        </tr>
        <tr>
            <th><label for="ac_savoir_faire_cta_url">URL du bouton</label></th>
            <td>
                <input type="url" id="ac_savoir_faire_cta_url" name="ac_savoir_faire_cta_url" value="<?php echo esc_attr( $savoir_faire_cta_url ); ?>" class="large-text" placeholder="/savoir-faire/">
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Fonction utilitaire pour afficher un champ image avec upload
 */
function ac_render_image_field( $post_id, $meta_key, $image_id, $field_name ) {
    $image_url = '';
    if ( $image_id ) {
        $image_url = wp_get_attachment_image_url( $image_id, 'medium' );
    }
    ?>
    <div class="ac-image-field">
        <input type="hidden" name="<?php echo esc_attr( $field_name ); ?>" id="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $image_id ); ?>">
        <div class="ac-image-preview" style="margin-bottom: 10px;">
            <?php if ( $image_url ) : ?>
                <img src="<?php echo esc_url( $image_url ); ?>" style="max-width: 300px; height: auto; display: block;">
            <?php endif; ?>
        </div>
        <button type="button" class="button ac-upload-image-button" data-field="<?php echo esc_attr( $field_name ); ?>">
            <?php echo $image_id ? 'Changer l\'image' : 'Ajouter une image'; ?>
        </button>
        <?php if ( $image_id ) : ?>
            <button type="button" class="button ac-remove-image-button" data-field="<?php echo esc_attr( $field_name ); ?>">Supprimer</button>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * ==========================================================================
 * INTEGRATION YOAST SEO - Champs Personnalisés Natifs WordPress
 * ==========================================================================
 * 
 * Ce filtre permet à Yoast SEO d'analyser le contenu des champs personnalisés
 * natifs de WordPress utilisés sur la page d'accueil.
 */

/**
 * Ajouter le contenu des champs personnalisés à l'analyse Yoast SEO
 * 
 * @param string $content Le contenu existant de la page
 * @param WP_Post $post L'objet post
 * @return string Le contenu enrichi pour l'analyse SEO
 */
function ac_add_custom_fields_to_yoast_analysis( $content, $post ) {
    // Vérifier si c'est la page d'accueil
    $front_page_id = get_option( 'page_on_front' );
    if ( ! $front_page_id || $post->ID != $front_page_id ) {
        return $content;
    }
    
    $additional_content = '';
    
    // ==========================================================================
    // SECTION HERO - Boutons CTA
    // ==========================================================================
    $hero_cta_primary_text = get_post_meta( $post->ID, '_ac_hero_cta_primary_text', true );
    $hero_cta_secondary_text = get_post_meta( $post->ID, '_ac_hero_cta_secondary_text', true );
    
    if ( $hero_cta_primary_text ) {
        $additional_content .= '<p>' . esc_html( $hero_cta_primary_text ) . '</p>';
    }
    if ( $hero_cta_secondary_text ) {
        $additional_content .= '<p>' . esc_html( $hero_cta_secondary_text ) . '</p>';
    }
    
    // ==========================================================================
    // SECTION ORIGINES (Votre Marbrier)
    // ==========================================================================
    $origines_title = get_post_meta( $post->ID, '_ac_origines_title', true );
    $origines_content = get_post_meta( $post->ID, '_ac_origines_content', true );
    
    if ( $origines_title ) {
        $additional_content .= '<h2>' . esc_html( $origines_title ) . '</h2>';
    }
    if ( $origines_content ) {
        $additional_content .= wp_kses_post( wpautop( $origines_content ) );
    }
    
    // ==========================================================================
    // SECTION VALEURS (Champs personnalisés natifs)
    // ==========================================================================
    $valeurs_title = get_post_meta( $post->ID, 'ac_valeurs_title', true );
    $valeurs_labels = get_post_meta( $post->ID, 'ac_valeurs_labels', true );
    
    $additional_content .= '<h2>' . esc_html( $valeurs_title ?: 'Mes Valeurs' ) . '</h2>';
    
    if ( $valeurs_labels ) {
        $labels = array_map( 'trim', explode( '|', $valeurs_labels ) );
        $additional_content .= '<p>' . esc_html( implode( ', ', $labels ) ) . '</p>';
    } else {
        $additional_content .= '<p>Précision, Passion, Durabilité, Respect des matériaux, Transparence</p>';
    }
    
    // ==========================================================================
    // SECTION REALISATIONS
    // ==========================================================================
    $realisations_title = get_post_meta( $post->ID, '_ac_realisations_title', true );
    $realisations_content = get_post_meta( $post->ID, '_ac_realisations_content', true );
    $realisations_cta_text = get_post_meta( $post->ID, '_ac_realisations_cta_text', true );
    
    if ( $realisations_title ) {
        $additional_content .= '<h2>' . esc_html( $realisations_title ) . '</h2>';
    }
    if ( $realisations_content ) {
        $additional_content .= wp_kses_post( wpautop( $realisations_content ) );
    }
    if ( $realisations_cta_text ) {
        $additional_content .= '<p><a href="' . esc_url( home_url( '/marbre-sur-mesure/' ) ) . '">' . esc_html( $realisations_cta_text ) . '</a></p>';
    }
    
    // ==========================================================================
    // SECTION MATIERES (Champs personnalisés natifs)
    // ==========================================================================
    $matieres_title = get_post_meta( $post->ID, 'ac_matieres_title', true );
    $matieres_labels = get_post_meta( $post->ID, 'ac_matieres_labels', true );
    $matieres_cta_text = get_post_meta( $post->ID, 'ac_matieres_cta_text', true );
    
    $additional_content .= '<h2>' . esc_html( $matieres_title ?: 'Découvrir les Matières' ) . '</h2>';
    
    if ( $matieres_labels ) {
        $labels = array_map( 'trim', explode( '|', $matieres_labels ) );
        $additional_content .= '<p>Nous travaillons : ' . esc_html( implode( ', ', $labels ) ) . '</p>';
    } else {
        $additional_content .= '<p>Nous travaillons le Marbre, le Granite et le Quartzite.</p>';
    }
    
    if ( $matieres_cta_text ) {
        $additional_content .= '<p><a href="' . esc_url( home_url( '/marbre/' ) ) . '">' . esc_html( $matieres_cta_text ) . '</a></p>';
    }
    
    // ==========================================================================
    // SECTION SAVOIR-FAIRE
    // ==========================================================================
    $savoir_faire_title = get_post_meta( $post->ID, '_ac_savoir_faire_title', true );
    $savoir_faire_content = get_post_meta( $post->ID, '_ac_savoir_faire_content', true );
    $savoir_faire_cta_text = get_post_meta( $post->ID, '_ac_savoir_faire_cta_text', true );
    
    if ( $savoir_faire_title ) {
        $additional_content .= '<h2>' . esc_html( $savoir_faire_title ) . '</h2>';
    }
    if ( $savoir_faire_content ) {
        $additional_content .= wp_kses_post( wpautop( $savoir_faire_content ) );
    }
    if ( $savoir_faire_cta_text ) {
        $additional_content .= '<p><a href="' . esc_url( home_url( '/artisans-marbrier-paris/' ) ) . '">' . esc_html( $savoir_faire_cta_text ) . '</a></p>';
    }
    
    return $content . $additional_content;
}

// Hook principal Yoast SEO pour l'analyse de contenu
add_filter( 'wpseo_pre_analysis_post_content', 'ac_add_custom_fields_to_yoast_analysis', 10, 2 );

/**
 * Filtre alternatif pour les versions récentes de Yoast SEO
 * Utilise le hook 'the_seo_framework_fetched_description_excerpt' si Yoast ne fonctionne pas
 */
function ac_yoast_content_for_seo_analysis( $content ) {
    global $post;
    
    if ( ! $post ) {
        return $content;
    }
    
    return ac_add_custom_fields_to_yoast_analysis( $content, $post );
}

// Hook secondaire pour compatibilité
add_filter( 'wpseo_metabox_entries', 'ac_yoast_content_for_seo_analysis', 10, 1 );

/**
 * Ajouter les champs personnalisés à l'indexation Yoast
 * Ce filtre expose les meta_keys pour que Yoast puisse les indexer
 */
function ac_register_yoast_indexable_custom_fields( $keys ) {
    $homepage_keys = array(
        // Champs avec underscore (metaboxes)
        '_ac_hero_cta_primary_text',
        '_ac_hero_cta_secondary_text',
        '_ac_origines_title',
        '_ac_origines_content',
        '_ac_realisations_title',
        '_ac_realisations_content',
        '_ac_realisations_cta_text',
        '_ac_savoir_faire_title',
        '_ac_savoir_faire_content',
        '_ac_savoir_faire_cta_text',
        // Champs natifs (sans underscore)
        'ac_valeurs_title',
        'ac_valeurs_labels',
        'ac_matieres_title',
        'ac_matieres_labels',
        'ac_matieres_cta_text',
    );
    
    return array_merge( $keys, $homepage_keys );
}
add_filter( 'wpseo_indexable_forced_included_post_meta_keys', 'ac_register_yoast_indexable_custom_fields' );

/**
 * Sauvegarder les metaboxes
 */
function ac_save_homepage_meta( $post_id ) {
    // Vérifier le nonce
    if ( ! isset( $_POST['ac_homepage_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ac_homepage_meta_nonce'], 'ac_save_homepage_meta' ) ) {
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
    
    // Liste des champs à sauvegarder
    $fields = array(
        // Hero
        'ac_hero_video_url',
        'ac_hero_image_id',
        'ac_hero_logo_id',
        'ac_hero_cta_primary_text',
        'ac_hero_cta_primary_url',
        'ac_hero_cta_secondary_text',
        'ac_hero_cta_secondary_url',
        // Origines
        'ac_origines_title',
        'ac_origines_content',
        'ac_origines_image_id',
        // Réalisations
        'ac_realisations_title',
        'ac_realisations_content',
        'ac_realisations_image_id',
        'ac_realisations_cta_text',
        'ac_realisations_cta_url',
        // Savoir-Faire
        'ac_savoir_faire_title',
        'ac_savoir_faire_content',
        'ac_savoir_faire_image_id',
        'ac_savoir_faire_cta_text',
        'ac_savoir_faire_cta_url',
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $value = $_POST[ $field ];
            
            // Sanitize selon le type de champ
            if ( strpos( $field, '_content' ) !== false ) {
                $value = wp_kses_post( $value );
            } elseif ( strpos( $field, '_url' ) !== false ) {
                $value = esc_url_raw( $value );
            } elseif ( strpos( $field, '_id' ) !== false ) {
                $value = absint( $value );
            } else {
                $value = sanitize_text_field( $value );
            }
            
            update_post_meta( $post_id, '_' . $field, $value );
        }
    }
}
add_action( 'save_post', 'ac_save_homepage_meta' );

/**
 * Enqueue scripts pour l'upload d'images
 */
function ac_enqueue_admin_scripts( $hook ) {
    if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
        return;
    }
    
    wp_enqueue_media();
    wp_enqueue_script( 'ac-admin-metabox', AC_THEME_URI . '/assets/js/admin-metabox.js', array( 'jquery' ), AC_THEME_VERSION, true );
}
add_action( 'admin_enqueue_scripts', 'ac_enqueue_admin_scripts' );
