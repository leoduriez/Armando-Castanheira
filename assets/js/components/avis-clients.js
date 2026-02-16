/**
 * ========================================
 * SECTION AVIS CLIENTS - JAVASCRIPT
 * ========================================
 * 
 * Gestion complète de la section avis clients :
 * - Carousel d'avis avec navigation et swipe mobile
 * - Formulaire d'ajout d'avis avec validation
 * - Système de notation par étoiles
 * - Sauvegarde en base de données via AJAX
 * - Indicateurs de pagination
 * 
 * @package Armando_Castanheira
 * @version 1.0.0
 */

(function() {
    'use strict';

    // Configuration globale de l'application
    const CONFIG = {
        maxAvis: 50,
        animationDuration: 500,
        ajaxUrl: window.acAjax?.ajaxurl || '/wp-admin/admin-ajax.php',
        nonce: window.acAjax?.nonce || ''
    };

    // Variables d'état globales
    let currentSlide = 0;
    let avisData = [];
    let selectedRating = 0;

    /**
     * Initialisation au chargement du DOM
     * Lance l'initialisation dès que le DOM est prêt
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAvisSection);
    } else {
        initAvisSection();
    }

    /**
     * Fonction principale d'initialisation
     * Initialise tous les composants de la section avis clients
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
     * GESTION DU CAROUSEL D'AVIS
     * Carousel responsive avec navigation par boutons, indicateurs et swipe
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
        
        // Ne rien faire s'il n'y a pas d'avis
        if (totalSlides === 0) return;

        // Navigation circulaire (revient au début/fin)
        if (direction === 'prev') {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        } else {
            currentSlide = (currentSlide + 1) % totalSlides;
        }

        updateCarousel();
    }

    function updateCarousel() {
        // Mettre à jour l'affichage du carousel
        const track = document.querySelector('.carousel-track');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');

        if (!track) return;

        // Afficher les avis et déplacer le carousel
        renderAvis();
        track.style.transform = `translateX(-${currentSlide * 100}%)`;

        // Désactiver les boutons s'il n'y a qu'un seul avis
        const totalSlides = avisData.length;
        if (prevBtn && nextBtn) {
            prevBtn.disabled = totalSlides <= 1;
            nextBtn.disabled = totalSlides <= 1;
        }

        updateIndicators();
    }

    function renderAvis() {
        // Générer le HTML de tous les avis
        const track = document.querySelector('.carousel-track');
        if (!track) return;

        // Vider le contenu existant
        track.innerHTML = '';

        // Afficher un message si aucun avis
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

        // Créer et ajouter une carte pour chaque avis
        avisData.forEach(avis => {
            const card = createAvisCard(avis);
            track.appendChild(card);
        });
    }

    function createAvisCard(avis) {
        // Créer une carte d'avis avec avatar, nom, étoiles et commentaire
        const card = document.createElement('div');
        card.className = 'avis-card';

        // Générer l'initiale pour l'avatar
        const initial = avis.prenom.charAt(0).toUpperCase();
        // Générer les étoiles selon la note
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
        // Générer le HTML des 5 étoiles (remplies ou vides)
        let html = '';
        for (let i = 1; i <= 5; i++) {
            html += `<span class="star ${i <= rating ? 'filled' : ''}">★</span>`;
        }
        return html;
    }

    function createIndicators() {
        // Créer les indicateurs de pagination (points)
        const container = document.querySelector('.carousel-indicators');
        if (!container) return;

        container.innerHTML = '';

        // Ne pas afficher d'indicateurs s'il n'y a qu'un seul avis
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
        // Activer la navigation par swipe sur mobile
        const carousel = document.querySelector('.avis-carousel');
        if (!carousel) return;

        // Variables pour détecter le swipe
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
            // Déterminer la direction du swipe
            const swipeThreshold = 50; // Seuil minimum de 50px
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swipe vers la gauche = suivant
                    navigateCarousel('next');
                } else {
                    // Swipe vers la droite = précédent
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

        // Envoyer l'avis à la base de données
        saveAvisToDatabase(prenom, commentaire, rating, (response) => {
            toggleSubmitButton(false);

            if (response.success) {
                form.reset();
                resetRating();
                document.querySelector('.char-count').textContent = '0/500';

                showMessage(response.data.message || 'Merci pour votre avis !', 'success');

                // Recharger les avis depuis la base de données
                loadAvisFromStorage();

                setTimeout(() => {
                    document.querySelector('.avis-carousel-wrapper').scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }, 500);
            } else {
                showMessage(response.data.message || 'Une erreur est survenue.', 'error');
            }
        });
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
        // Charger les avis depuis la base de données via AJAX
        fetch(CONFIG.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'get_avis_clients',
                nonce: CONFIG.nonce,
                limit: CONFIG.maxAvis
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.avis) {
                avisData = data.data.avis.map(avis => ({
                    id: avis.id,
                    prenom: avis.prenom,
                    commentaire: avis.commentaire,
                    rating: parseInt(avis.rating),
                    date: avis.date_creation
                }));
            } else {
                avisData = [];
            }
            updateCarousel();
            createIndicators();
        })
        .catch(error => {
            console.error('Erreur lors du chargement des avis:', error);
            avisData = [];
            updateCarousel();
            createIndicators();
        });
    }

    function saveAvisToDatabase(prenom, commentaire, rating, callback) {
        // Sauvegarder l'avis dans la base de données via AJAX
        fetch(CONFIG.ajaxUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'add_avis_client',
                nonce: CONFIG.nonce,
                prenom: prenom,
                commentaire: commentaire,
                rating: rating
            })
        })
        .then(response => response.json())
        .then(data => {
            if (callback) {
                callback(data);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la sauvegarde de l\'avis:', error);
            if (callback) {
                callback({ success: false, data: { message: 'Erreur réseau' } });
            }
        });
    }

    function addAvis(avis) {
        avisData.unshift(avis);
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
        addAvis: function(prenom, commentaire, rating, callback) {
            if (!prenom || !commentaire || !rating) {
                console.error('Paramètres manquants');
                return false;
            }
            saveAvisToDatabase(prenom, commentaire, rating, (response) => {
                if (response.success) {
                    loadAvisFromStorage();
                }
                if (callback) callback(response);
            });
            return true;
        },
        loadAvis: function() {
            loadAvisFromStorage();
            return true;
        },
        clearAvis: function() {
            console.warn('La suppression des avis doit se faire depuis l\'administration WordPress.');
            return false;
        }
    };

})();
