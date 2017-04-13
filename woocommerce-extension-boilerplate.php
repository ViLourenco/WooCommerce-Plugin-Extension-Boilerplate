<?php
/**
 * Plugin Name: WooCommerce Extension Plugin Boilerplate
 * Version: 1.0.0
 * Plugin URI: https://blog.vilourenco.com.br
 * Description: Woo Extension Plugin Boilerplate
 * Author: Vinícius Lourenço
 * Author URI: https://blog.vilourenco.com.br
 * Requires at least: 4.4.0
 * Tested up to: 4.6.0
 *
 * Text Domain: woo-extension-plugin-boilerplate
 * Domain Path: /languages
 *
 * @package WordPress
 * @author  Vinícius Lourenço
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'WooCommerce_Extension_Plugin_Boilerplate' ) ) {

	/**
	 * Main Class.
	 */
	class WooCommerce_Extension_Plugin_Boilerplate {


		/**
		* Plugin version.
		*
		* @var string
		*/
		const VERSION = '1.0.0';


		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Return an instance of this class.
		 *
		 * @return object single instance of this class.
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		private function __construct() {
			if ( ! class_exists( 'WooCommerce' ) ) {
				add_action( 'admin_notices', array( $this, 'fallback_notice' ) );
			} else {
				$this->load_plugin_textdomain();
				$this->includes();
			}
		}

		/**
		 * Method to includes our dependencies.
		 *
		 * @var string
		 */
		public function includes() {
			include_once 'includes/woocommerce-extension-functionality.php';
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @access public
		 * @return bool
		 */
		public function load_plugin_textdomain() {
			$locale = apply_filters( 'wepb_plugin_locale', get_locale(), 'woocommerce-extension-plugin-boilerplate' );

			//load_textdomain( 'woo-extension-plugin-boilerplate', trailingslashit( WP_LANG_DIR ) . 'woocommerce-extension-plugin-boilerplate/woocommerce-extension-plugin-boilerplate' . '-' . $locale . '.mo' );

			//load_plugin_textdomain( 'woocommerce-extension-plugin-boilerplate', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

			return true;
		}

		/**
		 * Fallback notice.
		 *
		 * We need some plugins to work, and if any isn't active we'll show you!
		 */
		public function fallback_notice() {
			echo '<div class="error">';
			echo '<p>' . __( 'Woo Extension Plugin Boilerplate: Needs the WooCommerce Plugin activated.', 'woo-extension-plugin-boilerplate' ) . '</p>';
			echo '</div>';
		}
	}
}

/**
* Initialize the plugin.
*/
add_action( 'plugins_loaded', array( 'WooCommerce_Extension_Plugin_Boilerplate', 'get_instance' ) );
