<?php
/**
 * Template Name: Matières
 * 
 * Template pour la page Matières avec Advanced Custom Fields
 * Structure calquée sur front-page.php (Page d'Accueil)
 *
 * @package Armando_Castanheira
 */

get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
?>

<main id="main-content" class="site-main page-matieres">
    
    <!-- Contenu principal pour Yoast SEO -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- ========== PAGE HEADER ========== -->
    <header class="page-header page-header--matieres">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Matières', 'armando-castanheira' ); ?></h1>
        </div>
    </header>
    
    <!-- ========== FILTRES ========== -->
    <?php 
    $current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
    ?>
    <section class="section-filter">
        <div class="container">
            <nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrer les matières', 'armando-castanheira' ); ?>">
                <ul class="filter-bar__list">
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( remove_query_arg( 'type' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'tous' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Toutes', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'marbre' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'marbre' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Marbre', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'granit' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'granit' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Granit', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( add_query_arg( 'type', 'quartzite' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'quartzite' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Quartzite', 'armando-castanheira' ); ?>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    
    <!-- ========== MATIÈRES SECTION ========== -->
    <?php
    // Vérifier si ACF est disponible
    if ( ! function_exists( 'get_field' ) ) {
        echo '<p>ACF non disponible</p>';
    }
    
    // Récupérer tous les champs ACF de la page en une seule requête
    $page_id = get_the_ID();
    $all_fields = get_fields( $page_id );
    
    // Liste des matières avec leurs métadonnées
    $matieres_data = array(
        1  => array( 'nom' => 'STEEL GREY', 'categorie' => 'granit' ),
        2  => array( 'nom' => 'GRANIT DU TARN', 'categorie' => 'granit' ),
        3  => array( 'nom' => 'VISCOUNT WHITE', 'categorie' => 'granit' ),
        4  => array( 'nom' => 'STAR GALAXY', 'categorie' => 'granit' ),
        5  => array( 'nom' => 'GRANIT NOIR ABSOLU', 'categorie' => 'granit' ),
        6  => array( 'nom' => 'BLUE PEARL', 'categorie' => 'granit' ),
        7  => array( 'nom' => 'BIANCA GIOIA', 'categorie' => 'quartzite' ),
        8  => array( 'nom' => 'INFINITY', 'categorie' => 'quartzite' ),
        9  => array( 'nom' => 'PATAGONIA', 'categorie' => 'quartzite' ),
        10 => array( 'nom' => 'PERLA VENATA', 'categorie' => 'quartzite' ),
        11 => array( 'nom' => 'AZUL MACAUBAS', 'categorie' => 'quartzite' ),
        12 => array( 'nom' => 'SEA PEARL', 'categorie' => 'quartzite' ),
        13 => array( 'nom' => 'WHITE MACAUBAS', 'categorie' => 'quartzite' ),
        14 => array( 'nom' => 'TAJ MAHAL', 'categorie' => 'quartzite' ),
        15 => array( 'nom' => 'MARBRE DE VILLEFRANCHE-DE-ROUERGUE', 'categorie' => 'marbre' ),
        16 => array( 'nom' => 'MARBRE DU LANGUEDOC', 'categorie' => 'marbre' ),
        17 => array( 'nom' => 'MARBRE DE SAINT-BEAUZIRE', 'categorie' => 'marbre' ),
        18 => array( 'nom' => 'MARBRE DE LA COURONNE', 'categorie' => 'marbre' ),
        19 => array( 'nom' => 'MARBRE DE TRETS', 'categorie' => 'marbre' ),
        20 => array( 'nom' => 'MARBRE GRAND ANTIQUE D\'AUBERT', 'categorie' => 'marbre' ),
        21 => array( 'nom' => 'MARBRE DE CAMPAN', 'categorie' => 'marbre' ),
        22 => array( 'nom' => 'MARBRE DE CHASSAGNE', 'categorie' => 'marbre' ),
        23 => array( 'nom' => 'BLEU TURQUIN', 'categorie' => 'marbre' ),
        24 => array( 'nom' => 'GRIOTTE DE CAUNES', 'categorie' => 'marbre' ),
        25 => array( 'nom' => 'SAINT-PONS', 'categorie' => 'marbre' ),
        26 => array( 'nom' => 'SARRANCOLIN', 'categorie' => 'marbre' ),
        27 => array( 'nom' => 'CAUNES MINERVOIS', 'categorie' => 'marbre' ),
        28 => array( 'nom' => 'MARBRE DU JURA', 'categorie' => 'marbre' ),
        29 => array( 'nom' => 'COMBLANCHIEN', 'categorie' => 'marbre' ),
    );
    
    // Construire le tableau des matières depuis les champs récupérés
    $matieres = array();
    foreach ( $matieres_data as $index => $data ) {
        // Récupérer depuis le tableau déjà chargé (plus rapide)
        $matiere_image = isset( $all_fields['matiere_' . $index . '_image'] ) ? $all_fields['matiere_' . $index . '_image'] : null;
        $matiere_description = isset( $all_fields['matiere_' . $index . '_description'] ) ? $all_fields['matiere_' . $index . '_description'] : '';
        
        // Gestion de l'image
        $image_url = '';
        if ( ! empty( $matiere_image ) ) {
            $image_url = is_array( $matiere_image ) ? $matiere_image['url'] : $matiere_image;
        }
        
        $matieres[] = array(
            'index'       => $index,
            'nom'         => $data['nom'],
            'categorie'   => $data['categorie'],
            'image'       => $image_url,
            'description' => $matiere_description ?: '',
        );
    }
    
    // Inverser l'ordre pour avoir Comblanchien en premier
    $matieres = array_reverse( $matieres );
    
    // Filtrer par catégorie si nécessaire
    if ( $current_filter !== 'tous' ) {
        $matieres = array_filter( $matieres, function( $m ) use ( $current_filter ) {
            return $m['categorie'] === $current_filter;
        });
        $matieres = array_values( $matieres ); // Réindexer
    }
    
    // Nombre de matières à afficher initialement
    $items_per_page = 12;
    ?>
    
    <section class="section-matieres-gallery">
        <div class="container">
            
            <!-- Grille des matières -->
            <div class="matieres-grid" id="matieres-grid">
                <?php 
                $index = 0;
                foreach ( $matieres as $matiere ) : 
                    $hidden_class = ( $index >= $items_per_page ) ? 'matiere-item--hidden' : '';
                ?>
                    <article class="matiere-item <?php echo esc_attr( $hidden_class ); ?>" data-index="<?php echo esc_attr( $index ); ?>">
                        <div class="matiere-item__card">
                            <!-- Texte en arrière-plan -->
                            <div class="matiere-item__content">
                                <p class="matiere-item__content-text"><?php echo esc_html( $matiere['description'] ); ?></p>
                            </div>
                            <!-- Image au premier plan -->
                            <div class="matiere-item__image">
                                <?php if ( $matiere['image'] ) : 
                                    // Déterminer le type de matière pour l'alt
                                    $type_matiere = '';
                                    if ( $matiere['categorie'] === 'marbre' ) {
                                        $type_matiere = 'Marbre';
                                    } elseif ( $matiere['categorie'] === 'granit' ) {
                                        $type_matiere = 'Granit';
                                    } elseif ( $matiere['categorie'] === 'quartzite' ) {
                                        $type_matiere = 'Quartzite';
                                    }
                                    $alt_text = $type_matiere . ' ' . $matiere['nom'] . ' - Matière noble pour marbrier';
                                ?>
                                    <img src="<?php echo esc_url( $matiere['image'] ); ?>" 
                                         alt="<?php echo esc_attr( $alt_text ); ?>" 
                                         loading="lazy">
                                <?php endif; ?>
                            </div>
                        </div>
                        <h2 class="matiere-item__title"><?php echo esc_html( $matiere['nom'] ); ?></h2>
                    </article>
                <?php 
                    $index++;
                endforeach; 
                ?>
            </div>
            
            <?php if ( count( $matieres ) > $items_per_page ) : ?>
            <div class="voir-plus-wrapper">
                <button type="button" class="btn btn--voir-plus" id="voir-plus-btn" 
                        data-total="<?php echo esc_attr( count( $matieres ) ); ?>" 
                        data-per-page="<?php echo esc_attr( $items_per_page ); ?>" 
                        data-current="<?php echo esc_attr( $items_per_page ); ?>">
                    <?php esc_html_e( 'Voir Plus', 'armando-castanheira' ); ?>
                </button>
            </div>
            <?php endif; ?>
            
        </div>
    </section>
    
</main>

<script>
/**
 * Galerie Matières - Chargement progressif
 * 
 * Comportement :
 * - Affichage initial : 12 images visibles
 * - Chaque clic "Voir Plus" : +12 images supplémentaires
 * - Le bouton disparaît quand tout est affiché
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // =====================================================
        // ANIMATION CARTE AU CLIC ET MOUSELEAVE
        // Au clic : image monte, texte apparaît
        // Quand le curseur quitte : image redescend, texte disparaît
        // =====================================================
        const cards = document.querySelectorAll('.matiere-item__card');
        cards.forEach(function(card) {
            // Au clic : activer l'animation
            card.addEventListener('click', function() {
                this.classList.add('active');
            });
            
            // Quand le curseur quitte la carte : désactiver l'animation
            card.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });
        });
        
        // =====================================================
        // BOUTON VOIR PLUS - Chargement progressif
        // =====================================================
        const btn = document.getElementById('voir-plus-btn');
        if (!btn) return;
        
        const ITEMS_PER_CLICK = 12;
        
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Récupérer tous les éléments encore cachés
            const hiddenItems = document.querySelectorAll('.matiere-item--hidden');
            
            console.log('Éléments cachés trouvés:', hiddenItems.length);
            
            // Si rien à afficher, cacher le bouton
            if (hiddenItems.length === 0) {
                btn.style.display = 'none';
                return;
            }
            
            // Toujours afficher exactement 12 éléments par clic (ou moins si pas assez)
            const nbToReveal = Math.min(ITEMS_PER_CLICK, hiddenItems.length);
            
            console.log('Nombre à révéler:', nbToReveal);
            
            // Révéler les éléments avec animation décalée
            for (let i = 0; i < nbToReveal; i++) {
                const item = hiddenItems[i];
                item.style.animationDelay = (i * 0.05) + 's';
                item.classList.remove('matiere-item--hidden');
                item.classList.add('fade-in');
            }
            
            // Vérifier s'il reste des éléments cachés après cette action
            setTimeout(function() {
                const remaining = document.querySelectorAll('.matiere-item--hidden');
                console.log('Éléments restants:', remaining.length);
                if (remaining.length === 0) {
                    btn.style.display = 'none';
                }
            }, 100);
        });
        
    });
})();
</script>

<?php 
    endwhile;
endif;

get_footer(); 
?>
