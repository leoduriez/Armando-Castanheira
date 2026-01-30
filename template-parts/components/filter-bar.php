<?php
/**
 * Template part for filter bar component
 *
 * @package Armando_Castanheira
 * 
 * @param array $args {
 *     @type string $taxonomy  The taxonomy to get terms from
 *     @type string $all_label Label for "all" filter button
 * }
 */

$taxonomy = isset( $args['taxonomy'] ) ? $args['taxonomy'] : 'type_realisation';
$all_label = isset( $args['all_label'] ) ? $args['all_label'] : 'Tous';

$terms = get_terms( array(
    'taxonomy'   => $taxonomy,
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
) );

if ( empty( $terms ) || is_wp_error( $terms ) ) {
    return;
}

// Get current filter from URL
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
?>

<nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrer les éléments', 'armando-castanheira' ); ?>">
    <ul class="filter-bar__list">
        <li class="filter-bar__item">
            <button 
                type="button" 
                class="filter-btn <?php echo $current_filter === 'tous' ? 'active' : ''; ?>" 
                data-filter="tous"
                aria-pressed="<?php echo $current_filter === 'tous' ? 'true' : 'false'; ?>"
            >
                <?php echo esc_html( $all_label ); ?>
            </button>
        </li>
        
        <?php foreach ( $terms as $term ) : ?>
            <li class="filter-bar__item">
                <button 
                    type="button" 
                    class="filter-btn <?php echo $current_filter === $term->slug ? 'active' : ''; ?>" 
                    data-filter="<?php echo esc_attr( $term->slug ); ?>"
                    aria-pressed="<?php echo $current_filter === $term->slug ? 'true' : 'false'; ?>"
                >
                    <?php echo esc_html( $term->name ); ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
