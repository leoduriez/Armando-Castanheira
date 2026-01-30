<?php
/**
 * Archive template for Matières custom post type
 * 
 * Galerie de produits avec grille 2x2, filtres et pagination "Voir Plus"
 *
 * @package Armando_Castanheira
 */

get_header();

// Get filter from URL if present
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';

// Query args for matières
$query_args = array(
    'post_type'      => 'matiere',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Add meta query for category filter if needed
if ( $current_filter !== 'tous' ) {
    $query_args['meta_query'] = array(
        array(
            'key'     => 'matiere_categorie',
            'value'   => $current_filter,
            'compare' => '='
        )
    );
}

// Execute query
$matieres_query = new WP_Query( $query_args );
$matieres_data = array();

// Build matieres data array from ACF fields
if ( $matieres_query->have_posts() ) {
    while ( $matieres_query->have_posts() ) {
        $matieres_query->the_post();
        
        $matiere_image = get_field( 'matiere_image' );
        $matiere_description = get_field( 'matiere_description' );
        $matiere_categorie = get_field( 'matiere_categorie' );
        
        // Handle image field - can be array or string
        $image_url = '';
        if ( is_array( $matiere_image ) && ! empty( $matiere_image['url'] ) ) {
            $image_url = $matiere_image['url'];
        } elseif ( is_string( $matiere_image ) && ! empty( $matiere_image ) ) {
            $image_url = $matiere_image;
        }
        
        $matieres_data[] = array(
            'title'       => get_the_title(),
            'image'       => $image_url,
            'category'    => $matiere_categorie ?: 'autres',
            'description' => $matiere_description ?: '',
        );
    }
    wp_reset_postdata();
}

// No fallback needed - data comes from ACF

$total_items = count( $matieres_data );
$items_per_page = 12;
?>

<main id="main-content" class="site-main page-matieres">
    
    <!-- Page Header -->
    <header class="page-header page-header--matieres">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Matières', 'armando-castanheira' ); ?></h1>
        </div>
    </header>
    
    <!-- Filter Bar -->
    <section class="section-filter">
        <div class="container">
            <nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrer les matières', 'armando-castanheira' ); ?>">
                <ul class="filter-bar__list">
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( remove_query_arg( 'type' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'tous' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Tous', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'marbre' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'marbre' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Marbre', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'granit' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'granit' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Granit', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'quartzite' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'quartzite' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Quartzite', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    
    <!-- Galerie de Matières -->
    <section class="section-matieres-gallery">
        <div class="container">
            <div class="matieres-grid" id="matieres-grid" data-items-per-page="<?php echo esc_attr( $items_per_page ); ?>">
                <?php 
                $index = 0;
                foreach ( $matieres_data as $matiere ) :
                    $hidden_class = ( $index >= $items_per_page ) ? 'matiere-item--hidden' : '';
                ?>
                    <article class="matiere-item <?php echo esc_attr( $hidden_class ); ?>" data-index="<?php echo esc_attr( $index ); ?>">
                        <div class="matiere-item__card" onclick="this.classList.toggle('active')">
                            <!-- Texte en arrière-plan -->
                            <div class="matiere-item__content">
                                <p class="matiere-item__content-text"><?php echo esc_html( $matiere['description'] ); ?></p>
                            </div>
                            <!-- Image au premier plan -->
                            <div class="matiere-item__image">
                                <img src="<?php echo esc_url( $matiere['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $matiere['title'] ); ?>" 
                                     loading="lazy">
                            </div>
                        </div>
                        <h2 class="matiere-item__title"><?php echo esc_html( $matiere['title'] ); ?></h2>
                    </article>
                <?php 
                    $index++;
                endforeach;
                ?>
            </div>
            
            <?php if ( $total_items > $items_per_page ) : ?>
            <div class="voir-plus-wrapper">
                <button type="button" class="btn btn--voir-plus" id="voir-plus-btn" data-total="<?php echo esc_attr( $total_items ); ?>">
                    <?php esc_html_e( 'Voir Plus', 'armando-castanheira' ); ?>
                </button>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
</main>

<?php
get_footer();
