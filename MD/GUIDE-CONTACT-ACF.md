# 📋 Guide ACF - Page Contact

Ce guide explique comment créer les champs ACF pour la page Contact.

---

## 🎯 Étape 1 : Créer le groupe de champs ACF

### Accès :
1. Va dans **ACF** → **Groupes de champs**
2. Clique sur **Ajouter**

### Configuration du groupe :
- **Titre** : `Contact - Informations`

### Localisation :
- **Règles** : Afficher ce groupe de champs si :
  - **Modèle de page** est égal à **Contact**

---

## 📝 Champs à créer (Copie exactement ces valeurs)

Clique sur **"Ajouter un champ"** pour chaque champ ci-dessous :

---

### CHAMP 1
- **Libellé du champ** : `Photo de contact`
- **Nom du champ** : `contact_photo`
- **Type de champ** : Image
- **Valeur de retour** : Tableau d'image
- **Taille d'aperçu** : Miniature

### CHAMP 2
- **Libellé du champ** : `Nom`
- **Nom du champ** : `contact_nom`
- **Type de champ** : Texte

### CHAMP 3
- **Libellé du champ** : `Description`
- **Nom du champ** : `contact_description`
- **Type de champ** : Zone de texte
- **Lignes** : 3

---

**IMPORTANT** : Une fois tous les champs créés, clique sur **"Enregistrer les modifications"** en haut à droite.

---

## 🎨 Étape 2 : Remplir les champs dans WordPress

1. Va dans **Pages** → **Contact** (ou crée la page si elle n'existe pas)
2. **Attributs de page** → **Modèle** : Sélectionne **Contact**
3. **Descends en bas de la page** pour remplir les champs ACF :
   - **Photo de contact** : Upload l'image `pp-contact.webp`
   - **Nom** : `Armando<br>Castanheira` (avec le `<br>` pour le saut de ligne)
   - **Description** : `Passionné depuis plus de 15ans, chaque projet est le résultat de mon exigence et de la valeur du travail`
4. Clique sur **Mettre à jour**

**IMPORTANT** : Ne mets RIEN dans le contenu principal (éditeur WordPress). Tout se gère avec les champs ACF en bas !

---

## 📂 Chemins des images

Les images sont dans ton thème :
```
/wp-content/themes/armando-castanheira/assets/images/contact/
```

**Image disponible** :
- `pp-contact.webp`

---

## 🔧 Étape 3 : Modifier le template PHP

Le fichier `/page-templates/template-contact.php` doit être modifié pour utiliser les champs ACF au lieu du contenu en dur.

---

## ✅ Résultat final

Une fois les champs ACF créés et remplis, la page Contact affichera :
- **Photo personnalisée** modifiable depuis l'admin
- **Nom** modifiable depuis l'admin
- **Description** modifiable depuis l'admin
- **Formulaires de contact et devis** (inchangés)

Tout le contenu sera modifiable depuis l'admin WordPress !
