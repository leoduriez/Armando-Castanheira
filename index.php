<?php
/**
 * The main template file
 *
 * @package Armando_Castanheira
 */

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
        else :
            echo '<p>' . esc_html__( 'Aucun contenu trouvé.', 'armando-castanheira' ) . '</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
