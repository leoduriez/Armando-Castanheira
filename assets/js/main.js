/**
 * JavaScript principal - Vanilla JS uniquement
 * 
 * Ce fichier contient toutes les fonctionnalités JavaScript principales du thème :
 * - Bouton retour en haut
 * - Menu mobile
 * - Scroll smooth pour les ancres
 * - Lazy loading des images
 * - Animations au scroll
 * - Navigation active
 * - Accordéons du footer
 * - Popup vidéo
 * 
 * Aucune dépendance - 100% Vanilla JavaScript
 * 
 * @package Armando_Castanheira
 */

'use strict';

/**
 * Fonction DOM Ready
 * Exécute le callback quand le DOM est prêt
 */
function domReady(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback);
    } else {
        callback();
    }
}

/**
 * Bouton de retour en haut de page
 * 
 * Affiche un bouton quand l'utilisateur scrolle vers le bas.
 * Cliquer dessus ramène en haut de la page avec un scroll smooth.
 */
function initScrollToTop() {
    // Créer l'élément bouton dynamiquement
    const scrollBtn = document.createElement('button');
    scrollBtn.className = 'scroll-to-top';
    scrollBtn.setAttribute('aria-label', 'Retour en haut de page');
    scrollBtn.innerHTML = `
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    `;
    document.body.appendChild(scrollBtn);
    
    let ticking = false;
    const scrollThreshold = 300; // Afficher le bouton après 300px de scroll
    
    function updateButton() {
        const scrollY = window.scrollY;
        
        if (scrollY > scrollThreshold) {
            scrollBtn.classList.add('is-visible');
        } else {
            scrollBtn.classList.remove('is-visible');
        }
        
        ticking = false;
    }
    
    // Écouteur d'événement scroll (optimisé avec requestAnimationFrame)
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateButton);
            ticking = true;
        }
    }, { passive: true });
    
    // Événement click - scroll smooth vers le haut
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Vérification initiale
    updateButton();
}

/**
 * Toggle du menu mobile avec overlay
 * 
 * Gère l'ouverture/fermeture du menu mobile avec :
 * - Overlay sombre en arrière-plan
 * - Blocage du scroll du body
 * - Fermeture avec Escape ou clic sur l'overlay
 */
function initMobileMenu() {
    const burgerCheckbox = document.getElementById('burger-toggle');
    const mainNav = document.getElementById('main-navigation');
    
    if (!burgerCheckbox || !mainNav) return;
    
    // Créer l'élément overlay s'il n'existe pas
    let overlay = document.querySelector('.menu-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'menu-overlay';
        document.body.appendChild(overlay);
    }
    
    // Fonction pour ouvrir/fermer le menu
    function toggleMenu(open) {
        const isOpen = typeof open === 'boolean' ? open : !mainNav.classList.contains('is-open');
        
        mainNav.classList.toggle('is-open', isOpen);
        burgerCheckbox.checked = isOpen;
        document.body.classList.toggle('menu-open', isOpen);
        
        // Gérer l'affichage de l'overlay
        if (isOpen) {
            overlay.classList.add('is-visible');
            document.body.style.overflow = 'hidden';
        } else {
            overlay.classList.remove('is-visible');
            document.body.style.overflow = '';
        }
    }
    
    // Événement de changement de la checkbox
    burgerCheckbox.addEventListener('change', function() {
        toggleMenu(this.checked);
    });
    
    // Clic sur l'overlay pour fermer le menu
    overlay.addEventListener('click', function() {
        toggleMenu(false);
    });
    
    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mainNav.classList.contains('is-open')) {
            toggleMenu(false);
        }
    });
    
    // Fermer le menu lors du clic sur un lien de navigation
    mainNav.querySelectorAll('.nav-menu__link').forEach(link => {
        link.addEventListener('click', function() {
            toggleMenu(false);
        });
    });
}

/**
 * Scroll smooth pour les liens ancres
 * 
 * Ajoute un comportement de scroll fluide pour tous les liens
 * qui pointent vers une ancre (#section)
 */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            
            if (target) {
                e.preventDefault();
                
                const headerHeight = document.getElementById('site-header')?.offsetHeight || 0;
                const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Mettre à jour le focus pour l'accessibilité
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            }
        });
    });
}

/**
 * Chargement différé des images avec Intersection Observer
 * 
 * Charge les images uniquement quand elles deviennent visibles.
 * Améliore les performances en réduisant le temps de chargement initial.
 */
function initLazyLoad() {
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    
                    if (img.dataset.srcset) {
                        img.srcset = img.dataset.srcset;
                    }
                    
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Solution de secours pour les navigateurs anciens
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
        });
    }
}

/**
 * Animer les éléments au scroll
 * 
 * Ajoute des animations aux éléments avec l'attribut [data-animate]
 * quand ils deviennent visibles dans le viewport.
 */
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('[data-animate]');
    
    if (!animatedElements.length) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    animatedElements.forEach(el => observer.observe(el));
}

/**
 * Lien de navigation actif
 * 
 * Ajoute la classe 'active' au lien de navigation correspondant
 * à la page actuelle.
 */
function initActiveNavLink() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.main-navigation a, .footer-navigation a');
    
    navLinks.forEach(link => {
        const linkPath = new URL(link.href).pathname;
        
        if (linkPath === currentPath || 
            (currentPath.startsWith(linkPath) && linkPath !== '/')) {
            link.classList.add('active');
            link.setAttribute('aria-current', 'page');
        }
    });
}

/**
 * Clic sur le logo - scroll vers le haut
 * 
 * Sur la page d'accueil, cliquer sur le logo scrolle vers le haut
 * au lieu de recharger la page.
 */
function initLogoScrollToTop() {
    const logos = document.querySelectorAll('.site-logo, .footer-logo');
    
    logos.forEach(logo => {
        logo.addEventListener('click', function(e) {
            // Uniquement si on est sur la page d'accueil
            const logoHref = this.getAttribute('href') || this.querySelector('a')?.getAttribute('href');
            const currentPath = window.location.pathname;
            
            // Si clic sur le logo sur la page d'accueil, scroller vers le haut au lieu de naviguer
            if (currentPath === '/' || currentPath === '/index.php' || currentPath === '') {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Accordéons du footer
 * 
 * Gère l'ouverture/fermeture des accordéons pour les mentions légales
 * et la politique de confidentialité.
 */
function initFooterAccordions() {
    const triggers = document.querySelectorAll('.footer-accordion-trigger');
    const accordions = document.querySelectorAll('.footer-accordion');
    
    triggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('data-target');
            const targetAccordion = document.getElementById(targetId);
            
            if (!targetAccordion) return;
            
            // Fermer tous les autres accordéons
            accordions.forEach(acc => {
                if (acc.id !== targetId) {
                    acc.classList.remove('active');
                }
            });
            
            // Basculer l'accordéon actuel
            targetAccordion.classList.toggle('active');
            
            // Scroller vers l'accordéon quand il s'ouvre
            if (targetAccordion.classList.contains('active')) {
                setTimeout(() => {
                    targetAccordion.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        });
    });
    
    // Boutons de fermeture
    const closeButtons = document.querySelectorAll('.footer-accordion__close');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const accordion = this.closest('.footer-accordion');
            if (accordion) {
                accordion.classList.remove('active');
            }
        });
    });
    
    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            accordions.forEach(acc => acc.classList.remove('active'));
        }
    });
}

/**
 * Accordéon des matières
 * 
 * Affiche/masque la description lors du clic sur une carte de matière.
 * Une seule carte peut être ouverte à la fois.
 */
function initMatieresAccordion() {
    const matiereCards = document.querySelectorAll('.matiere-card');
    
    if (!matiereCards.length) return;
    
    matiereCards.forEach(card => {
        const header = card.querySelector('.matiere-card__header');
        
        if (!header) return;
        
        header.addEventListener('click', function() {
            // Fermer toutes les autres cartes
            matiereCards.forEach(otherCard => {
                if (otherCard !== card && otherCard.classList.contains('is-open')) {
                    otherCard.classList.remove('is-open');
                    const otherHeader = otherCard.querySelector('.matiere-card__header');
                    if (otherHeader) {
                        otherHeader.setAttribute('aria-expanded', 'false');
                    }
                }
            });
            
            // Basculer la carte actuelle
            const isOpen = card.classList.toggle('is-open');
            header.setAttribute('aria-expanded', isOpen);
        });
        
        // Accessibilité clavier (Enter et Espace)
        header.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                header.click();
            }
        });
    });
}

/**
 * Popup vidéo du hero
 * 
 * Ouvre une vidéo dans une modal lors du clic sur le bouton play.
 * Supporte YouTube et Vimeo avec autoplay.
 */
function initHeroVideoPopup() {
    const playBtn = document.getElementById('hero-play-btn');
    
    if (!playBtn) return;
    
    // Récupérer l'URL de la vidéo depuis l'attribut data ou le customizer
    const videoUrl = playBtn.dataset.videoUrl || (typeof acAjax !== 'undefined' ? acAjax.heroVideoUrl : '');
    
    if (!videoUrl) return;
    
    playBtn.addEventListener('click', function() {
        // Créer la modal dynamiquement
        const modal = document.createElement('div');
        modal.className = 'video-modal';
        modal.innerHTML = `
            <div class="video-modal__overlay"></div>
            <div class="video-modal__content">
                <button class="video-modal__close" aria-label="Fermer la vidéo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="video-modal__wrapper">
                    <iframe 
                        src="${getEmbedUrl(videoUrl)}" 
                        frameborder="0" 
                        allow="autoplay; fullscreen; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
        
        // Ajouter la classe show après un court délai pour l'animation
        setTimeout(() => modal.classList.add('is-visible'), 10);
        
        // Fonction pour fermer la modal
        function closeModal() {
            modal.classList.remove('is-visible');
            setTimeout(() => {
                document.body.removeChild(modal);
                document.body.style.overflow = '';
            }, 300);
        }
        
        // Fermer au clic sur l'overlay
        modal.querySelector('.video-modal__overlay').addEventListener('click', closeModal);
        
        // Fermer au clic sur le bouton
        modal.querySelector('.video-modal__close').addEventListener('click', closeModal);
        
        // Fermer avec la touche Escape
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') {
                closeModal();
                document.removeEventListener('keydown', escHandler);
            }
        });
    });
    
    // Fonction helper pour convertir les URLs YouTube/Vimeo en URLs embed
    function getEmbedUrl(url) {
        // Gestion des URLs YouTube
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return videoId ? `https://www.youtube.com/embed/${videoId[1]}?autoplay=1` : url;
        }
        
        // Gestion des URLs Vimeo
        if (url.includes('vimeo.com')) {
            const videoId = url.match(/vimeo\.com\/(\d+)/);
            return videoId ? `https://player.vimeo.com/video/${videoId[1]}?autoplay=1` : url;
        }
        
        return url;
    }
}

/**
 * Initialiser toutes les fonctions au chargement du DOM
 */
domReady(function() {
    initScrollToTop();
    initMobileMenu();
    initSmoothScroll();
    initLazyLoad();
    initScrollAnimations();
    initActiveNavLink();
    initLogoScrollToTop();
    initFooterAccordions();
    initMatieresAccordion();
    initHeroVideoPopup();
});

/**
 * Exporter pour utilisation dans d'autres modules
 */
window.AC = {
    domReady: domReady
};
