<?php
/*
Plugin Name: WP-SPDX specifications
Description: Render the static html specification in a wordpress website.
Version: 1.0
Author: Salima Rouhiyyeh
License: GPL 2
*/

require_once ( 'html-importer.php' );
require_once ( 'html-import-options.php' );

// plugin_activation_check()
function html_import_activation_check() {
	if ( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) ); // Deactivate myself
		wp_die( "Sorry, but you can't run this plugin, it requires PHP 5 or higher.", 'import-html-pages' );
	}
}
register_activation_hook( __FILE__, 'html_import_activation_check' );

// Option page styles
function html_import_css() {
    wp_register_style( 'html-import-css', plugins_url( 'html-import-styles.css', __FILE__ ) );

}
function add_html_import_styles() {
    wp_enqueue_style( 'html-import-css' );
}
add_action( 'admin_init', 'html_import_css' );

// Option page scripts
function html_import_scripts() {
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'html-import-tabs', plugins_url( 'js/tabs.js', __FILE__ ), array( 'jquery', 'jquery-ui-tabs' ) );
}

// set default options
function html_import_set_defaults() {
	$options = html_import_get_options();
	add_option( 'html_import', $options, '', 'no' );
}
register_activation_hook( __FILE__, 'html_import_set_defaults' );

//register our settings
function register_html_import_settings() {
	register_setting( 'html_import', 'html_import', 'html_import_validate_options' );
}

// when uninstalled, remove option
function html_import_remove_options() {
	delete_option( 'html_import' );
}
register_uninstall_hook( __FILE__, 'html_import_remove_options' );
// for testing only
// register_deactivation_hook( __FILE__, 'html_import_remove_options' );

function html_import_add_pages() {
// Add option page to admin menu
	$pg = add_options_page( __( 'SPDX Specs', 'import-html-pages' ), __( 'SPDX Specs', 'import-html-pages' ), 'manage_options', basename( __FILE__ ), 'html_import_options_page' );

// Add styles and scripts
	add_action( 'admin_print_styles-'.$pg, 'add_html_import_styles' );
	add_action( 'admin_print_scripts-'.$pg, 'html_import_scripts' );

// register setting
	add_action( 'admin_init', 'register_html_import_settings' );

//	add_contextual_help( $pg, $text );
}
add_action( 'admin_menu', 'html_import_add_pages' );

// Add link to options page from plugin list
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'html_import_plugin_actions' );
function html_import_plugin_actions( $links ) {
	$new_links = array();
	$new_links[] = sprintf( '<a href="options-general.php?page=html-import.php">%s</a>', __( 'Settings', 'html-import' ) );
	return array_merge( $new_links, $links );
}
