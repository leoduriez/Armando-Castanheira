# Guide de Gestion des Réalisations avec ACF

Ce guide explique comment gérer tes réalisations avec ACF gratuit.

---

## 📍 Où gérer les réalisations ?

WordPress Admin → **Réalisations** → **Ajouter** ou **Modifier une réalisation**

---

## 🎯 Système actuel

Tu as déjà un **Custom Post Type "Réalisations"** configuré. Chaque réalisation contient :

- **Titre** : Titre de la réalisation
- **Contenu** : Description (éditeur WordPress)
- **Image à la une** : Photo principale de la réalisation
- **Catégorie** : Type de réalisation (Cuisine, Salle de bain, Autre)

---

## ✨ Nouveaux champs ACF

J'ai ajouté 2 champs ACF pour gérer les comparaisons avant/après :

### 1. Mode Avant/Après
- **Type** : Oui/Non
- **Utilité** : Active l'affichage de 2 images côte à côte

### 2. Image Après
- **Type** : Image
- **Utilité** : Image "après" pour le mode comparaison
- **Condition** : Visible uniquement si "Mode Avant/Après" est activé

---

## 📝 Comment créer une réalisation

### Réalisation simple (1 image)

1. **Réalisations** → **Ajouter**
2. **Titre** : Ex: "PLAN DE TRAVAIL ET CRÉDENCE"
3. **Contenu** : Description complète en HTML
4. **Image à la une** : Clique sur "Définir l'image principale"
5. **Catégorie** : Sélectionne "Cuisine", "Salle de bain" ou "Autre"
6. **Mode Avant/Après** : Laisse sur "Non"
7. **Publier**

---

### Réalisation avant/après (2 images)

1. **Réalisations** → **Ajouter**
2. **Titre** : Ex: "RÉNOVATION ESCALIER"
3. **Contenu** : Description de la rénovation
4. **Image à la une** : Image "avant"
5. **Catégorie** : Sélectionne la catégorie
6. **Mode Avant/Après** : Active sur "Oui"
7. **Image Après** : Clique sur "Ajouter image" et sélectionne l'image "après"
8. **Publier**

---

## 📂 Catégories de réalisations

Tu dois créer 3 catégories dans **Réalisations** → **Type de réalisation** :

| Nom | Slug |
|-----|------|
| Cuisine | `cuisine` |
| Salle de bain | `salle-de-bain` |
| Autre | `autre` |

---

## 🗂️ Liste des réalisations à créer

Voici toutes les réalisations avec leur contenu **dans l'ordre de création** :  
⚠️ **Crée-les dans cet ordre pour qu'elles s'affichent correctement sur le site** (la dernière créée sera en premier).

---

### 1. RÉNOVATION SOL TRANI 2

**Catégorie** : Autre  
**Mode Avant/Après** : Non

**Titre** :
```
RÉNOVATION SOL
```

**Contenu** :
```html
Rénovation d'un sol en Trani afin de redonner du caractère à l'ensemble du pavillon. L'objectif était de rafraîchir la pierre, d'améliorer son éclat et de simplifier son entretien au quotidien.

Le travail a consisté en un ponçage et un polissage complet, suivis d'un traitement hydrofuge pour protéger la pierre des taches et infiltrations.

Grâce à la forte teneur en calcaire du Trani, la cristallisation a offert une brillance marquée, redonnant au sol une surface lumineuse, régulière.
```

**Image à la une** : `realisations/sol5.webp`

---

### 2. RÉNOVATION SOL MARFIL

**Catégorie** : Autre  
**Mode Avant/Après** : Non

**Titre** :
```
RÉNOVATION SOL MARBRE
```

**Contenu** :
```html
Rénovation d'un sol en marbre Marfil sur 70 m² afin de redonner vie et profondeur à l'espace intérieur. Ce projet a permis d'éliminer les traces d'usure tout en restaurant l'éclat naturel de cette pierre beige chaleureuse.

Un ponçage minutieux, suivi d'un polissage et de la rénovation des joints, a assuré une étanchéité parfaite. La cristallisation finale a offert une brillance durable, accentuant la luminosité et l'élégance de la pièce.
```

**Image à la une** : `realisations/sol4.webp`

---

### 3. INSTALLATION PLAN DE CUISINE TERRAZZO

**Catégorie** : Cuisine  
**Mode Avant/Après** : Non

**Titre** :
```
INSTALLATION PLAN DE CUISINE
```

**Contenu** :
```html
Fabrication et installation d'un îlot central en terrazzo, une matière originale en plein renouveau. Très prisé dans les années 50 puis oublié pendant plusieurs décennies, le terrazzo revient aujourd'hui au cœur des projets de décoration contemporaine.

Composé d'une résine liant des éclats de marbre colorés, il offre un aspect moucheté unique, à la fois graphique et chaleureux, qui apporte une touche de caractère et d'élégance à la pièce.
```

**Image à la une** : `realisations/plan-de-cuisine.webp`

---

### 4. RÉNOVATION SOL TRANI

**Catégorie** : Autre  
**Mode Avant/Après** : Non

**Titre** :
```
RÉNOVATION SOL
```

**Contenu** :
```html
Rénovation d'un sol en Trani pour redonner du caractère à l'ensemble du pavillon. L'objectif est de rafraîchir la pierre, d'améliorer son éclat et de faciliter son entretien au quotidien.

Le travail a consisté en un ponçage puis un polissage complet du sol, avant l'application d'un traitement hydrofuge pour le protéger des taches et des infiltrations.
```

**Image à la une** : `realisations/sol3.webp`

---

### 5. RÉNOVATION SOL MOSAÏQUE

**Catégorie** : Autre  
**Mode Avant/Après** : Non

**Titre** :
```
RÉNOVATION SOL EN MARBRE MOSAÏQUE
```

**Contenu** :
```html
Rénovation d'un sol en marbre mosaïque pour le café Blomet, situé dans le 15ᵉ arrondissement de Paris. L'objectif est de redonner au sol un aspect propre et homogène, tout en respectant le dessin d'origine de la mosaïque.

Chaque petits carreaux à reçu un soin particulier puis apporté au nivellement pour obtenir un sol le plus régulier possible, agréable à l'œil comme à la marche.
```

**Image à la une** : `realisations/sol2.webp`

---

### 6. INSTALLATION SOL DAMIER

**Catégorie** : Autre  
**Mode Avant/Après** : Non

**Titre** :
```
INSTALLATION SOL DAMIER
```

**Contenu** :
```html
Fabrication et installation d'un sol façon damier en marbre blanc de Carrare et Vert Alpi, réalisé sur-mesure pour le hall d'entrée de bureaux d'un client qatari.

L'objectif est de créer un sol élégant et graphique, avec un motif parfaitement régulier dès l'arrivée dans les lieux.

Chaque pièce de marbre a été ajustée pour que les pierres s'emboîtent proprement, donnant un sol harmonieux, précis et visuellement très équilibré.
```

**Image à la une** : `realisations/sol1.webp`

---

### 7. RÉNOVATION TABLE (AVANT/APRÈS)

**Catégorie** : Autre  
**Mode Avant/Après** : **OUI**

**Titre** :
```
RÉNOVATION TABLE
```

**Contenu** :
```html
Rénovation et traitement hydrofuge d'une table en Calacatta Vagli Oro, trois ans après sa fabrication sur mesure. Le client m'a rappelé souhaitant protéger la pierre sans une finition trop brillante, tout en préservant un bel aspect naturel.

La fabrication initiale de cette table en Calacatta Vagli Oro, reconnus pour leurs veines dorées élégantes à comprit la découpe précise, le façonnage des bords et un polissage léger pour mettre en valeur les motifs naturels de la pierre, avant une pose impeccable adaptée aux dimensions et au style du mobilier.
```

**Image à la une (Avant)** : `realisations/table1-1.webp`  
**Image Après** : `realisations/table1-2.webp`

---

### 8. RÉNOVATION ESCALIER (AVANT/APRÈS)

**Catégorie** : Autre  
**Mode Avant/Après** : **OUI**

**Titre** :
```
RÉNOVATION ESCALIER
```

**Contenu** :
```html
Rénovation complète d'un escalier en marbre blanc de Carrare. L'objectif est de redonner à l'escalier son éclat d'origine, tout en corrigeant les défauts accumulés avec le temps.

La première étape est de reprendre les marches abîmées, nettoyer en profondeur et préparer la surface à être poncé et retravaillé pour retrouver une surface plane, nette et homogène.

Un travail de finition a permis de révéler à nouveau les veines du Carrare et sa luminosité naturelle. L'escalier retrouve ainsi un aspect propre, élégant et lumineux, tout en restant parfaitement adapté à un usage quotidien.
```

**Image à la une (Avant)** : `realisations/escalier1-1.webp`  
**Image Après** : `realisations/escalier1-2.webp`

---

### 9. BAIGNOIRE TRAVERTIN

**Catégorie** : Salle de bain  
**Mode Avant/Après** : Non

**Titre** :
```
FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER
```

**Contenu** :
```html
Fabrication et installation d'une baignoire ainsi que d'un évier en travertin, réalisés sur-mesure pour cette salle de bain.

Le résultat est un ensemble sobre et lumineux, où la pierre apporte immédiatement une sensation de confort.
```

**Image à la une** : `realisations/salle-de-bain2.webp`

---

### 10. BAIGNOIRE VERT BAMBOU

**Catégorie** : Salle de bain  
**Mode Avant/Après** : Non

**Titre** :
```
FABRICATION ET INSTALLATION BAIGNOIRE ET ÉVIER
```

**Contenu** :
```html
Baignoire et vasque réalisées sur-mesure en marbre Vert Bambou. Ce projet avait pour but de créer un ensemble unique, à la fois sobre et original, mettant en avant les nuances et le mouvement naturel de la pierre.

Le Vert Bambou nécessite des découpes nettes et des ajustements soignés pour épouser parfaitement les différentes formes de la salle.
```

**Image à la une** : `realisations/salle-de-bain1.webp`

---

### 11. GRANIT BLEUTÉ

**Catégorie** : Cuisine  
**Mode Avant/Après** : Non

**Titre** :
```
PLAN DE TRAVAIL ET CRÉDENCE
```

**Contenu** :
```html
Cet ouvrage a une valeur particulière : c'est le premier que j'ai entièrement conçu et réalisé seul.

Ses reflets bleutés, qui changent selon l'angle de vue, apportent profondeur et élégance à l'ensemble, faisant de ce granit un matériau à la fois solide et fascinant.
```

**Image à la une** : `realisations/cuisine4.webp`

---

### 12. MARBRE PANDA

**Catégorie** : Cuisine  
**Mode Avant/Après** : Non

**Titre** :
```
PLAN DE TRAVAIL ET CRÉDENCE
```

**Contenu** :
```html
Plan de travail et crédence réalisés en Marbre Panda, dans un style livre ouvert.

Ce procédé, qui consiste à faire se refléter les veines du marbre en miroir, crée un rendu spectaculaire.

Le Marbre Panda, avec ses contrastes de noir et de blanc, apporte à la fois élégance et modernité, transformant chaque surface en véritable pièce décorative.
```

**Image à la une** : `realisations/cuisine3.webp`

---

### 13. PLAN DE TRAVAIL QUARTZITE

**Catégorie** : Cuisine  
**Mode Avant/Après** : Non

**Titre** :
```
PLAN DE TRAVAIL ET CRÉDENCE
```

**Contenu** :
```html
Plan de travail et crédence réalisés en Quartzite Taj Mahal.

Le Quartzite est une matière exigeante, dense et robuste.

Son aspect raffiné et sa résistance exceptionnelle en font un matériau haut de gamme, idéal pour combiner élégance, durabilité et praticité au quotidien.
```

**Image à la une** : `realisations/cuisine2.webp`

---

### 14. BAR ONYX MIEL

**Catégorie** : Cuisine  
**Mode Avant/Après** : Non

**Titre** :
```
BAR ONYX MIEL
```

**Contenu** :
```html
Bar en onyx couleur miel réalisé sur-mesure pour un restaurant, pensé pour donner une nouvelle dimension à l'espace et mettre en valeur la chaleur naturelle de cette pierre d'exception.

Avec un décaissé précis pour intégrer une grille en laiton, permettant d'évacuer le surplus des verres tout en préservant l'esthétique du bar. Sous cette grille, un éclairage LED vient sublimer la translucidité et les nuances dorées de l'onyx, pour une ambiance élégante et raffinée.
```

**Image à la une** : `realisations/bar.webp`

---

## 📂 Chemins des images

Les images sont dans ton thème :
```
/wp-content/themes/armando-castanheira/assets/images/realisations/
```

Tu peux les uploader dans la **Médiathèque WordPress** depuis ce dossier.

---

## 🔧 Installation

1. **Importe les champs ACF** :
   - ACF → Outils → Importer
   - Sélectionne `acf-export-realisations.json`

2. **Crée les catégories** :
   - Réalisations → Type de réalisation → Ajouter
   - Crée : Cuisine, Salle de bain, Autre

3. **Crée les réalisations** :
   - Suis le guide ci-dessus pour chaque réalisation

---

## ✅ Checklist

- [ ] Champs ACF importés
- [ ] 3 catégories créées (Cuisine, Salle de bain, Autre)
- [ ] Images uploadées dans la médiathèque
- [ ] 14 réalisations créées avec leurs contenus
- [ ] Filtres testés sur la page Réalisations

---

## 🚀 Résultat

Une fois toutes les réalisations créées, ta page `/realisations/` affichera automatiquement :
- Toutes les réalisations avec filtres par catégorie
- Les images avant/après pour les rénovations
- Un design dynamique avec les vecteurs décoratifs

---

**Bon courage pour la création des réalisations ! 🎉**
