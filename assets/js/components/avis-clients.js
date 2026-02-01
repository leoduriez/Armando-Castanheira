/**
 * ========================================
 * SECTION AVIS CLIENTS - JAVASCRIPT
 * ========================================
 * Gestion du carousel et du formulaire d'avis clients
 * @version 1.0.0
 */

(function() {
    'use strict';

    // Configuration
    const CONFIG = {
        storageKey: 'avis_clients_data',
        maxAvis: 50,
        animationDuration: 500
    };

    // État de l'application
    let currentSlide = 0;
    let avisData = [];
    let selectedRating = 0;

    /**
     * Initialisation au chargement du DOM
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAvisSection);
    } else {
        initAvisSection();
    }

    /**
     * Fonction principale d'initialisation
     */
    function initAvisSection() {
        loadAvisFromStorage();
        initCarousel();
        initForm();
        initRatingSystem();
        console.log('Section Avis Clients initialisée');
    }

    /**
     * ========================================
     * GESTION DU CAROUSEL
     * ========================================
     */

    function initCarousel() {
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => navigateCarousel('prev'));
            nextBtn.addEventListener('click', () => navigateCarousel('next'));
        }

        initSwipeSupport();
        updateCarousel();
        createIndicators();
    }

    function navigateCarousel(direction) {
        const totalSlides = avisData.length;
        
        if (totalSlides === 0) return;

        if (direction === 'prev') {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        } else {
            currentSlide = (currentSlide + 1) % totalSlides;
        }

        updateCarousel();
    }

    function updateCarousel() {
        const track = document.querySelector('.carousel-track');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');

        if (!track) return;

        renderAvis();
        track.style.transform = `translateX(-${currentSlide * 100}%)`;

        const totalSlides = avisData.length;
        if (prevBtn && nextBtn) {
            prevBtn.disabled = totalSlides <= 1;
            nextBtn.disabled = totalSlides <= 1;
        }

        updateIndicators();
    }

    function renderAvis() {
        const track = document.querySelector('.carousel-track');
        if (!track) return;

        track.innerHTML = '';

        if (avisData.length === 0) {
            track.innerHTML = `
                <div class="avis-card">
                    <div class="avis-header">
                        <div class="avis-avatar">?</div>
                        <div class="avis-info">
                            <h3 class="avis-prenom">Aucun avis</h3>
                            <div class="avis-stars">
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                                <span class="star">★</span>
                            </div>
                        </div>
                    </div>
                    <p class="avis-commentaire">Soyez le premier à partager votre expérience !</p>
                </div>
            `;
            return;
        }

        avisData.forEach(avis => {
            const card = createAvisCard(avis);
            track.appendChild(card);
        });
    }

    function createAvisCard(avis) {
        const card = document.createElement('div');
        card.className = 'avis-card';

        const initial = avis.prenom.charAt(0).toUpperCase();
        const starsHTML = generateStarsHTML(avis.rating);

        card.innerHTML = `
            <div class="avis-header">
                <div class="avis-avatar">${initial}</div>
                <div class="avis-info">
                    <h3 class="avis-prenom">${escapeHTML(avis.prenom)}</h3>
                    <div class="avis-stars">
                        ${starsHTML}
                    </div>
                </div>
            </div>
            <p class="avis-commentaire">${escapeHTML(avis.commentaire)}</p>
        `;

        return card;
    }

    function generateStarsHTML(rating) {
        let html = '';
        for (let i = 1; i <= 5; i++) {
            html += `<span class="star ${i <= rating ? 'filled' : ''}">★</span>`;
        }
        return html;
    }

    function createIndicators() {
        const container = document.querySelector('.carousel-indicators');
        if (!container) return;

        container.innerHTML = '';

        if (avisData.length <= 1) return;

        avisData.forEach((_, index) => {
            const indicator = document.createElement('button');
            indicator.className = 'carousel-indicator';
            indicator.setAttribute('aria-label', `Aller à l'avis ${index + 1}`);
            indicator.addEventListener('click', () => goToSlide(index));
            container.appendChild(indicator);
        });

        updateIndicators();
    }

    function updateIndicators() {
        const indicators = document.querySelectorAll('.carousel-indicator');
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }

    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }

    function initSwipeSupport() {
        const carousel = document.querySelector('.avis-carousel');
        if (!carousel) return;

        let touchStartX = 0;
        let touchEndX = 0;

        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    navigateCarousel('next');
                } else {
                    navigateCarousel('prev');
                }
            }
        }
    }

    /**
     * ========================================
     * GESTION DU FORMULAIRE
     * ========================================
     */

    function initForm() {
        const form = document.getElementById('avis-form');
        const commentaireField = document.getElementById('commentaire');
        const charCount = document.querySelector('.char-count');

        if (!form) return;

        if (commentaireField && charCount) {
            commentaireField.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = `${count}/500`;
                
                if (count > 450) {
                    charCount.style.color = '#ef4444';
                } else {
                    charCount.style.color = '#6b7280';
                }
            });
        }

        form.addEventListener('submit', handleFormSubmit);
    }

    function handleFormSubmit(e) {
        e.preventDefault();

        const form = e.target;
        const prenom = document.getElementById('prenom').value.trim();
        const commentaire = document.getElementById('commentaire').value.trim();
        const rating = selectedRating;

        if (!prenom || !commentaire || rating === 0) {
            showMessage('Veuillez remplir tous les champs et sélectionner une note.', 'error');
            return;
        }

        toggleSubmitButton(true);

        setTimeout(() => {
            const nouvelAvis = {
                id: Date.now(),
                prenom: prenom,
                commentaire: commentaire,
                rating: rating,
                date: new Date().toISOString()
            };

            addAvis(nouvelAvis);

            form.reset();
            resetRating();
            document.querySelector('.char-count').textContent = '0/500';

            showMessage('Merci pour votre avis ! Il a été ajouté avec succès.', 'success');

            toggleSubmitButton(false);

            setTimeout(() => {
                document.querySelector('.avis-carousel-wrapper').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
            }, 500);
        }, 1000);
    }

    function toggleSubmitButton(loading) {
        const btn = document.querySelector('.submit-btn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        if (loading) {
            btn.disabled = true;
            btnText.style.display = 'none';
            btnLoader.style.display = 'inline-block';
        } else {
            btn.disabled = false;
            btnText.style.display = 'inline';
            btnLoader.style.display = 'none';
        }
    }

    function showMessage(text, type) {
        const messageEl = document.querySelector('.form-message');
        if (!messageEl) return;

        messageEl.textContent = text;
        messageEl.className = `form-message ${type}`;

        setTimeout(() => {
            messageEl.className = 'form-message';
        }, 5000);
    }

    /**
     * ========================================
     * SYSTÈME DE NOTATION PAR ÉTOILES
     * ========================================
     */

    function initRatingSystem() {
        const stars = document.querySelectorAll('.rating-star');
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                updateRatingDisplay();
            });

            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.dataset.rating);
                highlightStars(rating);
            });
        });

        const ratingContainer = document.querySelector('.rating-input');
        if (ratingContainer) {
            ratingContainer.addEventListener('mouseleave', function() {
                updateRatingDisplay();
            });
        }
    }

    function updateRatingDisplay() {
        const stars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            if (index < selectedRating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });

        if (ratingInput) {
            ratingInput.value = selectedRating;
        }
    }

    function highlightStars(rating) {
        const stars = document.querySelectorAll('.rating-star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.style.color = '#A69586';
            } else {
                star.style.color = '#d1d5db';
            }
        });
    }

    function resetRating() {
        selectedRating = 0;
        updateRatingDisplay();
    }

    /**
     * ========================================
     * GESTION DU STOCKAGE LOCAL
     * ========================================
     */

    function loadAvisFromStorage() {
        try {
            const stored = localStorage.getItem(CONFIG.storageKey);
            if (stored) {
                avisData = JSON.parse(stored);
            } else {
                avisData = [
                    {
                        id: 1,
                        prenom: 'Marie',
                        commentaire: 'Excellent service ! Je recommande vivement. L\'équipe est très professionnelle et à l\'écoute.',
                        rating: 5,
                        date: new Date().toISOString()
                    }
                ];
                saveAvisToStorage();
            }
        } catch (error) {
            console.error('Erreur lors du chargement des avis:', error);
            avisData = [];
        }
    }

    function saveAvisToStorage() {
        try {
            if (avisData.length > CONFIG.maxAvis) {
                avisData = avisData.slice(-CONFIG.maxAvis);
            }
            localStorage.setItem(CONFIG.storageKey, JSON.stringify(avisData));
        } catch (error) {
            console.error('Erreur lors de la sauvegarde des avis:', error);
        }
    }

    function addAvis(avis) {
        avisData.unshift(avis);
        saveAvisToStorage();
        currentSlide = 0;
        updateCarousel();
        createIndicators();
    }

    function escapeHTML(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    /**
     * ========================================
     * API PUBLIQUE
     * ========================================
     */

    window.AvisClientsAPI = {
        getAvis: function() {
            return [...avisData];
        },
        addAvis: function(prenom, commentaire, rating) {
            if (!prenom || !commentaire || !rating) {
                console.error('Paramètres manquants');
                return false;
            }
            const nouvelAvis = {
                id: Date.now(),
                prenom: prenom,
                commentaire: commentaire,
                rating: parseInt(rating),
                date: new Date().toISOString()
            };
            addAvis(nouvelAvis);
            return true;
        },
        loadAvis: function(avisArray) {
            if (!Array.isArray(avisArray)) {
                console.error('Le paramètre doit être un tableau');
                return false;
            }
            avisData = avisArray;
            saveAvisToStorage();
            currentSlide = 0;
            updateCarousel();
            createIndicators();
            return true;
        },
        clearAvis: function() {
            if (confirm('Êtes-vous sûr de vouloir effacer tous les avis ?')) {
                avisData = [];
                saveAvisToStorage();
                currentSlide = 0;
                updateCarousel();
                createIndicators();
                return true;
            }
            return false;
        }
    };

})();
