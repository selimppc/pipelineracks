<?php


require_once dirname( __FILE__ ) . '/class.settings-api.php';

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('wpgs_option' ) ):
class wpgs_option {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Woocommerce Product Gallery Slider Option Panel', 'WPGS Option Panel', 'delete_posts', 'wpgs_option', array($this, 'wpgs_page') );
		
    }
	

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wpgs_option_id',
                'title' => __( 'Woocommerce Product Gallery Slider Option Panel', 'wpgs' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wpgs_option_id' => array(
                array(
                    'name' => 'cursorcolor',
                    'label' => __( 'Scrollbar Color', 'wedevs' ),
                    'desc' => __( 'Select a color for your Scrollbar.', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#ddd'
                ),
                array(
                    'name' => 'background',
                    'label' => __( 'Background Color', 'wedevs' ),
                    'desc' => __( 'Select a Background for your Scrollbar.', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#fff'
                ),
				array(
                    'name' => 'cursorwidth',
                    'label' => __( 'Scrollbar width', 'wedevs' ),
                    'desc' => __( 'Select Scrollbar width in px .Default: 10px (only number) ', 'wedevs' ),
                    'type' => 'text',
                    'default' => '10'
                ),
                array(
                    'name' => 'cursorborderradius',
                    'label' => __( 'Scrollbar border-radius', 'wedevs' ),
                    'desc' => __( 'select Scrollbar Border-radius in px.default: 0px (only number)', 'wedevs' ),
                    'type' => 'text',
					'default' => '0'
                ),
                array(
                    'name' => 'autohidemode',
                    'label' => __( 'Autohide', 'wedevs' ),
                    'desc' => __( ' Default:No', 'wedevs' ),
                    'type' => 'select',
					'default' => 'no',
                    'options' => array(
                        'true' => 'Yes',
                        'false' => 'No'
                    )
                ),
               
            ),
        );

        return $settings_fields;
    }
	
	
	



    function wpgs_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new wpgs_option();