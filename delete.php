<?PHP
                   
                    $wp_load_path = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';
                    if (file_exists($wp_load_path)) {
                        // Include the wp-load.php file
                        require_once($wp_load_path);
                        $plugin_url = plugin_dir_url( __FILE__ );
                        // Access the WordPress environment, including the global $wpdb object
                        global $wpdb;
                        $refid = $_GET['id'];
                        $table_name = $wpdb->prefix . 'product_set';
                        // Execute the DELETE statement
                        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE referenceid = %s", $refid));

                        // Check the affected rows to determine if the deletion was successful
                        if ($wpdb->rows_affected > 0) {
                            wp_safe_redirect(wp_get_referer());
                        } else {
                            echo 'Failed to delete record.';
                        }
                    }
?>