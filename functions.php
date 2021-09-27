<?php
/*
Theme
@package AquilaKili
*/

if (! defined( 'AQUILAKILI_DIR_PATH' ) ) {
    define('AQUILAKILI_DIR_PATH', untrailingslashit( get_template_directory() ));
}

if (! defined( 'AQUILAKILI_DIR_URI' )){
    define('AQUILAKILI_DIR_PATH', untrailingslashit( get_template_directory_uri() ));
}

require_once AQUILAKILI_DIR_PATH . '/inc/helpers/autoloader.php';

function aquilakili_get_theme_instance(){
    \AQUILAKILI_THEME\Inc\AQUILAKILI_THEME::get_instance();

}

    function kili_enqueue_scripts() {



    }
    add_action('wp_enqueue_scripts', 'kili_enqueue_scripts');

?>