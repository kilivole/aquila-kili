<?php
/**
 * Register Menus
 * 
 * @package AquilaKili
 */

 namespace AquilaKili_Theme\Inc;

 use AQUILAKILI_THEME\Inc\Traits\Singleton;

 class Menus {

     use Singleton;

     
     protected function __construct() {
        // load class.
        $this->setup_hooks();
    } 

    protected function setup_hooks() {
        /**
         * Actions.
         */

        add_action('init', [$this, 'register_menus']);

    }
    
    public function register_menus() {
        register_nav_menus([
            'aquilakili-header-menu' => esc_html__( 'Header Menu', 'aquilakili' ),
            'aquilakili-footer-menu' => esc_html__( 'Footer Menu', 'aquilakili' ),
        ]);

    }

    public function get_menu_id ( $location ) {
        // Get all the locations.
        $locations = get_nav_menu_locations();

        // Get object id by locations.
        $menu_id = $locations[ $location ]; 

        return ! empty( $menu_id) ? $menu_id : '';
    }

    public function get_child_menu_items( $menu_array, $parent_id) {

        $child_menus = [];

        if ( ! empty( $menu_array ) && is_arry( $menu_array )) {
            foreach ( $menu_array as $menu ) {
                if ( intval( $menu->$menu_item_parent ) === $parent_id ) {
                    array_push( $child_menus, $menu );
                }
            }
        }
        return $child_menus;

    }

 }