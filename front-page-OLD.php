<?php
/**
 * Front Page Template
 * 
 * The template for displaying the home page
 * Contenu dynamique via WordPress + ACF pour compatibilité Yoast SEO
 *
 * @package Armando_Castanheira
 */

get_header();

// Démarrer la boucle WordPress pour que Yoast SEO puisse analyser le contenu
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
    
    // Récupération des custom fields natifs WordPress avec fallbacks
    $hero_video = get_post_meta( get_the_ID(), '_ac_hero_video_url', true );
    $hero_image_id = get_post_meta( get_the_ID(), '_ac_hero_image_id', true );
    $hero_image = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : '';
    $hero_logo_id = get_post_meta( get_the_ID(), '_ac_hero_logo_id', true );
    $hero_logo = $hero_logo_id ? wp_get_attachment_image_url( $hero_logo_id, 'full' ) : '';
    $hero_cta_primary_text = get_post_meta( get_the_ID(), '_ac_hero_cta_primary_text', true ) ?: __( 'Demander un devis', 'armando-castanheira' );
    $hero_cta_primary_url = get_post_meta( get_the_ID(), '_ac_hero_cta_primary_url', true ) ?: home_url( '/contact/' );
    $hero_cta_secondary_text = get_post_meta( get_the_ID(), '_ac_hero_cta_secondary_text', true ) ?: __( 'Voir les réalisations', 'armando-castanheira' );
    $hero_cta_secondary_url = get_post_meta( get_the_ID(), '_ac_hero_cta_secondary_url', true ) ?: home_url( '/realisations/' );
?>

<main id="main-content" class="site-main page-home">
    
    <!-- Contenu principal pour Yoast SEO (masqué visuellement mais lu par les moteurs) -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- Hero Section -->
    <section class="hero" id="hero">
        <div class="hero__background">
            <?php if ( $hero_video ) : ?>
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
                <?php 
                $logo_url = $hero_logo ?: AC_THEME_URI . '/assets/images/common/logo-ac.webp';
                ?>
                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
            </div>
            
            <button class="hero__play-btn" id="hero-play-btn" aria-label="<?php esc_attr_e( 'Lire la vidéo', 'armando-castanheira' ); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                </svg>
            </button>
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
    
    <!-- Origines Section -->
    <?php 
    $origines_title = get_post_meta( get_the_ID(), '_ac_origines_title', true ) ?: __( 'Votre Marbrier', 'armando-castanheira' );
    $origines_content = get_post_meta( get_the_ID(), '_ac_origines_content', true );
    $origines_image_id = get_post_meta( get_the_ID(), '_ac_origines_image_id', true );
    $origines_image = $origines_image_id ? wp_get_attachment_image_url( $origines_image_id, 'full' ) : '';
    ?>
    <section class="section section-origines" id="origines">
        <!-- Décoration gauche -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <div class="origines__grid">
                <div class="origines__content" data-animate="fade-right">
                    <h2 class="section__title"><?php echo esc_html( $origines_title ); ?></h2>
                    
                    <div class="origines__text">
                        <?php 
                        if ( $origines_content ) {
                            echo wp_kses_post( $origines_content );
                        } else {
                            // Fallback - contenu par défaut
                        ?>
                        <p>Mon activité à commencé auprès d'un marbrier spécialisé dans le nettoyage et la cristallisation du marbre.</p>
                        <p>En 2019, je fonde mon entreprise pour mettre ce savoir-faire au service de mes clients en proposant une offre complète autour du marbre et de ses déclinaisons</p>
                        <p>Aujourd'hui je me consacre à la rénovation, à l'entretien, à la fabrication et la pose du marbre sur-mesure.</p>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="origines__image" data-animate="fade-left">
                    <?php 
                    if ( $origines_image ) {
                        echo '<img src="' . esc_url( $origines_image ) . '" alt="' . esc_attr( $origines_title ) . '" loading="lazy">';
                    } else {
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/savoir-faire/origine.webp' ) . '" alt="' . esc_attr( $origines_title ) . '" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Valeurs Section -->
    <?php 
    $valeurs_title = get_post_meta( get_the_ID(), 'ac_valeurs_title', true ) ?: __( 'Mes Valeurs', 'armando-castanheira' );
    
    // Valeurs dynamiques via champs personnalisés (format: label1|label2|label3|label4|label5)
    $valeurs_labels_raw = get_post_meta( get_the_ID(), 'ac_valeurs_labels', true );
    $valeurs_labels = $valeurs_labels_raw ? array_map( 'trim', explode( '|', $valeurs_labels_raw ) ) : array();
    
    // Valeurs par défaut si non renseignées
    $default_valeurs = array(
        array( 'icon' => '/assets/images/common/drawing-compass.webp', 'label' => isset( $valeurs_labels[0] ) && $valeurs_labels[0] ? $valeurs_labels[0] : __( 'Précision', 'armando-castanheira' ) ),
        array( 'icon' => '/assets/images/common/fire.webp', 'label' => isset( $valeurs_labels[1] ) && $valeurs_labels[1] ? $valeurs_labels[1] : __( 'Passion', 'armando-castanheira' ) ),
        array( 'icon' => '/assets/images/common/infini.webp', 'label' => isset( $valeurs_labels[2] ) && $valeurs_labels[2] ? $valeurs_labels[2] : __( 'Durabilité', 'armando-castanheira' ) ),
        array( 'icon' => '/assets/images/common/check.webp', 'label' => isset( $valeurs_labels[3] ) && $valeurs_labels[3] ? $valeurs_labels[3] : __( 'Respect des matériaux', 'armando-castanheira' ) ),
        array( 'icon' => '/assets/images/common/hand-shake.webp', 'label' => isset( $valeurs_labels[4] ) && $valeurs_labels[4] ? $valeurs_labels[4] : __( 'Transparence', 'armando-castanheira' ) ),
    );
    ?>
    <section class="section section-valeurs" id="valeurs">
        <div class="container">
            <h2 class="section__title section__title--right"><?php echo esc_html( $valeurs_title ); ?></h2>
            
            <div class="valeurs__grid" data-animate="fade-up">
                <?php 
                // Afficher les valeurs (en dur pour cette section)
                foreach ( $default_valeurs as $valeur ) : ?>
                    <div class="valeur-item">
                        <div class="valeur-item__icon">
                            <img src="<?php echo esc_url( AC_THEME_URI . $valeur['icon'] ); ?>" alt="<?php echo esc_attr( $valeur['label'] ); ?>">
                        </div>
                        <span class="valeur-item__label"><?php echo esc_html( $valeur['label'] ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Réalisations Preview Section -->
    <?php 
    $realisations_title = get_post_meta( get_the_ID(), '_ac_realisations_title', true ) ?: __( 'Réalisations', 'armando-castanheira' );
    $realisations_content = get_post_meta( get_the_ID(), '_ac_realisations_content', true );
    $realisations_image_id = get_post_meta( get_the_ID(), '_ac_realisations_image_id', true );
    $realisations_image = $realisations_image_id ? wp_get_attachment_image_url( $realisations_image_id, 'full' ) : '';
    $realisations_cta_text = get_post_meta( get_the_ID(), '_ac_realisations_cta_text', true ) ?: __( 'Voir plus', 'armando-castanheira' );
    $realisations_cta_url = get_post_meta( get_the_ID(), '_ac_realisations_cta_url', true ) ?: home_url( '/realisations/' );
    ?>
    <section class="section section-realisations-preview" id="realisations-preview">
        <!-- Décoration droite -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="realisations-preview__grid">
                <div class="realisations-preview__content" data-animate="fade-right">
                    <h2 class="section__title"><?php echo esc_html( $realisations_title ); ?></h2>
                    
                    <div class="realisations-preview__text">
                        <?php 
                        if ( $realisations_content ) {
                            echo wp_kses_post( $realisations_content );
                        } else {
                        ?>
                        <p>Pour chaque projet, je vous accompagne avec sérieux, précision et écoute, afin de vous offrir un service sur-mesure et un résultat à la hauteur des vos attentes.</p>
                        <p>Faire appel à un artisan marbrier, c'est avoir l'assurance d'un travail soigné, réalisé avec respect du marbre et de vos envies.</p>
                        <?php } ?>
                    </div>
                    
                    <a href="<?php echo esc_url( $realisations_cta_url ); ?>" class="btn btn--primary">
                        <?php echo esc_html( $realisations_cta_text ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="realisations-preview__image" data-animate="fade-left">
                    <?php 
                    if ( $realisations_image ) {
                        echo '<img src="' . esc_url( $realisations_image ) . '" alt="' . esc_attr( $realisations_title ) . '" loading="lazy">';
                    } else {
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/home/realisation.webp' ) . '" alt="' . esc_attr( $realisations_title ) . '" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Matières Preview Section -->
    <?php 
    $matieres_title = get_post_meta( get_the_ID(), 'ac_matieres_title', true ) ?: __( 'Découvrir les Matières', 'armando-castanheira' );
    $matieres_cta_text = get_post_meta( get_the_ID(), 'ac_matieres_cta_text', true ) ?: __( 'Voir plus', 'armando-castanheira' );
    $matieres_cta_url = get_post_meta( get_the_ID(), 'ac_matieres_cta_url', true ) ?: home_url( '/matieres/' );
    
    // Matières dynamiques (format: label1|label2|label3)
    $matieres_labels_raw = get_post_meta( get_the_ID(), 'ac_matieres_labels', true );
    $matieres_labels = $matieres_labels_raw ? array_map( 'trim', explode( '|', $matieres_labels_raw ) ) : array();
    
    // Matières par défaut
    $default_matieres = array(
        array( 'image' => '/assets/images/home/rond-marbre-blanc.webp', 'label' => isset( $matieres_labels[0] ) && $matieres_labels[0] ? $matieres_labels[0] : __( 'Marbre', 'armando-castanheira' ), 'url' => home_url( '/matieres/?type=marbre' ) ),
        array( 'image' => '/assets/images/home/rond-granit.webp', 'label' => isset( $matieres_labels[1] ) && $matieres_labels[1] ? $matieres_labels[1] : __( 'Granite', 'armando-castanheira' ), 'url' => home_url( '/matieres/?type=granite' ) ),
        array( 'image' => '/assets/images/home/rond-quartzite.webp', 'label' => isset( $matieres_labels[2] ) && $matieres_labels[2] ? $matieres_labels[2] : __( 'Quartzite', 'armando-castanheira' ), 'url' => home_url( '/matieres/?type=quartzite' ) ),
    );
    ?>
    <section class="section section-matieres-preview" id="matieres-preview">
        <!-- Décoration gauche -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="container">
            <h2 class="section__title section__title--center"><?php echo esc_html( $matieres_title ); ?></h2>
            
            <div class="matieres-preview__grid" data-animate="fade-up">
                <?php 
                // Afficher les matières (en dur pour cette section)
                foreach ( $default_matieres as $matiere ) : ?>
                    <a href="<?php echo esc_url( $matiere['url'] ); ?>" class="matiere-preview-item">
                        <div class="matiere-preview-item__image">
                            <img src="<?php echo esc_url( AC_THEME_URI . $matiere['image'] ); ?>" alt="<?php echo esc_attr( $matiere['label'] ); ?>" loading="lazy">
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
    
    <!-- Savoir-Faire Preview Section -->
    <?php 
    $savoir_faire_title = get_post_meta( get_the_ID(), '_ac_savoir_faire_title', true ) ?: __( 'Une Pierre d\'Exception', 'armando-castanheira' );
    $savoir_faire_content = get_post_meta( get_the_ID(), '_ac_savoir_faire_content', true );
    $savoir_faire_image_id = get_post_meta( get_the_ID(), '_ac_savoir_faire_image_id', true );
    $savoir_faire_image = $savoir_faire_image_id ? wp_get_attachment_image_url( $savoir_faire_image_id, 'full' ) : '';
    $savoir_faire_cta_text = get_post_meta( get_the_ID(), '_ac_savoir_faire_cta_text', true ) ?: __( 'Voir plus', 'armando-castanheira' );
    $savoir_faire_cta_url = get_post_meta( get_the_ID(), '_ac_savoir_faire_cta_url', true ) ?: home_url( '/savoir-faire/' );
    ?>
    <section class="section section-savoir-faire-preview" id="savoir-faire-preview">
        <!-- Décoration droite -->
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector1.webp' ); ?>" alt="" class="decor decor--right" aria-hidden="true">
        <div class="container">
            <div class="savoir-faire-preview__grid">
                <div class="savoir-faire-preview__content" data-animate="fade-right">
                    <h2 class="section__title"><?php echo esc_html( $savoir_faire_title ); ?></h2>
                    
                    <div class="savoir-faire-preview__text">
                        <?php 
                        if ( $savoir_faire_content ) {
                            echo wp_kses_post( $savoir_faire_content );
                        } else {
                        ?>
                        <p>Pour chaque réalisation en marbre, je sélectionne la pierre avec soin et réalise une fabrication sur mesure, depuis le choix de la pierre jusqu'à la découpe sur mesure, afin de répondre précisément aux besoins de votre réalisation.</p>
                        <p>La pose du marbre est effectuée avec méthode et précision. Chaque plaque est ajustée à la main en respectant les veines naturelles et les raccords, pour un rendu propre et équilibré.</p>
                        <p>La cristallisation du marbre permet d'entretenir et de raviver son aspect. Ce traitement apporte une finition plus brillante tout en protégeant la surface de la pierre.</p>
                        <?php } ?>
                    </div>
                    
                    <a href="<?php echo esc_url( $savoir_faire_cta_url ); ?>" class="btn btn--primary">
                        <?php echo esc_html( $savoir_faire_cta_text ); ?>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                
                <div class="savoir-faire-preview__image" data-animate="fade-left">
                    <?php 
                    if ( $savoir_faire_image ) {
                        echo '<img src="' . esc_url( $savoir_faire_image ) . '" alt="' . esc_attr( $savoir_faire_title ) . '" loading="lazy">';
                    } else {
                        echo '<img src="' . esc_url( AC_THEME_URI . '/assets/images/savoir-faire/apprendre-le-savoir-faire.webp' ) . '" alt="' . esc_attr( $savoir_faire_title ) . '" loading="lazy">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    
</main>

<?php 
    endwhile;
endif;

get_footer();
