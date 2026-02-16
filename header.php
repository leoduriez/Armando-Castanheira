<?php
/**
 * Template du header (en-tête)
 * 
 * Contient la structure HTML du header avec :
 * - Balises meta essentielles
 * - Logo du site
 * - Navigation principale
 * - Menu mobile (burger)
 * - Bouton de contact
 *
 * @package Armando_Castanheira
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/webp" href="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/favicon.webp' ); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/favicon.webp' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only" href="#main-content">
    <?php esc_html_e( 'Aller au contenu principal', 'armando-castanheira' ); ?>
</a>

<header class="site-header" id="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo du site -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
                <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/logo-ac.webp' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo__img">
            </a>

            <!-- Navigation principale au centre -->
            <nav class="main-navigation" id="main-navigation" aria-label="<?php esc_attr_e( 'Navigation principale', 'armando-castanheira' ); ?>">
                <ul class="nav-menu">
                    <li class="nav-menu__item">
                        <a href="<?php echo esc_url( home_url( '/marbre-sur-mesure/' ) ); ?>" class="nav-menu__link">
                            <?php esc_html_e( 'Réalisations', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="nav-menu__item">
                        <a href="<?php echo esc_url( home_url( '/artisans-marbrier-paris/' ) ); ?>" class="nav-menu__link">
                            <?php esc_html_e( 'Savoir-Faire', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="nav-menu__item">
                        <a href="<?php echo esc_url( home_url( '/marbre/' ) ); ?>" class="nav-menu__link">
                            <?php esc_html_e( 'Matières', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="nav-menu__item nav-menu__item--contact-mobile">
                        <a href="<?php echo esc_url( home_url( '/marbrier-paris/' ) ); ?>" class="nav-menu__link nav-menu__link--contact">
                            <?php esc_html_e( 'Contact', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Bouton de contact (séparé à droite sur desktop) -->
            <div class="header-contact">
                <a href="<?php echo esc_url( home_url( '/marbrier-paris/' ) ); ?>" class="nav-menu__link nav-menu__link--contact">
                    <?php esc_html_e( 'Contact', 'armando-castanheira' ); ?>
                </a>
            </div>

            <!-- Bouton toggle pour le menu mobile (hamburger) -->
            <label class="burger" for="burger-toggle" aria-label="<?php esc_attr_e( 'Menu', 'armando-castanheira' ); ?>">
                <input type="checkbox" id="burger-toggle">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
    </div>
</header>
