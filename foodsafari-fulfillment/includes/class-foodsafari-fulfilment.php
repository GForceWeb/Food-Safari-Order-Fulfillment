<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://g-force.net
 * @since      1.0.0
 *
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Foodsafari_Fulfilment
 * @subpackage Foodsafari_Fulfilment/includes
 * @author     Grant Derepas <grant@g-force.net>
 */
class Foodsafari_Fulfilment {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Foodsafari_Fulfilment_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'foodsafari-fulfilment';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Foodsafari_Fulfilment_Loader. Orchestrates the hooks of the plugin.
	 * - Foodsafari_Fulfilment_i18n. Defines internationalization functionality.
	 * - Foodsafari_Fulfilment_Admin. Defines all hooks for the admin area.
	 * - Foodsafari_Fulfilment_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-foodsafari-fulfilment-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-foodsafari-fulfilment-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-foodsafari-fulfilment-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-foodsafari-fulfilment-public.php';

		$this->loader = new Foodsafari_Fulfilment_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Foodsafari_Fulfilment_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Foodsafari_Fulfilment_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Foodsafari_Fulfilment_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Foodsafari_Fulfilment_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		//CRON TASKS
		$this->loader->add_filter('cron_schedules', $plugin_public, 'ff_cron_schedules');
		$this->loader->add_action( 'ff_weekly_report', $plugin_public,  'ff_weeklyReport' );
		$this->loader->add_action( 'ff_daily_cron', $plugin_public,  'ff_monthlyReport' );
		$this->loader->add_action( 'ff_daily_cron', $plugin_public,  'ff_fulfilmentCron' );
		$this->loader->add_action( 'ff_rezdy_sync', $plugin_public,  'ff_rezdySync' );

		//Shortcodes
		$this->loader->add_action( 'init', $plugin_public, 'ff_register_shortcodes' );

		//Admin Ajax
		$this->loader->add_action("wp_ajax_rezdysync", $plugin_public, "ff_manualrezdysync");
		$this->loader->add_action("wp_ajax_nopriv_rezdysync", $plugin_public, "my_must_login");
		$this->loader->add_action("wp_ajax_send_fulfillment", $plugin_public, "send_fulfillment");
		$this->loader->add_action("wp_ajax_nopriv_send_fulfillment", $plugin_public, "my_must_login");
		$this->loader->add_action("wp_ajax_ff_markFulfilment", $plugin_public, "ff_markFulfilment");
		$this->loader->add_action("wp_ajax_nopriv_ff_markFulfilment", $plugin_public, "my_must_login");


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Foodsafari_Fulfilment_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
