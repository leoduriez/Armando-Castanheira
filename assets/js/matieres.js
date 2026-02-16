/**
 * Page Matières - JavaScript
 * 
 * Gère le bouton "Voir Plus" pour l'affichage progressif des items.
 * Permet de charger les matières par groupes de 12 pour améliorer les performances.
 * Inclut des animations en cascade et un scroll automatique.
 * 
 * @package Armando_Castanheira
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const voirPlusBtn = document.getElementById('voir-plus-btn');
        const grid = document.getElementById('matieres-grid');
        
        // Vérifier que les éléments existent
        if (!voirPlusBtn || !grid) return;

        const itemsPerPage = parseInt(grid.dataset.itemsPerPage, 10) || 12;
        const totalItems = parseInt(voirPlusBtn.dataset.total, 10) || 0;
        let currentlyShown = itemsPerPage;

        voirPlusBtn.addEventListener('click', function() {
            // Récupérer tous les items cachés
            const hiddenItems = grid.querySelectorAll('.matiere-item--hidden');
            
            // Calculer combien d'items afficher (12 ou le reste)
            let itemsToShow = Math.min(hiddenItems.length, itemsPerPage);
            
            // Afficher les items avec animation en cascade
            for (let i = 0; i < itemsToShow; i++) {
                const item = hiddenItems[i];
                item.classList.remove('matiere-item--hidden');
                item.classList.add('fade-in');
                
                // Animation décalée pour chaque item (effet cascade)
                item.style.animationDelay = (i * 0.1) + 's';
            }
            
            currentlyShown += itemsToShow;
            
            // Cacher le bouton "Voir Plus" si tous les items sont affichés
            if (currentlyShown >= totalItems) {
                voirPlusBtn.classList.add('hidden');
            }
            
            // Scroll automatique vers les nouveaux éléments affichés
            setTimeout(function() {
                const newlyVisible = grid.querySelectorAll('.matiere-item:not(.matiere-item--hidden)');
                if (newlyVisible.length > itemsPerPage) {
                    // Trouver le premier nouvel item affiché
                    const firstNewItem = newlyVisible[currentlyShown - itemsToShow];
                    if (firstNewItem) {
                        // Scroller vers cet item avec animation fluide
                        firstNewItem.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                    }
                }
            }, 100);
        });
    });
})();
