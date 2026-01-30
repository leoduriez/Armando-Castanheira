<?php
/**
 * Template Name: Accueil
 * Template Post Type: page
 * 
 * Template pour la page d'accueil
 *
 * @package Armando_Castanheira
 */

get_header();
?>

<main id="main-content" class="site-main page-home">
    
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero__background">
            <?php 
            $hero_video = get_theme_mod( 'ac_hero_video_file', '' );
            $hero_image = get_theme_mod( 'ac_hero_bg_image', '' );
            
            if ( $hero_video ) : ?>
                <video class="hero__video" autoplay muted loop playsinline>
                    <source src="<?php echo esc_url( $hero_video ); ?>" type="video/mp4">
                </video>
            <?php elseif ( $hero_image ) : ?>
                <img src="<?php echo esc_url( $hero_image ); ?>" alt="" class="hero__bg-image">
            <?php else : ?>
                <!-- Fallback: placeholder ou couleur -->
                <div class="hero__bg-placeholder"></div>
            <?php endif; ?>
        </div>
        
        <div class="hero__content">
            <div class="hero__logo">
                <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/logo-ac.webp' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
            </div>
            
            <button class="hero__play-btn" id="hero-play-btn" aria-label="<?php esc_attr_e( 'Lire la vidéo', 'armando-castanheira' ); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
            </button>
        </div>
        
        <div class="hero__cta">
            <a href="<?php echo esc_url( home_url( '/marbrier-paris/' ) ); ?>" class="btn btn--primary">
                <?php esc_html_e( 'Demander un devis', 'armando-castanheira' ); ?>
            </a>
            <a href="<?php echo esc_url( home_url( '/marbre-sur-mesure/' ) ); ?>" class="btn btn--secondary">
                <?php esc_html_e( 'Voir les réalisations', 'armando-castanheira' ); ?>
            </a>
        </div>
    </section>
    
    <!-- Origines Section -->
    <section class="section section-origines" id="origines">
        <!-- Décoration gauche -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <div class="origines__grid">
                <div class="origines__content" data-animate="fade-right">
                    <h2 class="section__title"><?php esc_html_e( 'Votre Marbrier', 'armando-castanheira' ); ?></h2>
                    
                    <div class="origines__text">
                        <?php
                        // Get content from customizer or ACF
                        $origines_text = get_theme_mod( 'ac_origines_text', '' );
                        if ( $origines_text ) {
                            echo wp_kses_post( $origines_text );
                        } else {
                        ?>
                        <p>Mon activité à commencé auprès d'un marbrier spécialisé dans le nettoyage et la cristallisation du marbre.</p>
                        
                        <p>En 2019, je fonde mon entreprise pour mettre ce savoir-faire au service de mes clients en proposant une offre complète autour du marbre et de ses déclinaisons</p>
                        
                        <p>Aujourd'hui je me consacre à la rénovation, à l'entretien, à la fabrication et la pose du marbre sur-mesure.</p>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="origines__image" data-animate="fade-left">
                    <?php
                    $origines_image = get_theme_mod( 'ac_origines_image', '' );
                    if ( $origines_image ) {
                        echo '<img src="' . esc_url( $origines_image ) . '" alt="Votre marbrier" loading="lazy">';
                    } else {
                        // Image par défaut
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/savoir-faire/origine.webp' ) . '" alt="Votre marbrier" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Valeurs Section -->
    <section class="section section-valeurs" id="valeurs">
        <div class="container">
            <h2 class="section__title section__title--right"><?php esc_html_e( 'Mes Valeurs', 'armando-castanheira' ); ?></h2>
            
            <div class="valeurs__grid" data-animate="fade-up">
                <!-- Précision -->
                <div class="valeur-item">
                    <div class="valeur-item__icon">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/drawing-compass.webp' ); ?>" alt="Précision">
                    </div>
                    <span class="valeur-item__label"><?php esc_html_e( 'Précision', 'armando-castanheira' ); ?></span>
                </div>
                
                <!-- Passion -->
                <div class="valeur-item">
                    <div class="valeur-item__icon">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/fire.webp' ); ?>" alt="Passion">
                    </div>
                    <span class="valeur-item__label"><?php esc_html_e( 'Passion', 'armando-castanheira' ); ?></span>
                </div>
                
                <!-- Durabilité -->
                <div class="valeur-item">
                    <div class="valeur-item__icon">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/infini.webp' ); ?>" alt="Durabilité">
                    </div>
                    <span class="valeur-item__label"><?php esc_html_e( 'Durabilité', 'armando-castanheira' ); ?></span>
                </div>
                
                <!-- Respect des matériaux -->
                <div class="valeur-item">
                    <div class="valeur-item__icon">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/check.webp' ); ?>" alt="Respect des matériaux">
                    </div>
                    <span class="valeur-item__label"><?php esc_html_e( 'Respect des matériaux', 'armando-castanheira' ); ?></span>
                </div>
                
                <!-- Transparence -->
                <div class="valeur-item">
                    <div class="valeur-item__icon">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/hand-shake.webp' ); ?>" alt="Transparence">
                    </div>
                    <span class="valeur-item__label"><?php esc_html_e( 'Transparence', 'armando-castanheira' ); ?></span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Réalisations Preview Section -->
    <section class="section section-realisations-preview" id="realisations-preview">
        <!-- Décoration droite -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="realisations-preview__grid">
                <div class="realisations-preview__content" data-animate="fade-right">
                    <h2 class="section__title"><?php esc_html_e( 'Réalisations', 'armando-castanheira' ); ?></h2>
                    
                    <div class="realisations-preview__text">
                        <?php
                        $realisations_text = get_theme_mod( 'ac_realisations_preview_text', '' );
                        if ( $realisations_text ) {
                            echo wp_kses_post( $realisations_text );
                        } else {
                        ?>
                        <p>Pour chaque projet, je vous accompagne avec sérieux, précision et écoute, afin de vous offrir un service sur-mesure et un résultat à la hauteur des vos attentes.</p>
                        
                        <p>Faire appel à un artisan marbrier, c'est avoir l'assurance d'un travail soigné, réalisé avec respect du marbre et de vos envies.</p>
                        <?php } ?>
                    </div>
                    
                    <a href="<?php echo esc_url( home_url( '/marbre-sur-mesure/' ) ); ?>" class="btn btn--primary">
                        <?php esc_html_e( 'Voir plus', 'armando-castanheira' ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="realisations-preview__image" data-animate="fade-left">
                    <?php
                    $realisations_image = get_theme_mod( 'ac_realisations_image', '' );
                    if ( $realisations_image ) {
                        echo '<img src="' . esc_url( $realisations_image ) . '" alt="Réalisations en marbre" loading="lazy">';
                    } else {
                        // Image par défaut
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/home/realisation.webp' ) . '" alt="Réalisations en marbre" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Matières Preview Section -->
    <section class="section section-matieres-preview" id="matieres-preview">
        <!-- Décoration gauche -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <h2 class="section__title section__title--center"><?php esc_html_e( 'Découvrir les Matières', 'armando-castanheira' ); ?></h2>
            
            <div class="matieres-preview__grid" data-animate="fade-up">
                <!-- Marbre -->
                <a href="<?php echo esc_url( home_url( '/marbre/?type=marbre' ) ); ?>" class="matiere-preview-item">
                    <div class="matiere-preview-item__image">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/home/rond-marbre-blanc.webp' ); ?>" alt="Marbre" loading="lazy">
                    </div>
                    <span class="matiere-preview-item__label"><?php esc_html_e( 'Marbre', 'armando-castanheira' ); ?></span>
                </a>
                
                <!-- Granite -->
                <a href="<?php echo esc_url( home_url( '/marbre/?type=granite' ) ); ?>" class="matiere-preview-item">
                    <div class="matiere-preview-item__image">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/home/rond-granit.webp' ); ?>" alt="Granite" loading="lazy">
                    </div>
                    <span class="matiere-preview-item__label"><?php esc_html_e( 'Granite', 'armando-castanheira' ); ?></span>
                </a>
                
                <!-- Quartzite -->
                <a href="<?php echo esc_url( home_url( '/marbre/?type=quartzite' ) ); ?>" class="matiere-preview-item">
                    <div class="matiere-preview-item__image">
                        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/home/rond-quartzite.webp' ); ?>" alt="Quartzite" loading="lazy">
                    </div>
                    <span class="matiere-preview-item__label"><?php esc_html_e( 'Quartzite', 'armando-castanheira' ); ?></span>
                </a>
            </div>
            
            <div class="matieres-preview__cta">
                <a href="<?php echo esc_url( home_url( '/marbre/' ) ); ?>" class="btn btn--secondary">
                    <?php esc_html_e( 'Voir plus', 'armando-castanheira' ); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    
    <!-- Savoir-Faire Preview Section -->
    <section class="section section-savoir-faire-preview" id="savoir-faire-preview">
        <!-- Décoration droite -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="savoir-faire-preview__grid">
                <div class="savoir-faire-preview__content" data-animate="fade-right">
                    <h2 class="section__title"><?php esc_html_e( 'Une Pierre d\'Exception', 'armando-castanheira' ); ?></h2>
                    
                    <div class="savoir-faire-preview__text">
                        <?php
                        $savoir_faire_text = get_theme_mod( 'ac_savoir_faire_preview_text', '' );
                        if ( $savoir_faire_text ) {
                            echo wp_kses_post( $savoir_faire_text );
                        } else {
                        ?>
                        <p>Pour chaque réalisation en marbre, je sélectionne la pierre avec soin et réalise une fabrication sur mesure, depuis le choix de la pierre jusqu'à la découpe sur mesure, afin de répondre précisément aux besoins de votre réalisation.</p>
                        
                        <p>La pose du marbre est effectuée avec méthode et précision. Chaque plaque est ajustée à la main en respectant les veines naturelles et les raccords, pour un rendu propre et équilibré.</p>
                        
                        <p>La cristallisation du marbre permet d'entretenir et de raviver son aspect. Ce traitement apporte une finition plus brillante tout en protégeant la surface de la pierre.</p>
                        <?php } ?>
                    </div>
                    
                    <a href="<?php echo esc_url( home_url( '/artisans-marbrier-paris/' ) ); ?>" class="btn btn--primary">
                        <?php esc_html_e( 'Voir plus', 'armando-castanheira' ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="savoir-faire-preview__image" data-animate="fade-left">
                    <?php
                    $savoir_faire_image = get_theme_mod( 'ac_savoir_faire_image', '' );
                    if ( $savoir_faire_image ) {
                        echo '<img src="' . esc_url( $savoir_faire_image ) . '" alt="Savoir-faire artisanal" loading="lazy">';
                    } else {
                        // Image par défaut
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/savoir-faire/apprendre-le-savoir-faire.webp' ) . '" alt="Savoir-faire artisanal" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
