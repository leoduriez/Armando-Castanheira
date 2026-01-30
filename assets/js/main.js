/**
 * Main JavaScript - Vanilla JS Only
 * 
 * @package Armando_Castanheira
 */

'use strict';

/**
 * DOM Ready function
 */
function domReady(callback) {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback);
    } else {
        callback();
    }
}

/**
 * Scroll to Top Button
 * Shows a button when user scrolls down, clicking it scrolls back to top
 */
function initScrollToTop() {
    // Create the button element
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
    const scrollThreshold = 300; // Show button after 300px scroll
    
    function updateButton() {
        const scrollY = window.scrollY;
        
        if (scrollY > scrollThreshold) {
            scrollBtn.classList.add('is-visible');
        } else {
            scrollBtn.classList.remove('is-visible');
        }
        
        ticking = false;
    }
    
    // Scroll event listener
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(updateButton);
            ticking = true;
        }
    }, { passive: true });
    
    // Click event - smooth scroll to top
    scrollBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Initial check
    updateButton();
}

/**
 * Mobile menu toggle with overlay
 */
function initMobileMenu() {
    const burgerCheckbox = document.getElementById('burger-toggle');
    const mainNav = document.getElementById('main-navigation');
    
    if (!burgerCheckbox || !mainNav) return;
    
    // Create overlay element
    let overlay = document.querySelector('.menu-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'menu-overlay';
        document.body.appendChild(overlay);
    }
    
    // Toggle menu function
    function toggleMenu(open) {
        const isOpen = typeof open === 'boolean' ? open : !mainNav.classList.contains('is-open');
        
        mainNav.classList.toggle('is-open', isOpen);
        burgerCheckbox.checked = isOpen;
        document.body.classList.toggle('menu-open', isOpen);
        
        // Handle overlay
        if (isOpen) {
            overlay.classList.add('is-visible');
            document.body.style.overflow = 'hidden';
        } else {
            overlay.classList.remove('is-visible');
            document.body.style.overflow = '';
        }
    }
    
    // Checkbox change event
    burgerCheckbox.addEventListener('change', function() {
        toggleMenu(this.checked);
    });
    
    // Click on overlay to close
    overlay.addEventListener('click', function() {
        toggleMenu(false);
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mainNav.classList.contains('is-open')) {
            toggleMenu(false);
        }
    });
    
    // Close menu when clicking a nav link
    mainNav.querySelectorAll('.nav-menu__link').forEach(link => {
        link.addEventListener('click', function() {
            toggleMenu(false);
        });
    });
}

/**
 * Smooth scroll for anchor links
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
                
                // Update focus for accessibility
                target.setAttribute('tabindex', '-1');
                target.focus({ preventScroll: true });
            }
        });
    });
}

/**
 * Lazy loading images with Intersection Observer
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
        // Fallback for older browsers
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
        });
    }
}

/**
 * Animate elements on scroll
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
 * Active navigation link
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
 * Logo click - smooth scroll to top
 */
function initLogoScrollToTop() {
    const logos = document.querySelectorAll('.site-logo, .footer-logo');
    
    logos.forEach(logo => {
        logo.addEventListener('click', function(e) {
            // Only if we're on the homepage
            const logoHref = this.getAttribute('href') || this.querySelector('a')?.getAttribute('href');
            const currentPath = window.location.pathname;
            
            // If clicking logo on homepage, scroll to top instead of navigating
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
 * Footer Accordions
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
            
            // Close all other accordions
            accordions.forEach(acc => {
                if (acc.id !== targetId) {
                    acc.classList.remove('active');
                }
            });
            
            // Toggle current accordion
            targetAccordion.classList.toggle('active');
            
            // Scroll to accordion when opened
            if (targetAccordion.classList.contains('active')) {
                setTimeout(() => {
                    targetAccordion.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, 100);
            }
        });
    });
    
    // Close buttons
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
 * Matières Accordion
 * Toggle description when clicking on matiere card
 */
function initMatieresAccordion() {
    const matiereCards = document.querySelectorAll('.matiere-card');
    
    if (!matiereCards.length) return;
    
    matiereCards.forEach(card => {
        const header = card.querySelector('.matiere-card__header');
        
        if (!header) return;
        
        header.addEventListener('click', function() {
            // Close all other cards
            matiereCards.forEach(otherCard => {
                if (otherCard !== card && otherCard.classList.contains('is-open')) {
                    otherCard.classList.remove('is-open');
                    const otherHeader = otherCard.querySelector('.matiere-card__header');
                    if (otherHeader) {
                        otherHeader.setAttribute('aria-expanded', 'false');
                    }
                }
            });
            
            // Toggle current card
            const isOpen = card.classList.toggle('is-open');
            header.setAttribute('aria-expanded', isOpen);
        });
        
        // Keyboard accessibility
        header.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                header.click();
            }
        });
    });
}

/**
 * Hero Video Popup
 * Opens a video in a modal when clicking the play button
 */
function initHeroVideoPopup() {
    const playBtn = document.getElementById('hero-play-btn');
    
    if (!playBtn) return;
    
    // Get video URL from data attribute or customizer
    const videoUrl = playBtn.dataset.videoUrl || (typeof acAjax !== 'undefined' ? acAjax.heroVideoUrl : '');
    
    if (!videoUrl) return;
    
    playBtn.addEventListener('click', function() {
        // Create modal
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
        
        // Add show class after a small delay for animation
        setTimeout(() => modal.classList.add('is-visible'), 10);
        
        // Close modal function
        function closeModal() {
            modal.classList.remove('is-visible');
            setTimeout(() => {
                document.body.removeChild(modal);
                document.body.style.overflow = '';
            }, 300);
        }
        
        // Close on overlay click
        modal.querySelector('.video-modal__overlay').addEventListener('click', closeModal);
        
        // Close on button click
        modal.querySelector('.video-modal__close').addEventListener('click', closeModal);
        
        // Close on escape key
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') {
                closeModal();
                document.removeEventListener('keydown', escHandler);
            }
        });
    });
    
    // Helper function to convert YouTube/Vimeo URLs to embed URLs
    function getEmbedUrl(url) {
        // YouTube
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            const videoId = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
            return videoId ? `https://www.youtube.com/embed/${videoId[1]}?autoplay=1` : url;
        }
        
        // Vimeo
        if (url.includes('vimeo.com')) {
            const videoId = url.match(/vimeo\.com\/(\d+)/);
            return videoId ? `https://player.vimeo.com/video/${videoId[1]}?autoplay=1` : url;
        }
        
        return url;
    }
}

/**
 * Initialize all functions
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
 * Export for use in other modules
 */
window.AC = {
    domReady: domReady
};
