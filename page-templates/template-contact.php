<?php
/**
 * Template Name: Contact
 * 
 * Page template for the contact page with contact form and quote request
 *
 * @package Armando_Castanheira
 */

get_header();

// Check which form to display
$current_form = isset( $_GET['form'] ) ? sanitize_text_field( $_GET['form'] ) : 'contact';
?>

<main id="main-content" class="site-main page-contact">
    
    <!-- Contenu SEO caché pour Yoast -->
    <div class="sr-only seo-content">
        <h2>Formulaire de contact et demande de devis</h2>
        <p>Contactez Armando Castanheira, artisan marbrier à Paris, pour toute demande de devis ou question concernant vos projets en marbre, granit et pierre naturelle.</p>
        <p>Utilisez notre formulaire de contact pour nous joindre rapidement ou remplissez une demande de devis détaillée pour votre projet de marbrerie sur-mesure.</p>
        <h3>Formulaire de contact</h3>
        <p>Pour toute question générale, utilisez notre formulaire de contact. Nous vous répondrons dans les plus brefs délais.</p>
        <h3>Demande de devis gratuit</h3>
        <p>Pour obtenir un devis personnalisé pour votre projet en marbre (plan de travail, escalier, salle de bain, sol), remplissez notre formulaire de demande de devis en ligne.</p>
    </div>
    
    <!-- Page Header with Contact Card -->
    <header class="page-header page-header--contact">
        <div class="container">
            <div class="contact-card">
                <div class="contact-card__photo">
                    <?php 
                    $photo = get_field( 'contact_photo' );
                    $photo_url = ! empty( $photo['url'] ) ? $photo['url'] : AC_THEME_URI . '/assets/images/contact/pp-contact.webp';
                    ?>
                    <img src="<?php echo esc_url( $photo_url ); ?>" 
                         alt="<?php esc_attr_e( 'Armando Castanheira', 'armando-castanheira' ); ?>"
                         width="280" height="315">
                </div>
                <div class="contact-card__info">
                    <h1 class="contact-card__name">
                        <?php 
                        $nom = get_field( 'contact_nom' );
                        echo ! empty( $nom ) ? wp_kses_post( $nom ) : 'Armando<br>Castanheira';
                        ?>
                    </h1>
                    <p class="contact-card__description">
                        <?php 
                        $description = get_field( 'contact_description' );
                        echo ! empty( $description ) ? esc_html( $description ) : 'Passionné depuis plus de 15ans, chaque projet est le résultat de mon exigence et de la valeur du travail';
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Form Section -->
    <section class="section-form">
        <div class="container">
            
            <!-- Contact Form -->
            <div id="form-contact" class="form-panel <?php echo $current_form === 'contact' ? 'is-active' : ''; ?>">
                <div class="form-header">
                    <h2 class="form-title"><?php esc_html_e( 'Formulaire de contact', 'armando-castanheira' ); ?></h2>
                    <a href="<?php echo esc_url( add_query_arg( 'form', 'devis' ) ); ?>" class="form-link">
                        <?php esc_html_e( 'ou demander un devis', 'armando-castanheira' ); ?>
                    </a>
                </div>
                
                <form class="contact-form" action="" method="post" id="contact-form" data-validate>
                    <input type="hidden" name="form_type" value="contact">
                    <div class="form-grid">
                        <div class="form-group form-group--half">
                            <input type="text" name="prenom" class="form-input" placeholder="<?php esc_attr_e( 'Prénom *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="text" name="nom" class="form-input" placeholder="<?php esc_attr_e( 'Nom *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="email" name="email" class="form-input" placeholder="<?php esc_attr_e( 'E-mail *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="tel" name="telephone" class="form-input" placeholder="<?php esc_attr_e( 'Téléphone *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <textarea name="message" class="form-textarea" placeholder="<?php esc_attr_e( 'Message', 'armando-castanheira' ); ?>"></textarea>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="text" name="adresse" class="form-input" placeholder="<?php esc_attr_e( 'Adresse *', 'armando-castanheira' ); ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <p class="form-note"><?php esc_html_e( 'Les champs avec une * sont obligatoires.', 'armando-castanheira' ); ?></p>
                        <button type="submit" class="btn-submit">
                            <?php esc_html_e( 'Envoyer', 'armando-castanheira' ); ?>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Devis Form -->
            <div id="form-devis" class="form-panel <?php echo $current_form === 'devis' ? 'is-active' : ''; ?>">
                <div class="form-header">
                    <h2 class="form-title"><?php esc_html_e( 'Demande de devis', 'armando-castanheira' ); ?></h2>
                    <a href="<?php echo esc_url( remove_query_arg( 'form' ) ); ?>" class="form-link">
                        <?php esc_html_e( 'ou nous contacter', 'armando-castanheira' ); ?>
                    </a>
                </div>
                
                <form class="contact-form" action="" method="post" id="devis-form" data-validate>
                    <input type="hidden" name="form_type" value="devis">
                    
                    <!-- Section: Vos informations -->
                    <h3 class="form-section-title"><?php esc_html_e( 'Vos informations', 'armando-castanheira' ); ?></h3>
                    <div class="form-grid">
                        <div class="form-group form-group--half">
                            <input type="text" name="prenom" class="form-input" placeholder="<?php esc_attr_e( 'Prénom *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="text" name="nom" class="form-input" placeholder="<?php esc_attr_e( 'Nom *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="email" name="email" class="form-input" placeholder="<?php esc_attr_e( 'E-mail *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="tel" name="telephone" class="form-input" placeholder="<?php esc_attr_e( 'Téléphone *', 'armando-castanheira' ); ?>" required>
                        </div>
                    </div>
                    
                    <!-- Section: Votre projet -->
                    <h3 class="form-section-title"><?php esc_html_e( 'Votre projet', 'armando-castanheira' ); ?></h3>
                    <div class="form-grid">
                        <div class="form-group form-group--half">
                            <input type="text" name="piece" class="form-input" placeholder="<?php esc_attr_e( 'Pièce de la maison *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="text" name="taille" class="form-input" placeholder="<?php esc_attr_e( 'Taille * (Longueur, Largeur, Hauteur)', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <input type="text" name="matiere" class="form-input" placeholder="<?php esc_attr_e( 'Matière *', 'armando-castanheira' ); ?>" required>
                        </div>
                        <div class="form-group form-group--half">
                            <textarea name="message" class="form-textarea" placeholder="<?php esc_attr_e( 'Message', 'armando-castanheira' ); ?>"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-footer">
                        <p class="form-note"><?php esc_html_e( 'Les champs avec une * sont obligatoires.', 'armando-castanheira' ); ?></p>
                        <button type="submit" class="btn-submit">
                            <?php esc_html_e( 'Envoyer', 'armando-castanheira' ); ?>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </section>
    
    <!-- Popup Contact -->
    <div id="popup-contact" class="popup-overlay" aria-hidden="true">
        <div class="popup-content">
            <button type="button" class="popup-close" aria-label="<?php esc_attr_e( 'Fermer', 'armando-castanheira' ); ?>">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/popup-contact.webp' ); ?>" 
                 alt="<?php esc_attr_e( 'Message envoyé avec succès', 'armando-castanheira' ); ?>"
                 class="popup-image">
        </div>
    </div>
    
    <!-- Popup Devis -->
    <div id="popup-devis" class="popup-overlay" aria-hidden="true">
        <div class="popup-content">
            <button type="button" class="popup-close" aria-label="<?php esc_attr_e( 'Fermer', 'armando-castanheira' ); ?>">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/popup-devis.webp' ); ?>" 
                 alt="<?php esc_attr_e( 'Demande de devis envoyée', 'armando-castanheira' ); ?>"
                 class="popup-image">
        </div>
    </div>
    
</main>

<?php get_footer(); ?>
