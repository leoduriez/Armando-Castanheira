<?php
/**
 * Template Name: Réalisations
 * 
 * Template pour la page Réalisations avec Advanced Custom Fields
 * Structure calquée sur template-matieres.php
 *
 * @package Armando_Castanheira
 */

get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>

<main id="main-content" class="site-main page-realisations">
    
    <!-- Contenu principal pour Yoast SEO -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- ========== PAGE HEADER ========== -->
    <header class="page-header page-header--realisations">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Réalisations', 'armando-castanheira' ); ?></h1>
        </div>
    </header>
    
    <!-- ========== FILTRES ========== -->
    <?php 
    $current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
    ?>
    <section class="section-filter">
        <div class="container">
            <nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrer les réalisations', 'armando-castanheira' ); ?>">
                <ul class="filter-bar__list">
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( remove_query_arg( 'type' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'tous' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Tous', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'cuisine' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'cuisine' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Cuisine', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'salle-de-bain' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'salle-de-bain' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Salle de bain', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'autre' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'autre' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Autre', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    
    <!-- ========== RÉALISATIONS SECTION ========== -->
    <?php
    // Vérifier si ACF est disponible
    if ( ! function_exists( 'get_field' ) ) {
        echo '<p>ACF non disponible</p>';
    }
    
    // Récupérer tous les champs ACF de la page en une seule requête
    $page_id = get_the_ID();
    $all_fields = get_fields( $page_id );
    
    // Liste des réalisations avec leurs titres par défaut
    $realisations_data = array(
        1  => array( 'titre_defaut' => 'BAR ONYX MIEL', 'categorie_defaut' => 'cuisine' ),
        2  => array( 'titre_defaut' => 'PLAN DE TRAVAIL ET CRÉDENCE', 'categorie_defaut' => 'cuisine' ),
        3  => array( 'titre_defaut' => 'PLAN DE TRAVAIL ET CRÉDENCE', 'categorie_defaut' => 'cuisine' ),
        4  => array( 'titre_defaut' => 'PLAN DE TRAVAIL ET CRÉDENCE', 'categorie_defaut' => 'cuisine' ),
        5  => array( 'titre_defaut' => 'FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER', 'categorie_defaut' => 'salle-de-bain' ),
        6  => array( 'titre_defaut' => 'FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER', 'categorie_defaut' => 'salle-de-bain' ),
        7  => array( 'titre_defaut' => 'RÉNOVATION ESCALIER', 'categorie_defaut' => 'autre', 'is_compare_defaut' => true ),
        8  => array( 'titre_defaut' => 'RÉNOVATION TABLE', 'categorie_defaut' => 'autre', 'is_compare_defaut' => true ),
        9  => array( 'titre_defaut' => 'INSTALLATION SOL DAMIER', 'categorie_defaut' => 'autre' ),
        10 => array( 'titre_defaut' => 'RÉNOVATION SOL EN MARBRE MOSAÏQUE', 'categorie_defaut' => 'autre' ),
        11 => array( 'titre_defaut' => 'RÉNOVATION SOL', 'categorie_defaut' => 'autre' ),
        12 => array( 'titre_defaut' => 'INSTALLATION PLAN DE CUISINE', 'categorie_defaut' => 'cuisine' ),
        13 => array( 'titre_defaut' => 'RÉNOVATION SOL MARBRE', 'categorie_defaut' => 'autre' ),
        14 => array( 'titre_defaut' => 'RÉNOVATION SOL', 'categorie_defaut' => 'autre' ),
    );
    
    // Construire le tableau des réalisations depuis les champs ACF
    $realisations = array();
    foreach ( $realisations_data as $index => $data ) {
        // Récupérer depuis le tableau déjà chargé
        $titre = isset( $all_fields['realisation_' . $index . '_titre'] ) && ! empty( $all_fields['realisation_' . $index . '_titre'] ) 
            ? $all_fields['realisation_' . $index . '_titre'] 
            : $data['titre_defaut'];
        $image = isset( $all_fields['realisation_' . $index . '_image'] ) ? $all_fields['realisation_' . $index . '_image'] : null;
        $image2 = isset( $all_fields['realisation_' . $index . '_image2'] ) ? $all_fields['realisation_' . $index . '_image2'] : null;
        $description = isset( $all_fields['realisation_' . $index . '_description'] ) ? $all_fields['realisation_' . $index . '_description'] : '';
        $categorie = isset( $all_fields['realisation_' . $index . '_categorie'] ) && ! empty( $all_fields['realisation_' . $index . '_categorie'] ) 
            ? $all_fields['realisation_' . $index . '_categorie'] 
            : $data['categorie_defaut'];
        $is_compare = isset( $all_fields['realisation_' . $index . '_is_compare'] ) 
            ? $all_fields['realisation_' . $index . '_is_compare'] 
            : ( isset( $data['is_compare_defaut'] ) ? $data['is_compare_defaut'] : false );
        
        // Gestion des images
        $image_url = '';
        $image2_url = '';
        if ( ! empty( $image ) ) {
            $image_url = is_array( $image ) ? $image['url'] : $image;
        }
        if ( ! empty( $image2 ) ) {
            $image2_url = is_array( $image2 ) ? $image2['url'] : $image2;
        }
        
        // N'ajouter que si l'image principale existe
        if ( ! empty( $image_url ) || ! empty( $description ) ) {
            $realisations[] = array(
                'index'       => $index,
                'titre'       => $titre,
                'categorie'   => $categorie,
                'image'       => $image_url,
                'image2'      => $image2_url,
                'description' => $description,
                'is_compare'  => $is_compare,
            );
        }
    }
    
    // Filtrer par catégorie si nécessaire
    if ( $current_filter !== 'tous' ) {
        $realisations = array_filter( $realisations, function( $r ) use ( $current_filter ) {
            return $r['categorie'] === $current_filter;
        });
        $realisations = array_values( $realisations );
    }
    
    // Calculer le nombre de vectors
    $nb_realisations = count( $realisations );
    if ( $nb_realisations >= 12 ) {
        $nb_vectors = 8;
    } elseif ( $nb_realisations >= 8 ) {
        $nb_vectors = 6;
    } elseif ( $nb_realisations >= 4 ) {
        $nb_vectors = 4;
    } else {
        $nb_vectors = 2;
    }
    ?>
    
    <section class="section-realisations" data-vectors="<?php echo esc_attr( $nb_vectors ); ?>">
        <?php 
        // Générer les vectors décoratifs
        for ( $i = 1; $i <= $nb_vectors; $i++ ) :
            $side = ( $i % 2 === 1 ) ? 'left' : 'right';
            $vector = ( $i % 2 === 1 ) ? 'vector2.webp' : 'vector1.webp';
        ?>
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/' . $vector ); ?>" alt="" class="decor decor--<?php echo $side; ?> decor--pos-<?php echo $i; ?>" aria-hidden="true">
        <?php endfor; ?>
        
        <div class="container">
            <div class="realisations-list" aria-live="polite">
                <?php 
                if ( ! empty( $realisations ) ) :
                    $index = 0;
                    foreach ( $realisations as $realisation ) :
                        $index++;
                        $is_reversed = ( $index % 2 === 0 );
                        $reversed_class = $is_reversed ? 'realisation-item--reversed' : '';
                        $escalier_class = ( strpos( strtolower( $realisation['titre'] ), 'escalier' ) !== false ) ? 'realisation-item--escalier' : '';
                        
                        // Alt text optimisé pour SEO
                        $alt_text = 'Réalisation marbre granit - ' . $realisation['titre'];
                ?>
                    <article class="realisation-item <?php echo esc_attr( $reversed_class . ' ' . $escalier_class ); ?>" data-animate="fade-up">
                        <div class="realisation-item__content">
                            <h2 class="realisation-item__title"><?php echo esc_html( $realisation['titre'] ); ?></h2>
                            <div class="realisation-item__description">
                                <?php echo wp_kses_post( $realisation['description'] ); ?>
                            </div>
                        </div>
                        <div class="realisation-item__image <?php echo $realisation['is_compare'] && ! empty( $realisation['image2'] ) ? 'realisation-item__image--compare' : ''; ?>">
                            <?php if ( $realisation['is_compare'] && ! empty( $realisation['image2'] ) ) : ?>
                                <img src="<?php echo esc_url( $realisation['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $alt_text ); ?> - Avant" 
                                     class="realisation-item__img"
                                     loading="lazy">
                                <img src="<?php echo esc_url( $realisation['image2'] ); ?>" 
                                     alt="<?php echo esc_attr( $alt_text ); ?> - Après" 
                                     class="realisation-item__img"
                                     loading="lazy">
                            <?php elseif ( ! empty( $realisation['image'] ) ) : ?>
                                <img src="<?php echo esc_url( $realisation['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $alt_text ); ?>" 
                                     class="realisation-item__img"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                    </article>
                <?php 
                    endforeach;
                else :
                ?>
                    <p class="no-results"><?php esc_html_e( 'Aucune réalisation trouvée.', 'armando-castanheira' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
</main>

<?php 
    endwhile;
endif;

get_footer(); 
?>
