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


if ( ! class_exists( 'WooCommerce_Plugin_Extension_Boilerplate' ) ) {

	/**
	 * Main Class.
	 */
	class WooCommerce_Plugin_Extension_Boilerplate {


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
         * Method to call and run all the things that you need to fire when your plugin is activated.
         *
         */
        public static function activate() {
            include_once 'includeswoocommerce-plugin-extension-boilerplate-activate.php';
            WooCommerce_Plugin_Extension_Boilerplate_Activate::activate();

        }

        /**
         * Method to call and run all the things that you need to fire when your plugin is deactivated.
         *
         */
        public static function deactivate() {
            include_once 'includes/woocommerce-plugin-extension-boilerplate-deactivate.php';
            WooCommerce_Plugin_Extension_Boilerplate_Deactivate::deactivate();
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
* Hook to run when your plugin is activated
*/
register_activation_hook( __FILE__, array( 'WooCommerce_Plugin_Extension_Boilerplate', 'activate' ) );

/**
* Hook to run when your plugin is deactivated
*/
register_deactivation_hook( __FILE__, array( 'WooCommerce_Plugin_Extension_Boilerplate', 'deactivate' ) );

/**
* Initialize the plugin.
*/
add_action( 'plugins_loaded', array( 'WooCommerce_Plugin_Extension_Boilerplate', 'get_instance' ) );
