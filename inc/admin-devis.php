<?php
/**
 * Page d'administration pour gérer les demandes de devis
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Ajouter le menu dans l'administration WordPress
 */
function ac_add_devis_admin_menu() {
    add_menu_page(
        'Demandes de Devis',           // Titre de la page
        'Devis',                        // Titre du menu
        'manage_options',               // Capacité requise
        'demandes-devis',               // Slug du menu
        'ac_render_devis_admin_page',   // Fonction de rendu
        'dashicons-clipboard',          // Icône
        30                              // Position
    );
}
add_action( 'admin_menu', 'ac_add_devis_admin_menu' );

/**
 * Rendu de la page d'administration
 */
function ac_render_devis_admin_page() {
    // Vérifier les permissions
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Vous n\'avez pas les permissions nécessaires.' );
    }

    // Gérer les actions
    if ( isset( $_GET['action'] ) && isset( $_GET['devis_id'] ) ) {
        $devis_id = absint( $_GET['devis_id'] );
        
        if ( $_GET['action'] === 'delete' && check_admin_referer( 'delete_devis_' . $devis_id ) ) {
            ac_delete_demande_devis( $devis_id );
            echo '<div class="notice notice-success"><p>Demande de devis supprimée.</p></div>';
        } elseif ( isset( $_GET['statut'] ) && check_admin_referer( 'update_statut_' . $devis_id ) ) {
            ac_update_statut_devis( $devis_id, sanitize_text_field( $_GET['statut'] ) );
            echo '<div class="notice notice-success"><p>Statut mis à jour.</p></div>';
        }
    }

    // Récupérer le filtre de statut
    $statut_filter = isset( $_GET['statut_filter'] ) ? sanitize_text_field( $_GET['statut_filter'] ) : 'tous';
    
    // Récupérer les statistiques
    $stats = ac_get_devis_stats();
    
    // Récupérer les demandes de devis
    $demandes = ac_get_demandes_devis( 100, $statut_filter );
    
    ?>
    <div class="wrap">
        <h1>
            <span class="dashicons dashicons-clipboard"></span>
            Demandes de Devis
        </h1>

        <!-- Statistiques -->
        <div class="ac-devis-stats" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin: 20px 0;">
            <div class="ac-stat-card" style="background: #fff; padding: 20px; border-left: 4px solid #2271b1; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Total</h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #2271b1;"><?php echo esc_html( $stats['total'] ); ?></p>
            </div>
            <div class="ac-stat-card" style="background: #fff; padding: 20px; border-left: 4px solid #00a32a; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Nouveaux</h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #00a32a;"><?php echo esc_html( $stats['nouveaux'] ); ?></p>
            </div>
            <div class="ac-stat-card" style="background: #fff; padding: 20px; border-left: 4px solid #dba617; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px 0; color: #666; font-size: 14px;">En cours</h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #dba617;"><?php echo esc_html( $stats['en_cours'] ); ?></p>
            </div>
            <div class="ac-stat-card" style="background: #fff; padding: 20px; border-left: 4px solid #646970; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 10px 0; color: #666; font-size: 14px;">Traités</h3>
                <p style="margin: 0; font-size: 32px; font-weight: bold; color: #646970;"><?php echo esc_html( $stats['traites'] ); ?></p>
            </div>
        </div>

        <!-- Filtres -->
        <div class="tablenav top">
            <div class="alignleft actions">
                <select name="statut_filter" id="statut_filter" onchange="window.location.href='?page=demandes-devis&statut_filter=' + this.value">
                    <option value="tous" <?php selected( $statut_filter, 'tous' ); ?>>Tous les statuts</option>
                    <option value="nouveau" <?php selected( $statut_filter, 'nouveau' ); ?>>Nouveaux</option>
                    <option value="en_cours" <?php selected( $statut_filter, 'en_cours' ); ?>>En cours</option>
                    <option value="traite" <?php selected( $statut_filter, 'traite' ); ?>>Traités</option>
                </select>
            </div>
        </div>

        <!-- Tableau des demandes -->
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Projet</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( empty( $demandes ) ) : ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px;">
                            <span class="dashicons dashicons-clipboard" style="font-size: 48px; color: #ccc;"></span>
                            <p style="color: #666;">Aucune demande de devis trouvée.</p>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ( $demandes as $demande ) : ?>
                        <tr>
                            <td><strong>#<?php echo esc_html( $demande['id'] ); ?></strong></td>
                            <td><?php echo esc_html( date_i18n( 'd/m/Y H:i', strtotime( $demande['date_creation'] ) ) ); ?></td>
                            <td>
                                <strong><?php echo esc_html( $demande['prenom'] . ' ' . $demande['nom'] ); ?></strong>
                            </td>
                            <td>
                                <a href="mailto:<?php echo esc_attr( $demande['email'] ); ?>"><?php echo esc_html( $demande['email'] ); ?></a><br>
                                <a href="tel:<?php echo esc_attr( $demande['telephone'] ); ?>"><?php echo esc_html( $demande['telephone'] ); ?></a>
                            </td>
                            <td>
                                <strong><?php echo esc_html( $demande['piece'] ); ?></strong><br>
                                Matière: <?php echo esc_html( $demande['matiere'] ); ?><br>
                                Taille: <?php echo esc_html( $demande['taille'] ); ?>
                                <?php if ( ! empty( $demande['message'] ) ) : ?>
                                    <br><em><?php echo esc_html( wp_trim_words( $demande['message'], 10 ) ); ?></em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $statut_colors = array(
                                    'nouveau'  => '#00a32a',
                                    'en_cours' => '#dba617',
                                    'traite'   => '#646970',
                                );
                                $statut_labels = array(
                                    'nouveau'  => 'Nouveau',
                                    'en_cours' => 'En cours',
                                    'traite'   => 'Traité',
                                );
                                $color = $statut_colors[ $demande['statut'] ] ?? '#646970';
                                $label = $statut_labels[ $demande['statut'] ] ?? $demande['statut'];
                                ?>
                                <span style="display: inline-block; padding: 4px 12px; background: <?php echo esc_attr( $color ); ?>; color: white; border-radius: 3px; font-size: 12px;">
                                    <?php echo esc_html( $label ); ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="button" onclick="toggleDetails(<?php echo esc_attr( $demande['id'] ); ?>)">
                                    Détails
                                </button>
                                
                                <!-- Menu déroulant pour changer le statut -->
                                <select onchange="if(this.value) window.location.href=this.value" style="margin-left: 5px;">
                                    <option value="">Changer statut</option>
                                    <option value="<?php echo esc_url( wp_nonce_url( '?page=demandes-devis&action=update&devis_id=' . $demande['id'] . '&statut=nouveau', 'update_statut_' . $demande['id'] ) ); ?>">Nouveau</option>
                                    <option value="<?php echo esc_url( wp_nonce_url( '?page=demandes-devis&action=update&devis_id=' . $demande['id'] . '&statut=en_cours', 'update_statut_' . $demande['id'] ) ); ?>">En cours</option>
                                    <option value="<?php echo esc_url( wp_nonce_url( '?page=demandes-devis&action=update&devis_id=' . $demande['id'] . '&statut=traite', 'update_statut_' . $demande['id'] ) ); ?>">Traité</option>
                                </select>
                                
                                <a href="<?php echo esc_url( wp_nonce_url( '?page=demandes-devis&action=delete&devis_id=' . $demande['id'], 'delete_devis_' . $demande['id'] ) ); ?>" 
                                   class="button button-link-delete" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');"
                                   style="color: #b32d2e; margin-left: 5px;">
                                    Supprimer
                                </a>
                                
                                <!-- Détails cachés -->
                                <tr id="details-<?php echo esc_attr( $demande['id'] ); ?>" style="display: none;">
                                    <td colspan="7" style="background: #f9f9f9; padding: 20px;">
                                        <h3>Détails de la demande #<?php echo esc_html( $demande['id'] ); ?></h3>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="width: 200px;"><strong>Prénom:</strong></td>
                                                <td><?php echo esc_html( $demande['prenom'] ); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Nom:</strong></td>
                                                <td><?php echo esc_html( $demande['nom'] ); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td><a href="mailto:<?php echo esc_attr( $demande['email'] ); ?>"><?php echo esc_html( $demande['email'] ); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Téléphone:</strong></td>
                                                <td><a href="tel:<?php echo esc_attr( $demande['telephone'] ); ?>"><?php echo esc_html( $demande['telephone'] ); ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Pièce:</strong></td>
                                                <td><?php echo esc_html( $demande['piece'] ); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Taille:</strong></td>
                                                <td><?php echo esc_html( $demande['taille'] ); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Matière:</strong></td>
                                                <td><?php echo esc_html( $demande['matiere'] ); ?></td>
                                            </tr>
                                            <?php if ( ! empty( $demande['message'] ) ) : ?>
                                                <tr>
                                                    <td><strong>Message:</strong></td>
                                                    <td><?php echo nl2br( esc_html( $demande['message'] ) ); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td><strong>Date de création:</strong></td>
                                                <td><?php echo esc_html( date_i18n( 'd/m/Y à H:i:s', strtotime( $demande['date_creation'] ) ) ); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Adresse IP:</strong></td>
                                                <td><?php echo esc_html( $demande['ip_address'] ); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
    function toggleDetails(id) {
        var detailsRow = document.getElementById('details-' + id);
        if (detailsRow.style.display === 'none') {
            detailsRow.style.display = 'table-row';
        } else {
            detailsRow.style.display = 'none';
        }
    }
    </script>

    <style>
    .ac-devis-stats {
        margin: 20px 0;
    }
    .ac-stat-card h3 {
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    </style>
    <?php
}
