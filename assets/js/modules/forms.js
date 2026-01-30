/**
 * Forms Module - Vanilla JS
 * Handles form validation and submission
 * 
 * @package Armando_Castanheira
 */

'use strict';

(function() {
    /**
     * Form Validator
     */
    class FormValidator {
        constructor(form) {
            this.form = form;
            this.fields = form.querySelectorAll('input, textarea, select');
            this.submitButton = form.querySelector('[type="submit"]');
            
            this.init();
        }
        
        init() {
            this.bindEvents();
            this.setupAccessibility();
        }
        
        bindEvents() {
            // Real-time validation on blur
            this.fields.forEach(field => {
                field.addEventListener('blur', () => this.validateField(field));
                field.addEventListener('input', () => this.clearError(field));
            });
            
            // Form submission
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
        
        setupAccessibility() {
            this.fields.forEach(field => {
                // Ensure all fields have associated labels
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
            
            // Clear previous errors
            this.clearError(field);
            
            // Required check
            if (required && !value) {
                this.showError(field, 'Ce champ est requis.');
                return false;
            }
            
            // Email validation
            if (type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    this.showError(field, 'Veuillez entrer une adresse email valide.');
                    return false;
                }
            }
            
            // Phone validation
            if (type === 'tel' && value) {
                const phoneRegex = /^[\d\s\+\-\.\(\)]{10,}$/;
                if (!phoneRegex.test(value)) {
                    this.showError(field, 'Veuillez entrer un numéro de téléphone valide.');
                    return false;
                }
            }
            
            // Min length
            const minLength = field.getAttribute('minlength');
            if (minLength && value.length < parseInt(minLength)) {
                this.showError(field, `Minimum ${minLength} caractères requis.`);
                return false;
            }
            
            return true;
        }
        
        validateAll() {
            let isValid = true;
            
            this.fields.forEach(field => {
                if (!this.validateField(field)) {
                    isValid = false;
                }
            });
            
            return isValid;
        }
        
        showError(field, message) {
            field.classList.add('has-error');
            field.setAttribute('aria-invalid', 'true');
            
            // Create error message
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
                // Focus first error field
                const firstError = this.form.querySelector('.has-error');
                if (firstError) {
                    firstError.focus();
                }
                return;
            }
            
            // Disable submit button
            this.submitButton.disabled = true;
            this.submitButton.classList.add('is-loading');
            
            try {
                // Check if AJAX is available
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
                        this.showSuccess(data.data?.message || 'Votre message a été envoyé avec succès.');
                        this.form.reset();
                    } else {
                        this.showFormError(data.data?.message || 'Une erreur est survenue. Veuillez réessayer.');
                    }
                } else {
                    // Fallback: Show success popup directly (for demo/testing)
                    // In production, you should configure the AJAX handler
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
        
        // Simulate form submission delay
        simulateSubmit() {
            return new Promise(resolve => setTimeout(resolve, 800));
        }
        
        showSuccess(message) {
            // Determine which popup to show based on form type
            const formType = this.form.querySelector('input[name="form_type"]');
            const popupId = formType && formType.value === 'devis' ? 'popup-devis' : 'popup-contact';
            const popup = document.getElementById(popupId);
            
            if (popup) {
                // Show popup
                popup.classList.add('is-active');
                popup.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                
                // Focus close button for accessibility
                const closeBtn = popup.querySelector('.popup-close');
                if (closeBtn) {
                    closeBtn.focus();
                }
            } else {
                // Fallback to default success message
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
                
                // Scroll to success message
                successElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
        
        showFormError(message) {
            // Remove existing form error
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
     * Initialize forms
     */
    function initForms() {
        const forms = document.querySelectorAll('form[data-validate]');
        
        forms.forEach(form => {
            new FormValidator(form);
        });
        
        // Initialize popup close handlers
        initPopups();
    }
    
    /**
     * Initialize popup handlers
     */
    function initPopups() {
        const popups = document.querySelectorAll('.popup-overlay');
        
        popups.forEach(popup => {
            // Close button click
            const closeBtn = popup.querySelector('.popup-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => closePopup(popup));
            }
            
            // Click outside to close
            popup.addEventListener('click', (e) => {
                if (e.target === popup) {
                    closePopup(popup);
                }
            });
            
            // Escape key to close
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && popup.classList.contains('is-active')) {
                    closePopup(popup);
                }
            });
        });
    }
    
    /**
     * Close popup
     */
    function closePopup(popup) {
        popup.classList.remove('is-active');
        popup.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    
    /**
     * Initialize on DOM ready
     */
    if (typeof AC !== 'undefined' && AC.domReady) {
        AC.domReady(initForms);
    } else {
        document.addEventListener('DOMContentLoaded', initForms);
    }
})();
