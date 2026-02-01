<?php
/**
 * Armando Castanheira - Functions and definitions
 *
 * @package Armando_Castanheira
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Define theme constants
 */
define( 'AC_THEME_VERSION', '1.0.0' );
define( 'AC_THEME_DIR', get_template_directory() );
define( 'AC_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function ac_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Custom image sizes
    add_image_size( 'realisation-card', 800, 600, true );
    add_image_size( 'realisation-large', 1200, 800, true );
    add_image_size( 'matiere-card', 600, 400, true );
    add_image_size( 'hero-image', 1920, 1080, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary'   => __( 'Menu Principal', 'armando-castanheira' ),
        'footer'    => __( 'Menu Footer', 'armando-castanheira' ),
    ) );

    // Switch default core markup to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Remove support for block widgets
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'ac_theme_setup' );

/**
 * Set the content width in pixels
 */
function ac_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ac_content_width', 1200 );
}
add_action( 'after_setup_theme', 'ac_content_width', 0 );

/**
 * Include required files
 */
require AC_THEME_DIR . '/inc/enqueue.php';
require AC_THEME_DIR . '/inc/custom-post-types.php';
require AC_THEME_DIR . '/inc/taxonomies.php';
require AC_THEME_DIR . '/inc/security.php';
require AC_THEME_DIR . '/inc/template-functions.php';
require AC_THEME_DIR . '/inc/ajax-handlers.php';
require AC_THEME_DIR . '/inc/customizer.php';
// require AC_THEME_DIR . '/inc/homepage-metaboxes.php';
// require AC_THEME_DIR . '/inc/realisations-metaboxes.php';

/**
 * Disable jQuery migration and move jQuery to footer (if ever needed by plugins)
 * We don't use jQuery in this theme, but some plugins might require it
 */
function ac_optimize_jquery() {
    if ( ! is_admin() ) {
        // Deregister jQuery migrate
        wp_deregister_script( 'jquery-migrate' );
    }
}
add_action( 'wp_enqueue_scripts', 'ac_optimize_jquery', 1 );

/**
 * Remove WordPress emoji scripts
 */
function ac_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'ac_disable_emojis' );

/**
 * Remove unnecessary header items
 */
function ac_clean_head() {
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
}
add_action( 'init', 'ac_clean_head' );

/**
 * Add custom body classes
 */
function ac_body_classes( $classes ) {
    // Add page slug as class
    if ( is_page() ) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }

    // Add class if is front page
    if ( is_front_page() ) {
        $classes[] = 'is-front-page';
    }

    return $classes;
}
add_filter( 'body_class', 'ac_body_classes' );

/**
 * Custom excerpt length
 */
function ac_excerpt_length( $length ) {
    return 25;
}
add_filter( 'excerpt_length', 'ac_excerpt_length' );

/**
 * Custom excerpt more
 */
function ac_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'ac_excerpt_more' );

/* ==========================================================================
   PERFORMANCE OPTIMIZATIONS
   ========================================================================== */

/**
 * Disable unnecessary features for performance
 */
function ac_performance_optimizations() {
    // Disable WordPress emoji inline styles and scripts
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    
    // Remove WordPress version
    remove_action( 'wp_head', 'wp_generator' );
    
    // Remove RSD link
    remove_action( 'wp_head', 'rsd_link' );
    
    // Remove Windows Live Writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    
    // Remove WP JSON/REST API link
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
}
add_action( 'init', 'ac_performance_optimizations' );

/**
 * Enable lazy loading for images
 */
function ac_add_image_attributes( $attr, $attachment = null ) {
    $attr['loading'] = 'lazy';
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ac_add_image_attributes', 10, 2 );

/**
 * Remove unnecessary emoji script filter
 */
function ac_filter_script_loader_tag( $tag, $handle ) {
    if ( 'emoji-js' === $handle ) {
        return '';
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'ac_filter_script_loader_tag', 10, 2 );

/**
 * Optimize CSS and JS loading
 */
function ac_optimize_assets() {
    // Load scripts in footer for better performance
    wp_enqueue_script( 
        'ac-main', 
        AC_THEME_URI . '/assets/js/main.js', 
        array(), 
        AC_THEME_VERSION, 
        true // Load in footer
    );
}
// Hook is already in enqueue.php, but ensure footer loading

/**
 * Add preconnect and prefetch hints for performance
 */
function ac_add_preconnect_hints() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action( 'wp_head', 'ac_add_preconnect_hints', 2 );

/**
 * Add DNS prefetch for external resources
 */
function ac_add_dns_prefetch() {
    ?>
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <?php
}
add_action( 'wp_head', 'ac_add_dns_prefetch', 2 );

/**
 * Defer non-critical CSS
 */
function ac_defer_non_critical_css() {
    // Add loading="async" attribute to stylesheet
    wp_enqueue_style( 
        'ac-style', 
        AC_THEME_URI . '/style.css', 
        array(), 
        AC_THEME_VERSION 
    );
}

/**
 * Optimize image delivery with srcset for modern formats
 */
function ac_add_responsive_images() {
    add_image_size( 'realisation-small', 600, 450, true );
    add_image_size( 'realisation-medium', 900, 675, true );
    add_image_size( 'realisation-xlarge', 1400, 1050, true );
}
add_action( 'after_setup_theme', 'ac_add_responsive_images' );

/**
 * Browser caching headers
 */
function ac_add_cache_headers() {
    // Set cache headers for static assets
    if ( ! is_admin() ) {
        header( 'Cache-Control: public, max-age=31536000, immutable', true );
    }
}
// Uncomment if not using server-side caching
// add_action( 'send_headers', 'ac_add_cache_headers' );

/* ==========================================================================
   END PERFORMANCE OPTIMIZATIONS
   ========================================================================== */

/**
 * Désactiver wpautop (auto-paragraphes) pour la page d'accueil
 * Cela empêche WordPress d'ajouter des balises <p> parasites dans le contenu
 */
function ac_disable_wpautop_on_homepage( $content ) {
    if ( is_page() && is_front_page() ) {
        remove_filter( 'the_content', 'wpautop' );
    }
    return $content;
}
add_filter( 'the_content', 'ac_disable_wpautop_on_homepage', 0 );

/**
 * Ensure WordPress media scripts are loaded in admin
 * This fixes the "Set featured image" button not working
 */
function ac_enqueue_admin_scripts( $hook ) {
    // Load media scripts on post edit screens
    if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
        wp_enqueue_media();
    }
}
add_action( 'admin_enqueue_scripts', 'ac_enqueue_admin_scripts' );

/**
 * Shortcode pour afficher toutes les matières sur une seule page
 * Usage: [afficher_matieres]
 */
function ac_shortcode_afficher_matieres( $atts ) {
    // Récupérer le filtre depuis l'URL
    $current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
    
    // Arguments de la requête
    $args = array(
        'post_type'      => 'matiere',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    // Ajouter le filtre par catégorie si nécessaire
    if ( $current_filter !== 'tous' ) {
        $args['meta_query'] = array(
            array(
                'key'     => 'matiere_categorie',
                'value'   => $current_filter,
                'compare' => '='
            )
        );
    }
    
    // Exécuter la requête
    $matieres_query = new WP_Query( $args );
    
    // Démarrer le buffer de sortie
    ob_start();
    
    if ( $matieres_query->have_posts() ) :
    ?>
        <div class="matieres-shortcode-wrapper">
            <div class="matieres-grid">
                <?php 
                while ( $matieres_query->have_posts() ) : 
                    $matieres_query->the_post();
                    
                    $matiere_image = get_field( 'matiere_image' );
                    $matiere_description = get_field( 'matiere_description' );
                    $matiere_categorie = get_field( 'matiere_categorie' );
                    
                    // Gérer l'image (array ou string)
                    $image_url = '';
                    if ( is_array( $matiere_image ) && ! empty( $matiere_image['url'] ) ) {
                        $image_url = $matiere_image['url'];
                    } elseif ( is_string( $matiere_image ) && ! empty( $matiere_image ) ) {
                        $image_url = $matiere_image;
                    }
                ?>
                    <article class="matiere-card" data-category="<?php echo esc_attr( $matiere_categorie ?: 'autres' ); ?>">
                        <div class="matiere-card__image">
                            <?php if ( $image_url ) : ?>
                                <img src="<?php echo esc_url( $image_url ); ?>" 
                                     alt="<?php echo esc_attr( get_the_title() ); ?>"
                                     loading="lazy">
                            <?php endif; ?>
                        </div>
                        <div class="matiere-card__content">
                            <h2 class="matiere-card__title"><?php the_title(); ?></h2>
                            <?php if ( $matiere_description ) : ?>
                                <p class="matiere-card__description"><?php echo esc_html( $matiere_description ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php 
                endwhile;
                ?>
            </div>
        </div>
    <?php
    else :
        echo '<p>Aucune matière trouvée.</p>';
    endif;
    
    wp_reset_postdata();
    
    // Retourner le contenu du buffer
    return ob_get_clean();
}
add_shortcode( 'afficher_matieres', 'ac_shortcode_afficher_matieres' );

/**
 * Shortcode pour afficher toutes les matières en HTML statique
 * Usage: [matieres_static]
 */
function ac_shortcode_matieres_static( $atts ) {
    // Récupérer le filtre depuis l'URL
    $current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';
    
    // Liste des 29 matières
    $matieres = array(
        array( 'nom' => 'STEEL GREY', 'categorie' => 'granit', 'image' => 'matiere/steel-grey.webp', 'description' => 'Le Granit Steel Grey, originaire d\'Inde, se distingue par un fond gris acier homogène parsemé de fines particules argentées, noires et grises. Son aspect équilibré et lumineux confère à cette pierre naturelle un style moderne, sobre et élégant, parfait pour les aménagements intérieurs et extérieurs alliant raffinement, durabilité et résistance.' ),
        array( 'nom' => 'GRANIT DU TARN', 'categorie' => 'granit', 'image' => 'matiere/granit-du-tarn.webp', 'description' => 'Issu du massif du Sidobre, dans le Tarn, ce granit français se caractérise par ses tons gris bleutés et son grain dynamique, rehaussé de cristaux brillants. Sa texture mouchetée apporte un charme authentique et intemporel, tandis que sa robustesse naturelle garantit une fiabilité exceptionnelle pour les projets contemporains comme pour les réalisations plus traditionnelles.' ),
        array( 'nom' => 'VISCOUNT WHITE', 'categorie' => 'granit', 'image' => 'matiere/viscount-white.webp', 'description' => 'Venu d\'Inde, le Viscount White séduit par ses tons gris très clairs et ses veinures souples créant de subtils mouvements sur la pierre. Son aspect doux et lumineux, évoquant le marbre, s\'associe à la robustesse caractéristique du granit, en faisant un choix idéal pour les intérieurs sobres, élégants et durables.' ),
        array( 'nom' => 'STAR GALAXY', 'categorie' => 'granit', 'image' => 'matiere/star-galaxy.webp', 'description' => 'Issu des carrières d\'Inde, le Star Galaxy séduit par son noir profond parsemé d\'éclats métalliques dorés, évoquant un ciel étoilé. Ce contraste spectaculaire crée un effet lumineux unique, faisant de ce granit une pierre élégante, moderne et sophistiquée, idéale pour sublimer les espaces au style contemporain, raffiné ou luxueux.' ),
        array( 'nom' => 'GRANIT NOIR ABSOLU', 'categorie' => 'granit', 'image' => 'matiere/granit-noir-absolu.webp', 'description' => 'Originaire d\'Inde, le Noir Absolu est un granit à la teinte noire intense et homogène, véritable symbole d\'élégance et de modernité. Sa texture lisse et son aspect profond confèrent un style pur et intemporel à tout projet. À la fois robuste et raffiné, il s\'intègre aussi bien aux designs minimalistes qu\'aux créations contrastées.' ),
        array( 'nom' => 'BLUE PEARL', 'categorie' => 'granit', 'image' => 'matiere/blue-pearl.webp', 'description' => 'Originaire de Norvège, le Blue Pearl charme par sa teinte bleu‑gris profonde et ses reflets métalliques captant superbement la lumière. Ses cristaux irisés, nuancés d\'argent et de bleu, confèrent à cette pierre un éclat saisissant et élégant, parfait pour insuffler une touche de modernité raffinée à tout espace intérieur ou extérieur.' ),
        array( 'nom' => 'BIANCA GIOIA', 'categorie' => 'quartzite', 'image' => 'matiere/bianca-gioia.webp', 'description' => 'Issu des carrières du Brésil, le Bianca Gioia séduit par sa lueur délicate et son poli éclatant. Sa blancheur subtile reflète magnifiquement la lumière, apportant une clarté naturelle qui agrandit visuellement les espaces et crée une atmosphère douce, raffinée et lumineuse, idéale pour des intérieurs élégants et harmonieux.' ),
        array( 'nom' => 'INFINITY', 'categorie' => 'quartzite', 'image' => 'matiere/infinity.webp', 'description' => 'Venu du Brésil, le Quartzite Infinity séduit par sa palette douce et équilibrée, parcourue de légères ondulations qui évoquent le mouvement du marbre. Sa texture apaisante et sa résistance naturelle en font un matériau idéal pour des intérieurs sophistiqués et intemporels.' ),
        array( 'nom' => 'PATAGONIA', 'categorie' => 'quartzite', 'image' => 'matiere/patagonia.webp', 'description' => 'Née des terres du Brésil, la Patagonia est une pierre d\'exception formée par la rencontre naturelle du quartz, du feldspath et des oxydes de fer. Elle révèle une surface vivante et contrastée, mêlant nuances beiges, bruns intenses et cristaux scintillants. Véritable œuvre de la nature, elle confère à chaque projet un caractère fort et contemporain.' ),
        array( 'nom' => 'PERLA VENATA', 'categorie' => 'quartzite', 'image' => 'matiere/perla-venata.webp', 'description' => 'Issu des carrières du Brésil, le Perla Venata séduit par son blanc ivoire délicat rehaussé de fines veines dorées aussi subtiles qu\'élégantes. Son aspect à la fois chaleureux et apaisant en fait un matériau idéal pour les intérieurs sobres, raffinés et lumineux, tout en garantissant la résistance exceptionnelle propre au quartzite.' ),
        array( 'nom' => 'AZUL MACAUBAS', 'categorie' => 'quartzite', 'image' => 'matiere/azul-macaubas.webp', 'description' => 'Extraite au Brésil, l\'Azul Macaubas séduit par son bleu profond et lumineux, surnommé « Bleu du Brésil ». Ses motifs naturels, rappelant les vagues ou l\'horizon, insufflent une sensation de fraîcheur et d\'élégance. Pierre à la fois raffinée et spectaculaire, elle sublime les espaces et s\'impose comme un choix d\'exception pour les projets haut de gamme.' ),
        array( 'nom' => 'SEA PEARL', 'categorie' => 'quartzite', 'image' => 'matiere/sea-pearl.webp', 'description' => 'Venu du Brésil, le Sea Pearl rappelle la sérénité des pierres polies par la mer. Ses nuances de gris délicatement veinées créent un effet visuel apaisant, alliant équilibre, douceur et raffinement. À la fois résistant et élégant, ce quartzite s\'harmonise parfaitement avec des ambiances modernes comme avec des espaces plus classiques.' ),
        array( 'nom' => 'WHITE MACAUBAS', 'categorie' => 'quartzite', 'image' => 'matiere/white-macaubas.webp', 'description' => 'Originaire du Brésil, le White Macaubas séduit par sa blancheur éclatante traversée de fines veines grises rappelant la délicatesse du marbre. Derrière son apparence subtile se cache une pierre d\'une résistance remarquable, aussi solide que le granit. Élégant, moderne et intemporel, il insuffle à chaque projet une touche unique de pureté et de raffinement.' ),
        array( 'nom' => 'TAJ MAHAL', 'categorie' => 'quartzite', 'image' => 'matiere/taj-mahal.webp', 'description' => 'Originaire de la région d\'Uruoca, au Brésil, le Quartzite Taj Mahal séduit par son fond blanc crème délicatement traversé de fines veines dorées. Alliant élégance et résistance, cette pierre naturelle offre un aspect doux et lumineux, parfait pour sublimer les cuisines, salles de bains ou aménagements intérieurs haut de gamme.' ),
        array( 'nom' => 'MARBRE DE VILLEFRANCHE-DE-ROUERGUE', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-villefranche-de-rouergue.webp', 'description' => 'Originaire de l\'Aveyron, le Marbre de Villefranche‑de‑Rouergue révèle de superbes nuances de rouge et de rose, agrémentées de délicates veines blanches. Ce marbre au caractère affirmé, autrefois prisé pour orner monuments et demeures, séduit toujours par sa chaleur naturelle, son élégance authentique et son charme intemporel dans les projets décoratifs raffinés.' ),
        array( 'nom' => 'MARBRE DU LANGUEDOC', 'categorie' => 'marbre', 'image' => 'matiere/marbre-du-langudoc.webp', 'description' => 'Issu des carrières historiques de Caunes‑Minervois, au cœur du Languedoc, ce marbre d\'exception se distingue par ses nuances raffinées, du rose tendre au rouge profond, traversées de fines veines blanches. Utilisé depuis l\'Antiquité dans les palais et monuments français, le Marbre du Languedoc incarne élégance, richesse et tradition du savoir‑faire méridional.' ),
        array( 'nom' => 'MARBRE DE SAINT-BEAUZIRE', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-saint-beauzire.webp', 'description' => 'Originaire du Puy‑de‑Dôme, le Marbre de Saint‑Beauzire charme par ses teintes chaudes, oscillant entre rouge rosé et brun profond. Ses fines veines claires créent un contraste harmonieux, sublimant la beauté naturelle de cette pierre. À la fois rare, robuste et expressive, elle incarne tout le caractère et la tradition authentique des marbres d\'Auvergne.' ),
        array( 'nom' => 'MARBRE DE LA COURONNE', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-la-courone.webp', 'description' => 'Issu des carrières de La Couronne, sur la Côte Bleue près de Martigues, ce marbre à la teinte rosée et lumineuse est exploité depuis l\'Antiquité. Utilisé dans de nombreux monuments marseillais, le Marbre de la Couronne séduit par son charme méditerranéen, sa douce couleur solaire et son héritage historique profondément ancré dans le Sud.' ),
        array( 'nom' => 'MARBRE DE TRETS', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-trets.webp', 'description' => 'Issu des carrières de Trets, en Provence, le Marbre de Trets aussi appelé « marbre jaspé du pays », séduit par ses tons chauds, dominés par le jaune doré et parcourus de veines rouges nuancées. Utilisé depuis le XVIIᵉ siècle, il illustre un savoir‑faire ancestral et célèbre la beauté expressive, chaleureuse et élégante des marbres méridionaux.' ),
        array( 'nom' => 'MARBRE GRAND ANTIQUE D\'AUBERT', 'categorie' => 'marbre', 'image' => 'matiere/marbre-grand-antique-aubert.webp', 'description' => 'Le Grand Antique d\'Aubert, originaire de l\'Ariège, est un marbre au caractère fort, reconnaissable à son contraste spectaculaire entre un noir profond et un blanc pur qui attire le regard. Utilisé depuis des siècles dans des édifices prestigieux, il incarne le raffinement, la force et la noblesse du marbre français.' ),
        array( 'nom' => 'MARBRE DE CAMPAN', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-campan.webp', 'description' => 'Le Marbre de Campan, originaire des Pyrénées, se distingue par ses couleurs douces et nuancées, mêlant des tons verts tendres et rosés, où chaque pièce révèle un mouvement unique animé de veines délicates qui apportent profondeur, charme et élégance, capable de sublimer aussi bien un intérieur classique qu\'un décor résolument contemporain.' ),
        array( 'nom' => 'MARBRE DE CHASSAGNE', 'categorie' => 'marbre', 'image' => 'matiere/marbre-de-chassagne.webp', 'description' => 'La Pierre de Chassagne, issue des carrières de Chassagne‑Montrachet en Bourgogne, se distingue par ses tons clairs et chaleureux, du beige au rose saumoné, associés à un grain délicat et de fines veines cristallines qui lui confèrent une élégance naturelle, idéale pour composer des ambiances sobres, lumineuses et intemporelles dans tout type de projet intérieur.' ),
        array( 'nom' => 'BLEU TURQUIN', 'categorie' => 'marbre', 'image' => 'matiere/bleu-turquin.webp', 'description' => 'Le Bleu Turquin, ou Bardiglio, est un marbre d\'origine italienne à la douce teinte gris‑bleu, animé de veines blanches ou noires qui dessinent des motifs subtils et raffinés, lui donnant une allure élégante et légèrement vintage, idéale pour apporter une touche de raffinement discret et intemporel à tous types d\'intérieurs.' ),
        array( 'nom' => 'GRIOTTE DE CAUNES', 'categorie' => 'marbre', 'image' => 'matiere/griotte-de-caunes.webp', 'description' => 'Le Marbre Griotte de Caunes, extrait des carrières de Caunes‑Minervois, se distingue par son rouge intense, ponctué de petites inclusions plus claires issues de fossiles anciens, qui lui confèrent un aspect vivant, chaleureux et authentique, idéal pour apporter du caractère et une vraie personnalité à n\'importe quel espace intérieur.' ),
        array( 'nom' => 'SAINT-PONS', 'categorie' => 'marbre', 'image' => 'matiere/saint-pons.webp', 'description' => 'Le Marbre de Saint‑Pons compte parmi les pierres emblématiques du sud de la France, réputé pour son rouge profond et chaleureux tout en offrant de superbes variantes plus claires, du blanc crème au blanc neige, comme les Skyros ou Kuros Perle de Nacre, aux reflets subtils, parfois délicatement veinés de gris, de violet ou de doré, qui apportent une élégance naturelle et lumineuse à chaque projet.' ),
        array( 'nom' => 'SARRANCOLIN', 'categorie' => 'marbre', 'image' => 'matiere/sarrancolin.webp', 'description' => 'Le Marbre de Sarrancolin est une pierre naturelle rare et expressive, extraite des carrières pyrénéennes autour du village éponyme, connue pour ses teintes nuancées de gris, beige ou rose, sublimées par des veines rouges, dorées ou claires qui créent un effet visuel chaleureux, spectaculaire et emblématique du savoir‑faire des marbres français.' ),
        array( 'nom' => 'CAUNES MINERVOIS', 'categorie' => 'marbre', 'image' => 'matiere/caunes-minervois.webp', 'description' => 'Le Marbre de Caunes‑Minervois, aussi appelé marbre du Languedoc, provient du village éponyme au cœur de l\'Aude et bénéficie d\'une renommée séculaire pour ses couleurs intenses, allant du rose délicat au rouge profond, souvent animées de veines blanches élégantes qui soulignent son caractère noble, expressif et unique dans chaque réalisation.' ),
        array( 'nom' => 'MARBRE DU JURA', 'categorie' => 'marbre', 'image' => 'matiere/marbre-du-jura.webp', 'description' => 'Le Marbre du Jura est une pierre naturelle originaire du massif jurassien, souvent appelée marbre bien qu\'il s\'agisse d\'un calcaire poli aux superbes nuances, allant du beige clair au gris-bleu, parfois réhaussé de veines délicates et de subtiles traces fossiles qui racontent l\'histoire de la pierre et rendent chaque réalisation vraiment unique.' ),
        array( 'nom' => 'COMBLANCHIEN', 'categorie' => 'marbre', 'image' => 'matiere/comblanchien.webp', 'description' => 'Le Comblanchien est une pierre calcaire de Bourgogne à grain très fin, naturellement compacte et d\'une belle teinte beige rosé. Parfois traversée de veines ou d\'inclusions fossiles, elle séduit par son aspect raffiné, proche du marbre, et sa grande résistance, idéale pour les projets aussi bien intérieurs qu\'extérieurs.' ),
    );
    
    // Filtrer selon la catégorie
    $matieres_filtrees = array();
    foreach ( $matieres as $matiere ) {
        if ( $current_filter === 'tous' || $matiere['categorie'] === $current_filter ) {
            $matieres_filtrees[] = $matiere;
        }
    }
    
    // Générer le HTML
    ob_start();
    ?>
    <div class="matieres-grid">
        <?php foreach ( $matieres_filtrees as $matiere ) : ?>
            <article class="matiere-item">
                <div class="matiere-item__card" onclick="this.classList.toggle('active')">
                    <div class="matiere-item__content">
                        <p class="matiere-item__content-text"><?php echo esc_html( $matiere['description'] ); ?></p>
                    </div>
                    <div class="matiere-item__image">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $matiere['image'] ); ?>" 
                             alt="<?php echo esc_attr( $matiere['nom'] ); ?>" 
                             loading="lazy">
                    </div>
                </div>
                <h2 class="matiere-item__title"><?php echo esc_html( $matiere['nom'] ); ?></h2>
            </article>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'matieres_static', 'ac_shortcode_matieres_static' );

/* ==========================================================================
   SECTION AVIS CLIENTS
   ========================================================================== */

/**
 * Ajouter la section Avis Clients avant le footer
 */
add_action('get_footer', 'avis_clients_render_section');

function avis_clients_render_section() {
    if (!is_front_page()) return;
    
    ?>
    <!-- DÉBUT SECTION AVIS CLIENTS -->
    <section id="avis-clients-section" class="avis-clients-wrapper">
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/vector2.webp' ); ?>" alt="" class="decor decor--left" aria-hidden="true">
        <div class="avis-container">
            <!-- Titre de la section -->
            <h2 class="section__title section__title--center avis-title">Ce que disent nos clients</h2>
            
            <!-- Carousel des avis -->
            <div class="avis-carousel-wrapper">
                <button class="carousel-btn carousel-prev" aria-label="Avis précédent">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                
                <div class="avis-carousel">
                    <div class="carousel-track">
                        <!-- Les avis seront ajoutés dynamiquement ici -->
                        <div class="avis-card">
                            <div class="avis-header">
                                <div class="avis-avatar">M</div>
                                <div class="avis-info">
                                    <h3 class="avis-prenom">Marie</h3>
                                    <div class="avis-stars">
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                    </div>
                                </div>
                            </div>
                            <p class="avis-commentaire">Excellent service ! Je recommande vivement. L'équipe est très professionnelle et à l'écoute.</p>
                        </div>
                    </div>
                </div>
                
                <button class="carousel-btn carousel-next" aria-label="Avis suivant">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
            
            <!-- Indicateurs du carousel -->
            <div class="carousel-indicators"></div>
            
            <!-- Formulaire d'ajout d'avis -->
            <div class="avis-form-wrapper">
                <h3 class="form-title">Partagez votre expérience</h3>
                <form id="avis-form" class="avis-form">
                    <div class="form-group">
                        <label for="prenom">Prénom <span class="required">*</span></label>
                        <input 
                            type="text" 
                            id="prenom" 
                            name="prenom" 
                            placeholder="Votre prénom" 
                            required 
                            maxlength="50"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="commentaire">Votre avis <span class="required">*</span></label>
                        <textarea 
                            id="commentaire" 
                            name="commentaire" 
                            placeholder="Partagez votre expérience avec nous..." 
                            required 
                            rows="4"
                            maxlength="500"
                        ></textarea>
                        <span class="char-count">0/500</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Votre note <span class="required">*</span></label>
                        <div class="rating-input">
                            <span class="rating-star" data-rating="1">★</span>
                            <span class="rating-star" data-rating="2">★</span>
                            <span class="rating-star" data-rating="3">★</span>
                            <span class="rating-star" data-rating="4">★</span>
                            <span class="rating-star" data-rating="5">★</span>
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Envoyer mon avis</span>
                        <span class="btn-loader" style="display: none;">
                            <svg class="spinner" viewBox="0 0 50 50">
                                <circle cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                        </span>
                    </button>
                    
                    <p class="form-message"></p>
                </form>
            </div>
        </div>
    </section>
    <!-- FIN SECTION AVIS CLIENTS -->
    <?php
}

/**
 * Enqueue les styles CSS pour la section Avis Clients
 */
add_action('wp_enqueue_scripts', 'avis_clients_enqueue_styles');

function avis_clients_enqueue_styles() {
    if (is_front_page()) {
        wp_enqueue_style(
            'avis-clients',
            AC_THEME_URI . '/assets/css/components/avis-clients.css',
            array(),
            AC_THEME_VERSION
        );
    }
}

/**
 * Enqueue le JavaScript pour la section Avis Clients
 */
add_action('wp_enqueue_scripts', 'avis_clients_enqueue_scripts');

function avis_clients_enqueue_scripts() {
    if (is_front_page()) {
        wp_enqueue_script(
            'avis-clients',
            AC_THEME_URI . '/assets/js/components/avis-clients.js',
            array(),
            AC_THEME_VERSION,
            true
        );
    }
}
