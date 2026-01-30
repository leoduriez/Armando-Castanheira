<?php
/**
 * Template Name: Page Demande de Devis
 * 
 * Template pour la page de demande de devis
 *
 * @package suspended_starter
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="page-hero page-hero--devis">
        <div class="container">
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <p class="page-hero__subtitle">
                <?php _e('Décrivez votre projet et recevez une estimation personnalisée sous 48h', 'suspended_starter'); ?>
            </p>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="section section--devis">
        <div class="container">
            
            <div class="devis-layout">
                
                <!-- Colonne formulaire -->
                <div class="devis-layout__form">
                    <?php
                    // Afficher le contenu de la page si présent
                    while (have_posts()) :
                        the_post();
                        if (get_the_content()) :
                            ?>
                            <div class="devis-intro">
                                <?php the_content(); ?>
                            </div>
                            <?php
                        endif;
                    endwhile;

                    // Afficher le formulaire de devis via shortcode
                    if (shortcode_exists('armando_devis')) {
                        echo do_shortcode('[armando_devis]');
                    } else {
                        ?>
                        <div class="notice notice--warning">
                            <p><?php _e('Le formulaire de devis n\'est pas disponible. Veuillez activer le plugin Armando Castanheira.', 'suspended_starter'); ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Sidebar informations -->
                <aside class="devis-layout__sidebar">
                    
                    <!-- Pourquoi nous choisir -->
                    <div class="devis-card">
                        <h3 class="devis-card__title">
                            <span class="icon">✓</span>
                            <?php _e('Pourquoi nous choisir', 'suspended_starter'); ?>
                        </h3>
                        <ul class="devis-card__list">
                            <li><?php _e('Plus de 30 ans d\'expérience', 'suspended_starter'); ?></li>
                            <li><?php _e('Artisan marbrier qualifié', 'suspended_starter'); ?></li>
                            <li><?php _e('Matériaux de qualité premium', 'suspended_starter'); ?></li>
                            <li><?php _e('Devis gratuit et sans engagement', 'suspended_starter'); ?></li>
                            <li><?php _e('Réponse sous 48h', 'suspended_starter'); ?></li>
                        </ul>
                    </div>

                    <!-- Contact direct -->
                    <div class="devis-card devis-card--contact">
                        <h3 class="devis-card__title">
                            <span class="icon">📞</span>
                            <?php _e('Besoin d\'un conseil ?', 'suspended_starter'); ?>
                        </h3>
                        <p><?php _e('Notre équipe est à votre écoute pour répondre à toutes vos questions.', 'suspended_starter'); ?></p>
                        
                        <?php 
                        $phone = get_theme_mod('contact_phone', '+33 1 23 45 67 89');
                        $email = get_theme_mod('contact_email', 'contact@armando-castanheira.com');
                        ?>
                        
                        <div class="devis-card__contact-info">
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="contact-link contact-link--phone">
                                <span class="dashicons dashicons-phone"></span>
                                <?php echo esc_html($phone); ?>
                            </a>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-link contact-link--email">
                                <span class="dashicons dashicons-email"></span>
                                <?php echo esc_html($email); ?>
                            </a>
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div class="devis-card">
                        <h3 class="devis-card__title">
                            <span class="icon">🕐</span>
                            <?php _e('Horaires d\'ouverture', 'suspended_starter'); ?>
                        </h3>
                        <ul class="devis-card__hours">
                            <li>
                                <span><?php _e('Lundi - Vendredi', 'suspended_starter'); ?></span>
                                <span>8h00 - 18h00</span>
                            </li>
                            <li>
                                <span><?php _e('Samedi', 'suspended_starter'); ?></span>
                                <span>9h00 - 12h00</span>
                            </li>
                            <li>
                                <span><?php _e('Dimanche', 'suspended_starter'); ?></span>
                                <span><?php _e('Fermé', 'suspended_starter'); ?></span>
                            </li>
                        </ul>
                    </div>

                </aside>

            </div>

        </div>
    </section>

    <!-- Section réassurance -->
    <section class="section section--reassurance bg-light">
        <div class="container">
            <div class="reassurance-grid">
                <div class="reassurance-item">
                    <div class="reassurance-item__icon">🏆</div>
                    <h4 class="reassurance-item__title"><?php _e('Qualité artisanale', 'suspended_starter'); ?></h4>
                    <p><?php _e('Chaque projet est réalisé avec le plus grand soin par nos artisans qualifiés.', 'suspended_starter'); ?></p>
                </div>
                <div class="reassurance-item">
                    <div class="reassurance-item__icon">💎</div>
                    <h4 class="reassurance-item__title"><?php _e('Matériaux nobles', 'suspended_starter'); ?></h4>
                    <p><?php _e('Nous sélectionnons les plus beaux marbres et granits pour vos projets.', 'suspended_starter'); ?></p>
                </div>
                <div class="reassurance-item">
                    <div class="reassurance-item__icon">🤝</div>
                    <h4 class="reassurance-item__title"><?php _e('Accompagnement', 'suspended_starter'); ?></h4>
                    <p><?php _e('De la conception à la pose, nous vous accompagnons à chaque étape.', 'suspended_starter'); ?></p>
                </div>
                <div class="reassurance-item">
                    <div class="reassurance-item__icon">✅</div>
                    <h4 class="reassurance-item__title"><?php _e('Garantie', 'suspended_starter'); ?></h4>
                    <p><?php _e('Tous nos travaux sont garantis pour votre tranquillité d\'esprit.', 'suspended_starter'); ?></p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
