<?PHP

error_reporting(E_ALL ^ E_WARNING);

$document_root = $_SERVER['DOCUMENT_ROOT'];

// Construct the path to wp-config.php
$wp_config_path = $document_root . '/wp-config.php';

require_once $wp_config_path;

$productSet = new stdClass();
$productsets = [];

$dirForArt = $_POST['dirArt'];

// Reference id for each entry
$productSet->referenceid = $_POST['referencenumber'];
$productSet->productname = $_POST['productname'];
$productSet->productcode = $_POST['productcode'];
$productSet->producttype = $_POST['producttype'];
$productSet->productcategory = $_POST['productcategory'];

$productSet->front_thumbnail = $_POST['front_thumbnail'];
$productSet->front_body = $_POST['front_body'];
$productSet->front_pattern_i = $_POST['front_pattern_i'];
$productSet->front_pattern_ii = $_POST['front_pattern_ii'];
$productSet->front_outline = $_POST['front_outline'];

$productSet->side_thumbnail = $_POST['side_thumbnail'];
$productSet->side_body = $_POST['side_body'];
$productSet->side_pattern_i = $_POST['side_pattern_i'];
$productSet->side_pattern_ii = $_POST['side_pattern_ii'];
$productSet->side_outline = $_POST['side_outline'];

$productSet->back_thumbnail = $_POST['back_thumbnail'];
$productSet->back_body = $_POST['back_body'];
$productSet->back_pattern_i = $_POST['back_pattern_i'];
$productSet->back_pattern_ii = $_POST['back_pattern_ii'];
$productSet->back_outline = $_POST['back_outline'];


// Front Part
if (isset($_FILES['front_thumbnail']) && $_FILES['front_thumbnail']['error'] === UPLOAD_ERR_OK) {
    $front_thumbnail_name = $_FILES['front_thumbnail']['name'];
    $productSet->front_thumbnail = $front_thumbnail_name;
    move_uploaded_file($_FILES['front_thumbnail']['tmp_name'], 'front_product_images/' . $front_thumbnail_name);
}

if (isset($_FILES['front_body']) && $_FILES['front_body']['error'] === UPLOAD_ERR_OK) {
    $front_body_name = $_FILES['front_body']['name'];
    $productSet->front_body = $front_body_name;
    move_uploaded_file($_FILES['front_body']['tmp_name'], 'front_product_images/' . $front_body_name);
}

if (isset($_FILES['front_pattern_i']) && $_FILES['front_pattern_i']['error'] === UPLOAD_ERR_OK) {
    $front_pattern_i_name = $_FILES['front_pattern_i']['name'];
    $productSet->front_pattern_i = $front_pattern_i_name;
    move_uploaded_file($_FILES['front_pattern_i']['tmp_name'], 'front_product_images/' . $front_pattern_i_name);
}

if (isset($_FILES['front_pattern_ii']) && $_FILES['front_pattern_ii']['error'] === UPLOAD_ERR_OK) {
    $front_pattern_ii_name = $_FILES['front_pattern_ii']['name'];
    $productSet->front_pattern_ii = $front_pattern_ii_name;
    move_uploaded_file($_FILES['front_pattern_ii']['tmp_name'], 'front_product_images/' . $front_pattern_ii_name);
}

if (isset($_FILES['front_outline']) && $_FILES['front_outline']['error'] === UPLOAD_ERR_OK) {
    $front_outline_name = $_FILES['front_outline']['name'];
    $productSet->front_outline = $front_outline_name;
    move_uploaded_file($_FILES['front_outline']['tmp_name'], 'front_product_images/' . $front_outline_name);
}


// Side Part
if (isset($_FILES['side_thumbnail']) && $_FILES['side_thumbnail']['error'] === UPLOAD_ERR_OK) {
    $side_thumbnail_name = $_FILES['side_thumbnail']['name'];
    $productSet->side_thumbnail = $side_thumbnail_name;
    move_uploaded_file($_FILES['side_thumbnail']['tmp_name'], 'side_product_images/' . $side_thumbnail_name);
}
if (isset($_FILES['side_body']) && $_FILES['side_body']['error'] === UPLOAD_ERR_OK) {
    $side_body_name = $_FILES['side_body']['name'];
    $productSet->side_body = $side_body_name;
    move_uploaded_file($_FILES['side_body']['tmp_name'], 'side_product_images/' . $side_body_name);
}
if (isset($_FILES['side_pattern_i']) && $_FILES['side_pattern_i']['error'] === UPLOAD_ERR_OK) {
    $side_pattern_i_name = $_FILES['side_pattern_i']['name'];
    $productSet->side_pattern_i = $side_pattern_i_name;
    move_uploaded_file($_FILES['side_pattern_i']['tmp_name'], 'side_product_images/' . $side_pattern_i_name);
}
if (isset($_FILES['side_pattern_ii']) && $_FILES['side_pattern_ii']['error'] === UPLOAD_ERR_OK) {
    $side_pattern_ii_name = $_FILES['side_pattern_ii']['name'];
    $productSet->side_pattern_ii = $side_pattern_ii_name;
    move_uploaded_file($_FILES['side_pattern_ii']['tmp_name'], 'side_product_images/' . $side_pattern_ii_name);
}
if (isset($_FILES['side_outline']) && $_FILES['side_outline']['error'] === UPLOAD_ERR_OK) {
    $side_outline_name = $_FILES['side_outline']['name'];
    $productSet->side_outline = $side_outline_name;
    move_uploaded_file($_FILES['side_outline']['tmp_name'], 'side_product_images/' . $side_outline_name);
}

// Repeat the same process for other side part file uploads...

// Back Part
if (isset($_FILES['back_thumbnail']) && $_FILES['back_thumbnail']['error'] === UPLOAD_ERR_OK) {
    $back_thumbnail_name = $_FILES['back_thumbnail']['name'];
    $productSet->back_thumbnail = $back_thumbnail_name;
    move_uploaded_file($_FILES['back_thumbnail']['tmp_name'], 'back_product_images/' . $back_thumbnail_name);
}
if (isset($_FILES['back_body']) && $_FILES['back_body']['error'] === UPLOAD_ERR_OK) {
    $back_body_name = $_FILES['back_body']['name'];
    $productSet->back_body = $back_body_name;
    move_uploaded_file($_FILES['back_body']['tmp_name'], 'back_product_images/' . $back_body_name);
}
if (isset($_FILES['back_pattern_i']) && $_FILES['back_pattern_i']['error'] === UPLOAD_ERR_OK) {
    $back_pattern_i_name = $_FILES['back_pattern_i']['name'];
    $productSet->back_pattern_i = $back_pattern_i_name;
    move_uploaded_file($_FILES['back_pattern_i']['tmp_name'], 'back_product_images/' . $back_pattern_i_name);
}
if (isset($_FILES['back_pattern_ii']) && $_FILES['back_pattern_ii']['error'] === UPLOAD_ERR_OK) {
    $back_pattern_ii_name = $_FILES['back_pattern_ii']['name'];
    $productSet->back_pattern_ii = $back_pattern_ii_name;
    move_uploaded_file($_FILES['back_pattern_ii']['tmp_name'], 'back_product_images/' . $back_pattern_ii_name);
}
if (isset($_FILES['back_outline']) && $_FILES['back_outline']['error'] === UPLOAD_ERR_OK) {
    $back_outline_name = $_FILES['back_outline']['name'];
    $productSet->back_outline = $back_outline_name;
    move_uploaded_file($_FILES['back_outline']['tmp_name'], 'back_product_images/' . $back_outline_name);
}

try {
    
    global $wpdb;

    $table_name = $wpdb->prefix.'product_set';
    
    $data = array(
        'referenceid' => $productSet->referenceid,
        'productname' => $productSet->productname,
        'itemcode' => $productSet->productcode,
        'producttype' => $productSet->producttype,
        'productcategory' => $productSet->productcategory,
        'front_thumbnail' => $productSet->front_thumbnail,
        'front_body' => $productSet->front_body,
        'front_pattern_i' => $productSet->front_pattern_i,
        'front_pattern_ii' => $productSet->front_pattern_ii,
        'front_outline' => $productSet->front_outline,
        'side_thumbnail' => $productSet->side_thumbnail,
        'side_body' => $productSet->side_body,
        'side_pattern_i' => $productSet->side_pattern_i,
        'side_pattern_ii' => $productSet->side_pattern_ii,
        'side_outline' => $productSet->side_outline,
        'back_thumbnail' => $productSet->back_thumbnail,
        'back_body' => $productSet->back_body,
        'back_pattern_i' => $productSet->back_pattern_i,
        'back_pattern_ii' => $productSet->back_pattern_ii,
        'back_outline' => $productSet->back_outline,
        'created_at' => 'CURRENT_TIMESTAMP',
        'updated_at' => 'CURRENT_TIMESTAMP'

    );

    $result = $wpdb->insert($table_name, $data);
    
    if ($result !== false) {
        // Success, redirect to the desired location
        wp_safe_redirect(wp_get_referer());
        exit;
    } else {
        // An error occurred while creating the product code
        // header("Location: DIY.productset.php?error=An error occurred while creating the product code");
        exit;
    }

} catch (Exception $e) {
    // Handle any exceptions that occur during the database operation
    echo $e->getMessage();
}
?>