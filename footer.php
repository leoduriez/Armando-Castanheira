<?php
/**
 * Template du footer (pied de page)
 * 
 * Contient la structure HTML du footer avec :
 * - Logo
 * - Navigation footer
 * - Liens réseaux sociaux
 * - Mentions légales et politique de confidentialité (accordéons)
 * - Copyright
 *
 * @package Armando_Castanheira
 */

?>

<footer class="site-footer" id="site-footer">
    <div class="container">
        <div class="footer-inner">
            <!-- Logo du site à gauche -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
                <img src="<?php echo esc_url( AC_THEME_URI . '/assets/images/common/logo-ac.webp' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
            </a>

            <!-- Navigation du footer au centre -->
            <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Navigation footer', 'armando-castanheira' ); ?>">
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url( home_url( '/marbre-sur-mesure/' ) ); ?>"><?php esc_html_e( 'Réalisations', 'armando-castanheira' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/artisans-marbrier-paris/' ) ); ?>"><?php esc_html_e( 'Savoir-Faire', 'armando-castanheira' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/marbre/' ) ); ?>"><?php esc_html_e( 'Matières', 'armando-castanheira' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/marbrier-paris/' ) ); ?>"><?php esc_html_e( 'Contacts', 'armando-castanheira' ); ?></a></li>
                </ul>
            </nav>

            <!-- Liens vers les réseaux sociaux à droite -->
            <div class="footer-social">
                <a href="https://www.instagram.com/armando_castanheira_marbre/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="https://www.facebook.com/profile.php?id=61585945697534" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <a href="#" class="footer-accordion-trigger" data-target="mentions-legales">
                <?php esc_html_e( 'Mentions légales', 'armando-castanheira' ); ?>
            </a>
            <span class="separator">-</span>
            <a href="#" class="footer-accordion-trigger" data-target="politique-confidentialite">
                <?php esc_html_e( 'Politique de confidentialité', 'armando-castanheira' ); ?>
            </a>
            <span class="separator">-</span>
            <span>Armando Castanheira <?php echo date( 'Y' ); ?></span>
        </div>
        
        <!-- Accordéon pour les Mentions Légales et CGU (Conditions Générales d'Utilisation) -->
        <div class="footer-accordion" id="mentions-legales">
            <div class="footer-accordion__content">
                <h3>Conditions Générales d'Utilisation</h3>
                <p><strong>Dernière mise à jour : <?php echo date('d/m/Y'); ?></strong></p>
                
                <p>Bienvenue sur <strong>www.armando-castanheira.fr</strong>. En naviguant sur ce site, vous acceptez pleinement les présentes Conditions Générales d'Utilisation. Si vous ne les acceptez pas, merci de ne pas utiliser ce site.</p>
                
                <h4>1. Présentation du site</h4>
                <p>Le site <strong>www.armando-castanheira.fr</strong> est un site personnel / portfolio destiné à présenter mon activité de marbrier dans le 8<sup>e</sup> arrondissement de Paris. Jusqu'à présent, je trouvais mes clients principalement par le bouche-à-oreille. Aujourd'hui, je souhaite gagner en visibilité grâce à un site vitrine professionnel qui mettra en avant mon savoir-faire, mes réalisations et mon univers artisanal, à la fois sobre et élégant.</p>
                <p><strong>Éditeur :</strong> Armando Castanheira<br>
                <strong>Email :</strong> <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a><br>
                <strong>Localisation :</strong> Paris 75008</p>
                
                <h4>2. Accès au site</h4>
                <p>Le site est accessible gratuitement depuis n'importe où, pour tout utilisateur ayant accès à Internet. Tous les frais liés à l'accès au service (connexion Internet, matériel, etc.) sont à votre charge.</p>
                
                <h4>3. Propriété intellectuelle</h4>
                <p>Tous les contenus présents sur ce site (textes, images, vidéos, projets, logos…) sont protégés par le droit d'auteur. Sauf mention contraire, ils m'appartiennent. Vous n'êtes pas autorisé(e) à copier, reproduire, modifier, distribuer ou utiliser ces contenus sans mon accord écrit.</p>
                
                <h4>4. Protection des données personnelles</h4>
                <p>Ce site peut collecter certaines données (formulaire de contact, statistiques de visite…). Vos données ne sont jamais revendues, sont utilisées uniquement pour répondre à vos demandes ou améliorer le site, et sont conservées de manière sécurisée. Vous pouvez demander la suppression ou consultation de vos données à : <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a></p>
                
                <h4>5. Limitation de responsabilité</h4>
                <p>Je m'efforce de proposer un contenu fiable, mais je ne garantis pas l'absence d'erreur, la mise à jour constante du site, ni la disponibilité continue du site. Je ne peux pas être tenu responsable d'éventuels dommages liés à l'utilisation du site.</p>
                
                <h4>6. Liens externes</h4>
                <p>Le site peut contenir des liens vers d'autres sites externes. Je ne suis pas responsable de leur contenu ou de leur fonctionnement.</p>
                
                <h4>7. Modification des CGU</h4>
                <p>Je peux modifier ces Conditions Générales d'Utilisation à tout moment. La version la plus récente est toujours celle affichée ici.</p>
                
                <h4>8. Contact</h4>
                <p>Pour toute question concernant ces CGU, vous pouvez me contacter : <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a></p>
                
                <button class="footer-accordion__close">&times;</button>
            </div>
        </div>
        
        <!-- Accordéon pour la Politique de Confidentialité (RGPD) -->
        <div class="footer-accordion" id="politique-confidentialite">
            <div class="footer-accordion__content">
                <h3>Politique de Confidentialité</h3>
                <p><strong>Dernière mise à jour : <?php echo date('d/m/Y'); ?></strong></p>
                
                <p>Chez <strong>Armando Castanheira</strong>, nous accordons une grande importance à la protection de vos données personnelles. Cette politique de confidentialité vous informe sur la manière dont nous collectons, utilisons et protégeons vos informations.</p>
                
                <h4>1. Informations collectées</h4>
                <p>Nous collectons certaines informations personnelles lorsque vous utilisez notre site, notamment celles que vous fournissez volontairement (nom, email, téléphone) ainsi que des données recueillies automatiquement (adresse IP, navigateur, pages visitées, cookies).</p>
                <p><strong>Contact :</strong> Armando Castanheira<br>
                <strong>Email :</strong> <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a><br>
                <strong>Téléphone :</strong> <a href="tel:+33685240768">+33 6 85 24 07 68</a></p>
                
                <h4>2. Utilisation des données</h4>
                <p>Ces informations servent à améliorer nos services, répondre à vos demandes, assurer le bon fonctionnement du site et analyser son utilisation.</p>
                
                <h4>3. Partage des données</h4>
                <p><strong>Nous ne vendons pas vos données.</strong> Elles peuvent uniquement être partagées avec des prestataires de confiance ou si la loi l'exige.</p>
                
                <h4>4. Sécurité des données</h4>
                <p>Des mesures de sécurité sont mises en place pour protéger vos données, bien qu'aucun système ne soit totalement garanti.</p>
                
                <h4>5. Vos droits (RGPD)</h4>
                <p>Vous disposez de droits conformément au RGPD : accès, rectification, suppression, opposition, portabilité et limitation du traitement. Pour exercer vos droits, contactez-nous via notre email.</p>
                
                <h4>6. Conservation des données</h4>
                <p>Les données sont conservées seulement le temps nécessaire à nos finalités.</p>
                
                <h4>7. Modifications de la politique</h4>
                <p>Nous pouvons mettre à jour cette politique à tout moment. La version la plus récente est toujours affichée sur cette page.</p>
                
                <h4>8. Contact</h4>
                <p>Pour toute question, contactez-nous :<br>
                <strong>Email :</strong> <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a><br>
                <strong>Téléphone :</strong> <a href="tel:+33685240768">+33 6 85 24 07 68</a><br>
                <strong>Adresse :</strong> Paris 75008</p>
                
                <button class="footer-accordion__close">&times;</button>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
