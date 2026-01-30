<?php
/**
 * Front Page Template - Version ACF
 * 
 * Template pour la page d'accueil avec Advanced Custom Fields
 * Tous les contenus sont modifiables via l'admin WordPress
 *
 * @package Armando_Castanheira
 */

get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>

<main id="main-content" class="site-main page-home">
    
    <!-- Contenu principal pour Yoast SEO -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- ========== HERO SECTION ========== -->
    <?php
    $hero_video = get_field( 'hero_video' ); // Champ fichier ACF
    $hero_image = get_field( 'hero_image' );
    $hero_logo = get_field( 'hero_logo' );
    $hero_cta_primary_text = get_field( 'hero_cta_primary_text' ) ?: __( 'Demander un devis', 'armando-castanheira' );
    $hero_cta_primary_url = get_field( 'hero_cta_primary_url' ) ?: home_url( '/marbrier-paris/' );
    $hero_cta_secondary_text = get_field( 'hero_cta_secondary_text' ) ?: __( 'Voir les réalisations', 'armando-castanheira' );
    $hero_cta_secondary_url = get_field( 'hero_cta_secondary_url' ) ?: home_url( '/marbre-sur-mesure/' );
    ?>
    <section class="hero" id="hero">
        <div class="hero__background">
            <?php if ( $hero_video ) : ?>
                <video class="hero__video" autoplay muted loop playsinline>
                    <source src="<?php echo esc_url( $hero_video['url'] ); ?>" type="<?php echo esc_attr( $hero_video['mime_type'] ); ?>">
                </video>
            <?php elseif ( $hero_image ) : ?>
                <img src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( $hero_image['alt'] ); ?>" class="hero__bg-image">
            <?php else : ?>
                <div class="hero__bg-placeholder"></div>
            <?php endif; ?>
        </div>
        
        <div class="hero__cta">
            <a href="<?php echo esc_url( $hero_cta_primary_url ); ?>" class="btn btn--primary">
                <?php echo esc_html( $hero_cta_primary_text ); ?>
            </a>
            <a href="<?php echo esc_url( $hero_cta_secondary_url ); ?>" class="btn btn--secondary">
                <?php echo esc_html( $hero_cta_secondary_text ); ?>
            </a>
        </div>
    </section>
    
    <!-- ========== ORIGINES SECTION ========== -->
    <?php 
    $origines_title = get_field( 'origines_title' ) ?: __( 'Votre Marbrier', 'armando-castanheira' );
    $origines_content = get_field( 'origines_content' );
    $origines_image = get_field( 'origines_image' );
    ?>
    <section class="section section-origines" id="origines">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <div class="origines__grid">
                <div class="origines__content" data-animate="fade-right">
                    <h2 class="section__title"><?php echo esc_html( $origines_title ); ?></h2>
                    
                    <div class="origines__text">
                        <?php if ( $origines_content ) : ?>
                            <?php echo wp_kses_post( $origines_content ); ?>
                        <?php else : ?>
                            <p>Mon activité à commencé auprès d'un marbrier spécialisé dans le nettoyage et la cristallisation du marbre.</p>
                            <p>En 2019, je fonde mon entreprise pour mettre ce savoir-faire au service de mes clients en proposant une offre complète autour du marbre et de ses déclinaisons.</p>
                            <p>Aujourd'hui je me consacre à la rénovation, à l'entretien, à la fabrication et la pose du marbre sur-mesure.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="origines__image" data-animate="fade-left">
                    <?php if ( $origines_image ) : ?>
                        <img src="<?php echo esc_url( $origines_image['url'] ); ?>" alt="<?php echo esc_attr( $origines_image['alt'] ?: $origines_title ); ?>" loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/savoir-faire/origine.webp' ); ?>" alt="<?php echo esc_attr( $origines_title ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ========== VALEURS SECTION ========== -->
    <?php 
    $valeurs_title = get_field( 'valeurs_title' ) ?: __( 'Mes Valeurs', 'armando-castanheira' );
    
    // Valeurs individuelles (ACF gratuit - pas de répéteur)
    $valeurs = array(
        array(
            'icon' => get_field( 'valeur_1_icon' ),
            'label' => get_field( 'valeur_1_label' ) ?: __( 'Précision', 'armando-castanheira' ),
            'default_icon' => AC_THEME_URI . '/assets/images/common/drawing-compass.webp'
        ),
        array(
            'icon' => get_field( 'valeur_2_icon' ),
            'label' => get_field( 'valeur_2_label' ) ?: __( 'Passion', 'armando-castanheira' ),
            'default_icon' => AC_THEME_URI . '/assets/images/common/fire.webp'
        ),
        array(
            'icon' => get_field( 'valeur_3_icon' ),
            'label' => get_field( 'valeur_3_label' ) ?: __( 'Durabilité', 'armando-castanheira' ),
            'default_icon' => AC_THEME_URI . '/assets/images/common/infini.webp'
        ),
        array(
            'icon' => get_field( 'valeur_4_icon' ),
            'label' => get_field( 'valeur_4_label' ) ?: __( 'Respect des matériaux', 'armando-castanheira' ),
            'default_icon' => AC_THEME_URI . '/assets/images/common/check.webp'
        ),
        array(
            'icon' => get_field( 'valeur_5_icon' ),
            'label' => get_field( 'valeur_5_label' ) ?: __( 'Transparence', 'armando-castanheira' ),
            'default_icon' => AC_THEME_URI . '/assets/images/common/hand-shake.webp'
        ),
    );
    ?>
    <section class="section section-valeurs" id="valeurs">
        <div class="container">
            <h2 class="section__title section__title--center"><?php echo esc_html( $valeurs_title ); ?></h2>
            
            <div class="valeurs__grid" data-animate="fade-up">
                <?php foreach ( $valeurs as $valeur ) : ?>
                    <div class="valeur-item">
                        <div class="valeur-item__icon">
                            <?php 
                            $icon_url = ! empty( $valeur['icon'] ) ? $valeur['icon']['url'] : $valeur['default_icon'];
                            ?>
                            <img src="<?php echo esc_url( $icon_url ); ?>" alt="<?php echo esc_attr( $valeur['label'] ); ?>">
                        </div>
                        <span class="valeur-item__label"><?php echo esc_html( $valeur['label'] ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- ========== RÉALISATIONS SECTION ========== -->
    <?php 
    $realisations_title = get_field( 'realisations_title' ) ?: __( 'Réalisations', 'armando-castanheira' );
    $realisations_content = get_field( 'realisations_content' );
    $realisations_image = get_field( 'realisations_image' );
    $realisations_cta_text = get_field( 'realisations_cta_text' ) ?: __( 'Voir plus', 'armando-castanheira' );
    $realisations_cta_url = get_field( 'realisations_cta_url' ) ?: home_url( '/marbre-sur-mesure/' );
    ?>
    <section class="section section-realisations-preview" id="realisations-preview">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="realisations-preview__grid realisations-preview__grid--reversed">
                <div class="realisations-preview__image" data-animate="fade-right">
                    <?php if ( $realisations_image ) : ?>
                        <img src="<?php echo esc_url( $realisations_image['url'] ); ?>" alt="<?php echo esc_attr( $realisations_image['alt'] ?: $realisations_title ); ?>" loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/home/realisation.webp' ); ?>" alt="<?php echo esc_attr( $realisations_title ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
                
                <div class="realisations-preview__content" data-animate="fade-left">
                    <h2 class="section__title"><?php echo esc_html( $realisations_title ); ?></h2>
                    
                    <div class="realisations-preview__text">
                        <?php if ( $realisations_content ) : ?>
                            <?php echo wp_kses_post( $realisations_content ); ?>
                        <?php else : ?>
                            <p>Pour chaque projet, je vous accompagne avec sérieux, précision et écoute, afin de vous offrir un service sur-mesure et un résultat à la hauteur de vos attentes.</p>
                            <p>Faire appel à un artisan marbrier, c'est avoir l'assurance d'un travail soigné, réalisé avec respect du marbre et de vos envies.</p>
                        <?php endif; ?>
                    </div>
                    
                    <a href="<?php echo esc_url( $realisations_cta_url ); ?>" class="btn btn--primary">
                        <?php echo esc_html( $realisations_cta_text ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ========== MATIÈRES SECTION ========== -->
    <?php 
    $matieres_title = get_field( 'matieres_title' ) ?: __( 'Découvrir les Matières', 'armando-castanheira' );
    $matieres_cta_text = get_field( 'matieres_cta_text' ) ?: __( 'Voir plus', 'armando-castanheira' );
    $matieres_cta_url = get_field( 'matieres_cta_url' ) ?: home_url( '/marbre/' );
    
    // Matières individuelles (ACF gratuit - pas de répéteur)
    $matieres = array(
        array(
            'image' => get_field( 'matiere_1_image' ),
            'label' => get_field( 'matiere_1_label' ) ?: __( 'Marbre', 'armando-castanheira' ),
            'url' => get_field( 'matiere_1_url' ) ?: home_url( '/marbre/?type=marbre' ),
            'default_image' => AC_THEME_URI . '/assets/images/home/rond-marbre-blanc.webp'
        ),
        array(
            'image' => get_field( 'matiere_2_image' ),
            'label' => get_field( 'matiere_2_label' ) ?: __( 'Granite', 'armando-castanheira' ),
            'url' => get_field( 'matiere_2_url' ) ?: home_url( '/marbre/?type=granite' ),
            'default_image' => AC_THEME_URI . '/assets/images/home/rond-granit.webp'
        ),
        array(
            'image' => get_field( 'matiere_3_image' ),
            'label' => get_field( 'matiere_3_label' ) ?: __( 'Quartzite', 'armando-castanheira' ),
            'url' => get_field( 'matiere_3_url' ) ?: home_url( '/marbre/?type=quartzite' ),
            'default_image' => AC_THEME_URI . '/assets/images/home/rond-quartzite.webp'
        ),
    );
    ?>
    <section class="section section-matieres-preview" id="matieres-preview">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <h2 class="section__title section__title--center"><?php echo esc_html( $matieres_title ); ?></h2>
            
            <div class="matieres-preview__grid" data-animate="fade-up">
                <?php foreach ( $matieres as $matiere ) : ?>
                    <a href="<?php echo esc_url( $matiere['url'] ); ?>" class="matiere-preview-item">
                        <div class="matiere-preview-item__image">
                            <?php 
                            $image_url = ! empty( $matiere['image'] ) ? $matiere['image']['url'] : $matiere['default_image'];
                            ?>
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $matiere['label'] ); ?>" loading="lazy">
                        </div>
                        <span class="matiere-preview-item__label"><?php echo esc_html( $matiere['label'] ); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
            
            <div class="matieres-preview__cta">
                <a href="<?php echo esc_url( $matieres_cta_url ); ?>" class="btn btn--secondary">
                    <?php echo esc_html( $matieres_cta_text ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- ========== SAVOIR-FAIRE SECTION ========== -->
    <?php 
    $savoir_faire_title = get_field( 'savoir_faire_title' ) ?: __( 'Une Pierre d\'Exception', 'armando-castanheira' );
    $savoir_faire_content = get_field( 'savoir_faire_content' );
    $savoir_faire_image = get_field( 'savoir_faire_image' );
    $savoir_faire_cta_text = get_field( 'savoir_faire_cta_text' ) ?: __( 'Voir plus', 'armando-castanheira' );
    $savoir_faire_cta_url = get_field( 'savoir_faire_cta_url' ) ?: home_url( '/artisans-marbrier-paris/' );
    ?>
    <section class="section section-savoir-faire-preview" id="savoir-faire-preview">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="savoir-faire-preview__grid">
                <div class="savoir-faire-preview__content" data-animate="fade-right">
                    <h2 class="section__title"><?php echo esc_html( $savoir_faire_title ); ?></h2>
                    
                    <div class="savoir-faire-preview__text">
                        <?php if ( $savoir_faire_content ) : ?>
                            <?php echo wp_kses_post( $savoir_faire_content ); ?>
                        <?php else : ?>
                            <p>Pour chaque réalisation en marbre, je sélectionne la pierre avec soin et réalise une fabrication sur mesure, depuis le choix de la pierre jusqu'à la découpe sur mesure, afin de répondre précisément aux besoins de votre réalisation.</p>
                            <p>La pose du marbre est effectuée avec méthode et précision. Chaque plaque est ajustée à la main en respectant les veines naturelles et les raccords, pour un rendu propre et équilibré.</p>
                            <p>La cristallisation du marbre permet d'entretenir et de raviver son aspect. Ce traitement apporte une finition plus brillante tout en protégeant la surface de la pierre.</p>
                        <?php endif; ?>
                    </div>
                    
                    <a href="<?php echo esc_url( $savoir_faire_cta_url ); ?>" class="btn btn--primary">
                        <?php echo esc_html( $savoir_faire_cta_text ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="savoir-faire-preview__image" data-animate="fade-left">
                    <?php if ( $savoir_faire_image ) : ?>
                        <img src="<?php echo esc_url( $savoir_faire_image['url'] ); ?>" alt="<?php echo esc_attr( $savoir_faire_image['alt'] ?: $savoir_faire_title ); ?>" loading="lazy">
                    <?php else : ?>
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/savoir-faire/apprendre-le-savoir-faire.webp' ); ?>" alt="<?php echo esc_attr( $savoir_faire_title ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php 
    endwhile;
endif;

get_footer();
