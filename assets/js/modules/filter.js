/**
 * Module de filtrage - Vanilla JS
 * 
 * Gère le filtrage AJAX pour les Réalisations et Matières.
 * Permet de filtrer dynamiquement le contenu sans recharger la page.
 * Inclut la gestion de l'historique du navigateur et l'accessibilité.
 * 
 * @package Armando_Castanheira
 */

'use strict';

(function() {
    /**
     * Contrôleur de filtrage
     * Classe principale qui gère toute la logique de filtrage
     */
    class FilterController {
        constructor(options) {
            this.filterBar = document.querySelector(options.filterBarSelector || '.filter-bar');
            this.contentContainer = document.querySelector(options.contentSelector || '.filter-content');
            this.ajaxAction = options.ajaxAction || 'filter_realisations';
            this.loadingClass = 'is-loading';
            
            if (!this.filterBar || !this.contentContainer) {
                return;
            }
            
            this.init();
        }
        
        init() {
            // Initialiser les événements
            this.bindEvents();
        }
        
        bindEvents() {
            // Attacher les événements de clic aux boutons de filtre
            const filterButtons = this.filterBar.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', (e) => this.handleFilter(e));
            });
        }
        
        handleFilter(e) {
            const button = e.currentTarget;
            const filterValue = button.dataset.filter;
            
            // Mettre à jour l'état actif du bouton
            this.updateActiveButton(button);
            
            // Récupérer le contenu filtré via AJAX
            this.fetchContent(filterValue);
            
            // Mettre à jour l'URL sans recharger (pour les marque-pages)
            this.updateURL(filterValue);
        }
        
        updateActiveButton(activeButton) {
            // Retirer la classe active de tous les boutons
            const allButtons = this.filterBar.querySelectorAll('.filter-btn');
            
            allButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-pressed', 'false');
            });
            
            // Ajouter la classe active au bouton cliqué
            activeButton.classList.add('active');
            activeButton.setAttribute('aria-pressed', 'true');
        }
        
        async fetchContent(filterValue) {
            // Afficher l'état de chargement
            this.contentContainer.classList.add(this.loadingClass);
            this.contentContainer.setAttribute('aria-busy', 'true');
            
            try {
                const formData = new FormData();
                formData.append('action', this.ajaxAction);
                formData.append('type', filterValue);
                formData.append('nonce', acAjax.nonce);
                
                const response = await fetch(acAjax.ajaxUrl, {
                    method: 'POST',
                    body: formData,
                    credentials: 'same-origin'
                });
                
                if (!response.ok) {
                    throw new Error('La réponse réseau n\'est pas correcte');
                }
                
                const data = await response.json();
                
                if (data.success) {
                    // Afficher le contenu filtré
                    this.renderContent(data.data.html);
                } else {
                    // Afficher un message d'erreur
                    this.showError(data.data?.message || 'Une erreur est survenue.');
                }
            } catch (error) {
                console.error('Filter error:', error);
                this.showError('Impossible de charger le contenu. Veuillez réessayer.');
            } finally {
                this.contentContainer.classList.remove(this.loadingClass);
                this.contentContainer.setAttribute('aria-busy', 'false');
            }
        }
        
        renderContent(html) {
            // Animation de fondu sortant
            this.contentContainer.style.opacity = '0';
            
            setTimeout(() => {
                // Remplacer le contenu
                this.contentContainer.innerHTML = html;
                
                // Animation de fondu entrant
                this.contentContainer.style.opacity = '1';
                
                // Annoncer la mise à jour aux lecteurs d'écran
                this.announceUpdate();
            }, 200);
        }
        
        showError(message) {
            this.contentContainer.innerHTML = `
                <div class="filter-error" role="alert">
                    <p>${message}</p>
                </div>
            `;
        }
        
        updateURL(filterValue) {
            // Mettre à jour l'URL dans la barre d'adresse sans recharger
            const url = new URL(window.location);
            
            if (filterValue === 'tous' || filterValue === 'toutes') {
                // Supprimer le paramètre si "tous" est sélectionné
                url.searchParams.delete('type');
            } else {
                // Ajouter/modifier le paramètre de filtre
                url.searchParams.set('type', filterValue);
            }
            
            // Mettre à jour l'historique du navigateur
            window.history.pushState({}, '', url);
        }
        
        announceUpdate() {
            // Créer une région live pour les lecteurs d'écran (accessibilité)
            let liveRegion = document.getElementById('filter-live-region');
            
            if (!liveRegion) {
                liveRegion = document.createElement('div');
                liveRegion.id = 'filter-live-region';
                liveRegion.setAttribute('aria-live', 'polite');
                liveRegion.setAttribute('aria-atomic', 'true');
                liveRegion.className = 'sr-only';
                document.body.appendChild(liveRegion);
            }
            
            const itemCount = this.contentContainer.querySelectorAll('.realisation-item, .matiere-item').length;
            liveRegion.textContent = `${itemCount} élément${itemCount > 1 ? 's' : ''} affiché${itemCount > 1 ? 's' : ''}.`;
        }
    }
    
    /**
     * Initialiser les filtres selon la page
     * Détecte automatiquement le type de page et initialise le bon filtre
     */
    function initFilters() {
        // Vérifier si on est sur la page des matières
        if (document.body.classList.contains('page-template-template-matieres') || 
            document.body.classList.contains('post-type-archive-matiere')) {
            new FilterController({
                filterBarSelector: '.filter-bar',
                contentSelector: '.matieres-list',
                ajaxAction: 'filter_matieres'
            });
        }
    }
    
    /**
     * Gérer les boutons précédent/suivant du navigateur
     * Permet de naviguer dans l'historique des filtres
     */
    function handlePopState() {
        window.addEventListener('popstate', function() {
            const url = new URL(window.location);
            const filterValue = url.searchParams.get('type') || 'tous';
            
            const activeButton = document.querySelector(`.filter-btn[data-filter="${filterValue}"]`);
            if (activeButton) {
                activeButton.click();
            }
        });
    }
    
    /**
     * Initialiser quand le DOM est prêt
     */
    if (typeof AC !== 'undefined' && AC.domReady) {
        AC.domReady(function() {
            initFilters();
            handlePopState();
        });
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            initFilters();
            handlePopState();
        });
    }
})();
