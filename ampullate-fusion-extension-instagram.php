<?php
/**
 * @package Fusion_Extension_Instagram
 */

/**
 * Plugin Name: Fusion : Extension - Instagram (by Ampullate)
 * Plugin URI: https://ampullate.com/wordpress-plugins/ampullate-fusion-extension-instagram
 * Description: Instagram Extension Package for Fusion. Requires <a href="https://wordpress.org/plugins/instagram-feed/" taget="_blank">Instagram Feed</a> or <a href="https://smashballoon.com/instagram-feed/s" taget="_blank">Instagram Feed Pro</a> to be installed, activated and configured for the feeds desired.
 * Version: 1.0.0
 * Author: Ampullate Inc.
 * Author URI: http://ampullate.com
 * Text Domain: ampullate-fusion-extension-instagram
 * Domain Path: /languages/
 * License: GPL2
 */

define('AMP_FUSION_EXTN_INSTAGRAM_VERSION', '1.0.0');

/**
 * FusionExtensionInstagram class.
 *
 * Class for initializing an instance of the Fusion Instagram Extension.
 *
 * @since 1.0.0
 */
class FusionExtensionInstagram	{
	public function __construct() {

		// Initialize the language files
		add_action('plugins_loaded', array($this, 'load_textdomain'));

		// Enqueue front end scripts and styles
		add_action('wp_enqueue_scripts', array($this, 'front_enqueue_scripts_styles'));

	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.0
	 *
	 */

	public function load_textdomain() {
		load_plugin_textdomain( 'ampullate-fusion-extension-instagram', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Enqueue JavaScript and CSS on Front End pages.
	 *
	 * @since 1.0.0
	 *
	 */

	public function front_enqueue_scripts_styles() {
		//scripts
		//wp_register_script( 'fsn_instagram', plugin_dir_url( __FILE__ ) . 'includes/js/fusion-extension-instagram.js', array('jquery','fsn_core'), AMP_FUSION_EXTN_INSTAGRAM_VERSION, true );
		//styles
		//wp_enqueue_style( 'fsn_instagram', plugin_dir_url( __FILE__ ) . 'includes/css/fusion-extension-instagram.css', false, AMP_FUSION_EXTN_INSTAGRAM_VERSION );
	}

}

$fsn_extension_instagram = new FusionExtensionInstagram();

//EXTENSIONS

//Instagram
require_once('includes/extensions/instagram.php');

?>
