<?php
/**
 * Template part for displaying a single matière card
 *
 * @package Armando_Castanheira
 */

?>

<article class="matiere-item" data-animate="fade-up">
    <div class="matiere-item__image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'matiere-card', array(
                'class'   => 'matiere-item__img',
                'loading' => 'lazy',
            ) ); ?>
        <?php else : ?>
            <div class="matiere-item__placeholder"></div>
        <?php endif; ?>
    </div>
    
    <div class="matiere-item__content">
        <h3 class="matiere-item__title"><?php the_title(); ?></h3>
        
        <?php
        // Display type
        $terms = get_the_terms( get_the_ID(), 'type_matiere' );
        if ( $terms && ! is_wp_error( $terms ) ) :
            $term = $terms[0];
        ?>
            <span class="matiere-item__type"><?php echo esc_html( $term->name ); ?></span>
        <?php endif; ?>
        
        <div class="matiere-item__description">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
