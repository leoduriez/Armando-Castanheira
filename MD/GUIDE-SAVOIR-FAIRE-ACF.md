# Guide ACF - Page Savoir-Faire

## 📋 Vue d'ensemble

Ce guide explique comment créer et gérer le contenu de la page **Savoir-Faire** avec Advanced Custom Fields (version gratuite).

La page contient **3 sections** qui alternent entre texte à gauche/image à droite et image à gauche/texte à droite.

---

## 🎯 Étape 1 : Créer les champs ACF

### Dans WordPress Admin :
1. Va dans **ACF** → **Groupes de champs**
2. Clique sur **Ajouter un groupe de champs**
3. Nomme le groupe : **Savoir-Faire - Contenu**

### Localisation :
- **Règles** : Afficher ce groupe de champs si :
  - **Modèle de page** est égal à **Savoir faire**

---

## 📝 Champs à créer (Copie exactement ces valeurs)

Clique sur **"Ajouter un champ"** pour chaque champ ci-dessous :

---

### CHAMP 1
- **Libellé du champ** : `Titre Section 1`
- **Nom du champ** : `section_1_titre`
- **Type de champ** : Texte
- **Valeur par défaut** : `Installation sur mesure`

### CHAMP 2
- **Libellé du champ** : `Contenu Section 1`
- **Nom du champ** : `section_1_contenu`
- **Type de champ** : Éditeur WYSIWYG
- **Onglets à afficher** : Visuel et Texte

### CHAMP 3
- **Libellé du champ** : `Image Section 1`
- **Nom du champ** : `section_1_image`
- **Type de champ** : Image
- **Valeur de retour** : Tableau d'image

---

### CHAMP 4
- **Libellé du champ** : `Titre Section 2`
- **Nom du champ** : `section_2_titre`
- **Type de champ** : Texte
- **Valeur par défaut** : `Redonner l'éclat`

### CHAMP 5
- **Libellé du champ** : `Contenu Section 2`
- **Nom du champ** : `section_2_contenu`
- **Type de champ** : Éditeur WYSIWYG
- **Onglets à afficher** : Visuel et Texte

### CHAMP 6
- **Libellé du champ** : `Image Section 2`
- **Nom du champ** : `section_2_image`
- **Type de champ** : Image
- **Valeur de retour** : Tableau d'image

---

### CHAMP 7
- **Libellé du champ** : `Titre Section 3`
- **Nom du champ** : `section_3_titre`
- **Type de champ** : Texte
- **Valeur par défaut** : `Rénovation`

### CHAMP 8
- **Libellé du champ** : `Contenu Section 3`
- **Nom du champ** : `section_3_contenu`
- **Type de champ** : Éditeur WYSIWYG
- **Onglets à afficher** : Visuel et Texte

### CHAMP 9
- **Libellé du champ** : `Image Section 3`
- **Nom du champ** : `section_3_image`
- **Type de champ** : Image
- **Valeur de retour** : Tableau d'image

---

**IMPORTANT** : Une fois tous les champs créés, clique sur **"Enregistrer les modifications"** en haut à droite.

---

## 🎨 Étape 2 : Créer la page dans WordPress

1. Va dans **Pages** → **Ajouter**
2. Titre : **Savoir-Faire**
3. Dans **Attributs de page** → **Modèle** : Sélectionne **Savoir faire**
4. Publie la page

---

## ✍️ Étape 3 : Remplir le contenu

### Section 1 : Installation sur mesure

**Titre** :
```
Installation sur mesure
```

**Contenu** :
```html
La pose du marbre demande rigueur et savoir‑faire. Chaque plaque est choisie, ajustée et installée à la main, avec une attention particulière portée aux veines et aux raccords naturels.

Cette précision dans les détails garantit un résultat élégant, où la beauté et la durabilité du marbre s'expriment pleinement.
```

**Image** : `savoir-faire/cristalisation.webp`

---

### Section 2 : Redonner l'éclat

**Titre** :
```
Redonner l'éclat
```

**Contenu** :
```html
La cristallisation est un traitement de rénovation et de protection qui permet de raviver la brillance du marbre. En appliquant des produits spécifiques qui réagissent avec la surface de la pierre, on crée une fine couche protectrice tout en renforçant sa densité.

Cette technique redonne vie au marbre, lui offrant un aspect brillant et profond, comme au premier jour.
```

**Image** : `savoir-faire/fabrication.webp`

---

### Section 3 : Rénovation

**Titre** :
```
Rénovation
```

**Contenu** :
```html
La fabrication d'un ouvrage en marbre, c'est avant tout un savoir-faire artisanal qui commence par le choix minutieux du bloc ou de la dalle. Selon la couleur, le veinage et l'usage prévu : sol, plan de travail, table ou habillage mural, on sélectionne la pierre idéale pour sublimer l'espace.

On passe ensuite à la découpe sur mesure, précise au millimètre, pour s'adapter parfaitement aux dimensions du chantier. Les bords sont façonnés avec soin : droits, chanfreinés, adoucis ou arrondis, selon le style désiré.
```

**Image** : `savoir-faire/installation.webp`

---

## 📂 Chemins des images

Les images sont dans ton thème :
```
/wp-content/themes/armando-castanheira/assets/images/savoir-faire/
```

**Images disponibles** :
- `cristalisation.webp`
- `fabrication.webp`
- `installation.webp`

---

## 🔧 Étape 4 : Modifier le template PHP

Le fichier `/page-templates/template-savoir-faire.php` doit être modifié pour utiliser les champs ACF au lieu du contenu en dur.

---

## ✅ Résultat final

Une fois les champs ACF créés et remplis, la page Savoir-Faire affichera :
- **Section 1** : Texte à gauche, Image à droite
- **Section 2** : Image à gauche, Texte à droite (inversé)
- **Section 3** : Texte à gauche, Image à droite

Tout le contenu sera modifiable depuis l'admin WordPress !
