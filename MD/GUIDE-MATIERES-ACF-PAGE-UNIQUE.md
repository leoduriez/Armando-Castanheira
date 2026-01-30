# Guide ACF – Page Matières (tout sur une page, compatible Yoast SEO)

## 🎯 Objectif
Avoir toutes les matières (image, description, catégorie) sur une seule page WordPress via un groupe ACF, pour que Yoast SEO analyse tout le contenu.

---

## Étape 1 : Créer le groupe de champs ACF

1. Va dans **ACF** → **Groupes de champs** → **Ajouter**
2. **Titre du groupe** : `Matières – Page unique`
3. **Règle d’affichage** :
   - Afficher si **Page** est égal à **Matières** (ou la page que tu veux)

---

## Étape 2 : Ajouter les champs pour chaque matière

Pour chaque matière (1 à 29), ajoute :

### Comment créer les champs

Pour chaque matière ci-dessous, tu dois créer **3 champs ACF** :
1. Un champ **Image**
2. Un champ **Description** (Zone de texte)
3. Un champ **Catégorie** (Sélection)

**Exemple pour la matière 1 - STEEL GREY :**
- Clique sur "Ajouter un champ"
- Libellé : `Image – STEEL GREY`
- Nom : `matiere_1_image`
- Type : Image
- Valeur de retour : Tableau d'image

- Clique sur "Ajouter un champ"
- Libellé : `Description – STEEL GREY`
- Nom : `matiere_1_description`
- Type : Zone de texte
- Lignes : 5

- Clique sur "Ajouter un champ"
- Libellé : `Catégorie – STEEL GREY`
- Nom : `matiere_1_categorie`
- Type : Sélection
- Choix :
```
marbre : Marbre
granit : Granit
quartzite : Quartzite
autres : Autres
```
- Valeur par défaut : granit

---

## Liste complète des 87 champs ACF à créer

### GRANITS (6 matières = 18 champs)

**Matière 1 - STEEL GREY**
- Libellé : `Image – STEEL GREY` | Nom : `matiere_1_image` | Type : Image
- Libellé : `Description – STEEL GREY` | Nom : `matiere_1_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – STEEL GREY` | Nom : `matiere_1_categorie` | Type : Sélection | Défaut : **granit**

**Matière 2 - GRANIT DU TARN**
- Libellé : `Image – GRANIT DU TARN` | Nom : `matiere_2_image` | Type : Image
- Libellé : `Description – GRANIT DU TARN` | Nom : `matiere_2_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – GRANIT DU TARN` | Nom : `matiere_2_categorie` | Type : Sélection | Défaut : **granit**

**Matière 3 - VISCOUNT WHITE**
- Libellé : `Image – VISCOUNT WHITE` | Nom : `matiere_3_image` | Type : Image
- Libellé : `Description – VISCOUNT WHITE` | Nom : `matiere_3_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – VISCOUNT WHITE` | Nom : `matiere_3_categorie` | Type : Sélection | Défaut : **granit**

**Matière 4 - STAR GALAXY**
- Libellé : `Image – STAR GALAXY` | Nom : `matiere_4_image` | Type : Image
- Libellé : `Description – STAR GALAXY` | Nom : `matiere_4_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – STAR GALAXY` | Nom : `matiere_4_categorie` | Type : Sélection | Défaut : **granit**

**Matière 5 - GRANIT NOIR ABSOLU**
- Libellé : `Image – GRANIT NOIR ABSOLU` | Nom : `matiere_5_image` | Type : Image
- Libellé : `Description – GRANIT NOIR ABSOLU` | Nom : `matiere_5_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – GRANIT NOIR ABSOLU` | Nom : `matiere_5_categorie` | Type : Sélection | Défaut : **granit**

**Matière 6 - BLUE PEARL**
- Libellé : `Image – BLUE PEARL` | Nom : `matiere_6_image` | Type : Image
- Libellé : `Description – BLUE PEARL` | Nom : `matiere_6_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – BLUE PEARL` | Nom : `matiere_6_categorie` | Type : Sélection | Défaut : **granit**

---

### QUARTZITES (8 matières = 24 champs)

**Matière 7 - BIANCA GIOIA**
- Libellé : `Image – BIANCA GIOIA` | Nom : `matiere_7_image` | Type : Image
- Libellé : `Description – BIANCA GIOIA` | Nom : `matiere_7_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – BIANCA GIOIA` | Nom : `matiere_7_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 8 - INFINITY**
- Libellé : `Image – INFINITY` | Nom : `matiere_8_image` | Type : Image
- Libellé : `Description – INFINITY` | Nom : `matiere_8_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – INFINITY` | Nom : `matiere_8_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 9 - PATAGONIA**
- Libellé : `Image – PATAGONIA` | Nom : `matiere_9_image` | Type : Image
- Libellé : `Description – PATAGONIA` | Nom : `matiere_9_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – PATAGONIA` | Nom : `matiere_9_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 10 - PERLA VENATA** 
- Libellé : `Image – PERLA VENATA` | Nom : `matiere_10_image` | Type : Image
- Libellé : `Description – PERLA VENATA` | Nom : `matiere_10_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – PERLA VENATA` | Nom : `matiere_10_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 11 - AZUL MACAUBAS** 
- Libellé : `Image – AZUL MACAUBAS` | Nom : `matiere_11_image` | Type : Image
- Libellé : `Description – AZUL MACAUBAS` | Nom : `matiere_11_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – AZUL MACAUBAS` | Nom : `matiere_11_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 12 - SEA PEARL** 
- Libellé : `Image – SEA PEARL` | Nom : `matiere_12_image` | Type : Image
- Libellé : `Description – SEA PEARL` | Nom : `matiere_12_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – SEA PEARL` | Nom : `matiere_12_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 13 - WHITE MACAUBAS** 
- Libellé : `Image – WHITE MACAUBAS` | Nom : `matiere_13_image` | Type : Image
- Libellé : `Description – WHITE MACAUBAS` | Nom : `matiere_13_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – WHITE MACAUBAS` | Nom : `matiere_13_categorie` | Type : Sélection | Défaut : **quartzite**

**Matière 14 - TAJ MAHAL** 
- Libellé : `Image – TAJ MAHAL` | Nom : `matiere_14_image` | Type : Image
- Libellé : `Description – TAJ MAHAL` | Nom : `matiere_14_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – TAJ MAHAL` | Nom : `matiere_14_categorie` | Type : Sélection | Défaut : **quartzite**

---

### MARBRES (15 matières = 45 champs)

**Matière 15 - MARBRE DE VILLEFRANCHE-DE-ROUERGUE**
- Libellé : `Image – MARBRE DE VILLEFRANCHE-DE-ROUERGUE` | Nom : `matiere_15_image` | Type : Image
- Libellé : `Description – MARBRE DE VILLEFRANCHE-DE-ROUERGUE` | Nom : `matiere_15_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE VILLEFRANCHE-DE-ROUERGUE` | Nom : `matiere_15_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 16 - MARBRE DU LANGUEDOC**
- Libellé : `Image – MARBRE DU LANGUEDOC` | Nom : `matiere_16_image` | Type : Image
- Libellé : `Description – MARBRE DU LANGUEDOC` | Nom : `matiere_16_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DU LANGUEDOC` | Nom : `matiere_16_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 17 - MARBRE DE SAINT-BEAUZIRE**
- Libellé : `Image – MARBRE DE SAINT-BEAUZIRE` | Nom : `matiere_17_image` | Type : Image
- Libellé : `Description – MARBRE DE SAINT-BEAUZIRE` | Nom : `matiere_17_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE SAINT-BEAUZIRE` | Nom : `matiere_17_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 18 - MARBRE DE LA COURONNE**
- Libellé : `Image – MARBRE DE LA COURONNE` | Nom : `matiere_18_image` | Type : Image
- Libellé : `Description – MARBRE DE LA COURONNE` | Nom : `matiere_18_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE LA COURONNE` | Nom : `matiere_18_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 19 - MARBRE DE TRETS**
- Libellé : `Image – MARBRE DE TRETS` | Nom : `matiere_19_image` | Type : Image
- Libellé : `Description – MARBRE DE TRETS` | Nom : `matiere_19_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE TRETS` | Nom : `matiere_19_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 20 - MARBRE GRAND ANTIQUE D'AUBERT**
- Libellé : `Image – MARBRE GRAND ANTIQUE D'AUBERT` | Nom : `matiere_20_image` | Type : Image
- Libellé : `Description – MARBRE GRAND ANTIQUE D'AUBERT` | Nom : `matiere_20_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE GRAND ANTIQUE D'AUBERT` | Nom : `matiere_20_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 21 - MARBRE DE CAMPAN**
- Libellé : `Image – MARBRE DE CAMPAN` | Nom : `matiere_21_image` | Type : Image
- Libellé : `Description – MARBRE DE CAMPAN` | Nom : `matiere_21_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE CAMPAN` | Nom : `matiere_21_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 22 - MARBRE DE CHASSAGNE**
- Libellé : `Image – MARBRE DE CHASSAGNE` | Nom : `matiere_22_image` | Type : Image
- Libellé : `Description – MARBRE DE CHASSAGNE` | Nom : `matiere_22_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DE CHASSAGNE` | Nom : `matiere_22_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 23 - BLEU TURQUIN**
- Libellé : `Image – BLEU TURQUIN` | Nom : `matiere_23_image` | Type : Image
- Libellé : `Description – BLEU TURQUIN` | Nom : `matiere_23_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – BLEU TURQUIN` | Nom : `matiere_23_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 24 - GRIOTTE DE CAUNES** 
- Libellé : `Image – GRIOTTE DE CAUNES` | Nom : `matiere_24_image` | Type : Image
- Libellé : `Description – GRIOTTE DE CAUNES` | Nom : `matiere_24_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – GRIOTTE DE CAUNES` | Nom : `matiere_24_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 25 - SAINT-PONS** 
- Libellé : `Image – SAINT-PONS` | Nom : `matiere_25_image` | Type : Image
- Libellé : `Description – SAINT-PONS` | Nom : `matiere_25_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – SAINT-PONS` | Nom : `matiere_25_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 26 - SARRANCOLIN** 
- Libellé : `Image – SARRANCOLIN` | Nom : `matiere_26_image` | Type : Image
- Libellé : `Description – SARRANCOLIN` | Nom : `matiere_26_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – SARRANCOLIN` | Nom : `matiere_26_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 27 - CAUNES MINERVOIS**
- Libellé : `Image – CAUNES MINERVOIS` | Nom : `matiere_27_image` | Type : Image
- Libellé : `Description – CAUNES MINERVOIS` | Nom : `matiere_27_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – CAUNES MINERVOIS` | Nom : `matiere_27_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 28 - MARBRE DU JURA** 
- Libellé : `Image – MARBRE DU JURA` | Nom : `matiere_28_image` | Type : Image
- Libellé : `Description – MARBRE DU JURA` | Nom : `matiere_28_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – MARBRE DU JURA` | Nom : `matiere_28_categorie` | Type : Sélection | Défaut : **marbre**

**Matière 29 - COMBLANCHIEN** -
- Libellé : `Image – COMBLANCHIEN` | Nom : `matiere_29_image` | Type : Image
- Libellé : `Description – COMBLANCHIEN` | Nom : `matiere_29_description` | Type : Zone de texte (5 lignes)
- Libellé : `Catégorie – COMBLANCHIEN` | Nom : `matiere_29_categorie` | Type : Sélection | Défaut : **marbre**

---

## Étape 3 : Remplir les champs sur la page « Matières »

1. Va dans **Pages** → **Matières**
2. Descends en bas pour remplir tous les champs ACF :
   - Image, description, catégorie pour chaque matière (voir la liste)
3. Clique sur **Mettre à jour**

---

## Étape 4 : Modifier le template PHP

Utilise ce code pour afficher dynamiquement toutes les matières depuis les champs ACF de la page :

```php
<?php
$matieres = array(
  1 => 'COMBLANCHIEN',
  2 => 'MARBRE DU JURA',
  3 => 'CAUNES MINERVOIS',
  4 => 'SARRANCOLIN',
  5 => 'SAINT-PONS',
  6 => 'GRIOTTE DE CAUNES',
  7 => 'BLEU TURQUIN',
  8 => 'MARBRE DE CHASSAGNE',
  9 => 'MARBRE DE CAMPAN',
  10 => 'MARBRE GRAND ANTIQUE D\'AUBERT',
  11 => 'MARBRE DE TRETS',
  12 => 'MARBRE DE LA COURONNE',
  13 => 'MARBRE DE SAINT-BEAUZIRE',
  14 => 'MARBRE DU LANGUEDOC',
  15 => 'MARBRE DE VILLEFRANCHE-DE-ROUERGUE',
  16 => 'TAJ MAHAL',
  17 => 'WHITE MACAUBAS',
  18 => 'SEA PEARL',
  19 => 'AZUL MACAUBAS',
  20 => 'PERLA VENATA',
  21 => 'PATAGONIA',
  22 => 'INFINITY',
  23 => 'BIANCA GIOIA',
  24 => 'BLUE PEARL',
  25 => 'GRANIT NOIR ABSOLU',
  26 => 'STAR GALAXY',
  27 => 'VISCOUNT WHITE',
  28 => 'GRANIT DU TARN',
  29 => 'STEEL GREY',
);
?>
<div class="matieres-grid">
<?php foreach ($matieres as $i => $nom) :
  $image = get_field('matiere_' . $i . '_image');
  $description = get_field('matiere_' . $i . '_description');
  $categorie = get_field('matiere_' . $i . '_categorie');
  if (!$image && !$description) continue;
  ?>
  <article class="matiere-card" data-category="<?php echo esc_attr($categorie); ?>">
    <div class="matiere-card__image">
      <?php if ($image && !empty($image['url'])) : ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
      <?php endif; ?>
    </div>
    <div class="matiere-card__content">
      <h2 class="matiere-card__title"><?php echo esc_html($nom); ?></h2>
      <?php if ($description) : ?>
        <p class="matiere-card__description"><?php echo esc_html($description); ?></p>
      <?php endif; ?>
    </div>
  </article>
<?php endforeach; ?>
</div>
```

---

## Résultat
- Toutes les matières sont dans le contenu principal de la page.
- Yoast SEO voit et analyse tout.
- Plus de problème d’archive ou de CPT invisible pour Yoast.

---

**Tu peux demander la liste exacte des noms/numéros si besoin !**
