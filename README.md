# 🏛️ Armando Castanheira - Thème WordPress Professionnel

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/leoduriez/Armando-Castanheira)
[![WordPress](https://img.shields.io/badge/WordPress-6.0+-green.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-8.0+-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

## 📋 Vue d'ensemble

Thème WordPress custom **100% from scratch** développé pour Armando Castanheira, artisan marbrier parisien. Ce thème professionnel combine performance, accessibilité, sécurité et SEO pour offrir une expérience utilisateur optimale.

### 🎯 Objectifs du projet

- ✅ Site vitrine élégant et sobre pour un artisan marbrier
- ✅ Performance optimale (score PageSpeed 90+)
- ✅ Code 100% commenté en français
- ✅ Architecture moderne et maintenable
- ✅ Vanilla JavaScript (pas de jQuery)
- ✅ Responsive mobile-first

## 🚀 Optimisations de Performance

### Images
- ✅ Conversion WebP de tous les assets (69% de réduction de taille)
- ✅ Lazy loading automatique sur toutes les images
- ✅ Images responsives avec srcset
- ✅ Compression WebP optimale

### CSS & JavaScript
- ✅ CSS minifié et inline-optimisé
- ✅ JavaScript déféré (chargement en fin de page)
- ✅ Google Fonts optimisées avec display=swap
- ✅ Suppression des emojis WordPress inutiles

### Caching
- ✅ Headers de cache navigateur configurés (.htaccess)
- ✅ Cache-Control pour les assets statiques (1 an)
- ✅ GZIP compression activée

### Code
- ✅ Suppression des méta WordPress inutiles (version, RSD, etc.)
- ✅ Suppression des scripts d'emojis
- ✅ Optimisation des fichiers et suppression des doublons PNG

### Taille du thème
- **Avant**: 28 MB (avec PNG)
- **Après**: 8.3 MB (WebP uniquement)
- **Réduction**: 69% ✅

## 📁 Structure du projet

```
armando-castanheira/
├── assets/
│   ├── css/
│   │   ├── components/          # Composants réutilisables
│   │   │   └── avis-clients.css
│   │   └── pages/               # Styles spécifiques aux pages
│   │       ├── 404.css
│   │       ├── contact.css
│   │       ├── home.css
│   │       ├── legal.css
│   │       ├── matieres.css
│   │       ├── realisations.css
│   │       └── savoir-faire.css
│   ├── images/                  # Tous les fichiers en WebP
│   │   ├── common/              # Logo, favicon, etc.
│   │   ├── contact/
│   │   ├── headers/
│   │   └── matiere/             # 29 images de matières
│   └── js/
│       ├── main.js              # JavaScript principal (Vanilla JS)
│       ├── matieres.js          # Gestion "Voir Plus"
│       ├── components/
│       │   └── avis-clients.js  # Carousel et formulaire avis
│       └── modules/
│           ├── filter.js        # Filtrage AJAX
│           └── forms.js         # Validation formulaires
├── inc/                         # Fonctionnalités PHP
│   ├── admin-devis.php          # Page admin gestion devis
│   ├── ajax-handlers.php        # Gestionnaires AJAX
│   ├── avis-clients-db.php      # Base de données avis clients
│   ├── custom-post-types.php    # CPT Réalisations & Matières
│   ├── customizer.php           # Personnalisation WordPress
│   ├── devis-db.php             # Base de données devis
│   ├── enqueue.php              # Chargement conditionnel assets
│   ├── security.php             # Mesures de sécurité
│   ├── taxonomies.php           # Taxonomies personnalisées
│   └── template-functions.php   # Fonctions helper
├── page-templates/              # Templates de pages
│   ├── template-accueil.php
│   ├── template-contact.php
│   ├── template-matieres.php
│   ├── template-realisations.php
│   └── template-savoir-faire.php
├── template-parts/
│   ├── components/
│   │   └── filter-bar.php
│   └── content/
│       └── content-matiere.php
├── .htaccess                    # Optimisations serveur
├── style.css                    # Styles globaux
├── header.php                   # Header avec navigation
├── footer.php                   # Footer avec accordéons légaux
├── front-page.php
├── index.php
├── functions.php                # Configuration principale
├── page-cgu.php                 # CGU
├── page-confidentialite.php     # Politique de confidentialité
├── page-devis.php               # Formulaire devis
├── page-realisations.php        # Archive réalisations
├── archive-matiere.php          # Archive matières
├── 404.php                      # Page erreur 404
├── screenshot.png               # Aperçu thème WordPress
└── README.md                    # Documentation
```

## 🔧 Configuration recommandée

### 1. Serveur / Hébergement
- PHP 8.0+ obligatoire
- Module mod_expires activé pour le caching
- Module mod_deflate activé pour GZIP
- Module mod_rewrite activé pour les permaliens

### 2. Configurations WordPress
- Activer la "mise en cache du navigateur" dans les paramètres
- Utiliser un plugin de cache côté serveur (WP Super Cache, W3 Total Cache)
- Installer un CDN (CloudFlare, Bunny CDN) pour les assets statiques

### 3. Améliorations futures
- Minification CSS/JS automatique (plugin)
- Utiliser un service de CDN pour les images
- Implémenter Image Optimization plugin (Optimole, Smush)
- Ajouter Progressive Web App (PWA) pour le mode hors ligne

## ✨ Fonctionnalités principales

### 🎨 Design & Interface
- **Typographie fluide** avec `clamp()` pour un rendu optimal sur tous les écrans
- **Palette de couleurs** minimaliste et élégante (beige, marron, blanc)
- **Animations CSS** fluides et performantes (fade-in, slide, hover effects)
- **Responsive design** mobile-first avec breakpoints optimisés
- **CSS Variables** pour une personnalisation facile
- **Menu mobile** hamburger avec overlay et animations
- **Navigation sticky** qui se fixe au scroll

### 📄 Pages & Templates

#### Page d'accueil
- Hero section avec image de fond et CTA
- Section présentation de l'artisan
- Galerie de réalisations mise en avant
- Section matières avec aperçu
- **Carousel d'avis clients** avec système de notation
- Formulaire d'ajout d'avis en temps réel

#### Page Réalisations
- Affichage en grille responsive
- **Filtrage AJAX** par type (Cuisine, Salle de bain, Autres)
- Animations au scroll
- Lazy loading des images

#### Page Matières
- **29 matières** (marbres, granits, quartzites) avec images WebP
- Cartes interactives avec descriptions détaillées
- **Bouton "Voir Plus"** pour chargement progressif (12 par 12)
- Animations en cascade
- Scroll automatique vers les nouveaux items

#### Page Savoir-Faire
- Présentation du métier et des techniques
- Galerie de photos du processus
- Mise en valeur de l'expertise

#### Page Contact
- **Formulaire de contact** avec validation en temps réel
- **Formulaire de devis** avec champs spécifiques
- Validation côté client et serveur
- Envoi AJAX avec popup de confirmation
- Sauvegarde en base de données

### 🔧 Fonctionnalités techniques

#### Custom Post Types (CPT)
- **Réalisations** : projets de marbrerie avec taxonomie "Type de réalisation"
- **Matières** : catalogue des pierres avec taxonomie "Type de matière"

#### Base de données personnalisée
- **Table `wp_avis_clients`** : stockage des avis avec modération
- **Table `wp_demandes_devis`** : gestion des demandes de devis
- Statistiques et rapports disponibles

#### AJAX & JavaScript
- **Filtrage dynamique** sans rechargement de page
- **Validation de formulaires** en temps réel
- **Carousel d'avis** avec navigation et swipe mobile
- **Système de notation** par étoiles interactif
- **Popups modales** pour les confirmations
- 100% **Vanilla JavaScript** (pas de jQuery)

#### Sécurité
- Validation et sanitization de toutes les données
- Protection CSRF avec nonces
- Headers de sécurité HTTP configurés
- Limitation des tentatives de connexion
- Suppression des informations sensibles (version WP, XML-RPC)
- Désactivation de l'énumération des utilisateurs

### 🔍 SEO & Accessibilité
- **Structure HTML5 sémantique** (header, nav, main, article, section)
- **Meta tags** optimisés pour chaque page
- **URLs descriptives** et permaliens propres
- **Images avec alt text** systématique
- **ARIA labels** pour l'accessibilité
- **Fil d'Ariane** (breadcrumb) pour la navigation
- **Mobile-friendly** et responsive
- **Lighthouse score** 90+ attendu

## 📊 Performance Scores (attendus)

- **Google PageSpeed Insights**: 85-95/100 (desktop)
- **Lighthouse**: 90+/100
- **Time to First Contentful Paint**: < 2s
- **Fully Loaded**: < 3s

## � Installation

### Prérequis
- WordPress 6.0 ou supérieur
- PHP 8.0 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur Apache ou Nginx

### Étapes d'installation

1. **Télécharger le thème**
   ```bash
   git clone https://github.com/leoduriez/Armando-Castanheira.git
   ```

2. **Installer dans WordPress**
   - Copier le dossier dans `/wp-content/themes/`
   - Ou zipper et installer via l'interface WordPress

3. **Activer le thème**
   - Aller dans Apparence > Thèmes
   - Activer "Armando Castanheira"

4. **Configuration initiale**
   - Les tables de base de données se créent automatiquement
   - Configurer les permaliens en "Nom de l'article"
   - Créer les pages nécessaires et assigner les templates

5. **Importer le contenu (optionnel)**
   - Créer des réalisations via CPT "Réalisations"
   - Créer des matières via CPT "Matières"
   - Les taxonomies se créent automatiquement

## 📚 Documentation du code

### Code 100% commenté en français

Tous les fichiers PHP et JavaScript sont **entièrement commentés en français** pour faciliter la maintenance et la collaboration :

- **En-têtes de fichiers** : description du rôle et des fonctionnalités
- **Commentaires de fonctions** : explication détaillée avec `@param` et `@return`
- **Commentaires inline** : clarification des sections complexes
- **Architecture documentée** : structure et organisation expliquées

### Fichiers clés à connaître

| Fichier | Description |
|---------|-------------|
| `functions.php` | Configuration principale, optimisations, shortcodes |
| `inc/ajax-handlers.php` | Tous les gestionnaires AJAX (filtres, formulaires, avis) |
| `inc/enqueue.php` | Chargement conditionnel des CSS/JS par page |
| `inc/security.php` | Toutes les mesures de sécurité |
| `assets/js/main.js` | JavaScript principal (menu, scroll, animations) |
| `assets/js/components/avis-clients.js` | Carousel et formulaire d'avis |

## � Sécurité

### Mesures implémentées
- ✅ Validation et sanitization de toutes les données utilisateur
- ✅ Protection CSRF avec nonces WordPress
- ✅ Headers de sécurité HTTP (X-Frame-Options, X-Content-Type-Options, etc.)
- ✅ Suppression des informations sensibles (version WP, générateur, etc.)
- ✅ Désactivation de XML-RPC pour prévenir les attaques
- ✅ Limitation des tentatives de connexion
- ✅ Sanitization des noms de fichiers uploadés
- ✅ Messages d'erreur de connexion génériques

### Recommandations supplémentaires
- Utiliser un plugin de sécurité (Wordfence, iThemes Security)
- Activer le SSL/HTTPS
- Maintenir WordPress et PHP à jour
- Utiliser des mots de passe forts
- Limiter les tentatives de connexion avec un plugin dédié

## 📝 Maintenance

### Mises à jour
- Vérifier la compatibilité WordPress régulièrement
- Mettre à jour les plugins si utilisés
- Tester après chaque mise à jour

### Sauvegarde des images
- Garder un backup des images originales
- Format WebP pour le serveur (actuellement utilisé)
- PNG en développement pour édition

## �️ Technologies utilisées

### Frontend
- **HTML5** - Structure sémantique
- **CSS3** - Styles modernes avec variables, Grid, Flexbox
- **JavaScript ES6+** - 100% Vanilla JS (pas de jQuery)
- **WebP** - Format d'image optimisé

### Backend
- **PHP 8.0+** - Langage serveur
- **WordPress 6.0+** - CMS
- **MySQL** - Base de données

### Outils & Méthodologies
- **Git** - Contrôle de version
- **Mobile-First** - Approche responsive
- **BEM** - Méthodologie CSS (partielle)
- **AJAX** - Requêtes asynchrones
- **REST API** - Communication client-serveur

## �🚢 Déploiement

### Avant publication
1. ✅ Tester sur un environnement staging
2. ✅ Vérifier avec PageSpeed Insights
3. ✅ Tester sur mobile et desktop (responsive)
4. ✅ Vérifier tous les liens et navigation
5. ✅ Tester les formulaires (contact et devis)
6. ✅ Vérifier le carousel d'avis clients
7. ✅ Tester le filtrage AJAX des réalisations/matières
8. ✅ Valider l'accessibilité (ARIA, navigation clavier)

### Après publication
1. Configurer les headers `.htaccess` pour le caching
2. Activer le caching navigateur
3. Installer un plugin de cache (WP Super Cache, W3 Total Cache)
4. Mettre en place un CDN (CloudFlare recommandé)
5. Monitorer les performances avec Google Analytics
6. Configurer Google Search Console
7. Soumettre le sitemap XML

### Checklist de déploiement
- [ ] Backup complet du site
- [ ] Vérifier les permaliens
- [ ] Tester tous les formulaires
- [ ] Vérifier les emails (contact, devis)
- [ ] Tester le système d'avis clients
- [ ] Valider le responsive sur vrais appareils
- [ ] Optimiser les images si nécessaire
- [ ] Configurer le SSL/HTTPS
- [ ] Tester la vitesse de chargement

## 📈 Améliorations futures possibles

- [ ] Système de réservation en ligne
- [ ] Galerie avant/après interactive
- [ ] Intégration Instagram API pour feed automatique
- [ ] Module de blog pour articles/actualités
- [ ] Multilingue (WPML ou Polylang)
- [ ] Progressive Web App (PWA)
- [ ] Mode sombre (dark mode)
- [ ] Système de devis en ligne avec calcul automatique
- [ ] Chat en direct (LiveChat, Tawk.to)
- [ ] Intégration Google My Business

## 🤝 Contribution

Ce projet est développé et maintenu par **Léo Duriez**.

Pour toute question, suggestion ou amélioration :
- 📧 Email : leo.duriezj@gmail.com
- 🐙 GitHub : [@leoduriez](https://github.com/leoduriez)

## 📄 Licence

Ce thème est développé pour un usage privé. Tous droits réservés.

---

## 📊 Statistiques du projet

- **Lignes de code** : ~5000+ lignes (PHP + JS + CSS)
- **Fichiers** : 40+ fichiers
- **Commentaires** : 100% du code commenté en français
- **Taille du thème** : 8.3 MB (avec images WebP)
- **Images optimisées** : 33 images converties en WebP
- **Réduction de poids** : 69% par rapport aux PNG originaux

---

**Version thème** : 1.0.0  
**Dernière mise à jour** : Février 2025  
**Développeur** : Léo Duriez  
**Client** : Armando Castanheira - Artisan Marbrier Paris 8ème  
**Repository** : [github.com/leoduriez/Armando-Castanheira](https://github.com/leoduriez/Armando-Castanheira)

---

⭐ **Si ce projet vous plaît, n'hésitez pas à lui donner une étoile sur GitHub !**
