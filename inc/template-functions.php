<?php
/**
 * Fonctions de template et helpers
 * 
 * Ce fichier contient des fonctions utilitaires pour les templates :
 * - Gestion du logo
 * - Récupération des réalisations et matières
 * - Affichage des filtres
 * - Gestion des images
 * - Liens réseaux sociaux
 * - Fil d'Ariane (breadcrumb)
 *
 * @package Armando_Castanheira
 */

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Récupérer l'URL du logo personnalisé
 * 
 * @return string URL du logo
 */
function ac_get_logo_url() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    
    if ( $custom_logo_id ) {
        return wp_get_attachment_image_url( $custom_logo_id, 'full' );
    }
    
    return AC_THEME_URI . '/assets/images/logo.svg';
}

/**
 * Afficher le logo personnalisé
 * 
 * @param string $class Classes CSS supplémentaires
 */
function ac_display_logo( $class = '' ) {
    $logo_url = ac_get_logo_url();
    $site_name = get_bloginfo( 'name' );
    
    printf(
        '<a href="%s" class="site-logo %s" rel="home"><img src="%s" alt="%s"></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( $class ),
        esc_url( $logo_url ),
        esc_attr( $site_name )
    );
}

/**
 * Récupérer les réalisations par type
 * 
 * @param string $type Type de réalisation (slug de la taxonomie)
 * @param int $limit Nombre maximum de résultats (-1 pour tous)
 * @return WP_Query Objet de requête WordPress
 */
function ac_get_realisations( $type = '', $limit = -1 ) {
    $args = array(
        'post_type'      => 'realisation',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if ( ! empty( $type ) && $type !== 'tous' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'type_realisation',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        );
    }

    return new WP_Query( $args );
}

/**
 * Récupérer les matières par type
 * 
 * @param string $type Type de matière (slug de la taxonomie)
 * @param int $limit Nombre maximum de résultats (-1 pour tous)
 * @return WP_Query Objet de requête WordPress
 */
function ac_get_matieres( $type = '', $limit = -1 ) {
    $args = array(
        'post_type'      => 'matiere',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    );

    if ( ! empty( $type ) && $type !== 'toutes' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'type_matiere',
                'field'    => 'slug',
                'terms'    => $type,
            ),
        );
    }

    return new WP_Query( $args );
}

/**
 * Récupérer tous les termes d'une taxonomie
 * 
 * @param string $taxonomy Nom de la taxonomie
 * @return array|WP_Error Liste des termes
 */
function ac_get_filter_terms( $taxonomy ) {
    return get_terms( array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ) );
}

/**
 * Afficher la barre de filtres pour les réalisations ou matières
 * 
 * @param string $taxonomy Nom de la taxonomie
 * @param string $all_label Label du bouton "Tous"
 */
function ac_display_filter_bar( $taxonomy, $all_label = 'Tous' ) {
    $terms = ac_get_filter_terms( $taxonomy );
    
    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return;
    }
    
    $output = '<nav class="filter-bar" aria-label="Filtrer les éléments">';
    $output .= '<ul class="filter-list">';
    $output .= sprintf(
        '<li><button class="filter-btn active" data-filter="tous">%s</button></li>',
        esc_html( $all_label )
    );
    
    foreach ( $terms as $term ) {
        $output .= sprintf(
            '<li><button class="filter-btn" data-filter="%s">%s</button></li>',
            esc_attr( $term->slug ),
            esc_html( $term->name )
        );
    }
    
    $output .= '</ul>';
    $output .= '</nav>';
    
    echo $output;
}

/**
 * Récupérer l'URL de l'image à la une avec fallback
 * 
 * @param int $post_id ID de l'article
 * @param string $size Taille de l'image
 * @return string URL de l'image
 */
function ac_get_thumbnail_url( $post_id, $size = 'large' ) {
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, $size );
    }
    
    // Image de remplacement par défaut
    return AC_THEME_URI . '/assets/images/placeholder.jpg';
}

/**
 * Afficher une image responsive avec lazy loading
 * 
 * @param int $post_id ID de l'article
 * @param string $size Taille de l'image
 * @param string $class Classes CSS
 */
function ac_display_image( $post_id, $size = 'large', $class = '' ) {
    if ( has_post_thumbnail( $post_id ) ) {
        echo get_the_post_thumbnail( $post_id, $size, array(
            'class'   => $class,
            'loading' => 'lazy',
        ) );
    } else {
        printf(
            '<img src="%s" alt="" class="%s" loading="lazy">',
            esc_url( AC_THEME_URI . '/assets/images/placeholder.jpg' ),
            esc_attr( $class )
        );
    }
}

/**
 * Tronquer un texte à une longueur spécifique
 * 
 * @param string $text Texte à tronquer
 * @param int $length Longueur maximale
 * @param string $suffix Suffixe à ajouter
 * @return string Texte tronqué
 */
function ac_truncate_text( $text, $length = 150, $suffix = '...' ) {
    $text = wp_strip_all_tags( $text );
    
    if ( strlen( $text ) <= $length ) {
        return $text;
    }
    
    $text = substr( $text, 0, $length );
    $text = substr( $text, 0, strrpos( $text, ' ' ) );
    
    return $text . $suffix;
}

/**
 * Récupérer les liens des réseaux sociaux
 * Les URLs sont définies dans le Customizer WordPress
 * 
 * @return array Tableau associatif des liens sociaux
 */
function ac_get_social_links() {
    return array(
        'instagram' => get_theme_mod( 'ac_instagram_url', '' ),
        'facebook'  => get_theme_mod( 'ac_facebook_url', '' ),
    );
}

/**
 * Afficher les icônes des réseaux sociaux
 * Génère le HTML avec les icônes SVG
 */
function ac_display_social_icons() {
    $social_links = ac_get_social_links();
    
    $output = '<div class="social-icons">';
    
    if ( ! empty( $social_links['instagram'] ) ) {
        $output .= sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
            </a>',
            esc_url( $social_links['instagram'] )
        );
    }
    
    if ( ! empty( $social_links['facebook'] ) ) {
        $output .= sprintf(
            '<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
            </a>',
            esc_url( $social_links['facebook'] )
        );
    }
    
    $output .= '</div>';
    
    echo $output;
}

/**
 * Navigation fil d'Ariane (breadcrumb)
 * Affiche le chemin de navigation pour améliorer l'UX et le SEO
 */
function ac_breadcrumb() {
    if ( is_front_page() ) {
        return;
    }
    
    $output = '<nav class="breadcrumb" aria-label="Fil d\'Ariane">';
    $output .= '<ol class="breadcrumb-list">';
    $output .= sprintf(
        '<li><a href="%s">Accueil</a></li>',
        esc_url( home_url( '/' ) )
    );
    
    if ( is_page() ) {
        $output .= sprintf( '<li><span aria-current="page">%s</span></li>', get_the_title() );
    } elseif ( is_singular( 'realisation' ) ) {
        $output .= sprintf(
            '<li><a href="%s">Réalisations</a></li>',
            esc_url( get_post_type_archive_link( 'realisation' ) )
        );
        $output .= sprintf( '<li><span aria-current="page">%s</span></li>', get_the_title() );
    } elseif ( is_singular( 'matiere' ) ) {
        $output .= sprintf(
            '<li><a href="%s">Matières</a></li>',
            esc_url( get_post_type_archive_link( 'matiere' ) )
        );
        $output .= sprintf( '<li><span aria-current="page">%s</span></li>', get_the_title() );
    } elseif ( is_post_type_archive( 'realisation' ) ) {
        $output .= '<li><span aria-current="page">Réalisations</span></li>';
    } elseif ( is_post_type_archive( 'matiere' ) ) {
        $output .= '<li><span aria-current="page">Matières</span></li>';
    }
    
    $output .= '</ol>';
    $output .= '</nav>';
    
    echo $output;
}
