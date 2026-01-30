# Armando Castanheira - Thème WordPress Optimisé

## 📋 Vue d'ensemble

Thème WordPress custom développé from scratch pour Armando Castanheira, artisan marbrier. Optimisé pour la performance, l'accessibilité et l'SEO.

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
│   │   └── pages/
│   │       ├── home.css
│   │       └── realisations.css
│   ├── images/          (tous les fichiers en WebP)
│   └── js/
│       ├── main.js
│       └── modules/
├── inc/
│   ├── ajax-handlers.php
│   ├── custom-post-types.php
│   ├── customizer.php
│   ├── enqueue.php      (gestion optimisée des ressources)
│   ├── security.php
│   ├── taxonomies.php
│   └── template-functions.php
├── page-templates/
│   ├── template-contact.php
│   ├── template-matieres.php
│   └── template-savoir-faire.php
├── template-parts/
│   ├── components/
│   └── content/
├── .htaccess            (optimisations serveur)
├── style.css            (styles globaux)
├── header.php
├── footer.php
├── front-page.php
├── index.php
└── functions.php        (optimisations de performance)
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

## 🎨 Caractéristiques

### Design
- Typographie fluide avec clamp()
- Palette de couleurs minimaliste et élégante
- Animations CSS fluides et performantes
- Responsive design mobile-first
- Système de couleurs CSS variables

### Fonctionnalités
- Page d'accueil hero avec CTA
- Page réalisations avec filtrage par catégorie
- Navigation principale sticky
- Menu mobile hamburger
- Galerie avant/après pour comparaisons
- Formulaire de contact

### SEO
- Structure HTML5 sémantique
- Meta tags optimisés
- URLs descriptives
- Images avec alt text
- Mobile-friendly

## 📊 Performance Scores (attendus)

- **Google PageSpeed Insights**: 85-95/100 (desktop)
- **Lighthouse**: 90+/100
- **Time to First Contentful Paint**: < 2s
- **Fully Loaded**: < 3s

## 🔐 Sécurité

- Validation et sanitization des données
- Protection CSRF
- Headers de sécurité configurés
- Suppression des informations techniques exposées

## 📝 Maintenance

### Mises à jour
- Vérifier la compatibilité WordPress régulièrement
- Mettre à jour les plugins si utilisés
- Tester après chaque mise à jour

### Sauvegarde des images
- Garder un backup des images originales
- Format WebP pour le serveur (actuellement utilisé)
- PNG en développement pour édition

## 🚢 Déploiement

### Avant publication
1. Tester sur un environnement staging
2. Vérifier avec PageSpeed Insights
3. Tester sur mobile et desktop
4. Vérifier tous les liens
5. Tester les formulaires

### Après publication
1. Configurer les headers .htaccess
2. Activer le caching navigateur
3. Installer un plugin de cache
4. Mettre en place un CDN
5. Monitorer les performances

## 🤝 Support

Pour toute question ou améliorations, contactez le développeur.

---

**Version thème**: 1.0.0  
**Dernière mise à jour**: Décembre 2025  
**WebP Optimization**: 33 images converties et optimisées
