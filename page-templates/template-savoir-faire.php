<?php
/**
 * Template Name: Savoir faire
 * Template Post Type: page
 * Description: Template pour la page Savoir faire
 *
 * @package Armando_Castanheira
 */

// Charger les styles spécifiques à cette page
wp_enqueue_style( 'page-savoir-faire', AC_THEME_URI . '/assets/css/page-savoir-faire.css', array(), AC_THEME_VERSION );

get_header();
?>

<main id="main-content" class="site-main page-savoir-faire">
    
    <!-- Contenu WordPress pour SEO (caché visuellement) -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if ( get_the_content() ) : ?>
            <div class="page-content sr-only" aria-hidden="true">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    <?php endwhile; endif; ?>
    
    <!-- Page Header -->
    <header class="page-header page-header--savoir-faire">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </header>
    
    <!-- Section Filter (transition) -->
    <section class="section-filter">
        <div class="container">
        </div>
    </section>

    <!-- Contenu principal -->
    <div class="savoir-faire-wrapper">
        <!-- Vectors décoratifs globaux -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left decor--pos-1" aria-hidden="true">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right decor--pos-2" aria-hidden="true">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left decor--pos-3" aria-hidden="true">
        
        <div class="container">
            <div class="savoir-faire-content">
                
                <?php 
                // Récupérer l'ID de la page pour ACF
                $page_id = get_the_ID();
                ?>
                
                <!-- Section 1: INSTALLATION SUR MESURE (Texte à gauche, Image à droite) -->
                <section class="savoir-faire-section process-section installation-section">
                <div class="section-wrapper">
                    <div class="section-text">
                        <h2 class="section-title"><?php echo esc_html( get_field( 'section_1_titre' ) ?: 'Installation sur mesure' ); ?></h2>
                        <div class="section-content">
                            <?php 
                            $section_1_contenu = get_field( 'section_1_contenu' );
                            if ( $section_1_contenu ) {
                                echo wp_kses_post( $section_1_contenu );
                            } else {
                                echo '<p>La pose du marbre demande rigueur et savoir‑faire. Chaque plaque est choisie, ajustée et installée à la main, avec une attention particulière portée aux veines et aux raccords naturels.</p>';
                                echo '<p>Cette précision dans les détails garantit un résultat élégant, où la beauté et la durabilité du marbre s\'expriment pleinement.</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="section-image">
                        <?php 
                        $section_1_image = get_field( 'section_1_image' );
                        $image_url = $section_1_image ? $section_1_image['url'] : AC_THEME_URI . '/assets/images/savoir-faire/cristalisation.webp';
                        $image_alt = $section_1_image ? $section_1_image['alt'] : 'Installation sur mesure';
                        ?>
                        <img 
                            src="<?php echo esc_url( $image_url ); ?>"
                            alt="<?php echo esc_attr( $image_alt ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </section>

            <!-- Section 2: REDONNER L'ECLAT (Image à gauche, Texte à droite) -->
            <section class="savoir-faire-section process-section cristallisation-section">
                <div class="section-wrapper section-wrapper--image-left">
                    <div class="section-image">
                        <?php 
                        $section_2_image = get_field( 'section_2_image' );
                        $image_url = $section_2_image ? $section_2_image['url'] : AC_THEME_URI . '/assets/images/savoir-faire/fabrication.webp';
                        $image_alt = $section_2_image ? $section_2_image['alt'] : 'Redonner l\'éclat';
                        ?>
                        <img 
                            src="<?php echo esc_url( $image_url ); ?>"
                            alt="<?php echo esc_attr( $image_alt ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                    <div class="section-text">
                        <h2 class="section-title"><?php echo esc_html( get_field( 'section_2_titre' ) ?: 'Redonner l\'éclat' ); ?></h2>
                        <div class="section-content">
                            <?php 
                            $section_2_contenu = get_field( 'section_2_contenu' );
                            if ( $section_2_contenu ) {
                                echo wp_kses_post( $section_2_contenu );
                            } else {
                                echo '<p>La cristallisation est un traitement de rénovation et de protection qui permet de raviver la brillance du marbre. En appliquant des produits spécifiques qui réagissent avec la surface de la pierre, on crée une fine couche protectrice tout en renforçant sa densité.</p>';
                                echo '<p>Cette technique redonne vie au marbre, lui offrant un aspect brillant et profond, comme au premier jour.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section 3: RENOVATION (Texte à gauche, Image à droite) -->
            <section class="savoir-faire-section process-section fabrication-section">
                <div class="section-wrapper">
                    <div class="section-text">
                        <h2 class="section-title"><?php echo esc_html( get_field( 'section_3_titre' ) ?: 'Rénovation' ); ?></h2>
                        <div class="section-content">
                            <?php 
                            $section_3_contenu = get_field( 'section_3_contenu' );
                            if ( $section_3_contenu ) {
                                echo wp_kses_post( $section_3_contenu );
                            } else {
                                echo '<p>La fabrication d\'un ouvrage en marbre, c\'est avant tout un savoir-faire artisanal qui commence par le choix minutieux du bloc ou de la dalle. Selon la couleur, le veinage et l\'usage prévu : sol, plan de travail, table ou habillage mural, on sélectionne la pierre idéale pour sublimer l\'espace.</p>';
                                echo '<p>On passe ensuite à la découpe sur mesure, précise au millimètre, pour s\'adapter parfaitement aux dimensions du chantier. Les bords sont façonnés avec soin : droits, chanfreinés, adoucis ou arrondis, selon le style désiré.</p>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="section-image">
                        <?php 
                        $section_3_image = get_field( 'section_3_image' );
                        $image_url = $section_3_image ? $section_3_image['url'] : AC_THEME_URI . '/assets/images/savoir-faire/installation.webp';
                        $image_alt = $section_3_image ? $section_3_image['alt'] : 'Rénovation';
                        ?>
                        <img 
                            src="<?php echo esc_url( $image_url ); ?>"
                            alt="<?php echo esc_attr( $image_alt ); ?>"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                </div>
            </section>

            </div>
        </div>
    </div>
</main>

<?php
get_footer();
?>
