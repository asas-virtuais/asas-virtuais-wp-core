<?php
function mock_sanitize_title( $string ) {
    return str_replace( ' ', '-', strtolower( $string ) );
}
function sanitize_title( $string ) {
    return mock_sanitize_title( $string );
}
function plugins_url( $path = '', $plugin = '' ) {
    return 'http://localhost/wp-content/plugins/';
}
function plugin_dir_url( $file ) {
    return trailingslashit( plugins_url( '', $file ) );
}
function plugin_dir_path( $file ) {
    return trailingslashit( dirname( $file ) );
}
function trailingslashit( $string ) {
    return untrailingslashit( $string ) . '/';
}
function untrailingslashit( $string ) {
    return rtrim( $string, '/\\' );
}
WP_Mock::bootstrap();
