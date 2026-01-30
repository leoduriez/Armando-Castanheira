<?php
/**
 * Template Name: Matières (Static)
 * 
 * Template avec toutes les matières en dur (sans ACF)
 * 
 * @package Armando_Castanheira
 */

get_header();

// Démarrer la boucle WordPress pour Yoast SEO
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

// Get filter from URL if present
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';

// Liste des 29 matières avec leurs données
$matieres = array(
    // GRANITS (6 matières)
    array(
        'nom' => 'STEEL GREY',
        'categorie' => 'granit',
        'image' => 'matiere/steel-grey.webp',
        'description' => 'Le Granit Steel Grey, originaire d\'Inde, se distingue par un fond gris acier homogène parsemé de fines particules argentées, noires et grises. Son aspect équilibré et lumineux confère à cette pierre naturelle un style moderne, sobre et élégant, parfait pour les aménagements intérieurs et extérieurs alliant raffinement, durabilité et résistance.',
    ),
    array(
        'nom' => 'GRANIT DU TARN',
        'categorie' => 'granit',
        'image' => 'matiere/granit-du-tarn.webp',
        'description' => 'Issu du massif du Sidobre, dans le Tarn, ce granit français se caractérise par ses tons gris bleutés et son grain dynamique, rehaussé de cristaux brillants. Sa texture mouchetée apporte un charme authentique et intemporel, tandis que sa robustesse naturelle garantit une fiabilité exceptionnelle pour les projets contemporains comme pour les réalisations plus traditionnelles.',
    ),
    array(
        'nom' => 'VISCOUNT WHITE',
        'categorie' => 'granit',
        'image' => 'matiere/viscount-white.webp',
        'description' => 'Venu d\'Inde, le Viscount White séduit par ses tons gris très clairs et ses veinures souples créant de subtils mouvements sur la pierre. Son aspect doux et lumineux, évoquant le marbre, s\'associe à la robustesse caractéristique du granit, en faisant un choix idéal pour les intérieurs sobres, élégants et durables.',
    ),
    array(
        'nom' => 'STAR GALAXY',
        'categorie' => 'granit',
        'image' => 'matiere/star-galaxy.webp',
        'description' => 'Issu des carrières d\'Inde, le Star Galaxy séduit par son noir profond parsemé d\'éclats métalliques dorés, évoquant un ciel étoilé. Ce contraste spectaculaire crée un effet lumineux unique, faisant de ce granit une pierre élégante, moderne et sophistiquée, idéale pour sublimer les espaces au style contemporain, raffiné ou luxueux.',
    ),
    array(
        'nom' => 'GRANIT NOIR ABSOLU',
        'categorie' => 'granit',
        'image' => 'matiere/granit-noir-absolu.webp',
        'description' => 'Originaire d\'Inde, le Noir Absolu est un granit à la teinte noire intense et homogène, véritable symbole d\'élégance et de modernité. Sa texture lisse et son aspect profond confèrent un style pur et intemporel à tout projet. À la fois robuste et raffiné, il s\'intègre aussi bien aux designs minimalistes qu\'aux créations contrastées.',
    ),
    array(
        'nom' => 'BLUE PEARL',
        'categorie' => 'granit',
        'image' => 'matiere/blue-pearl.webp',
        'description' => 'Originaire de Norvège, le Blue Pearl charme par sa teinte bleu‑gris profonde et ses reflets métalliques captant superbement la lumière. Ses cristaux irisés, nuancés d\'argent et de bleu, confèrent à cette pierre un éclat saisissant et élégant, parfait pour insuffler une touche de modernité raffinée à tout espace intérieur ou extérieur.',
    ),
    
    // QUARTZITES (8 matières)
    array(
        'nom' => 'BIANCA GIOIA',
        'categorie' => 'quartzite',
        'image' => 'matiere/bianca-gioia.webp',
        'description' => 'Issu des carrières du Brésil, le Bianca Gioia séduit par sa lueur délicate et son poli éclatant. Sa blancheur subtile reflète magnifiquement la lumière, apportant une clarté naturelle qui agrandit visuellement les espaces et crée une atmosphère douce, raffinée et lumineuse, idéale pour des intérieurs élégants et harmonieux.',
    ),
    array(
        'nom' => 'INFINITY',
        'categorie' => 'quartzite',
        'image' => 'matiere/infinity.webp',
        'description' => 'Venu du Brésil, le Quartzite Infinity séduit par sa palette douce et équilibrée, parcourue de légères ondulations qui évoquent le mouvement du marbre. Sa texture apaisante et sa résistance naturelle en font un matériau idéal pour des intérieurs sophistiqués et intemporels.',
    ),
    array(
        'nom' => 'PATAGONIA',
        'categorie' => 'quartzite',
        'image' => 'matiere/patagonia.webp',
        'description' => 'Née des terres du Brésil, la Patagonia est une pierre d\'exception formée par la rencontre naturelle du quartz, du feldspath et des oxydes de fer. Elle révèle une surface vivante et contrastée, mêlant nuances beiges, bruns intenses et cristaux scintillants. Véritable œuvre de la nature, elle confère à chaque projet un caractère fort et contemporain.',
    ),
    array(
        'nom' => 'PERLA VENATA',
        'categorie' => 'quartzite',
        'image' => 'matiere/perla-venata.webp',
        'description' => 'Issu des carrières du Brésil, le Perla Venata séduit par son blanc ivoire délicat rehaussé de fines veines dorées aussi subtiles qu\'élégantes. Son aspect à la fois chaleureux et apaisant en fait un matériau idéal pour les intérieurs sobres, raffinés et lumineux, tout en garantissant la résistance exceptionnelle propre au quartzite.',
    ),
    array(
        'nom' => 'AZUL MACAUBAS',
        'categorie' => 'quartzite',
        'image' => 'matiere/azul-macaubas.webp',
        'description' => 'Extraite au Brésil, l\'Azul Macaubas séduit par son bleu profond et lumineux, surnommé « Bleu du Brésil ». Ses motifs naturels, rappelant les vagues ou l\'horizon, insufflent une sensation de fraîcheur et d\'élégance. Pierre à la fois raffinée et spectaculaire, elle sublime les espaces et s\'impose comme un choix d\'exception pour les projets haut de gamme.',
    ),
    array(
        'nom' => 'SEA PEARL',
        'categorie' => 'quartzite',
        'image' => 'matiere/sea-pearl.webp',
        'description' => 'Venu du Brésil, le Sea Pearl rappelle la sérénité des pierres polies par la mer. Ses nuances de gris délicatement veinées créent un effet visuel apaisant, alliant équilibre, douceur et raffinement. À la fois résistant et élégant, ce quartzite s\'harmonise parfaitement avec des ambiances modernes comme avec des espaces plus classiques.',
    ),
    array(
        'nom' => 'WHITE MACAUBAS',
        'categorie' => 'quartzite',
        'image' => 'matiere/white-macaubas.webp',
        'description' => 'Originaire du Brésil, le White Macaubas séduit par sa blancheur éclatante traversée de fines veines grises rappelant la délicatesse du marbre. Derrière son apparence subtile se cache une pierre d\'une résistance remarquable, aussi solide que le granit. Élégant, moderne et intemporel, il insuffle à chaque projet une touche unique de pureté et de raffinement.',
    ),
    array(
        'nom' => 'TAJ MAHAL',
        'categorie' => 'quartzite',
        'image' => 'matiere/taj-mahal.webp',
        'description' => 'Originaire de la région d\'Uruoca, au Brésil, le Quartzite Taj Mahal séduit par son fond blanc crème délicatement traversé de fines veines dorées. Alliant élégance et résistance, cette pierre naturelle offre un aspect doux et lumineux, parfait pour sublimer les cuisines, salles de bains ou aménagements intérieurs haut de gamme.',
    ),
    
    // MARBRES (15 matières)
    array(
        'nom' => 'MARBRE DE VILLEFRANCHE-DE-ROUERGUE',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-villefranche-de-rouergue.webp',
        'description' => 'Originaire de l\'Aveyron, le Marbre de Villefranche‑de‑Rouergue révèle de superbes nuances de rouge et de rose, agrémentées de délicates veines blanches. Ce marbre au caractère affirmé, autrefois prisé pour orner monuments et demeures, séduit toujours par sa chaleur naturelle, son élégance authentique et son charme intemporel dans les projets décoratifs raffinés.',
    ),
    array(
        'nom' => 'MARBRE DU LANGUEDOC',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-du-langudoc.webp',
        'description' => 'Issu des carrières historiques de Caunes‑Minervois, au cœur du Languedoc, ce marbre d\'exception se distingue par ses nuances raffinées, du rose tendre au rouge profond, traversées de fines veines blanches. Utilisé depuis l\'Antiquité dans les palais et monuments français, le Marbre du Languedoc incarne élégance, richesse et tradition du savoir‑faire méridional.',
    ),
    array(
        'nom' => 'MARBRE DE SAINT-BEAUZIRE',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-saint-beauzire.webp',
        'description' => 'Originaire du Puy‑de‑Dôme, le Marbre de Saint‑Beauzire charme par ses teintes chaudes, oscillant entre rouge rosé et brun profond. Ses fines veines claires créent un contraste harmonieux, sublimant la beauté naturelle de cette pierre. À la fois rare, robuste et expressive, elle incarne tout le caractère et la tradition authentique des marbres d\'Auvergne.',
    ),
    array(
        'nom' => 'MARBRE DE LA COURONNE',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-la-courone.webp',
        'description' => 'Issu des carrières de La Couronne, sur la Côte Bleue près de Martigues, ce marbre à la teinte rosée et lumineuse est exploité depuis l\'Antiquité. Utilisé dans de nombreux monuments marseillais, le Marbre de la Couronne séduit par son charme méditerranéen, sa douce couleur solaire et son héritage historique profondément ancré dans le Sud.',
    ),
    array(
        'nom' => 'MARBRE DE TRETS',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-trets.webp',
        'description' => 'Issu des carrières de Trets, en Provence, le Marbre de Trets aussi appelé « marbre jaspé du pays », séduit par ses tons chauds, dominés par le jaune doré et parcourus de veines rouges nuancées. Utilisé depuis le XVIIᵉ siècle, il illustre un savoir‑faire ancestral et célèbre la beauté expressive, chaleureuse et élégante des marbres méridionaux.',
    ),
    array(
        'nom' => 'MARBRE GRAND ANTIQUE D\'AUBERT',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-grand-antique-aubert.webp',
        'description' => 'Le Grand Antique d\'Aubert, originaire de l\'Ariège, est un marbre au caractère fort, reconnaissable à son contraste spectaculaire entre un noir profond et un blanc pur qui attire le regard. Utilisé depuis des siècles dans des édifices prestigieux, il incarne le raffinement, la force et la noblesse du marbre français.',
    ),
    array(
        'nom' => 'MARBRE DE CAMPAN',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-campan.webp',
        'description' => 'Le Marbre de Campan, originaire des Pyrénées, se distingue par ses couleurs douces et nuancées, mêlant des tons verts tendres et rosés, où chaque pièce révèle un mouvement unique animé de veines délicates qui apportent profondeur, charme et élégance, capable de sublimer aussi bien un intérieur classique qu\'un décor résolument contemporain.',
    ),
    array(
        'nom' => 'MARBRE DE CHASSAGNE',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-de-chassagne.webp',
        'description' => 'La Pierre de Chassagne, issue des carrières de Chassagne‑Montrachet en Bourgogne, se distingue par ses tons clairs et chaleureux, du beige au rose saumoné, associés à un grain délicat et de fines veines cristallines qui lui confèrent une élégance naturelle, idéale pour composer des ambiances sobres, lumineuses et intemporelles dans tout type de projet intérieur.',
    ),
    array(
        'nom' => 'BLEU TURQUIN',
        'categorie' => 'marbre',
        'image' => 'matiere/bleu-turquin.webp',
        'description' => 'Le Bleu Turquin, ou Bardiglio, est un marbre d\'origine italienne à la douce teinte gris‑bleu, animé de veines blanches ou noires qui dessinent des motifs subtils et raffinés, lui donnant une allure élégante et légèrement vintage, idéale pour apporter une touche de raffinement discret et intemporel à tous types d\'intérieurs.',
    ),
    array(
        'nom' => 'GRIOTTE DE CAUNES',
        'categorie' => 'marbre',
        'image' => 'matiere/griotte-de-caunes.webp',
        'description' => 'Le Marbre Griotte de Caunes, extrait des carrières de Caunes‑Minervois, se distingue par son rouge intense, ponctué de petites inclusions plus claires issues de fossiles anciens, qui lui confèrent un aspect vivant, chaleureux et authentique, idéal pour apporter du caractère et une vraie personnalité à n\'importe quel espace intérieur.',
    ),
    array(
        'nom' => 'SAINT-PONS',
        'categorie' => 'marbre',
        'image' => 'matiere/saint-pons.webp',
        'description' => 'Le Marbre de Saint‑Pons compte parmi les pierres emblématiques du sud de la France, réputé pour son rouge profond et chaleureux tout en offrant de superbes variantes plus claires, du blanc crème au blanc neige, comme les Skyros ou Kuros Perle de Nacre, aux reflets subtils, parfois délicatement veinés de gris, de violet ou de doré, qui apportent une élégance naturelle et lumineuse à chaque projet.',
    ),
    array(
        'nom' => 'SARRANCOLIN',
        'categorie' => 'marbre',
        'image' => 'matiere/sarrancolin.webp',
        'description' => 'Le Marbre de Sarrancolin est une pierre naturelle rare et expressive, extraite des carrières pyrénéennes autour du village éponyme, connue pour ses teintes nuancées de gris, beige ou rose, sublimées par des veines rouges, dorées ou claires qui créent un effet visuel chaleureux, spectaculaire et emblématique du savoir‑faire des marbres français.',
    ),
    array(
        'nom' => 'CAUNES MINERVOIS',
        'categorie' => 'marbre',
        'image' => 'matiere/caunes-minervois.webp',
        'description' => 'Le Marbre de Caunes‑Minervois, aussi appelé marbre du Languedoc, provient du village éponyme au cœur de l\'Aude et bénéficie d\'une renommée séculaire pour ses couleurs intenses, allant du rose délicat au rouge profond, souvent animées de veines blanches élégantes qui soulignent son caractère noble, expressif et unique dans chaque réalisation.',
    ),
    array(
        'nom' => 'MARBRE DU JURA',
        'categorie' => 'marbre',
        'image' => 'matiere/marbre-du-jura.webp',
        'description' => 'Le Marbre du Jura est une pierre naturelle originaire du massif jurassien, souvent appelée marbre bien qu\'il s\'agisse d\'un calcaire poli aux superbes nuances, allant du beige clair au gris-bleu, parfois réhaussé de veines délicates et de subtiles traces fossiles qui racontent l\'histoire de la pierre et rendent chaque réalisation vraiment unique.',
    ),
    array(
        'nom' => 'COMBLANCHIEN',
        'categorie' => 'marbre',
        'image' => 'matiere/comblanchien.webp',
        'description' => 'Le Comblanchien est une pierre calcaire de Bourgogne à grain très fin, naturellement compacte et d\'une belle teinte beige rosé. Parfois traversée de veines ou d\'inclusions fossiles, elle séduit par son aspect raffiné, proche du marbre, et sa grande résistance, idéale pour les projets aussi bien intérieurs qu\'extérieurs.',
    ),
);

// Filtrer les matières selon la catégorie
$matieres_filtrees = array();
foreach ( $matieres as $matiere ) {
    if ( $current_filter === 'tous' || $matiere['categorie'] === $current_filter ) {
        $matieres_filtrees[] = $matiere;
    }
}

$total_items = count( $matieres_filtrees );
$items_per_page = 12;
?>

<main id="main-content" class="site-main page-matieres">
    
    <!-- Contenu principal pour Yoast SEO -->
    <div class="sr-only seo-content">
        <?php the_content(); ?>
    </div>
    
    <!-- Page Header -->
    <header class="page-header page-header--matieres">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Matières', 'armando-castanheira' ); ?></h1>
        </div>
    </header>
    
    <!-- Filter Bar -->
    <section class="section-filter">
        <div class="container">
            <nav class="filter-bar" aria-label="<?php esc_attr_e( 'Filtrer les matières', 'armando-castanheira' ); ?>">
                <ul class="filter-bar__list">
                    <li class="filter-bar__item">
                        <a href="<?php echo esc_url( remove_query_arg( 'type' ) ); ?>" 
                           class="filter-btn <?php echo $current_filter === 'tous' ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Tous', 'armando-castanheira' ); ?>
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
    
    <!-- Galerie de Matières -->
    <section class="section-matieres-gallery">
        <div class="container">
            <div class="matieres-grid" id="matieres-grid" data-items-per-page="<?php echo esc_attr( $items_per_page ); ?>">
                <?php 
                $index = 0;
                foreach ( $matieres_filtrees as $matiere ) :
                    $hidden_class = ( $index >= $items_per_page ) ? 'matiere-item--hidden' : '';
                ?>
                    <article class="matiere-item <?php echo esc_attr( $hidden_class ); ?>" data-index="<?php echo esc_attr( $index ); ?>">
                        <div class="matiere-item__card" onclick="this.classList.toggle('active')">
                            <!-- Texte en arrière-plan -->
                            <div class="matiere-item__content">
                                <p class="matiere-item__content-text"><?php echo esc_html( $matiere['description'] ); ?></p>
                            </div>
                            <!-- Image au premier plan -->
                            <div class="matiere-item__image">
                                <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/' . $matiere['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $matiere['nom'] ); ?>" 
                                     loading="lazy">
                            </div>
                        </div>
                        <h2 class="matiere-item__title"><?php echo esc_html( $matiere['nom'] ); ?></h2>
                    </article>
                <?php 
                    $index++;
                endforeach;
                ?>
            </div>
            
            <?php if ( $total_items > $items_per_page ) : ?>
            <div class="voir-plus-wrapper">
                <button type="button" class="btn btn--voir-plus" id="voir-plus-btn" data-total="<?php echo esc_attr( $total_items ); ?>">
                    <?php esc_html_e( 'Voir Plus', 'armando-castanheira' ); ?>
                </button>
            </div>
            <?php endif; ?>
        </div>
    </section>
    
</main>

<?php 
    endwhile;
endif;

get_footer();
