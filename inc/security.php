<?php
/**
 * Security Functions
 *
 * @package Armando_Castanheira
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Remove WordPress version from head and feeds
 */
function ac_remove_wp_version() {
    return '';
}
add_filter( 'the_generator', 'ac_remove_wp_version' );

/**
 * Remove version from scripts and styles
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
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove X-Pingback header
 */
function ac_remove_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'ac_remove_x_pingback' );

/**
 * Disable author archives to prevent user enumeration
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
 * Remove login error messages (security)
 */
function ac_login_error_message() {
    return __( 'Identifiants incorrects.', 'armando-castanheira' );
}
add_filter( 'login_errors', 'ac_login_error_message' );

/**
 * Add security headers
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
 * Sanitize file uploads
 */
function ac_sanitize_file_name( $filename ) {
    // Remove accents
    $filename = remove_accents( $filename );
    
    // Convert to lowercase
    $filename = strtolower( $filename );
    
    // Replace spaces with dashes
    $filename = preg_replace( '/\s+/', '-', $filename );
    
    // Remove special characters
    $filename = preg_replace( '/[^a-z0-9\-\_\.]/', '', $filename );
    
    // Remove multiple dashes
    $filename = preg_replace( '/-+/', '-', $filename );
    
    return $filename;
}
add_filter( 'sanitize_file_name', 'ac_sanitize_file_name', 10 );

/**
 * Limit login attempts (basic implementation)
 * For production, consider using a dedicated plugin
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
 * Clear login attempts on successful login
 */
function ac_clear_login_attempts( $user_login, $user ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_name = 'login_attempts_' . md5( $ip );
    delete_transient( $transient_name );
}
add_action( 'wp_login', 'ac_clear_login_attempts', 10, 2 );
