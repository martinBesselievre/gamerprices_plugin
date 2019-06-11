<?php
/*
 * Plugin Name: GamerPrices
 * Plugin URI: https://www.gamerprices.com
 * Description: Description <strong>GamerPrices</strong>
 * Version: 1.0
 * Author: GamerPrices
 * Text Domain: gamerprices
 * Domain Path : /languages
 */

// 
if (! function_exists ( 'add_action' )) {
	exit ();
}

define ( 'GAMERPRICES_VERSION', '1.0' );
define ( 'GAMERPRICES__MINIMUM_WP_VERSION', '3.0' );
define ( 'GAMERPRICES__PLUGIN_URL', plugin_dir_url ( __FILE__ ) );
define ( 'GAMERPRICES__PLUGIN_DIR', plugin_dir_path ( __FILE__ ) );

require_once (GAMERPRICES__PLUGIN_DIR . 'class-gp.php');

register_activation_hook ( __FILE__, array (
	'GamerPrices',
	'plugin_activation' 
) );
register_deactivation_hook ( __FILE__, array (
	'GamerPrices',
	'plugin_deactivation' 
) );

//Bootstrap shortcode feature
require_once (GAMERPRICES__PLUGIN_DIR . 'class-gp-productbox-shortcode.php');
add_action ( 'init', array (
	'GP_Product_Box_Shortcode',
	'init'
) );

require_once (GAMERPRICES__PLUGIN_DIR . 'class-gp-gamebox-shortcode.php');
add_action ('init', array(
	'GP_Game_Box_Shortcode',
	'init'
));

