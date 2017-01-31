<?php
/**
 * Plugin Name: Responsive Slider
 * Plugin URI: http://alienwp.com/plugins/responsive-slider
 * Description: A responsive content slider for integrating into themes via a simple shortcode.
 * Version: 0.1.8
 * Author: AlienWP
 * Author URI: http://alienwp.com
 *
 * The Responsive Slider plugin allows users to create slides that consist of linked (to any url) images and titles.
 * The slider would then take those slides and present them as a jQuery-powered slideshow - at a chosen location within a theme, page, or post.
 *
 * @copyright 2012
 * @version 0.1.8
 * @author AlienWP
 * @link http://alienwp.com/plugins/responsive-slider
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @package Responsive Slider
 */

/* Setup the plugin. */
add_action( 'plugins_loaded', 'responsive_slider_setup' );

/* Register plugin activation hook. */
register_activation_hook( __FILE__, 'responsive_slider_activation' );
	
/* Register plugin activation hook. */
register_deactivation_hook( __FILE__, 'responsive_slider_deactivation' );

/* Register plugin activation hook. */
register_uninstall_hook( __FILE__, 'responsive_slider_uninstall' );

/**
 * Setup function.
 *
 */
function responsive_slider_setup() {

	/* Load translations on the backend. */
	if ( is_admin() )
		load_plugin_textdomain( 'responsive-slider', false, 'responsive-slider/languages' );	

	/* Get the plugin directory URI. */
	define( 'RESPONSIVE_SLIDER_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	
	/* Register the custom post types. */
	add_action( 'init', 'responsive_slider_register_cpt' );

	/* Register the shortcodes. */
	add_action( 'init', 'responsive_slider_register_shortcode' );

	/* Enqueue the stylesheet. */
	add_action( 'template_redirect', 'responsive_slider_enqueue_stylesheets' );
	
	/* Enqueue the admin stylesheet. */
	add_action( 'admin_enqueue_scripts', 'responsive_slider_enqueue_admin_stylesheets' );

	/* Enqueue the JavaScript. */
	add_action( 'template_redirect', 'responsive_slider_enqueue_scripts' );
	
	/* Custom post type icon. */
	add_action( 'admin_head', 'responsive_slider_cpt_icon' );		
	
	/* Add image sizes */
	add_action( 'init', 'responsive_slider_image_sizes' );
	
	/* Add meta box for slides. */
	add_action( 'add_meta_boxes', 'responsive_slider_create_slide_metaboxes' );
	
	/* Save meta box data. */
	add_action( 'save_post', 'responsive_slider_save_meta', 1, 2 );
	
	/* Edit post editor meta boxes. */
	add_action('do_meta_boxes', 'responsive_slider_edit_metaboxes');
	
	/* Add 'Settings' submenu to 'Slides'.*/
	add_action('admin_menu', 'responsive_slider_settings');
	
	/* Register and define the slider settings. */
	add_action( 'admin_init', 'responsive_slider_settings_init' );
	
	/* Edit slide columns in 'all_items' view.  */
	add_filter( 'manage_edit-slides_columns', 'responsive_slider_columns' );
	
	/* Add slide-specific columns to the 'all_items' view. */
	add_action( 'manage_posts_custom_column', 'responsive_slider_add_columns' );
	
	/* Order the slides by the 'order' attribute in the 'all_items' column view. */
	add_filter( 'pre_get_posts', 'responsive_slider_column_order' );	
}

/**
 * Do things on plugin activation.
 *
 * @since 0.1
 */
function responsive_slider_activation() {
	
	/* Register the custom post type. */
    responsive_slider_register_cpt();
	
	/* Flush permalinks. */
    flush_rewrite_rules();
	
	/* Set default slider settings. */
	responsive_slider_default_settings();
}

/**
 * Flush permalinks on plugin deactivation.
 *
 * @since 0.1
 */
function responsive_slider_deactivation() {
    flush_rewrite_rules();
}

/**
 * Delete slider settings on plugin uninstall.
 *
 * @since 0.1
 */
function responsive_slider_uninstall() {
	delete_option( 'responsive_slider_options' );	
}

/**
 * Register the 'Slides' custom post type.
 *
 * @since 0.1
 */
function responsive_slider_register_cpt() {
	
	$labels = array(
		'name'                 => __( 'Slides', 'responsive-slider' ),
		'singular_name'        => __( 'Slide', 'responsive-slider' ),
		'all_items'            => __( 'All Slides', 'responsive-slider' ),
		'add_new'              => __( 'Add New Slide', 'responsive-slider' ),
		'add_new_item'         => __( 'Add New Slide', 'responsive-slider' ),
		'edit_item'            => __( 'Edit Slide', 'responsive-slider' ),
		'new_item'             => __( 'New Slide', 'responsive-slider' ),
		'view_item'            => __( 'View Slide', 'responsive-slider' ),
		'search_items'         => __( 'Search Slides', 'responsive-slider' ),
		'not_found'            => __( 'No Slide found', 'responsive-slider' ),
		'not_found_in_trash'   => __( 'No Slide found in Trash', 'responsive-slider' ), 
		'parent_item_colon'    => ''
	);
	
	$args = array(
		'labels'               => $labels,
		'public'               => true,
		'publicly_queryable'   => true,
		'_builtin'             => false,
		'show_ui'              => true, 
		'query_var'            => true,
		'rewrite'              => array( "slug" => "slides" ),
		'capability_type'      => 'post',
		'hierarchical'         => false,
		'menu_position'        => 20,
		'supports'             => array( 'title','thumbnail', 'page-attributes' ),
		'taxonomies'           => array(),
		'has_archive'          => true,
		'show_in_nav_menus'    => false
	);
	
	register_post_type( 'slides', $args );
}

/**
 * Enqueue the stylesheet.
 *
 * @since 0.1
 */
function responsive_slider_enqueue_stylesheets() {
	wp_enqueue_style( 'responsive-slider', RESPONSIVE_SLIDER_URI . 'css/responsive-slider.css', false, 0.1, 'all' );
}

/**
 * Enqueue the admin stylesheet.
 *
 * @since 0.1
 */
function responsive_slider_enqueue_admin_stylesheets() {
	
	global $post_type;
	
	if ( ( isset( $post_type ) && $post_type == 'slides' ) || ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'slides' ) ) {
		wp_enqueue_style( 'responsive-slider_admin', RESPONSIVE_SLIDER_URI . 'css/responsive-slider-admin.css', false, 0.1, 'all' );
	}
}

/**
 * Enqueue the JavaScript.
 *
 * @since 0.1
 */
function responsive_slider_enqueue_scripts() {
	
	/* Enqueue script. */
	wp_enqueue_script( 'responsive-slider_flex-slider', RESPONSIVE_SLIDER_URI . 'responsive-slider.js', array( 'jquery' ), 0.1, true );

	/* Get slider settings. */
	$options = get_option( 'responsive_slider_options' );

	/* Prepare variables for JavaScript. */
	wp_localize_script( 'responsive-slider_flex-slider', 'slider', array(
		'effect'    => $options['slide_effect'],
		'delay'     => $options['slide_delay'],
		'duration'  => $options['slide_duration'],
		'start'     => $options['slide_start']		
	) );
}

/**
 * Custom post type icon.
 *
 * @since 0.1
 */
function responsive_slider_cpt_icon() {
	?>
	<style type="text/css" media="screen">
		#menu-posts-slides .wp-menu-image {
			background: url(<?php echo RESPONSIVE_SLIDER_URI . 'images/slides-icon.png'; ?>) no-repeat 6px -17px !important;
		}
		#menu-posts-slides:hover .wp-menu-image {
			background-position: 6px 7px!important;
		}	
	</style>
<?php }

/**
 * Output the slider.
 *
 * @since 0.1
 */
function responsive_slider() {

	$slides = new WP_Query( array( 'post_type' => 'slides', 'order' => 'ASC', 'orderby' => 'menu_order' ) );

	$slider = '';
	
	if ( $slides->have_posts() ) :
		
		$slider = '<div class="responsive-slider flexslider">';
		
			$slider .= '<ul class="slides">';
				
			while ( $slides->have_posts() ) : $slides->the_post();
			
				$slider .= '<li>';
				   
					$slider .= '<div id="slide-' . get_the_ID() . '" class="slide">';
						
						global $post;
						
							if ( has_post_thumbnail() ) {

								if ( get_post_meta( $post->ID, "_slide_link_url", true ) ) 
									$slider .= '<a href="' . get_post_meta( $post->ID, "_slide_link_url", true ) . '" title="' .  the_title_attribute ( array( 'echo' => 0 ) ) . '" >';

									$slider .= get_the_post_thumbnail( $post->ID, 'slide-thumbnail', array( 'class' => 'slide-thumbnail' ) );

								if ( get_post_meta( $post->ID, "_slide_link_url", true ) ) 
									$slider .= '</a>';

							}
						
						$slider .= '<h2 class="slide-title"><a href="' . get_post_meta( $post->ID, "_slide_link_url", true ) . '" title="' . the_title_attribute ( array( 'echo' => 0 ) ) . '" >' . get_the_title() . '</a></h2>';
					
					$slider .= '</div><!-- #slide-x -->';
				
				$slider .= '</li>';
				
			endwhile;
			
			$slider .= '</ul>';
			
		$slider .= '</div><!-- #featured-content -->';
	
	endif;

	wp_reset_query();

	return $slider;
}

/**
 * Register the slider shortcode.
 *
 * @since 0.1
 */
function responsive_slider_register_shortcode() {
	add_shortcode( 'responsive_slider', 'responsive_slider' );
}

/**
 *  Add image sizes
 *
 * @since 0.1
 */
function responsive_slider_image_sizes() {
	$options = get_option( 'responsive_slider_options' );
	add_image_size( 'slide-thumbnail', $options['slide_width'], $options['slide_height'], true );	
}

/**
 * Add meta box for slides.
 *
 * @since 0.1
 */
function responsive_slider_create_slide_metaboxes() {
    add_meta_box( 'responsive_slider_metabox_1', __( 'Slide Link', 'responsive-slider' ), 'responsive_slider_metabox_1', 'slides', 'normal', 'default' );
}

/**
 * Output the meta box #1.
 *
 * @since 0.1
 */             
function responsive_slider_metabox_1() {
	
	global $post;	
             
	/* Retrieve the metadata values if they already exist. */
	$slide_link_url = get_post_meta( $post->ID, '_slide_link_url', true ); ?>
	
	<p>URL: <input type="text" style="width: 90%;" name="slide_link_url" value="<?php echo esc_attr( $slide_link_url ); ?>" /></p>
	<span class="description"><?php echo _e( 'The URL this slide should link to.', 'responsive-slider' ); ?></span>
	
<?php }

/**
 * Save meta box data.
 *
 * @since 0.1
 */
function responsive_slider_save_meta( $post_id, $post ) {
	
	if ( isset( $_POST['slide_link_url'] ) ) {
		update_post_meta( $post_id, '_slide_link_url', strip_tags( $_POST['slide_link_url'] ) );
	}	
}

/**
 * Edit post editor meta boxes.
 *
 * @since 0.1
 */
function responsive_slider_edit_metaboxes() {
	
	/* Remove metaboxes */
    remove_meta_box( 'postimagediv', 'slides', 'side' );
	remove_meta_box( 'pageparentdiv', 'slides', 'side' );
	remove_meta_box( 'hybrid-core-post-template', 'slides', 'side' );
	remove_meta_box( 'theme-layouts-post-meta-box', 'slides', 'side' );
	remove_meta_box( 'post-stylesheets', 'slides', 'side' );
	
	/* Add the previously removed meta boxes - with modified properties */
    add_meta_box('postimagediv', __('Slide Image', 'responsive-slider' ), 'post_thumbnail_meta_box', 'slides', 'side', 'low');
	add_meta_box('pageparentdiv', __('Slide Order', 'responsive-slider' ), 'page_attributes_meta_box', 'slides', 'side', 'low');
}

/**
 * Add 'Settings' submenu to 'Slides'.
 *
 * @since 0.1
 */
function responsive_slider_settings() {
	add_submenu_page( 'edit.php?post_type=slides', __( 'Slider Settings', 'responsive-slider' ), __( 'Settings', 'responsive-slider' ), 'manage_options', 'responsive-slider-settings', 'responsive_slider_settings_page' );
}

/**
 * Create the Slider Settings page.
 *
 * @since 0.1
 */
function responsive_slider_settings_page() { ?>

	<div class="wrap">
		
		<?php screen_icon( 'plugins' ); ?>
		<h2><?php _e( 'Responsive Slider Settings', 'responsive-slider' ); ?></h2>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'responsive_slider_options' ); ?>
			<?php do_settings_sections( 'responsive-slider-settings' ); ?>
			<br /><p><input type="submit" name="Submit" value="<?php _e( 'Update Settings', 'responsive-slider' ); ?>" class="button-primary" /></p>
			<br /><p class="description"><?php _e( 'Note: Whenever you change the Width and Height settings, it is a good idea to re-upload the Featured Images of your Slides. This would get them cropped to the new size.', 'responsive-slider' ); ?></p>
		</form>
		
	</div>
	
<?php }

/**
 * Register and define the slider settings.
 *
 * @since 0.1
 */
function responsive_slider_settings_init() {
	
	/* Register the slider settings. */
	register_setting( 'responsive_slider_options', 'responsive_slider_options', 'responsive_slider_validate_options' );
	
	/* Add settings section. */
	add_settings_section( 'responsive_slider_options_main', __( ' ', 'responsive-slider' ), 'responsive_slider_section_text', 'responsive-slider-settings' );
	
	/* Add settings fields. */
	add_settings_field( 'slide_width', __( 'Width:', 'responsive-slider' ), 'slide_width', 'responsive-slider-settings', 'responsive_slider_options_main' );
	add_settings_field( 'slide_height', __( 'Height:', 'responsive-slider' ), 'slide_height', 'responsive-slider-settings', 'responsive_slider_options_main' );
	add_settings_field( 'slide_effect', __( 'Transition Effect:', 'responsive-slider' ), 'slide_effect', 'responsive-slider-settings', 'responsive_slider_options_main' );
	add_settings_field( 'slide_delay', __( 'Delay:', 'responsive-slider' ), 'slide_delay', 'responsive-slider-settings', 'responsive_slider_options_main' );
	add_settings_field( 'slide_duration', __( 'Animation Duration:', 'responsive-slider' ), 'slide_duration', 'responsive-slider-settings', 'responsive_slider_options_main' );
	add_settings_field( 'slide_start', __( 'Start Automatically:', 'responsive-slider' ), 'slide_start', 'responsive-slider-settings', 'responsive_slider_options_main' );		
}
	
/* Output the section header text. */
function responsive_slider_section_text() {
	echo '<p class="description">' . __( 'Make sure to set the desired slide width and height BEFORE creating your slides. Ideally, this would be the maximum size the slider container expands to.', 'responsive-slider' ) . '</p>';
}

/**
 * Display and fill the settings fields.
 *
 * @since 0.1
 */
function slide_width() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_width = $options['slide_width'];
	
	/* Echo the field. */ ?>
	<input type="text" id="slide_width" name="responsive_slider_options[slide_width]" value="<?php echo $slide_width; ?>" /> <span class="description"><?php _e( 'px', 'responsive-slider' ); ?></span>
	
<?php }

function slide_height() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_height = $options['slide_height'];
	
	/* Echo the field. */ ?>
	<input type="text" id="slide_height" name="responsive_slider_options[slide_height]" value="<?php echo $slide_height; ?>" /> <span class="description"><?php _e( 'px', 'responsive-slider' ); ?></span>
	
<?php }

function slide_effect() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_effect = $options['slide_effect'];
	
	/* Echo the field. */
	echo "<select id='slide_effect' name='responsive_slider_options[slide_effect]'>";
	echo '<option value="fade" ' . selected( $slide_effect, 'fade', false ) . ' >' . __( 'fade', 'responsive-slider' ) . '</option>';
	echo '<option value="slide" ' . selected( $slide_effect, 'slide', false ) . ' >' . __( 'slide', 'responsive-slider' ) . '</option>';
	echo '</select>';	
}

function slide_delay() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_delay = $options['slide_delay'];
	
	/* Echo the field. */ ?>
	<input type="text" id="slide_delay" name="responsive_slider_options[slide_delay]" value="<?php echo $slide_delay; ?>" /> <span class="description"><?php _e( 'milliseconds', 'responsive-slider' ); ?></span>
	
<?php }

function slide_duration() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_duration = $options['slide_duration'];
	
	/* Echo the field. */ ?>
	<input type="text" id="slide_duration" name="responsive_slider_options[slide_duration]" value="<?php echo $slide_duration; ?>" /> <span class="description"><?php _e( 'milliseconds', 'responsive-slider' ); ?></span>
	
<?php }

function slide_start() {
	
	/* Get the option value from the database. */
	$options = get_option( 'responsive_slider_options' );
	$slide_start = $options['slide_start'];
	
	/* Echo the field. */
	echo "<input type='checkbox' id='slide_start' name='responsive_slider_options[slide_start]' value='1' " . checked( $slide_start, 1, false ) . " />";	
}

/**
 * Validate and/or sanitize user input.
 *
 * @since 0.1
 */
function responsive_slider_validate_options( $input ) {
	
	$options = get_option( 'responsive_slider_options' );
	
	$options['slide_width'] = wp_filter_nohtml_kses( intval( $input['slide_width'] ) );
	$options['slide_height'] = wp_filter_nohtml_kses( intval( $input['slide_height'] ) );
	$options['slide_effect'] = wp_filter_nohtml_kses( $input['slide_effect'] );
	$options['slide_delay'] = wp_filter_nohtml_kses( intval( $input['slide_delay'] ) );
	$options['slide_duration'] = wp_filter_nohtml_kses( intval( $input['slide_duration'] ) );
	$options['slide_start'] = isset( $input['slide_start'] ) ? 1 : 0;	
	
	return $options;
}

/**
 * Default slider settings.
 *
 * @since 0.1
 */
function responsive_slider_default_settings() {

	/* Retrieve exisitng options, if any. */
	$ex_options = get_option( 'responsive_slider_options' );
	
	/* Check if options are set. Add default values if not. */ 
	if ( !is_array( $ex_options ) || $ex_options['slide_duration'] == '' ) {

		$default_options = array(	
			'slide_width'     => '940',
			'slide_height'    => '400',
			'slide_effect'    => 'fade',
			'slide_delay'     => '7000',
			'slide_duration'  => '600',
			'slide_start'     => 1		
		);	
		
		/* Set the default options. */
		update_option( 'responsive_slider_options', $default_options );
	}	
}

/**
 * Edit slide columns in 'all_items' view.
 *
 * @since 0.1
 */
function responsive_slider_columns( $columns ) {

	$columns = array(
		'cb'       => '<input type="checkbox" />',
		'image'    => __( 'Image', 'responsive-slider' ),
		'title'    => __( 'Title', 'responsive-slider' ),
		'order'    => __( 'Order', 'responsive-slider' ),
		'link'     => __( 'Link', 'responsive-slider' ),
		'date'     => __( 'Date', 'responsive-slider' )
	);

	return $columns;
}

/**
 * Add slide-specific columns to the 'all_items' view.
 *
 * @since 0.1
 */
function responsive_slider_add_columns( $column ) {

	global $post;
	
	/* Get the post edit link for the post. */
	$edit_link = get_edit_post_link( $post->ID );

	/* Add column 'Image'. */
	if ( $column == 'image' )		
		echo '<a href="' . $edit_link . '" title="' . $post->post_title . '">' . get_the_post_thumbnail( $post->ID, array( 60, 60 ), array( 'title' => trim( strip_tags(  $post->post_title ) ) ) ) . '</a>';
	
	/* Add column 'Order'. */	
	if ( $column == 'order' )		
		echo '<a href="' . $edit_link . '">' . $post->menu_order . '</a>';
	
	/* Add column 'Link'. */
	if ( $column == 'link' )		
		echo '<a href="' . get_post_meta( $post->ID, "_slide_link_url", true ) . '" target="_blank" >' . get_post_meta( $post->ID, "_slide_link_url", true ) . '</a>';		
}

/**
 * Order the slides by the 'order' attribute in the 'all_items' column view.
 *
 * @since 0.1.2
 */
function responsive_slider_column_order($wp_query) {
	
	if( is_admin() ) {
		
		$post_type = $wp_query->query['post_type'];
		
		if( $post_type == 'slides' ) {
			$wp_query->set( 'orderby', 'menu_order' );
			$wp_query->set( 'order', 'ASC' );
		}
	}	
}

?>