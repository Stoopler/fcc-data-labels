<?php
/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    FCC_BCL
 * @subpackage FCC_BCL/includes
 */
class FCC_BCL {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      FCC_BCL_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * Define the core functionality of the plugin.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        require_once FCC_BCL_PLUGIN_DIR . 'includes/class-fcc-bcl-loader.php';
        require_once FCC_BCL_PLUGIN_DIR . 'admin/class-fcc-bcl-admin.php';
        require_once FCC_BCL_PLUGIN_DIR . 'public/class-fcc-bcl-public.php';

        $this->loader = new FCC_BCL_Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new FCC_BCL_Admin();

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {
        $plugin_public = new FCC_BCL_Public();

        // Add the shortcode directly using WordPress function
        add_shortcode('fcc_bcl', array($plugin_public, 'render_label'));
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }
}