<?php
/**
 * Archive template for Matières custom post type - VERSION PROPRE
 * 
 * Cette version ne contient que le header, le système de filtre et le footer.
 * Prête à recevoir du nouveau contenu.
 *
 * @package Armando_Castanheira
 */

get_header();

// Get filter from URL if present
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
?>

<main id="main-content" class="site-main page-matieres page-matieres--empty">
    
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
    
    <!-- Zone de contenu vide - Prête à recevoir du nouveau contenu -->
    <section class="section-content-empty">
        <div class="container">
            <div class="content-placeholder">
                <!-- Votre nouveau contenu ira ici -->
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
