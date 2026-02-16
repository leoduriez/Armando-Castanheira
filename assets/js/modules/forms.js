/**
 * Module de formulaires - Vanilla JS
 * 
 * Gère la validation et la soumission des formulaires.
 * Inclut la validation en temps réel, l'accessibilité et l'envoi AJAX.
 * 
 * Fonctionnalités :
 * - Validation des champs (email, téléphone, longueur)
 * - Messages d'erreur accessibles
 * - Soumission AJAX
 * - Popups de confirmation
 * 
 * @package Armando_Castanheira
 */

'use strict';

(function() {
    /**
     * Validateur de formulaire
     * Classe principale pour la validation et la soumission des formulaires
     */
    class FormValidator {
        constructor(form) {
            this.form = form;
            this.fields = form.querySelectorAll('input, textarea, select');
            this.submitButton = form.querySelector('[type="submit"]');
            
            this.init();
        }
        
        init() {
            // Initialiser les événements et l'accessibilité
            this.bindEvents();
            this.setupAccessibility();
        }
        
        bindEvents() {
            // Validation en temps réel lors de la perte de focus
            this.fields.forEach(field => {
                field.addEventListener('blur', () => this.validateField(field));
                field.addEventListener('input', () => this.clearError(field));
            });
            
            // Soumission du formulaire
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
        
        setupAccessibility() {
            this.fields.forEach(field => {
                // S'assurer que tous les champs ont des labels associés
                const label = this.form.querySelector(`label[for="${field.id}"]`);
                if (!label && field.id) {
                    console.warn(`Field ${field.id} is missing an associated label`);
                }
            });
        }
        
        validateField(field) {
            const value = field.value.trim();
            const type = field.type;
            const required = field.hasAttribute('required');
            
            // Effacer les erreurs précédentes
            this.clearError(field);
            
            // Vérification des champs obligatoires
            if (required && !value) {
                this.showError(field, 'Ce champ est requis.');
                return false;
            }
            
            // Validation de l'email
            if (type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    this.showError(field, 'Veuillez entrer une adresse email valide.');
                    return false;
                }
            }
            
            // Validation du numéro de téléphone
            if (type === 'tel' && value) {
                const phoneRegex = /^[\d\s\+\-\.\(\)]{10,}$/;
                if (!phoneRegex.test(value)) {
                    this.showError(field, 'Veuillez entrer un numéro de téléphone valide.');
                    return false;
                }
            }
            
            // Longueur minimale
            const minLength = field.getAttribute('minlength');
            if (minLength && value.length < parseInt(minLength)) {
                this.showError(field, `Minimum ${minLength} caractères requis.`);
                return false;
            }
            
            return true;
        }
        
        validateAll() {
            // Valider tous les champs du formulaire
            let isValid = true;
            
            this.fields.forEach(field => {
                if (!this.validateField(field)) {
                    isValid = false;
                }
            });
            
            return isValid;
        }
        
        showError(field, message) {
            // Marquer le champ comme invalide
            field.classList.add('has-error');
            field.setAttribute('aria-invalid', 'true');
            
            // Créer le message d'erreur
            const errorId = `${field.id}-error`;
            let errorElement = document.getElementById(errorId);
            
            if (!errorElement) {
                errorElement = document.createElement('span');
                errorElement.id = errorId;
                errorElement.className = 'field-error';
                errorElement.setAttribute('role', 'alert');
                field.parentNode.appendChild(errorElement);
            }
            
            errorElement.textContent = message;
            field.setAttribute('aria-describedby', errorId);
        }
        
        clearError(field) {
            // Retirer les marqueurs d'erreur
            field.classList.remove('has-error');
            field.removeAttribute('aria-invalid');
            
            const errorId = `${field.id}-error`;
            const errorElement = document.getElementById(errorId);
            
            if (errorElement) {
                errorElement.remove();
            }
            
            field.removeAttribute('aria-describedby');
        }
        
        async handleSubmit(e) {
            e.preventDefault();
            
            if (!this.validateAll()) {
                // Mettre le focus sur le premier champ en erreur
                const firstError = this.form.querySelector('.has-error');
                if (firstError) {
                    firstError.focus();
                }
                return;
            }
            
            // Désactiver le bouton de soumission pendant l'envoi
            this.submitButton.disabled = true;
            this.submitButton.classList.add('is-loading');
            
            try {
                // Vérifier si AJAX est disponible
                if (typeof acAjax !== 'undefined' && acAjax.ajaxUrl) {
                    const formData = new FormData(this.form);
                    formData.append('action', this.form.dataset.action || 'submit_contact_form');
                    formData.append('nonce', acAjax.nonce);
                    
                    const response = await fetch(acAjax.ajaxUrl, {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin'
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Succès : afficher le message et réinitialiser le formulaire
                        this.showSuccess(data.data?.message || 'Votre message a été envoyé avec succès.');
                        this.form.reset();
                    } else {
                        // Erreur : afficher le message d'erreur
                        this.showFormError(data.data?.message || 'Une erreur est survenue. Veuillez réessayer.');
                    }
                } else {
                    // Solution de secours : afficher directement la popup de succès (pour démo/test)
                    // En production, vous devez configurer le gestionnaire AJAX
                    await this.simulateSubmit();
                    this.showSuccess('Votre message a été envoyé avec succès.');
                    this.form.reset();
                }
            } catch (error) {
                console.error('Form submission error:', error);
                this.showFormError('Impossible d\'envoyer le formulaire. Veuillez réessayer.');
            } finally {
                this.submitButton.disabled = false;
                this.submitButton.classList.remove('is-loading');
            }
        }
        
        // Simuler un délai de soumission du formulaire
        simulateSubmit() {
            return new Promise(resolve => setTimeout(resolve, 800));
        }
        
        showSuccess(message) {
            // Déterminer quelle popup afficher selon le type de formulaire
            const formType = this.form.querySelector('input[name="form_type"]');
            const popupId = formType && formType.value === 'devis' ? 'popup-devis' : 'popup-contact';
            const popup = document.getElementById(popupId);
            
            if (popup) {
                // Afficher la popup
                popup.classList.add('is-active');
                popup.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                
                // Mettre le focus sur le bouton de fermeture (accessibilité)
                const closeBtn = popup.querySelector('.popup-close');
                if (closeBtn) {
                    closeBtn.focus();
                }
            } else {
                // Solution de secours : message de succès par défaut
                const successElement = document.createElement('div');
                successElement.className = 'form-success';
                successElement.setAttribute('role', 'status');
                successElement.innerHTML = `
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <p>${message}</p>
                `;
                
                this.form.insertAdjacentElement('beforebegin', successElement);
                this.form.style.display = 'none';
                
                // Scroller vers le message de succès
                successElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
        
        showFormError(message) {
            // Supprimer le message d'erreur existant
            const existingError = this.form.querySelector('.form-error-message');
            if (existingError) {
                existingError.remove();
            }
            
            const errorElement = document.createElement('div');
            errorElement.className = 'form-error-message';
            errorElement.setAttribute('role', 'alert');
            errorElement.textContent = message;
            
            this.form.insertAdjacentElement('afterbegin', errorElement);
            errorElement.focus();
        }
    }
    
    /**
     * Initialiser les formulaires
     * Applique la validation à tous les formulaires avec l'attribut data-validate
     */
    function initForms() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            new FormValidator(form);
        });
        
        // Initialiser les gestionnaires de fermeture des popups
        initPopups();
    }
    
    /**
     * Initialiser les gestionnaires de popups
     * Gère l'ouverture/fermeture et les interactions
     */
    function initPopups() {
        const popups = document.querySelectorAll('.popup-overlay');
        
        popups.forEach(popup => {
            // Clic sur le bouton de fermeture
            const closeBtn = popup.querySelector('.popup-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => closePopup(popup));
            }
            
            // Clic à l'extérieur pour fermer
            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    closePopup(popup);
                }
            });
            
            // Touche Escape pour fermer
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && popup.classList.contains('is-active')) {
                    closePopup(popup);
                }
            });
        });
    }
    
    /**
     * Fermer une popup
     */
    function closePopup(popup) {
        popup.classList.remove('is-active');
        popup.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    
    /**
     * Initialiser quand le DOM est prêt
     */
    if (typeof AC !== 'undefined' && AC.domReady) {
        AC.domReady(initForms);
    } else {
        document.addEventListener('DOMContentLoaded', initForms);
    }
})();
