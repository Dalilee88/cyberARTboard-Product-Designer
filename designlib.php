<?PHP
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$document_root = $_SERVER['DOCUMENT_ROOT'];

// Construct the path to wp-config.php
$wp_config_path = $document_root . '/wp-config.php';

require_once $wp_config_path;

// Define the upload directory path
// $upload_dir = wp_upload_dir();

$plugin_url_dirForDesign = plugin_dir_url( __FILE__ ). 'upload_directory';

// Create your custom directory within the uploads folder
$custom_dir = $plugin_url_dirForDesign ;

chmod($custom_dir, 0755);

if (!file_exists($custom_dir)) {
    wp_mkdir_p($custom_dir);
}

if (isset($_POST['upload_image'])) {
    $Originalfile = $_FILES["image_file"];
    $image_name = $_FILES["image_file"]["name"];
    $image_temp = $_FILES["image_file"]["tmp_name"];
    $image_type = $Originalfile["type"];

    // Check if a file was uploaded
    if (empty($image_temp)) {
        echo 'No file was uploaded.';
    } else {
        // Create a unique filename to avoid overwriting
        $unique_filename = wp_unique_filename($custom_dir, $image_name);

        // Construct the local destination path
        $image_path = $custom_dir . '/' . $unique_filename;

        // echo $image_path.' / / '.$image_temp.' / / '.$unique_filename ;
        // die();

        // Move the uploaded file from the temporary directory to the custom directory
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], 'upload_directory/'.$image_name)) {
            // Insert image info into the database
            global $wpdb;
            $table_name = $wpdb->prefix . 'design_img';
            $inserted = $wpdb->insert($table_name, array(
                'name' => $image_name,
                'type' => $image_type,
                'content' => $image_path
            ));

            if ($inserted) {
                // Redirect back to the previous page
                wp_safe_redirect(wp_get_referer());
                exit;
            } else {
                // Handle the database insertion error
                echo 'Database insertion failed.';
            }
        } else {
            // Handle the file move error
            echo 'File upload failed. Check directory permissions.';
        }
    }
}


?>
