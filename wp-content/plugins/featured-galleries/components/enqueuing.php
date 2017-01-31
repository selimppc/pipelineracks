<?php

function fg_enqueue_stuff() {

	wp_enqueue_media();

	wp_enqueue_script( 'fg-script-admin', plugin_dir_url(dirname(__FILE__)).'js/admin.js' );

	wp_localize_script( 'fg-script-admin', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	wp_enqueue_style( 'fg-style-admin', plugin_dir_url(dirname(__FILE__)).'css/admin.css' );

	$show_sidebar = apply_filters( 'fg_show_sidebar', false );

	if ( !$show_sidebar ) { wp_enqueue_style( 'fg-style-admin-hidesidebar', plugin_dir_url(dirname(__FILE__)).'css/admin-hidesidebar.css' ); }

}