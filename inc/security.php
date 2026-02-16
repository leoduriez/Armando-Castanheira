<?php
/**
 * Fonctions de sécurité
 * 
 * Ce fichier contient toutes les mesures de sécurité du thème :
 * - Suppression des informations sensibles (version WordPress)
 * - Désactivation de XML-RPC
 * - Protection contre l'énumération des utilisateurs
 * - En-têtes de sécurité HTTP
 * - Limitation des tentatives de connexion
 * - Sanitisation des noms de fichiers
 *
 * @package Armando_Castanheira
 */

// Sécurité : empêche l'accès direct au fichier
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Supprimer la version de WordPress du head et des flux RSS
 * Empêche les attaquants de connaître la version exacte de WordPress
 */
function ac_remove_wp_version() {
    return '';
}
add_filter( 'the_generator', 'ac_remove_wp_version' );

/**
 * Supprimer la version des scripts et styles
 * Masque la version des fichiers CSS/JS pour plus de sécurité
 */
function ac_remove_version_scripts_styles( $src ) {
    if ( strpos( $src, 'ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'ac_remove_version_scripts_styles', 9999 );
add_filter( 'script_loader_src', 'ac_remove_version_scripts_styles', 9999 );

/**
 * Désactiver XML-RPC
 * Prévient les attaques par force brute via XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Supprimer l'en-tête X-Pingback
 * Empêche les attaques DDoS via pingback
 */
function ac_remove_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'ac_remove_x_pingback' );

/**
 * Désactiver les archives d'auteur pour empêcher l'énumération des utilisateurs
 * Empêche les attaquants de découvrir les noms d'utilisateur via les URLs
 */
function ac_disable_author_archives() {
    if ( is_author() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
    }
}
add_action( 'template_redirect', 'ac_disable_author_archives' );

/**
 * Supprimer les messages d'erreur de connexion détaillés
 * Empêche les attaquants de savoir si un nom d'utilisateur existe
 */
function ac_login_error_message() {
    return __( 'Identifiants incorrects.', 'armando-castanheira' );
}
add_filter( 'login_errors', 'ac_login_error_message' );

/**
 * Ajouter des en-têtes de sécurité HTTP
 * Protège contre XSS, clickjacking et autres attaques
 */
function ac_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    }
}
add_action( 'send_headers', 'ac_security_headers' );

/**
 * Nettoyer les noms de fichiers uploadés
 * Supprime les caractères spéciaux et accents pour éviter les problèmes
 */
function ac_sanitize_file_name( $filename ) {
    // Supprimer les accents
    $filename = remove_accents( $filename );
    
    // Convertir en minuscules
    $filename = strtolower( $filename );
    
    // Remplacer les espaces par des tirets
    $filename = preg_replace( '/\s+/', '-', $filename );
    
    // Supprimer les caractères spéciaux
    $filename = preg_replace( '/[^a-z0-9\-\_\.]/', '', $filename );
    
    // Supprimer les tirets multiples
    $filename = preg_replace( '/-+/', '-', $filename );
    
    return $filename;
}
add_filter( 'sanitize_file_name', 'ac_sanitize_file_name', 10 );

/**
 * Limiter les tentatives de connexion (implémentation basique)
 * 
 * Bloque temporairement les IP après 5 tentatives échouées.
 * Pour la production, envisagez d'utiliser un plugin dédié comme Wordfence.
 */
function ac_limit_login_attempts() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_name = 'login_attempts_' . md5( $ip );
    $attempts = get_transient( $transient_name );
    
    if ( $attempts === false ) {
        $attempts = 0;
    }
    
    if ( $attempts >= 5 ) {
        wp_die( 
            __( 'Trop de tentatives de connexion. Veuillez réessayer dans 15 minutes.', 'armando-castanheira' ),
            __( 'Connexion bloquée', 'armando-castanheira' ),
            array( 'response' => 403 )
        );
    }
}
add_action( 'wp_login_failed', 'ac_track_failed_login' );

function ac_track_failed_login( $username ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_name = 'login_attempts_' . md5( $ip );
    $attempts = get_transient( $transient_name );
    
    if ( $attempts === false ) {
        $attempts = 0;
    }
    
    $attempts++;
    set_transient( $transient_name, $attempts, 15 * MINUTE_IN_SECONDS );
}

/**
 * Effacer les tentatives de connexion après une connexion réussie
 * Réinitialise le compteur pour l'IP de l'utilisateur
 */
function ac_clear_login_attempts( $user_login, $user ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_name = 'login_attempts_' . md5( $ip );
    delete_transient( $transient_name );
}
add_action( 'wp_login', 'ac_clear_login_attempts', 10, 2 );
