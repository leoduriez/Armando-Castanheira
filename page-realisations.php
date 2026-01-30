<?php
/**
 * Page template for Réalisations
 * Automatically used for page with slug "realisations"
 *
 * @package Armando_Castanheira
 */

get_header();

// Démarrer la boucle WordPress pour Yoast SEO
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

// Get filter from URL if present
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';

// Query args for réalisations
$query_args = array(
    'post_type'      => 'realisation',
    'posts_per_page' => -1,
    'post_status'    => array( 'publish', 'future' ), // Inclut les publications planifiées
    'orderby'        => 'ID',
    'order'          => 'DESC', // Les réalisations créées en dernier apparaissent en premier
);

// Add taxonomy filter if needed
if ( $current_filter !== 'tous' ) {
    $query_args['tax_query'] = array(
        array(
            'taxonomy' => 'type_realisation',
            'field'    => 'slug',
            'terms'    => $current_filter === 'autre' ? 'autres' : $current_filter,
        ),
    );
}

// Get réalisations from database
$realisations_query = new WP_Query( $query_args );
$realisations_data = array();

if ( $realisations_query->have_posts() ) {
    while ( $realisations_query->have_posts() ) {
        $realisations_query->the_post();
        
        $realisation_id = get_the_ID();
        
        // ACF fields (avec fallback sur get_post_meta pour compatibilité)
        $is_compare = get_field( 'realisation_is_compare', $realisation_id );
        if ( $is_compare === null || $is_compare === '' ) {
            $is_compare = get_post_meta( $realisation_id, '_ac_realisation_is_compare', true ) === '1';
        }
        
        $image2 = get_field( 'realisation_image2', $realisation_id );
        if ( ! $image2 ) {
            $image2_id = get_post_meta( $realisation_id, '_ac_realisation_image2_id', true );
            if ( $image2_id ) {
                $image2 = array( 'url' => wp_get_attachment_image_url( $image2_id, 'full' ) );
            }
        }
        
        $item = array(
            'title'       => get_the_title(),
            'description' => get_the_content(),
            'image'       => get_the_post_thumbnail_url( $realisation_id, 'full' ),
            'is_compare'  => (bool) $is_compare,
        );
        
        if ( $is_compare && $image2 && ! empty( $image2['url'] ) ) {
            $item['image2'] = $image2['url'];
        }
        
        // Get category for legacy compatibility
        $terms = get_the_terms( $realisation_id, 'type_realisation' );
        if ( $terms && ! is_wp_error( $terms ) ) {
            $item['category'] = $terms[0]->slug;
        }
        
        $realisations_data[] = $item;
    }
    wp_reset_postdata();
}

// FALLBACK: Static réalisations data (si aucune réalisation dans la BDD)
if ( empty( $realisations_data ) ) {
    $realisations_data = array(
    // 1 - BAR ONYX MIEL
    array(
        'title'       => 'BAR ONYX MIEL',
        'image'       => 'realisations/bar.webp',
        'category'    => 'cuisine',
        'description' => '<p>Bar en onyx couleur miel réalisé sur-mesure pour un restaurant, pensé pour donner une nouvelle dimension à l\'espace et mettre en valeur la chaleur naturelle de cette pierre d\'exception.</p>
        <p>Avec un décaissé précis pour intégrer une grille en laiton, permettant d\'évacuer le surplus des verres tout en préservant l\'esthétique du bar. Sous cette grille, un éclairage LED vient sublimer la translucidité et les nuances dorées de l\'onyx, pour une ambiance élégante et raffinée.</p>',
    ),
    // 2 - PLAN DE TRAVAIL QUARTZITE
    array(
        'title'       => 'PLAN DE TRAVAIL ET CRÉDENCE',
        'image'       => 'realisations/cuisine2.webp',
        'category'    => 'cuisine',
        'description' => '<p>Plan de travail et crédence réalisés en Quartzite Taj Mahal.</p>
        <p>Le Quartzite est une matière exigeante, dense et robuste.</p>
        <p>Son aspect raffiné et sa résistance exceptionnelle en font un matériau haut de gamme, idéal pour combiner élégance, durabilité et praticité au quotidien.</p>',
    ),
    // 3 - MARBRE PANDA
    array(
        'title'       => 'PLAN DE TRAVAIL ET CRÉDENCE',
        'image'       => 'realisations/cuisine3.webp',
        'category'    => 'cuisine',
        'description' => '<p>Plan de travail et crédence réalisés en Marbre Panda, dans un style livre ouvert.</p>
        <p>Ce procédé, qui consiste à faire se refléter les veines du marbre en miroir, crée un rendu spectaculaire.</p>
        <p>Le Marbre Panda, avec ses contrastes de noir et de blanc, apporte à la fois élégance et modernité, transformant chaque surface en véritable pièce décorative.</p>',
    ),
    // 4 - GRANIT BLEUTÉ
    array(
        'title'       => 'PLAN DE TRAVAIL ET CRÉDENCE',
        'image'       => 'realisations/cuisine4.webp',
        'category'    => 'cuisine',
        'description' => '<p>Cet ouvrage a une valeur particulière : c\'est le premier que j\'ai entièrement conçu et réalisé seul.</p>
        <p>Ses reflets bleutés, qui changent selon l\'angle de vue, apportent profondeur et élégance à l\'ensemble, faisant de ce granit un matériau à la fois solide et fascinant.</p>',
    ),
    // 5 - BAIGNOIRE VERT BAMBOU
    array(
        'title'       => 'FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER',
        'image'       => 'realisations/salle-de-bain1.webp',
        'category'    => 'salle-de-bain',
        'description' => '<p>Baignoire et vasque réalisées sur-mesure en marbre Vert Bambou. Ce projet avait pour but de créer un ensemble unique, à la fois sobre et original, mettant en avant les nuances et le mouvement naturel de la pierre.</p>
        <p>Le Vert Bambou nécessite des découpes nettes et des ajustements soignés pour épouser parfaitement les différentes formes de la salle.</p>',
    ),
    // 6 - BAIGNOIRE TRAVERTIN
    array(
        'title'       => 'FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER',
        'image'       => 'realisations/salle-de-bain2.webp',
        'category'    => 'salle-de-bain',
        'description' => '<p>Fabrication et installation d\'une baignoire ainsi que d\'un évier en travertin, réalisés sur-mesure pour cette salle de bain.</p>
        <p>Le résultat est un ensemble sobre et lumineux, où la pierre apporte immédiatement une sensation de confort.</p>',
    ),
    // 7 - ESCALIER AVANT/APRÈS
    array(
        'title'       => 'RÉNOVATION ESCALIER',
        'image'       => 'realisations/escalier1-1.webp',
        'image2'      => 'realisations/escalier1-2.webp',
        'category'    => 'autre',
        'is_compare'  => true,
        'description' => '<p>Rénovation complète d\'un escalier en marbre blanc de Carrare. L\'objectif est de redonner à l\'escalier son éclat d\'origine, tout en corrigeant les défauts accumulés avec le temps.</p>
        <p>La première étape est de reprendre les marches abîmées, nettoyer en profondeur et préparer la surface à être poncé et retravaillé pour retrouver une surface plane, nette et homogène.</p>
        <p>Un travail de finition a permis de révéler à nouveau les veines du Carrare et sa luminosité naturelle. L\'escalier retrouve ainsi un aspect propre, élégant et lumineux, tout en restant parfaitement adapté à un usage quotidien.</p>',
    ),
    // 8 - TABLE AVANT/APRÈS
    array(
        'title'       => 'RÉNOVATION TABLE',
        'image'       => 'realisations/table1-1.webp',
        'image2'      => 'realisations/table1-2.webp',
        'category'    => 'autre',
        'is_compare'  => true,
        'description' => '<p>Rénovation et traitement hydrofuge d\'une table en Calacatta Vagli Oro, trois ans après sa fabrication sur mesure. Le client m\'a rappelé souhaitant protéger la pierre sans une finition trop brillante, tout en préservant un bel aspect naturel.</p>
        <p>La fabrication initiale de cette table en Calacatta Vagli Oro, reconnus pour leurs veines dorées élégantes à comprit la découpe précise, le façonnage des bords et un polissage léger pour mettre en valeur les motifs naturels de la pierre, avant une pose impeccable adaptée aux dimensions et au style du mobilier.</p>',
    ),
    // 9 - SOL DAMIER
    array(
        'title'       => 'INSTALLATION SOL DAMIER',
        'image'       => 'realisations/sol1.webp',
        'category'    => 'autre',
        'description' => '<p>Fabrication et installation d\'un sol façon damier en marbre blanc de Carrare et Vert Alpi, réalisé sur-mesure pour le hall d\'entrée de bureaux d\'un client qatari.</p>
        <p>L\'objectif est de créer un sol élégant et graphique, avec un motif parfaitement régulier dès l\'arrivée dans les lieux.</p>
        <p>Chaque pièce de marbre a été ajustée pour que les pierres s\'emboîtent proprement, donnant un sol harmonieux, précis et visuellement très équilibré.</p>',
    ),
    // 10 - SOL MOSAÏQUE
    array(
        'title'       => 'RÉNOVATION SOL EN MARBRE MOSAÏQUE',
        'image'       => 'realisations/sol2.webp',
        'category'    => 'autre',
        'description' => '<p>Rénovation d\'un sol en marbre mosaïque pour le café Blomet, situé dans le 15ᵉ arrondissement de Paris. L\'objectif est de redonner au sol un aspect propre et homogène, tout en respectant le dessin d\'origine de la mosaïque.</p>
        <p>Chaque petits carreaux à reçu un soin particulier puis apporté au nivellement pour obtenir un sol le plus régulier possible, agréable à l\'œil comme à la marche.</p>',
    ),
    // 11 - SOL TRANI
    array(
        'title'       => 'RÉNOVATION SOL',
        'image'       => 'realisations/sol3.webp',
        'category'    => 'autre',
        'description' => '<p>Rénovation d\'un sol en Trani pour redonner du caractère à l\'ensemble du pavillon. L\'objectif est de rafraîchir la pierre, d\'améliorer son éclat et de faciliter son entretien au quotidien.</p>
        <p>Le travail a consisté en un ponçage puis un polissage complet du sol, avant l\'application d\'un traitement hydrofuge pour le protéger des taches et des infiltrations.</p>',
    ),
    // 12 - TERRAZZO
    array(
        'title'       => 'INSTALLATION PLAN DE CUISINE',
        'image'       => 'realisations/plan-de-cuisine.webp',
        'category'    => 'cuisine',
        'description' => '<p>Fabrication et installation d\'un îlot central en terrazzo, une matière originale en plein renouveau. Très prisé dans les années 50 puis oublié pendant plusieurs décennies, le terrazzo revient aujourd\'hui au cœur des projets de décoration contemporaine.</p>
        <p>Composé d\'une résine liant des éclats de marbre colorés, il offre un aspect moucheté unique, à la fois graphique et chaleureux, qui apporte une touche de caractère et d\'élégance à la pièce.</p>',
    ),
    // 13 - SOL MARFIL
    array(
        'title'       => 'RÉNOVATION SOL MARBRE',
        'image'       => 'realisations/sol4.webp',
        'category'    => 'autre',
        'description' => '<p>Rénovation d\'un sol en marbre Marfil sur 70 m² afin de redonner vie et profondeur à l\'espace intérieur. Ce projet a permis d\'éliminer les traces d\'usure tout en restaurant l\'éclat naturel de cette pierre beige chaleureuse.</p>
        <p>Un ponçage minutieux, suivi d\'un polissage et de la rénovation des joints, a assuré une étanchéité parfaite. La cristallisation finale a offert une brillance durable, accentuant la luminosité et l\'élégance de la pièce.</p>',
    ),
    // 14 - SOL TRANI 2
    array(
        'title'       => 'RÉNOVATION SOL',
        'image'       => 'realisations/sol5.webp',
        'category'    => 'autre',
        'description' => '<p>Rénovation d\'un sol en Trani afin de redonner du caractère à l\'ensemble du pavillon. L\'objectif était de rafraîchir la pierre, d\'améliorer son éclat et de simplifier son entretien au quotidien.</p>
        <p>Le travail a consisté en un ponçage et un polissage complet, suivis d\'un traitement hydrofuge pour protéger la pierre des taches et infiltrations.</p>
        <p>Grâce à la forte teneur en calcaire du Trani, la cristallisation a offert une brillance marquée, redonnant au sol une surface lumineuse, régulière.</p>',
    ),
    );
}

// Calculer le nombre de vectors en fonction du nombre de réalisations
$nb_realisations = count( $realisations_data );
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

<main id="main-content" class="site-main page-realisations">
    
    <!-- Contenu principal pour Yoast SEO (masqué visuellement mais lu par les moteurs) -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- Page Header -->
    <header class="page-header page-header--realisations">
        <div class="container">
            <h1 class="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
        </div>
    </header>
    
    <!-- Filter Bar -->
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
    
    <!-- Réalisations List -->
    <section class="section-realisations" data-vectors="<?php echo esc_attr( $nb_vectors ); ?>">
        <?php 
        // Générer les vectors dynamiquement
        for ( $i = 1; $i <= $nb_vectors; $i++ ) :
            $side = ( $i % 2 === 1 ) ? 'left' : 'right';
            $vector = ( $i % 2 === 1 ) ? 'vector2.webp' : 'vector1.webp';
        ?>
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/' . $vector ); ?>" alt="" class="decor decor--<?php echo $side; ?> decor--pos-<?php echo $i; ?>" aria-hidden="true">
        <?php endfor; ?>
        <div class="container">
            <div class="realisations-list" aria-live="polite">
                <?php 
                if ( ! empty( $realisations_data ) ) :
                    $index = 0;
                    foreach ( $realisations_data as $realisation ) :
                        $index++;
                        $is_reversed = ( $index % 2 === 0 );
                        $reversed_class = $is_reversed ? 'realisation-item--reversed' : '';
                        $escalier_class = ( strpos( strtolower( $realisation['title'] ), 'escalier' ) !== false ) ? 'realisation-item--escalier' : '';
                ?>
                    <article class="realisation-item <?php echo esc_attr( $reversed_class . ' ' . $escalier_class ); ?>" data-animate="fade-up">
                        <div class="realisation-item__content">
                            <h2 class="realisation-item__title"><?php echo esc_html( $realisation['title'] ); ?></h2>
                            <div class="realisation-item__description">
                                <?php echo wp_kses_post( $realisation['description'] ); ?>
                            </div>
                        </div>
                        <div class="realisation-item__image <?php echo isset( $realisation['is_compare'] ) && $realisation['is_compare'] ? 'realisation-item__image--compare' : ''; ?>">
                            <?php if ( isset( $realisation['is_compare'] ) && $realisation['is_compare'] && isset( $realisation['image2'] ) ) : ?>
                                <img src="<?php echo esc_url( $realisation['image'] ?: AC_THEME_URI . '/assets/images/' . $realisation['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $realisation['title'] ); ?> - Avant" 
                                     class="realisation-item__img"
                                     loading="lazy">
                                <img src="<?php echo esc_url( $realisation['image2'] ?: AC_THEME_URI . '/assets/images/' . $realisation['image2'] ); ?>" 
                                     alt="<?php echo esc_attr( $realisation['title'] ); ?> - Après" 
                                     class="realisation-item__img"
                                     loading="lazy">
                            <?php else : ?>
                                <img src="<?php echo esc_url( $realisation['image'] ?: AC_THEME_URI . '/assets/images/' . $realisation['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $realisation['title'] ); ?>" 
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
