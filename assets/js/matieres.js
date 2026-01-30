/**
 * Matières Page - JavaScript
 * Gestion du bouton "Voir Plus" pour l'affichage progressif des items
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const voirPlusBtn = document.getElementById('voir-plus-btn');
        const grid = document.getElementById('matieres-grid');
        
        if (!voirPlusBtn || !grid) return;

        const itemsPerPage = parseInt(grid.dataset.itemsPerPage, 10) || 12;
        const totalItems = parseInt(voirPlusBtn.dataset.total, 10) || 0;
        let currentlyShown = itemsPerPage;

        voirPlusBtn.addEventListener('click', function() {
            const hiddenItems = grid.querySelectorAll('.matiere-item--hidden');
            
            // Afficher les 12 prochains items (ou tous les restants)
            let itemsToShow = Math.min(hiddenItems.length, itemsPerPage);
            
            for (let i = 0; i < itemsToShow; i++) {
                const item = hiddenItems[i];
                item.classList.remove('matiere-item--hidden');
                item.classList.add('fade-in');
                
                // Stagger animation
                item.style.animationDelay = (i * 0.1) + 's';
            }
            
            currentlyShown += itemsToShow;
            
            // Cacher le bouton si tout est affiché
            if (currentlyShown >= totalItems) {
                voirPlusBtn.classList.add('hidden');
            }
            
            // Scroll smooth vers les nouveaux éléments
            setTimeout(function() {
                const newlyVisible = grid.querySelectorAll('.matiere-item:not(.matiere-item--hidden)');
                if (newlyVisible.length > itemsPerPage) {
                    const firstNewItem = newlyVisible[currentlyShown - itemsToShow];
                    if (firstNewItem) {
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
