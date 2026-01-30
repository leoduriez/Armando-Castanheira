/**
 * Filter Module - Vanilla JS
 * Handles AJAX filtering for Réalisations and Matières
 * 
 * @package Armando_Castanheira
 */

'use strict';

(function() {
    /**
     * Filter Controller
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
            this.bindEvents();
        }
        
        bindEvents() {
            const filterButtons = this.filterBar.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', (e) => this.handleFilter(e));
            });
        }
        
        handleFilter(e) {
            const button = e.currentTarget;
            const filterValue = button.dataset.filter;
            
            // Update active state
            this.updateActiveButton(button);
            
            // Fetch filtered content
            this.fetchContent(filterValue);
            
            // Update URL without reload (for bookmarking)
            this.updateURL(filterValue);
        }
        
        updateActiveButton(activeButton) {
            const allButtons = this.filterBar.querySelectorAll('.filter-btn');
            
            allButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-pressed', 'false');
            });
            
            activeButton.classList.add('active');
            activeButton.setAttribute('aria-pressed', 'true');
        }
        
        async fetchContent(filterValue) {
            // Show loading state
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
                    throw new Error('Network response was not ok');
                }
                
                const data = await response.json();
                
                if (data.success) {
                    this.renderContent(data.data.html);
                } else {
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
            // Fade out
            this.contentContainer.style.opacity = '0';
            
            setTimeout(() => {
                this.contentContainer.innerHTML = html;
                
                // Fade in
                this.contentContainer.style.opacity = '1';
                
                // Announce to screen readers
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
            const url = new URL(window.location);
            
            if (filterValue === 'tous' || filterValue === 'toutes') {
                url.searchParams.delete('type');
            } else {
                url.searchParams.set('type', filterValue);
            }
            
            window.history.pushState({}, '', url);
        }
        
        announceUpdate() {
            // Create live region for screen readers
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
     * Initialize filters based on page
     */
    function initFilters() {
        // Check if we're on matières page
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
     * Handle browser back/forward
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
     * Initialize on DOM ready
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
