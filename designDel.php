<?php
// Include WordPress core files
require_once('../../../wp-load.php');

if (isset($_POST['imageName'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'design_img';
    $image_name = sanitize_text_field($_POST['imageName']);
    echo $image_name;
    // Delete the image record based on its name
    $result = $wpdb->delete($table_name, array('name' => $image_name));

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'Invalid request.';
}
?>
