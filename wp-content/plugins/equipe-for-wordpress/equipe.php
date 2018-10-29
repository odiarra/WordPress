<?php
/*
Plugin Name: Equipe for Wordpress
Description: Fetch results from Equipe Online.
Version: 2.1
Author: Fredrik Starck
Author URI: http://www.starck.nu
Text Domain: equipe
*/
if( !defined('ABSPATH') ) exit;
global $equipe_current_version;
$equipe_current_version = 2.1;

include_once dirname( __FILE__ ) . '/widget.class.php';
include_once dirname( __FILE__ ) . '/equipe.class.php';

if ( is_admin() )
{
	require_once dirname( __FILE__ ) . '/admin.php';
	require_once dirname( __FILE__ ) . '/install.php';
}

// Installation
register_activation_hook(__FILE__, 'equipe_install_init');
function equipe_install_init() 
{
	equipe_install();
}

// I18n
function equipe_i18n_init() {
	load_plugin_textdomain( 'equipe', false, basename(dirname(__FILE__)).'/languages' );
}
add_action('plugins_loaded', 'equipe_i18n_init');
	
// Load the widget on widgets_init
add_action('widgets_init', 'load_equipe_widget');
function load_equipe_widget() {
	register_widget('EquipeWidget');
}

// Fetch new results from Equipe Online
if( !function_exists('equipe_fetch') )
{
	function equipe_fetch()
	{
		$equipe = new Equipe;
		$equipe->fetch_from_api();
	}
}
register_activation_hook( __FILE__, 'equipe_fetch_from_api_schedule' );
// Schedule the fetch
function equipe_fetch_from_api_schedule()
{
	$timestamp = wp_next_scheduled( 'equipe-fetch-from-api' );
	if( $timestamp == false )
	{
		wp_schedule_event( time(), null, 'equipe-fetch-from-api' ); // Run once now
		wp_schedule_event( strtotime('01:00:00'), 'daily', 'equipe-fetch-from-api' );
	}
}
add_action( 'equipe-fetch-from-api', 'equipe_fetch' );

// Deactivation
register_deactivation_hook( __FILE__, 'equipe_fetch_from_api_deactivation' );
function equipe_fetch_from_api_deactivation() {
	wp_clear_scheduled_hook( 'equipe-fetch-from-api' );
}
?>