<?php
/**
 * Archive template for Matières custom post type
 * 
 * This template is used when accessing /matieres/ URL
 *
 * @package Armando_Castanheira
 */

get_header();

// Get filter from URL if present
$current_filter = isset( $_GET['type'] ) ? sanitize_text_field( $_GET['type'] ) : 'tous';

// Static matières data
$matieres_data = array(
    // 1 - COMBLANCHIEN
    array(
        'title'       => 'COMBLANCHIEN',
        'image'       => 'comblanchien.webp',
        'category'    => 'autres',
        'description' => '<p>Le Comblanchien est une pierre calcaire de Bourgogne à grain très fin, naturellement compacte et d\'une belle teinte beige rosé.</p><p>Parfois traversée de veines ou d\'inclusions fossiles, elle séduit par son aspect raffiné, proche du marbre, et sa grande résistance, idéale pour les projets aussi bien intérieurs qu\'extérieurs.</p>',
    ),
    // 2 - MARBRE DU JURA
    array(
        'title'       => 'MARBRE DU JURA',
        'image'       => 'marbre-du-jura.webp',
        'category'    => 'marbre',
        'description' => '<p>Le Marbre du Jura est une pierre naturelle issue du massif jurassien. Souvent considéré comme un marbre, il s\'agit en réalité d\'un calcaire poli, apprécié pour ses nuances allant du beige clair au gris-bleu.</p><p>Ses petites veines naturelles et traces fossiles racontent l\'histoire de la pierre et rendent chaque pièce unique. Élégant et intemporel, il s\'intègre aussi bien dans des intérieurs contemporains que dans des projets plus classiques.</p>',
    ),
    // 3 - CAUNES MINERVOIS
    array(
        'title'       => 'CAUNES MINERVOIS',
        'image'       => 'caunes-minervois.webp',
        'category'    => 'marbre',
        'description' => '<p>Le Marbre de Caunes‑Minervois, connu aussi sous le nom de marbre du Languedoc, tire son origine du village éponyme, au cœur de l\'Aude.</p><p>Réputé depuis des siècles, il séduit par ses couleurs intenses, du rose délicat au rouge profond, souvent rehaussées de veines blanches. Cette pierre d\'exception, à la fois noble et expressive, apporte une touche de caractère unique à chaque réalisation.</p>',
    ),
    // 4 - SARRANCOLIN
    array(
        'title'       => 'SARRANCOLIN',
        'image'       => 'sarrancolin.webp',
        'category'    => 'marbre',
        'description' => '<p>Le Marbre de Sarrancolin est une pierre rare et expressive, issue des carrières pyrénéennes autour du village du même nom.</p><p>Ses teintes nuancées de gris, beige ou rose, rehaussées de veines rouges, dorées ou claires, créent un effet visuel à la fois chaleureux et spectaculaire. Utilisé depuis des siècles dans les plus beaux édifices, il symbolise l\'élégance et le savoir‑faire des marbres français.</p>',
    ),
    // 5 - SAINT-PONS
    array(
        'title'       => 'SAINT-PONS',
        'image'       => 'saint-pons.webp',
        'category'    => 'marbre',
        'description' => '<p>Le Marbre de Saint‑Pons fait partie des pierres emblématiques du sud de la France. S\'il est surtout connu pour son rouge profond et chaleureux, on en trouve aussi de magnifiques variantes claires, du blanc crème au blanc neige, comme les Skyros ou Kuros Perle de Nacre.</p><p>Ces marbres aux reflets doux, parfois veinés de gris, de violet ou de doré, apportent une touche d\'élégance naturelle et de lumière à chaque projet.</p>',
    ),
    // 6 - GRIOTTE DE CAUNES
    array(
        'title'       => 'GRIOTTE DE CAUNES',
        'image'       => 'griotte-de-caunes.webp',
        'category'    => 'marbre',
        'description' => '<p>Issu des carrières de Caunes-Minervois, le Marbre Griotte de Caunes séduit par son rouge intense, animé de petites inclusions plus claires formées par des fossiles anciens.</p><p>Cette combinaison de couleurs et de textures donne à la pierre un aspect vivant et chaleureux, parfait pour apporter du caractère et de l\'authenticité à un espace.</p>',
    ),
    // 7 - BLEU TURQUIN
    array(
        'title'       => 'BLEU TURQUIN',
        'image'       => 'bleu-turquin.webp',
        'category'    => 'marbre',
        'description' => '<p>Marbre d\'origine italienne, le Bleu Turquin, aussi connu sous le nom de Bardiglio, séduit par sa douce couleur gris-bleu et ses veines blanches ou noires qui dessinent des motifs délicats.</p><p>Son apparence élégante et légèrement vintage apporte une touche de raffinement discret à tous types d\'intérieurs.</p>',
    ),
    // 8 - MARBRE DE CHASSAGNE
    array(
        'title'       => 'MARBRE DE CHASSAGNE',
        'image'       => 'marbre-de-chassagne.webp',
        'category'    => 'marbre',
        'description' => '<p>Issue des carrières de Chassagne-Montrachet, en Bourgogne, la Pierre de Chassagne séduit par ses tons clairs et chaleureux, du beige au rose saumoné.</p><p>Son grain délicat et ses légères veines cristallines lui donnent une élégance naturelle, parfaite pour créer des ambiances sobres, lumineuses et intemporelles.</p>',
    ),
    // 9 - MARBRE DE CAMPAN
    array(
        'title'       => 'MARBRE DE CAMPAN',
        'image'       => 'marbre-de-campan.webp',
        'category'    => 'marbre',
        'description' => '<p>Originaire des Pyrénées, le Marbre de Campan se reconnaît à ses couleurs douces et nuancées, mêlant des tons verts tendres et rosés.</p><p>Chaque pièce révèle un mouvement unique, avec des veines délicates qui apportent profondeur et élégance. C\'est une pierre pleine de charme et de caractère, capable de sublimer aussi bien un intérieur classique qu\'un décor contemporain.</p>',
    ),
    // 10 - MARBRE GRAND ANTIQUE D'AUBERT
    array(
        'title'       => 'MARBRE GRAND ANTIQUE D\'AUBERT',
        'image'       => 'marbre-grand-antique-aubert.webp',
        'category'    => 'marbre',
        'description' => '<p>Originaire de l\'Ariège, le Grand Antique d\'Aubert est une pierre au caractère fort, reconnaissable entre toutes. Composé d\'un mélange naturel de noir profond et de blanc pur, il offre un contraste spectaculaire qui attire immédiatement le regard.</p><p>Utilisé depuis des siècles dans les édifices prestigieux, il incarne le raffinement et la force du marbre français.</p>',
    ),
    // 11 - MARBRE DE TRETS
    array(
        'title'       => 'MARBRE DE TRETS',
        'image'       => 'marbre-de-trets.webp',
        'category'    => 'marbre',
        'description' => '<p>Issu des carrières de Trets, en Provence, le Marbre de Trets, aussi nommé « marbre jaspé du pays », séduit par ses tons chauds, dominés par le jaune doré et rehaussés de veines rouges ou mêlées de couleur.</p><p>Utilisé depuis le XVIIᵉ siècle, il témoigne d\'un savoir-faire ancestral et d\'un goût pour les marbres expressifs, alliant chaleur, histoire et élégance méridionale.</p>',
    ),
    // 12 - MARBRE DE LA COURONNE
    array(
        'title'       => 'MARBRE DE LA COURONNE',
        'image'       => 'marbre-de-la-courone.webp',
        'category'    => 'marbre',
        'description' => '<p>Issu des carrières de La Couronne, sur la Côte Bleue près de Martigues, ce marbre à la teinte rosée et lumineuse est extrait depuis l\'Antiquité.</p><p>Utilisé pour bâtir de nombreux monuments autour de Marseille, le Marbre de la Couronne séduit par son charme méditerranéen, sa douce couleur solaire et son ancrage historique profond.</p>',
    ),
    // 13 - MARBRE DE SAINT-BEAUZIRE
    array(
        'title'       => 'MARBRE DE SAINT-BEAUZIRE',
        'image'       => 'marbre-de-saint-beauzire.webp',
        'category'    => 'marbre',
        'description' => '<p>Originaire du Puy‑de‑Dôme, le Marbre de Saint‑Beauzire séduit par ses teintes chaudes, oscillant entre le rouge rosé et le brun profond.</p><p>Ses légères veines claires créent un contraste harmonieux qui met en valeur la richesse de la matière. Ce marbre rare, à la fois robuste et expressif, reflète tout le caractère et la tradition des pierres d\'Auvergne.</p>',
    ),
    // 14 - MARBRE DU LANGUEDOC
    array(
        'title'       => 'MARBRE DU LANGUEDOC',
        'image'       => 'marbre-du-langudoc.webp',
        'category'    => 'marbre',
        'description' => '<p>Issu des carrières historiques de Caunes‑Minervois, dans le cœur du Languedoc, ce marbre est reconnu pour ses nuances élégantes, du rose tendre au rouge intense, animées de veines blanches raffinées.</p><p>Utilisé depuis l\'Antiquité pour les palais et monuments français, le Marbre du Languedoc symbolise la richesse et la tradition du savoir‑faire méridional.</p>',
    ),
    // 15 - TAJ MAHAL
    array(
        'title'       => 'TAJ MAHAL',
        'image'       => 'taj-mahal.webp',
        'category'    => 'quartzite',
        'description' => '<p>Originaire de la région d\'Uruoca, au Brésil, le Quartzite Taj Mahal présente un fond blanc crème délicat, traversé de fines veines dorées.</p><p>Alliant résistance et élégance, cette pierre naturelle séduit par son aspect doux et lumineux, idéal pour les cuisines, salles de bains ou aménagements haut de gamme.</p>',
    ),
    // 16 - WHITE MACAUBAS
    array(
        'title'       => 'WHITE MACAUBAS',
        'image'       => 'white-macaubas.webp',
        'category'    => 'quartzite',
        'description' => '<p>Originaire du Brésil, le White Macaubas séduit par sa blancheur lumineuse et ses veines grises subtiles qui évoquent la finesse du marbre.</p><p>Derrière son allure délicate se cache une pierre d\'une résistance exceptionnelle, aussi solide que le granit. Élégant, moderne et intemporel, il apporte à chaque projet une touche de pureté et de raffinement.</p>',
    ),
    // 17 - SEA PEARL
    array(
        'title'       => 'SEA PEARL',
        'image'       => 'sea-pearl.webp',
        'category'    => 'quartzite',
        'description' => '<p>Venu du Brésil, le Sea Pearl évoque la tranquillité des pierres polies par la mer. Ses teintes grises nuancées et ses veines légères créent un effet visuel apaisant, combinant équilibre, douceur et raffinement.</p><p>Résistant et élégant, il s\'intègre aussi bien dans des ambiances modernes que dans des espaces plus classiques.</p>',
    ),
    // 18 - AZUL MACAUBAS
    array(
        'title'       => 'AZUL MACAUBAS',
        'image'       => 'azul-macaubas.webp',
        'category'    => 'quartzite',
        'description' => '<p>Extraite au Brésil, l\'Azul Macaubas fascine par son bleu profond et lumineux, qui lui vaut le nom de « Bleu du Brésil ».</p><p>Ses dessins naturels, évoquant les ondes marines ou l\'horizon, apportent une sensation de fraîcheur et d\'élégance à tout espace. C\'est une pierre à la fois raffinée et spectaculaire, parfaite pour les projets d\'exception.</p>',
    ),
    // 19 - PERLA VENATA
    array(
        'title'       => 'PERLA VENATA',
        'image'       => 'perla-venata.webp',
        'category'    => 'quartzite',
        'description' => '<p>Issu des carrières du Brésil, le Perla Venata charme par son blanc ivoire délicat et ses légères veines dorées, aussi fines qu\'élégantes.</p><p>Son aspect à la fois chaleureux et apaisant en fait un matériau de choix pour des intérieurs sobres, raffinés et lumineux, tout en offrant la robustesse du quartzite.</p>',
    ),
    // 20 - PATAGONIA
    array(
        'title'       => 'PATAGONIA',
        'image'       => 'patagonia.webp',
        'category'    => 'quartzite',
        'description' => '<p>Née des terres du Brésil, la Patagonia est une pierre d\'exception, issue de la rencontre naturelle entre plusieurs minéraux — quartz, feldspath et oxydes de fer.</p><p>Le résultat : une surface vivante et contrastée, où se mêlent beiges lumineux, bruns profonds et cristaux étincelants. Véritable œuvre de la nature, elle apporte à chaque réalisation un caractère fort et contemporain.</p>',
    ),
    // 21 - INFINITY
    array(
        'title'       => 'INFINITY',
        'image'       => 'infinity.webp',
        'category'    => 'quartzite',
        'description' => '<p>Venu du Brésil, le Quartzite Infinity séduit par sa palette douce et équilibrée, parcourue de légères ondulations qui évoquent le mouvement du marbre.</p><p>Sa texture apaisante et sa résistance naturelle en font un matériau idéal pour des intérieurs sophistiqués et intemporels.</p>',
    ),
    // 22 - BIANCA GIOIA
    array(
        'title'       => 'BIANCA GIOIA',
        'image'       => 'bianca-gioia.webp',
        'category'    => 'marbre',
        'description' => '<p>Issu des carrières du Brésil, le Bianca Gioia charme par sa lueur délicate et son poli éclatant.</p><p>Sa blancheur subtile reflète la lumière et agrandit visuellement les espaces, créant une atmosphère douce, raffinée et lumineuse.</p>',
    ),
    // 23 - MARBRE DE VILLEFRANCHE-DE-ROUERGUE
    array(
        'title'       => 'MARBRE DE VILLEFRANCHE-DE-ROUERGUE',
        'image'       => 'marbre-de-villefranche-de-rouergue.webp',
        'category'    => 'marbre',
        'description' => '<p>Originaire de l\'Aveyron, le Marbre de Villefranche‑de‑Rouergue dévoile de belles nuances de rouge et de rose, parfois animées de veines blanches fines.</p><p>Ce marbre au caractère affirmé a longtemps orné monuments et demeures, et continue aujourd\'hui de séduire par sa chaleur naturelle et son élégance authentique.</p>',
    ),
    // 24 - BLUE PEARL
    array(
        'title'       => 'BLUE PEARL',
        'image'       => 'blue-pearl.webp',
        'category'    => 'granit',
        'description' => '<p>Originaire de Norvège, le Blue Pearl séduit par sa teinte bleu‑gris intense et ses reflets métalliques qui accrochent magnifiquement la lumière.</p><p>Ses cristaux irisés, aux nuances d\'argent et de bleu, donnent à la pierre un rendu profond et lumineux, idéal pour apporter une touche de modernité raffinée à tout espace.</p>',
    ),
    // 25 - GRANIT NOIR ABSOLU
    array(
        'title'       => 'GRANIT NOIR ABSOLU',
        'image'       => 'granit-noir-absolu.webp',
        'category'    => 'granit',
        'description' => '<p>Originaire d\'Inde, le Noir Absolu est un granit à la teinte noire intense et uniforme, symbole d\'élégance et de modernité.</p><p>Sa texture lisse et son aspect profond apportent un style pur et intemporel à tout projet. À la fois solide et raffiné, il s\'adapte aussi bien à un design minimaliste qu\'à des créations plus contrastées.</p>',
    ),
    // 26 - STAR GALAXY
    array(
        'title'       => 'STAR GALAXY',
        'image'       => 'star-galaxy.webp',
        'category'    => 'granit',
        'description' => '<p>Issu des carrières d\'Inde, le Star Galaxy fascine par son noir intense et ses éclats métalliques dorés, semblables à de petites étoiles dans la nuit.</p><p>Ce jeu de lumière unique en fait une pierre à la fois élégante, moderne et sophistiquée, parfaite pour sublimer les espaces au style contemporain ou luxueux.</p>',
    ),
    // 27 - VISCOUNT WHITE
    array(
        'title'       => 'VISCOUNT WHITE',
        'image'       => 'viscount-white.webp',
        'category'    => 'granit',
        'description' => '<p>Venu d\'Inde, le Viscount White séduit par ses tons gris très clairs et ses veinures souples qui dessinent de subtils mouvements sur la pierre.</p><p>Son aspect doux et lumineux, rappelant celui du marbre, s\'accompagne de la robustesse propre au granit, faisant de lui un choix parfait pour les intérieurs sobres, élégants et durables.</p>',
    ),
    // 28 - GRANIT DU TARN
    array(
        'title'       => 'GRANIT DU TARN',
        'image'       => 'granit-du-tarn.webp',
        'category'    => 'granit',
        'description' => '<p>Issu du massif du Sidobre, dans le Tarn, ce granit français se distingue par ses tons gris bleutés et son grain vivant, parsemé de cristaux brillants.</p><p>Sa texture mouchetée lui donne un charme authentique et intemporel, tandis que sa robustesse naturelle en fait une valeur sûre, autant pour les projets contemporains que pour les réalisations plus traditionnelles.</p>',
    ),
    // 29 - STEEL GREY
    array(
        'title'       => 'STEEL GREY',
        'image'       => 'steel-grey.webp',
        'category'    => 'granit',
        'description' => '<p>Le Granit Steel Grey, originaire d\'Inde, présente un fond gris acier homogène, animé de fines particules argentées, noires et grises.</p><p>Son aspect équilibré et lumineux confère à cette pierre un style moderne, sobre et élégant, idéal pour des aménagements intérieurs et extérieurs alliant raffinement et résistance.</p>',
    ),
);

// Filter matières if needed
if ( $current_filter !== 'tous' ) {
    $matieres_data = array_filter( $matieres_data, function( $item ) use ( $current_filter ) {
        return $item['category'] === $current_filter;
    });
}

// Définir le nombre total de vectors selon le filtre
switch ( $current_filter ) {
    case 'granit':
        $nb_vectors = 5;  // 3 gauche, 2 droite
        break;
    case 'quartzite':
        $nb_vectors = 6;  // 3 gauche, 3 droite
        break;
    case 'marbre':
        $nb_vectors = 8;  // 4 gauche, 4 droite
        break;
    default: // 'tous'
        $nb_vectors = 10; // 5 gauche, 5 droite
        break;
}
?>

<main id="main-content" class="site-main page-matieres">
    
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
    
    <!-- Matières List -->
    <section class="section-matieres" data-vectors="<?php echo esc_attr( $nb_vectors ); ?>">
        <?php 
        // Générer les vectors dynamiquement (comme sur la page Réalisations)
        // Les positions impaires sont à gauche, les paires à droite
        for ( $i = 1; $i <= $nb_vectors; $i++ ) :
            $side = ( $i % 2 === 1 ) ? 'left' : 'right';
            $vector = ( $i % 2 === 1 ) ? 'vector2.webp' : 'vector1.webp';
        ?>
        <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/' . $vector ); ?>" alt="" class="decor decor--<?php echo $side; ?> decor--pos-<?php echo $i; ?>" aria-hidden="true">
        <?php endfor; ?>
        <div class="container">
            <div class="matieres-grid">
                <?php 
                if ( ! empty( $matieres_data ) ) :
                    foreach ( $matieres_data as $matiere ) :
                ?>
                    <article class="matiere-card" data-animate="fade-up">
                        <div class="matiere-card__header" role="button" tabindex="0" aria-expanded="false">
                            <div class="matiere-card__image">
                                <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/' . $matiere['image'] ); ?>" 
                                     alt="<?php echo esc_attr( $matiere['title'] ); ?>" 
                                     loading="lazy">
                            </div>
                            <h2 class="matiere-card__title"><?php echo esc_html( $matiere['title'] ); ?></h2>
                        </div>
                        <div class="matiere-card__content">
                            <div class="matiere-card__description">
                                <?php echo $matiere['description']; ?>
                            </div>
                        </div>
                    </article>
                <?php 
                    endforeach;
                else :
                ?>
                    <p class="no-results"><?php esc_html_e( 'Aucune matière trouvée.', 'armando-castanheira' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();
