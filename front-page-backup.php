<?php
/**
 * Front Page Template - Version Simplifiée
 * 
 * Template pour la page d'accueil utilisant uniquement le contenu principal WordPress
 * Tout le contenu est géré via l'éditeur WordPress (pas de metaboxes ni champs personnalisés)
 *
 * @package Armando_Castanheira
 */

get_header();

// Boucle WordPress standard
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>

<main id="main-content" class="site-main page-home">
    
    <?php 
    /**
     * Affichage du contenu principal
     * Tout le HTML de la page d'accueil doit être inséré dans l'éditeur WordPress
     */
    the_content(); 
    ?>
    
</main>

<?php 
    endwhile;
endif;

get_footer();
