<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @package    FCC_BCL
 * @subpackage FCC_BCL/public
 */
require_once FCC_BCL_PLUGIN_DIR . 'includes/class-fcc-bcl-label-template.php';

class FCC_BCL_Public {

    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->version = FCC_BCL_VERSION;
        add_action('wp_enqueue_scripts', array($this, 'enqueue_label_styles'));
        add_shortcode('fcc_bcl', array($this, 'render_label'));
    }

    /**
     * Render the FCC Broadband Consumer Label.
     *
     * @since    1.0.0
     * @param    array    $atts    Shortcode attributes.
     * @return   string            The HTML output for the label.
     */
    public function render_label($atts) {
        $atts = shortcode_atts(array(
            'id' => 0,
        ), $atts, 'fcc_bcl');

        $label_id = intval($atts['id']);

        if ($label_id <= 0) {
            return '<p>Invalid label ID.</p>';
        }

        $label_data = $this->get_label_data($label_id);

        if (!$label_data) {
            return '<p>Label not found.</p>';
        }

        return FCC_BCL_Label_Template::generate_label_html($label_data);
    }

    /**
     * Retrieve label data from the database.
     *
     * @since    1.0.0
     * @param    int      $label_id    The ID of the label to retrieve.
     * @return   array|false           The label data or false if not found.
     */
    private function get_label_data($label_id) {
        global $wpdb;
        $labels_table = $wpdb->prefix . 'fcc_labels';
        $companies_table = $wpdb->prefix . 'fcc_companies';
        
        $query = $wpdb->prepare(
            "SELECT l.*, c.company_name 
            FROM $labels_table l
            LEFT JOIN $companies_table c ON l.company_id = c.id
            WHERE l.id = %d",
            $label_id
        );
        
        $label = $wpdb->get_row($query, ARRAY_A);

        return $label;
    }

    /**
     * Enqueue label styles.
     *
     * @since    1.0.0
     */
    public function enqueue_label_styles() {
        global $post;
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'fcc_bcl')) {
            wp_enqueue_style('fcc-bcl-label-style', plugin_dir_url(__FILE__) . 'css/fcc-bcl-label.css', array(), $this->version, 'all');
        }
    }
}
