<?php
/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 * @package    FCC_BCL
 * @subpackage FCC_BCL/includes
 */
class FCC_BCL_Activator {

    /**
     * Create necessary database tables on plugin activation.
     *
     * @since    1.0.0
     */
    public static function activate() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $labels_table = $wpdb->prefix . 'fcc_labels';
        $companies_table = $wpdb->prefix . 'fcc_companies';

        // SQL for creating tables (unchanged)
        $sql = "CREATE TABLE $labels_table (
            id INT NOT NULL AUTO_INCREMENT,
            company_id INT,
            discounts_and_bundles_url VARCHAR(255),
            acp ENUM('Yes', 'No'),
            customer_support_url VARCHAR(255),
            customer_support_phone VARCHAR(20),
            network_management_url VARCHAR(255),
            privacy_policy_url VARCHAR(255),
            fcc_id VARCHAR(25),
            data_service_id VARCHAR(15),
            data_service_name VARCHAR(255),
            fixed_or_mobile ENUM('Fixed', 'Mobile'),
            data_service_price DECIMAL(10,2),
            billing_frequency_in_months INT,
            introductory_period_in_months INT,
            introductory_price_per_month DECIMAL(10,2),
            contract_duration INT,
            contract_url VARCHAR(255),
            monthly_fees LONGTEXT,
            onetime_fees LONGTEXT,
            early_termination_fee DECIMAL(10,2),
            dl_speed_in_kbps INT,
            ul_speed_in_kbps INT,
            latency_in_ms INT,
            data_included_in_monthly_price INT,
            overage_fee DECIMAL(10,2),
            overage_data_amount INT,
            shortcode VARCHAR(191) UNIQUE,
            created_at DATETIME,
            updated_at DATETIME,
            PRIMARY KEY (id)
        ) $charset_collate;";

        $sql .= "CREATE TABLE $companies_table (
            id INT NOT NULL AUTO_INCREMENT,
            company_name VARCHAR(255),
            customer_support_url VARCHAR(255),
            customer_support_phone VARCHAR(20),
            network_management_url VARCHAR(255),
            privacy_policy_url VARCHAR(255),
            contract_url VARCHAR(255),
            fcc_frn VARCHAR(255),
            created_at DATETIME,
            updated_at DATETIME,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        // Set the initial database version
        add_option('fcc_bcl_db_version', FCC_BCL_VERSION);
    }

    public static function check_version() {
        if (get_option('fcc_bcl_db_version') != FCC_BCL_VERSION) {
            self::upgrade();
        }
    }

    public static function upgrade() {
        $current_version = get_option('fcc_bcl_db_version', '1.0.0');
        
        if (version_compare($current_version, '1.1.0', '<')) {
            self::upgrade_to_110();
        }
        
        // Add more version checks and upgrade functions as needed
        
        update_option('fcc_bcl_db_version', FCC_BCL_VERSION);
    }
    
    private static function upgrade_to_110() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'fcc_labels';
        
        $labels = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
        
        foreach ($labels as $label) {
            $monthly_fees = array();
            $onetime_fees = array();
            
            // Convert existing fee columns to arrays
            for ($i = 1; $i <= 2; $i++) {
                if (!empty($label["monthly_fee_name_$i"]) && !empty($label["monthly_fee_price_$i"])) {
                    $monthly_fees[] = array(
                        'name' => $label["monthly_fee_name_$i"],
                        'price' => $label["monthly_fee_price_$i"]
                    );
                }
                if (!empty($label["onetime_fee_name_$i"]) && !empty($label["onetime_fee_price_$i"])) {
                    $onetime_fees[] = array(
                        'name' => $label["onetime_fee_name_$i"],
                        'price' => $label["onetime_fee_price_$i"]
                    );
                }
            }
            
            // Update the label with new serialized fee data
            $wpdb->update(
                $table_name,
                array(
                    'monthly_fees' => maybe_serialize($monthly_fees),
                    'onetime_fees' => maybe_serialize($onetime_fees),
                ),
                array('id' => $label['id'])
            );
        }
        
        // Remove old columns
        $wpdb->query("ALTER TABLE $table_name 
                      DROP COLUMN monthly_fee_name_1, 
                      DROP COLUMN monthly_fee_price_1, 
                      DROP COLUMN monthly_fee_name_2, 
                      DROP COLUMN monthly_fee_price_2, 
                      DROP COLUMN onetime_fee_name_1, 
                      DROP COLUMN onetime_fee_price_1");
    }
}