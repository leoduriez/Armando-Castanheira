<?php
/**
 * Template Name: Conditions Générales d'Utilisation
 * 
 * Template pour la page CGU
 *
 * @package armando-castanheira
 */

get_header();
?>

<main id="primary" class="site-main page-legal">

    <!-- Hero Section -->
    <section class="page-hero page-hero--legal">
        <div class="container">
            <h1 class="page-hero__title">Conditions Générales d'Utilisation</h1>
            <p class="page-hero__subtitle">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>
        </div>
    </section>

    <!-- Contenu CGU -->
    <section class="section section--legal-content">
        <div class="container">
            <div class="legal-content">

                <div class="legal-intro">
                    <p>Bienvenue sur <strong>www.armando-castanheira.fr</strong>. En naviguant sur ce site, vous acceptez pleinement les présentes Conditions Générales d'Utilisation. Si vous ne les acceptez pas, merci de ne pas utiliser ce site.</p>
                </div>

                <article class="legal-section">
                    <h2>1. Présentation du site</h2>
                    <p>Le site <strong>www.armando-castanheira.fr</strong> est un site personnel / portfolio destiné à présenter mon activité de marbrier dans le 8<sup>e</sup> arrondissement de Paris. Jusqu'à présent, je trouvais mes clients principalement par le bouche-à-oreille. Aujourd'hui, je souhaite gagner en visibilité grâce à un site vitrine professionnel qui mettra en avant mon savoir-faire, mes réalisations et mon univers artisanal, à la fois sobre et élégant.</p>
                    
                    <div class="legal-info-box">
                        <h3>Éditeur du site</h3>
                        <ul>
                            <li><strong>Nom :</strong> Armando Castanheira</li>
                            <li><strong>Email :</strong> <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a></li>
                            <li><strong>Localisation :</strong> Paris 75008</li>
                        </ul>
                    </div>
                </article>

                <article class="legal-section">
                    <h2>2. Accès au site</h2>
                    <p>Le site est accessible gratuitement depuis n'importe où, pour tout utilisateur ayant accès à Internet. Tous les frais liés à l'accès au service (connexion Internet, matériel, etc.) sont à votre charge.</p>
                </article>

                <article class="legal-section">
                    <h2>3. Propriété intellectuelle</h2>
                    <p>Tous les contenus présents sur ce site (textes, images, vidéos, projets, logos…) sont protégés par le droit d'auteur. Sauf mention contraire, ils m'appartiennent.</p>
                    
                    <div class="legal-warning-box">
                        <h3>Vous n'êtes pas autorisé(e) à :</h3>
                        <ul>
                            <li>Copier</li>
                            <li>Reproduire</li>
                            <li>Modifier</li>
                            <li>Distribuer</li>
                            <li>Utiliser ces contenus sans mon accord écrit</li>
                        </ul>
                    </div>
                </article>

                <article class="legal-section">
                    <h2>4. Protection des données personnelles</h2>
                    <p>Ce site peut collecter certaines données (formulaire de contact, statistiques de visite…).</p>
                    
                    <div class="legal-info-box">
                        <h3>Vos données :</h3>
                        <ul>
                            <li>Ne sont <strong>jamais revendues</strong></li>
                            <li>Sont utilisées uniquement pour répondre à vos demandes ou améliorer le site</li>
                            <li>Sont conservées de manière sécurisée</li>
                        </ul>
                        <p><strong>Vous pouvez demander la suppression ou consultation de vos données à :</strong><br>
                        <a href="mailto:armandocastanhieramb@gmail.com">armandocastanhieramb@gmail.com</a></p>
                    </div>
                </article>

                <article class="legal-section">
                    <h2>5. Limitation de responsabilité</h2>
                    <p>Je m'efforce de proposer un contenu fiable, mais je ne garantis pas :</p>
                    <ul>
                        <li>L'absence d'erreur</li>
                        <li>La mise à jour constante du site</li>
                        <li>La disponibilité continue du site</li>
                    </ul>
                    <p>Je ne peux pas être tenu responsable d'éventuels dommages liés à l'utilisation du site.</p>
                </article>

                <article class="legal-section">
                    <h2>6. Liens externes</h2>
                    <p>Le site peut contenir des liens vers d'autres sites externes. Je ne suis pas responsable de leur contenu ou de leur fonctionnement.</p>
                </article>

                <article class="legal-section">
                    <h2>7. Modification des CGU</h2>
                    <p>Je peux modifier ces Conditions Générales d'Utilisation à tout moment. La version la plus récente est toujours celle affichée ici.</p>
                </article>

                <article class="legal-section">
                    <h2>8. Contact</h2>
                    <p>Pour toute question concernant ces CGU, vous pouvez me contacter :</p>
                    <div class="legal-contact">
                        <a href="mailto:armandocastanhieramb@gmail.com" class="btn btn--primary">
                            <span class="dashicons dashicons-email"></span>
                            armandocastanhieramb@gmail.com
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

</main>

<?php
get_footer();
