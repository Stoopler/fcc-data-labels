<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @package    FCC_BCL
 * @subpackage FCC_BCL/admin
 */
class FCC_BCL_Admin {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style('fcc-bcl-admin', FCC_BCL_PLUGIN_URL . 'admin/css/fcc-bcl-admin.css', array(), FCC_BCL_VERSION, 'all');
        wp_enqueue_style('fcc-bcl-label-preview', FCC_BCL_PLUGIN_URL . 'admin/css/fcc-bcl-label-preview.css', array(), FCC_BCL_VERSION, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script('fcc-bcl-admin', FCC_BCL_PLUGIN_URL . 'admin/js/fcc-bcl-admin.js', array('jquery'), FCC_BCL_VERSION, false);
        wp_enqueue_script('fcc-bcl-label-preview', FCC_BCL_PLUGIN_URL . 'admin/js/fcc-bcl-label-preview.js', array('jquery'), FCC_BCL_VERSION, false);
    }

    /**
     * Add menu items to the admin area.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {
        add_menu_page(
            'FCC Labels',
            'FCC Labels',
            'manage_options',
            'fcc-bcl-add-label',
            array($this, 'display_add_label_page'),
            'dashicons-tag',
            6
        );
    
        add_submenu_page(
            'fcc-bcl-add-label',
            'Add New Label',
            'Add New Label',
            'manage_options',
            'fcc-bcl-add-label',
            array($this, 'display_add_label_page')
        );
    
        add_submenu_page(
            'fcc-bcl-add-label',
            'Manage Labels',
            'Manage Labels',
            'manage_options',
            'fcc-bcl-manage-labels',
            array($this, 'display_manage_labels_page')
        );
    
        add_submenu_page(
            'fcc-bcl-add-label',
            'Manage Companies',
            'Manage Companies',
            'manage_options',
            'fcc-bcl-companies',
            array($this, 'display_company_config_page')
        );
    
        // Add "Add Company" as a hidden item
        add_submenu_page(
            'fcc-bcl-companies',
            'Add New Company',
            'Add New Company',
            'manage_options',
            'fcc-bcl-add-company',
            array($this, 'display_add_company_page')
        );
    
        // Keep the edit company page as a hidden item
        add_submenu_page(
            'fcc-bcl-companies',
            'Edit Company',
            'Edit Company',
            'manage_options',
            'fcc-bcl-edit-company',
            array($this, 'display_edit_company_page')
        );
    }

    /**
     * Display the add company page
     *
     * @since    1.0.0
     */
    public function display_add_company_page() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        include_once('partials/fcc-bcl-add-company.php');
    }

    /**
     * Render the add label page.
     *
     * @since    1.0.0
     */
    public function display_add_label_page() {
        if (isset($_POST['fcc_bcl_add_label'])) {
            // Verify nonce
            if (!isset($_POST['fcc_bcl_add_label_nonce']) || !wp_verify_nonce($_POST['fcc_bcl_add_label_nonce'], 'fcc_bcl_add_label')) {
                wp_die('Security check failed');
            }

            // Process and sanitize form data
            $label_data = $this->process_label_form_data($_POST);

            // Save label data to database
            $result = $this->save_label_data($label_data);

            if ($result) {
                add_settings_error('fcc_bcl_messages', 'fcc_bcl_message', __('Label added successfully', 'fcc-bcl'), 'updated');
            } else {
                add_settings_error('fcc_bcl_messages', 'fcc_bcl_message', __('Error adding label', 'fcc-bcl'), 'error');
            }
        }

        $companies = $this->get_companies();
        include_once('partials/fcc-bcl-add-label.php');
    }

    /**
     * Render the manage labels page.
     *
     * @since    1.0.0
     */
    public function display_manage_labels_page() {
        include_once('partials/fcc-bcl-manage-labels.php');
    }

    /**
     * Render the company configuration page.
     *
     * @since    1.0.0
     */
    public function display_company_config_page() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        include_once('partials/fcc-bcl-company-config.php');
    }

    /**
     * Render the edit company page.
     *
     * @since    1.0.0
     */
    public function display_edit_company_page() {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $company_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $company = $this->get_company_by_id($company_id);

        if (!$company) {
            wp_die(__('Company not found.'));
        }

        include_once('partials/fcc-bcl-edit-company.php');
    }

    /**
     * Get a company by its ID.
     *
     * @since    1.0.0
     * @param    int    $id    The company ID.
     * @return   array|false   The company data or false if not found.
     */
    private function get_company_by_id($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fcc_companies';

        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id), ARRAY_A);
    }

    /**
     * Get all companies from the database.
     *
     * @since    1.0.0
     * @return   array    An array of company data.
     */
    private function get_companies() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fcc_companies';

        $companies = $wpdb->get_results("SELECT * FROM $table_name ORDER BY company_name ASC", ARRAY_A);

        return $companies;
    }

    /**
     * Process and sanitize company form data.
     *
     * @since    1.0.0
     * @param    array    $post_data    The raw POST data.
     * @return   array                  The sanitized company data.
     */
    private function process_company_form_data($post_data) {
        $company_data = array(
            'company_name' => sanitize_text_field($post_data['company_name']),
            'customer_support_url' => esc_url_raw($post_data['customer_support_url']),
            'customer_support_phone' => sanitize_text_field($post_data['customer_support_phone']),
            'network_management_url' => esc_url_raw($post_data['network_management_url']),
            'privacy_policy_url' => esc_url_raw($post_data['privacy_policy_url']),
            'contract_url' => esc_url_raw($post_data['contract_url']),
            'fcc_frn' => sanitize_text_field($post_data['fcc_frn']),
        );

        return $company_data;
    }

    /**
     * Save or update company data in the database.
     *
     * @since    1.0.0
     * @param    array    $company_data    The sanitized company data.
     * @param    int      $company_id      The company ID (0 for new companies).
     * @return   bool                      True on success, false on failure.
     */
    private function save_company_data($company_data, $company_id = 0) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fcc_companies';

        $company_data['updated_at'] = current_time('mysql');

        if ($company_id > 0) {
            // Update existing company
            $result = $wpdb->update($table_name, $company_data, array('id' => $company_id));
        } else {
            // Insert new company
            $company_data['created_at'] = current_time('mysql');
            $result = $wpdb->insert($table_name, $company_data);
        }

        return $result !== false;
    }

    /**
     * Get all labels from the database.
     *
     * @since    1.0.0
     * @return   array    An array of label data.
     */
    private function get_all_labels() {
        global $wpdb;
        $labels_table = $wpdb->prefix . 'fcc_labels';
        $companies_table = $wpdb->prefix . 'fcc_companies';

        $labels = $wpdb->get_results(
            "SELECT l.*, c.company_name
            FROM $labels_table l
            LEFT JOIN $companies_table c ON l.company_id = c.id
            ORDER BY l.id DESC",
            ARRAY_A
        );

        return $labels;
    }

    /**
     * Process and sanitize label form data.
     *
     * @since    1.0.0
     * @param    array    $post_data    The raw POST data.
     * @return   array                  The sanitized label data.
     */
    private function process_label_form_data($post_data) {
        $label_data = array(
            'company_id' => isset($post_data['company_id']) ? intval($post_data['company_id']) : 0,
            'discounts_and_bundles_url' => isset($post_data['discounts_and_bundles_url']) ? esc_url_raw($post_data['discounts_and_bundles_url']) : '',
            'acp' => isset($post_data['acp']) ? sanitize_text_field($post_data['acp']) : '',
            'fcc_id' => isset($post_data['fcc_id']) ? sanitize_text_field($post_data['fcc_id']) : '',
            'data_service_id' => isset($post_data['data_service_id']) ? sanitize_text_field($post_data['data_service_id']) : '',
            'data_service_name' => isset($post_data['data_service_name']) ? sanitize_text_field($post_data['data_service_name']) : '',
            'fixed_or_mobile' => isset($post_data['fixed_or_mobile']) ? sanitize_text_field($post_data['fixed_or_mobile']) : '',
            'data_service_price' => isset($post_data['data_service_price']) ? floatval($post_data['data_service_price']) : 0.0,
            'billing_frequency_in_months' => isset($post_data['billing_frequency_in_months']) ? intval($post_data['billing_frequency_in_months']) : 1,
            'introductory_period_in_months' => isset($post_data['introductory_period_in_months']) ? intval($post_data['introductory_period_in_months']) : 0,
            'introductory_price_per_month' => isset($post_data['introductory_price_per_month']) ? floatval($post_data['introductory_price_per_month']) : 0.0,
            'contract_duration' => isset($post_data['contract_duration']) ? intval($post_data['contract_duration']) : 0,
            'monthly_fees' => array(),
            'onetime_fees' => array(),
            'early_termination_fee' => isset($post_data['early_termination_fee']) ? floatval($post_data['early_termination_fee']) : 0.0,
            'dl_speed_in_kbps' => isset($post_data['dl_speed_in_kbps']) ? intval($post_data['dl_speed_in_kbps']) : 0,
            'ul_speed_in_kbps' => isset($post_data['ul_speed_in_kbps']) ? intval($post_data['ul_speed_in_kbps']) : 0,
            'latency_in_ms' => isset($post_data['latency_in_ms']) ? intval($post_data['latency_in_ms']) : 0,
            'data_included_in_monthly_price' => isset($post_data['data_included_in_monthly_price']) ? intval($post_data['data_included_in_monthly_price']) : 0,
            'overage_fee' => isset($post_data['overage_fee']) ? floatval($post_data['overage_fee']) : 0.0,
            'overage_data_amount' => isset($post_data['overage_data_amount']) ? intval($post_data['overage_data_amount']) : 0,
            'shortcode' => $this->generate_unique_shortcode(),
        );

        // Process monthly fees
        if (isset($post_data['monthly_fee_name']) && is_array($post_data['monthly_fee_name'])) {
            foreach ($post_data['monthly_fee_name'] as $key => $name) {
                if (!empty($name) && isset($post_data['monthly_fee_price'][$key])) {
                    $label_data['monthly_fees'][] = array(
                        'name' => sanitize_text_field($name),
                        'price' => floatval($post_data['monthly_fee_price'][$key])
                    );
                }
            }
        }

        // Process one-time fees
        if (isset($post_data['onetime_fee_name']) && is_array($post_data['onetime_fee_name'])) {
            foreach ($post_data['onetime_fee_name'] as $key => $name) {
                if (!empty($name) && isset($post_data['onetime_fee_price'][$key])) {
                    $label_data['onetime_fees'][] = array(
                        'name' => sanitize_text_field($name),
                        'price' => floatval($post_data['onetime_fee_price'][$key])
                    );
                }
            }
        }

        return $label_data;
    }

    /**
     * Generate a unique shortcode for the label.
     *
     * @since    1.0.0
     * @return   string    A unique shortcode.
     */
    private function generate_unique_shortcode() {
        $prefix = 'fcc_bcl_';
        $unique_id = uniqid();
        return $prefix . $unique_id;
    }

    private function render_plan_information($companies) {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/plan-information.php';
    }
    
    private function render_plan_speed() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/plan-speed.php';
    }
    
    private function render_plan_data() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/plan-data.php';
    }
    
    private function render_plan_pricing() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/plan-pricing.php';
    }
    
    private function render_plan_contract() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/plan-contract.php';
    }
    
    private function render_customer_support() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/customer-support.php';
    }
    
    private function render_monthly_fees() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/monthly-fees.php';
    }
    
    private function render_onetime_fees() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/onetime-fees.php';
    }
    
    private function render_discounts_and_bundles() {
        include FCC_BCL_PLUGIN_DIR . 'admin/partials/form-sections/discounts-and-bundles.php';
    }

    /**
     * Save label data to the database.
     *
     * @since    1.0.0
     * @param    array    $label_data    The sanitized label data.
     * @return   bool                    True on success, false on failure.
     */
    private function save_label_data($label_data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fcc_labels';

        // Prepare the data for insertion/update
        $data = array(
            'company_id' => $label_data['company_id'],
            'discounts_and_bundles_url' => $label_data['discounts_and_bundles_url'],
            'acp' => $label_data['acp'],
            'fcc_id' => $label_data['fcc_id'],
            'data_service_id' => $label_data['data_service_id'],
            'data_service_name' => $label_data['data_service_name'],
            'fixed_or_mobile' => $label_data['fixed_or_mobile'],
            'data_service_price' => $label_data['data_service_price'],
            'billing_frequency_in_months' => $label_data['billing_frequency_in_months'],
            'introductory_period_in_months' => $label_data['introductory_period_in_months'],
            'introductory_price_per_month' => $label_data['introductory_price_per_month'],
            'contract_duration' => $label_data['contract_duration'],
            'monthly_fees' => maybe_serialize($label_data['monthly_fees']),
            'onetime_fees' => maybe_serialize($label_data['onetime_fees']),
            'early_termination_fee' => $label_data['early_termination_fee'],
            'dl_speed_in_kbps' => $label_data['dl_speed_in_kbps'],
            'ul_speed_in_kbps' => $label_data['ul_speed_in_kbps'],
            'latency_in_ms' => $label_data['latency_in_ms'],
            'data_included_in_monthly_price' => $label_data['data_included_in_monthly_price'],
            'overage_fee' => $label_data['overage_fee'],
            'overage_data_amount' => $label_data['overage_data_amount'],
            'shortcode' => $label_data['shortcode'],
            'updated_at' => current_time('mysql'),
        );

        $format = array(
            '%d', // company_id
            '%s', // discounts_and_bundles_url
            '%s', // acp
            '%s', // fcc_id
            '%s', // data_service_id
            '%s', // data_service_name
            '%s', // fixed_or_mobile
            '%f', // data_service_price
            '%d', // billing_frequency_in_months
            '%d', // introductory_period_in_months
            '%f', // introductory_price_per_month
            '%d', // contract_duration
            '%s', // monthly_fees
            '%s', // onetime_fees
            '%f', // early_termination_fee
            '%d', // dl_speed_in_kbps
            '%d', // ul_speed_in_kbps
            '%d', // latency_in_ms
            '%d', // data_included_in_monthly_price
            '%f', // overage_fee
            '%d', // overage_data_amount
            '%s', // shortcode
            '%s', // updated_at
        );

        if (isset($label_data['id'])) {
            // Update existing record
            $wpdb->update($table_name, $data, array('id' => $label_data['id']), $format, array('%d'));
            return $label_data['id'];
        } else {
            // Insert new record
            $data['created_at'] = current_time('mysql');
            $wpdb->insert($table_name, $data, $format);
            return $wpdb->insert_id;
        }
    }  
}