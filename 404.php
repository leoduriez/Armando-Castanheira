<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Armando_Castanheira
 */

get_header();
?>

<main id="main-content" class="site-main page-404">
    <div class="error-404">
        <div class="error-404__content">
            <h1 class="error-404__title">Erreur 404</h1>
            <p class="error-404__message">Veuillez relancer la page ou revenir à l'accueil</p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__btn">
                <?php esc_html_e( 'Retour à l\'accueil', 'armando-castanheira' ); ?>
            </a>
        </div>
    </div>
</main>

<?php
get_footer();
