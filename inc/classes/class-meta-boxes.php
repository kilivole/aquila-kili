<?php
/**
 * Register meta boxes
 * 
 * @package AquilaKili
 */

 namespace AQUILAKILI_THEME\Inc;

 use AQUILAKILI_THEME\Inc\Traits\Singleton;

 class Meta_Boxes {
     use Singleton;

     
     protected function __construct() {

        // load class.
        $this->setup_hooks();
    } 

    protected function setup_hooks() {
        /**
         * Actions.
         */

        add_action('add_meta_boxes', [ $this, 'add_custom_meta_box']);
        add_action('save_post', [ $this, 'save_post_meta_data']);

    }

    public function add_custom_meta_box( $post ) {
        $screens = ['post'];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'hide-page-title',             // Unique ID
                __('Hide page title', 'aquilakili'),    // Box Title
                [ $this, 'custom_meta_box_html' ],    // Content callback, must be of type alable
                $screen,                    // Post type
                'side'                      //Context
            );
        }
    }

    public function custom_meta_box_html( $post ) {

        $value = get_post_meta($post->ID, '_hide_page_title', true);

        /**
         * Use nonce for verification
         */
        wp_nonce_field( plugin_basename(__FILE__), 'hide_title_meta_box_nonce_name');

        ?>
        <label for="aquilakili-field"><?php esc_html_e('Hide the page title', 'aquilakili'); ?></label>
        <select name="aquilakili_hide_title_field" id="aquilakili-field" class="postbox">
            <option value=""><?php esc_html_e('Select', 'aquilakili'); ?></option>
            <option value="yes" <?php selected( $value, 'something'); ?>>
                <?php esc_html_e( 'Yes', 'aquilakili'); ?>
            </option>
            <option value="no" <?php selected( $value, 'else'); ?>>
                <?php esc_html_e( 'No', 'aquilakili'); ?>
            </option>
        </select>
        <?php
    }

    public function save_post_meta_data($post_id){

        /**
         * WHen the post is saved or updated we get $_POST available
         * Check if the current user is authorized to do this
         */

         if ( current_user_can( 'edit_post', $post_id )) {
             return;
         }

         /**
          * Check if the nonce value we received is the same we created.
          */
         if( ! isset( $_POST['hide_title_meta_box_nonce_name'] ) ||
            ! wp_verify_nonce( $_POST['hide_title_meta_box_nonce_name'], plugin_basename(__FILE__) )
            ){
                return;
            }


        if ( array_key_exists( 'aquilakili_hide_title_field', $_POST ) ) {
            update_post_meta(
                $post_id,
                '_hide_page_title',
                $_POST['aquilakili_hide_title_field']
            );
        }
    }
 }