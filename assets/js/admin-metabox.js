/**
 * Script pour gérer l'upload d'images dans les metaboxes
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Upload d'image
        $(document).on('click', '.ac-upload-image-button', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var fieldId = button.data('field');
            var customUploader = wp.media({
                title: 'Choisir une image',
                button: {
                    text: 'Utiliser cette image'
                },
                multiple: false
            });
            
            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                
                // Mettre à jour le champ caché
                $('#' + fieldId).val(attachment.id);
                
                // Afficher l'aperçu
                var preview = button.siblings('.ac-image-preview');
                preview.html('<img src="' + attachment.url + '" style="max-width: 300px; height: auto; display: block;">');
                
                // Changer le texte du bouton
                button.text('Changer l\'image');
                
                // Afficher le bouton supprimer
                if (button.siblings('.ac-remove-image-button').length === 0) {
                    button.after('<button type="button" class="button ac-remove-image-button" data-field="' + fieldId + '">Supprimer</button>');
                }
            });
            
            customUploader.open();
        });
        
        // Supprimer l'image
        $(document).on('click', '.ac-remove-image-button', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var fieldId = button.data('field');
            
            // Vider le champ caché
            $('#' + fieldId).val('');
            
            // Vider l'aperçu
            button.siblings('.ac-image-preview').html('');
            
            // Changer le texte du bouton upload
            button.siblings('.ac-upload-image-button').text('Ajouter une image');
            
            // Supprimer le bouton supprimer
            button.remove();
        });
        
    });
    
})(jQuery);
