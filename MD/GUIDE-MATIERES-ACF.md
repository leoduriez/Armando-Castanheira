# Guide ACF - Page Matières

## 📋 Vue d'ensemble

Ce guide explique comment créer et gérer le contenu de la page **Matières** avec Advanced Custom Fields (version gratuite).

La page utilise un **Custom Post Type "Matière"** qui existe déjà. Tu vas créer des champs ACF pour gérer chaque matière individuellement.

---

## 🎯 Étape 1 : Créer les champs ACF

### Dans WordPress Admin :
1. Va dans **ACF** → **Groupes de champs**
2. Clique sur **Ajouter un groupe de champs**
3. Nomme le groupe : **Matières - Contenu**

### Localisation :
- **Règles** : Afficher ce groupe de champs si :
  - **Type de publication** est égal à **Matière**

---

## 📝 Champs à créer (Copie exactement ces valeurs)

Clique sur **"Ajouter un champ"** pour chaque champ ci-dessous :

---

### CHAMP 1
- **Libellé du champ** : `Image de la matière`
- **Nom du champ** : `matiere_image`
- **Type de champ** : Image
- **Valeur de retour** : Tableau d'image
- **Requis** : Oui

### CHAMP 2
- **Libellé du champ** : `Description`
- **Nom du champ** : `matiere_description`
- **Type de champ** : Zone de texte
- **Lignes** : 5
- **Requis** : Oui

### CHAMP 3
- **Libellé du champ** : `Catégorie`
- **Nom du champ** : `matiere_categorie`
- **Type de champ** : Sélection
- **Choix** : 
```
marbre : Marbre
granit : Granit
quartzite : Quartzite
autres : Autres
```
- **Valeur par défaut** : marbre
- **Requis** : Oui

---

**IMPORTANT** : Une fois tous les champs créés, clique sur **"Enregistrer les modifications"** en haut à droite.

---

## 🎨 Étape 2 : Créer les matières dans WordPress

### Comment créer une matière :

1. Va dans **Matières** → **Ajouter**
2. **Remplis UNIQUEMENT** :
   - **Titre** (en haut) : Nom de la matière en MAJUSCULES (ex: COMBLANCHIEN)
   - **LAISSE LE CONTENU PRINCIPAL VIDE** (la grande zone blanche au centre)
3. **Descends en bas de la page** pour remplir les champs ACF :
   - **Image de la matière** : Clique sur "Ajouter une image" → Upload l'image
   - **Description** : Copie/colle le texte descriptif du guide
   - **Catégorie** : Sélectionne la catégorie (Marbre, Granit, Quartzite ou Autres)
4. Clique sur **Publier**

**IMPORTANT** : Ne mets RIEN dans le contenu principal (éditeur WordPress). Tout se gère avec les champs ACF en bas !

---

## 📂 Liste des matières à créer

**IMPORTANT** : Crée les matières dans l'ordre ci-dessous (du 1 au 29) pour qu'elles s'affichent correctement sur le site !

---

### GRANITS (5 matières)

#### 1. STEEL GREY
- **Catégorie** : Granit
- **Description** : Le Granit Steel Grey, originaire d'Inde, se distingue par un fond gris acier homogène parsemé de fines particules argentées, noires et grises. Son aspect équilibré et lumineux confère à cette pierre naturelle un style moderne, sobre et élégant, parfait pour les aménagements intérieurs et extérieurs alliant raffinement, durabilité et résistance.
- **Image** : `matiere/steel-grey.webp`

#### 2. GRANIT DU TARN
- **Catégorie** : Granit
- **Description** : Issu du massif du Sidobre, dans le Tarn, ce granit français se caractérise par ses tons gris bleutés et son grain dynamique, rehaussé de cristaux brillants. Sa texture mouchetée apporte un charme authentique et intemporel, tandis que sa robustesse naturelle garantit une fiabilité exceptionnelle pour les projets contemporains comme pour les réalisations plus traditionnelles.
- **Image** : `matiere/granit-du-tarn.webp`

#### 3. VISCOUNT WHITE
- **Catégorie** : Granit
- **Description** : Venu d'Inde, le Viscount White séduit par ses tons gris très clairs et ses veinures souples créant de subtils mouvements sur la pierre. Son aspect doux et lumineux, évoquant le marbre, s'associe à la robustesse caractéristique du granit, en faisant un choix idéal pour les intérieurs sobres, élégants et durables.
- **Image** : `matiere/viscount-white.webp`

#### 4. STAR GALAXY
- **Catégorie** : Granit
- **Description** : Issu des carrières d'Inde, le Star Galaxy séduit par son noir profond parsemé d'éclats métalliques dorés, évoquant un ciel étoilé. Ce contraste spectaculaire crée un effet lumineux unique, faisant de ce granit une pierre élégante, moderne et sophistiquée, idéale pour sublimer les espaces au style contemporain, raffiné ou luxueux.
- **Image** : `matiere/star-galaxy.webp`

#### 5. GRANIT NOIR ABSOLU
- **Catégorie** : Granit
- **Description** : Originaire d'Inde, le Noir Absolu est un granit à la teinte noire intense et homogène, véritable symbole d'élégance et de modernité. Sa texture lisse et son aspect profond confèrent un style pur et intemporel à tout projet. À la fois robuste et raffiné, il s'intègre aussi bien aux designs minimalistes qu'aux créations contrastées.
- **Image** : `matiere/granit-noir-absolu.webp`

#### 6. BLUE PEARL
- **Catégorie** : Granit
- **Description** : Originaire de Norvège, le Blue Pearl charme par sa teinte bleu‑gris profonde et ses reflets métalliques captant superbement la lumière. Ses cristaux irisés, nuancés d'argent et de bleu, confèrent à cette pierre un éclat saisissant et élégant, parfait pour insuffler une touche de modernité raffinée à tout espace intérieur ou extérieur.
- **Image** : `matiere/blue-pearl.webp`

---

### QUARTZITES (8 matières)

#### 7. BIANCA GIOIA
- **Catégorie** : Quartzite
- **Description** : Issu des carrières du Brésil, le Bianca Gioia séduit par sa lueur délicate et son poli éclatant. Sa blancheur subtile reflète magnifiquement la lumière, apportant une clarté naturelle qui agrandit visuellement les espaces et crée une atmosphère douce, raffinée et lumineuse, idéale pour des intérieurs élégants et harmonieux.
- **Image** : `matiere/bianca-gioia.webp`

#### 8. INFINITY
- **Catégorie** : Quartzite
- **Description** : Venu du Brésil, le Quartzite Infinity séduit par sa palette douce et équilibrée, parcourue de légères ondulations qui évoquent le mouvement du marbre. Sa texture apaisante et sa résistance naturelle en font un matériau idéal pour des intérieurs sophistiqués et intemporels.
- **Image** : `matiere/infinity.webp`

#### 9. PATAGONIA
- **Catégorie** : Quartzite
- **Description** : Née des terres du Brésil, la Patagonia est une pierre d'exception formée par la rencontre naturelle du quartz, du feldspath et des oxydes de fer. Elle révèle une surface vivante et contrastée, mêlant nuances beiges, bruns intenses et cristaux scintillants. Véritable œuvre de la nature, elle confère à chaque projet un caractère fort et contemporain.
- **Image** : `matiere/patagonia.webp`

#### 10. PERLA VENATA
- **Catégorie** : Quartzite
- **Description** : Issu des carrières du Brésil, le Perla Venata séduit par son blanc ivoire délicat rehaussé de fines veines dorées aussi subtiles qu'élégantes. Son aspect à la fois chaleureux et apaisant en fait un matériau idéal pour les intérieurs sobres, raffinés et lumineux, tout en garantissant la résistance exceptionnelle propre au quartzite.
- **Image** : `matiere/perla-venata.webp`

#### 11. AZUL MACAUBAS
- **Catégorie** : Quartzite
- **Description** : Extraite au Brésil, l'Azul Macaubas séduit par son bleu profond et lumineux, surnommé « Bleu du Brésil ». Ses motifs naturels, rappelant les vagues ou l'horizon, insufflent une sensation de fraîcheur et d'élégance. Pierre à la fois raffinée et spectaculaire, elle sublime les espaces et s'impose comme un choix d'exception pour les projets haut de gamme.
- **Image** : `matiere/azul-macaubas.webp`

#### 12. SEA PEARL
- **Catégorie** : Quartzite
- **Description** : Venu du Brésil, le Sea Pearl rappelle la sérénité des pierres polies par la mer. Ses nuances de gris délicatement veinées créent un effet visuel apaisant, alliant équilibre, douceur et raffinement. À la fois résistant et élégant, ce quartzite s'harmonise parfaitement avec des ambiances modernes comme avec des espaces plus classiques.
- **Image** : `matiere/sea-pearl.webp`

#### 13. WHITE MACAUBAS
- **Catégorie** : Quartzite
- **Description** : Originaire du Brésil, le White Macaubas séduit par sa blancheur éclatante traversée de fines veines grises rappelant la délicatesse du marbre. Derrière son apparence subtile se cache une pierre d'une résistance remarquable, aussi solide que le granit. Élégant, moderne et intemporel, il insuffle à chaque projet une touche unique de pureté et de raffinement.
- **Image** : `matiere/white-macaubas.webp`

#### 14. TAJ MAHAL
- **Catégorie** : Quartzite
- **Description** : Originaire de la région d'Uruoca, au Brésil, le Quartzite Taj Mahal séduit par son fond blanc crème délicatement traversé de fines veines dorées. Alliant élégance et résistance, cette pierre naturelle offre un aspect doux et lumineux, parfait pour sublimer les cuisines, salles de bains ou aménagements intérieurs haut de gamme.
- **Image** : `matiere/taj-mahal.webp`

---

### MARBRES (15 matières)

#### 15. MARBRE DE VILLEFRANCHE-DE-ROUERGUE
- **Catégorie** : Marbre
- **Description** : Originaire de l'Aveyron, le Marbre de Villefranche‑de‑Rouergue révèle de superbes nuances de rouge et de rose, agrémentées de délicates veines blanches. Ce marbre au caractère affirmé, autrefois prisé pour orner monuments et demeures, séduit toujours par sa chaleur naturelle, son élégance authentique et son charme intemporel dans les projets décoratifs raffinés.
- **Image** : `matiere/marbre-de-villefranche-de-rouergue.webp`

#### 16. MARBRE DU LANGUEDOC
- **Catégorie** : Marbre
- **Description** : Issu des carrières historiques de Caunes‑Minervois, au cœur du Languedoc, ce marbre d'exception se distingue par ses nuances raffinées, du rose tendre au rouge profond, traversées de fines veines blanches. Utilisé depuis l'Antiquité dans les palais et monuments français, le Marbre du Languedoc incarne élégance, richesse et tradition du savoir‑faire méridional.
- **Image** : `matiere/marbre-du-langudoc.webp`

#### 17. MARBRE DE SAINT-BEAUZIRE
- **Catégorie** : Marbre
- **Description** : Originaire du Puy‑de‑Dôme, le Marbre de Saint‑Beauzire charme par ses teintes chaudes, oscillant entre rouge rosé et brun profond. Ses fines veines claires créent un contraste harmonieux, sublimant la beauté naturelle de cette pierre. À la fois rare, robuste et expressive, elle incarne tout le caractère et la tradition authentique des marbres d'Auvergne.
- **Image** : `matiere/marbre-de-saint-beauzire.webp`

#### 18. MARBRE DE LA COURONNE
- **Catégorie** : Marbre
- **Description** : Issu des carrières de La Couronne, sur la Côte Bleue près de Martigues, ce marbre à la teinte rosée et lumineuse est exploité depuis l'Antiquité. Utilisé dans de nombreux monuments marseillais, le Marbre de la Couronne séduit par son charme méditerranéen, sa douce couleur solaire et son héritage historique profondément ancré dans le Sud.
- **Image** : `matiere/marbre-de-la-courone.webp`

#### 19. MARBRE DE TRETS
- **Catégorie** : Marbre
- **Description** : Issu des carrières de Trets, en Provence, le Marbre de Trets aussi appelé « marbre jaspé du pays », séduit par ses tons chauds, dominés par le jaune doré et parcourus de veines rouges nuancées. Utilisé depuis le XVIIᵉ siècle, il illustre un savoir‑faire ancestral et célèbre la beauté expressive, chaleureuse et élégante des marbres méridionaux.
- **Image** : `matiere/marbre-de-trets.webp`

#### 20. MARBRE GRAND ANTIQUE D'AUBERT
- **Catégorie** : Marbre
- **Description** : Le Grand Antique d'Aubert, originaire de l'Ariège, est un marbre au caractère fort, reconnaissable à son contraste spectaculaire entre un noir profond et un blanc pur qui attire le regard. Utilisé depuis des siècles dans des édifices prestigieux, il incarne le raffinement, la force et la noblesse du marbre français.
- **Image** : `matiere/marbre-grand-antique-aubert.webp`

#### 21. MARBRE DE CAMPAN
- **Catégorie** : Marbre
- **Description** : Le Marbre de Campan, originaire des Pyrénées, se distingue par ses couleurs douces et nuancées, mêlant des tons verts tendres et rosés, où chaque pièce révèle un mouvement unique animé de veines délicates qui apportent profondeur, charme et élégance, capable de sublimer aussi bien un intérieur classique qu'un décor résolument contemporain.
- **Image** : `matiere/marbre-de-campan.webp`

#### 22. MARBRE DE CHASSAGNE
- **Catégorie** : Marbre
- **Description** : La Pierre de Chassagne, issue des carrières de Chassagne‑Montrachet en Bourgogne, se distingue par ses tons clairs et chaleureux, du beige au rose saumoné, associés à un grain délicat et de fines veines cristallines qui lui confèrent une élégance naturelle, idéale pour composer des ambiances sobres, lumineuses et intemporelles dans tout type de projet intérieur.
- **Image** : `matiere/marbre-de-chassagne.webp`

#### 23. BLEU TURQUIN
- **Catégorie** : Marbre
- **Description** : Le Bleu Turquin, ou Bardiglio, est un marbre d'origine italienne à la douce teinte gris‑bleu, animé de veines blanches ou noires qui dessinent des motifs subtils et raffinés, lui donnant une allure élégante et légèrement vintage, idéale pour apporter une touche de raffinement discret et intemporel à tous types d'intérieurs.
- **Image** : `matiere/bleu-turquin.webp`

#### 24. GRIOTTE DE CAUNES
- **Catégorie** : Marbre
- **Description** : Le Marbre Griotte de Caunes, extrait des carrières de Caunes‑Minervois, se distingue par son rouge intense, ponctué de petites inclusions plus claires issues de fossiles anciens, qui lui confèrent un aspect vivant, chaleureux et authentique, idéal pour apporter du caractère et une vraie personnalité à n'importe quel espace intérieur.
- **Image** : `matiere/griotte-de-caunes.webp`

#### 25. SAINT-PONS
- **Catégorie** : Marbre
- **Description** : Le Marbre de Saint‑Pons compte parmi les pierres emblématiques du sud de la France, réputé pour son rouge profond et chaleureux tout en offrant de superbes variantes plus claires, du blanc crème au blanc neige, comme les Skyros ou Kuros Perle de Nacre, aux reflets subtils, parfois délicatement veinés de gris, de violet ou de doré, qui apportent une élégance naturelle et lumineuse à chaque projet.
- **Image** : `matiere/saint-pons.webp`

#### 26. SARRANCOLIN
- **Catégorie** : Marbre
- **Description** : Le Marbre de Sarrancolin est une pierre naturelle rare et expressive, extraite des carrières pyrénéennes autour du village éponyme, connue pour ses teintes nuancées de gris, beige ou rose, sublimées par des veines rouges, dorées ou claires qui créent un effet visuel chaleureux, spectaculaire et emblématique du savoir‑faire des marbres français.
- **Image** : `matiere/sarrancolin.webp`

#### 27. CAUNES MINERVOIS
- **Catégorie** : Marbre
- **Description** : Le Marbre de Caunes‑Minervois, aussi appelé marbre du Languedoc, provient du village éponyme au cœur de l'Aude et bénéficie d'une renommée séculaire pour ses couleurs intenses, allant du rose délicat au rouge profond, souvent animées de veines blanches élégantes qui soulignent son caractère noble, expressif et unique dans chaque réalisation.
- **Image** : `matiere/caunes-minervois.webp`

#### 28. MARBRE DU JURA
- **Catégorie** : Marbre
- **Description** : Le Marbre du Jura est une pierre naturelle originaire du massif jurassien, souvent appelée marbre bien qu'il s'agisse d'un calcaire poli aux superbes nuances, allant du beige clair au gris-bleu, parfois réhaussé de veines délicates et de subtiles traces fossiles qui racontent l'histoire de la pierre et rendent chaque réalisation vraiment unique.
- **Image** : `matiere/marbre-du-jura.webp`

#### 29. COMBLANCHIEN
- **Catégorie** : Marbre
- **Description** : Le Comblanchien est une pierre calcaire de Bourgogne à grain très fin, naturellement compacte et d'une belle teinte beige rosé. Parfois traversée de veines ou d'inclusions fossiles, elle séduit par son aspect raffiné, proche du marbre, et sa grande résistance, idéale pour les projets aussi bien intérieurs qu'extérieurs.
- **Image** : `matiere/comblanchien.webp`

---

## 📂 Chemins des images

Les images sont dans ton thème :
```
/wp-content/themes/armando-castanheira/assets/images/matiere/
```

---

## 🔧 Étape 3 : Modifier le template PHP


Le fichier `/archive-matiere.php` doit être modifié pour utiliser les champs ACF au lieu du tableau en dur.

---

## ✅ Résultat final

Une fois les champs ACF créés et les matières ajoutées, la page Matières affichera :
- **Grille 2×2** avec pagination "Voir Plus"
- **Filtres** par catégorie (Tous, Marbre, Granit, Quartzite)
- **Cartes interactives** avec image et description au survol

Tout le contenu sera modifiable depuis l'admin WordPress !
