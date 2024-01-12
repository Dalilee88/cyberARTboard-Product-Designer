<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category View</title>
    <style>
        body{
            font-family: verdana;
        }
        h2{
            color:coral;
            font-weight: lighter;
        }
        .product-set{
            background-color: #DDE6ED;
            width: 90%!important;
            margin: 0px;
            padding:5px;
        }
        p{
            display: inline-block;
        }
        .itemcode-search{
            float: right;
        }
        #productcode{
            width: 200px;
            height: 30px;
            font-size: small;
            padding-left: 10px;
            outline-style: none;
            border-radius: 25px;
            border:1px solid black;
            text-transform: uppercase;
        }
        #productcode::placeholder{
            text-transform: capitalize;
        }
    </style>
    <style>
        small{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .product-catogory-item-container{
            background-color:transparent;
            width: fit-content;
        }
        .product-catogory-item-container a{
            display: inline-block;
            text-decoration: none;
        }
        .pro-list{
            background-position: center;
            background-size: 210px 250px;
            background-repeat: no-repeat;
            width:200px;
            height:280px;
            margin:05px;
            padding:05px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pro-list-product{
            background-position: center;
            background-size: 125px 150px;
            background-repeat: no-repeat;
            width:200px;
            height:280px;
            margin:05px;
            padding:05px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pro-list::after {
            content: attr(data-diy-label-text);
            background-color: coral;
            color: white;
            padding: 2px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: small;
            width: 120px;
          }
          .pro-list-product::after{
            content: attr(data-diy-label-text-product);
            background-color: #146C94;
            color: white;
            padding: 2px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: small;
            width: 120px;
          }
        .pro-list:hover,.pro-list-product:hover{
            background-color: #EEEEEE;
            filter:drop-shadow(2px 2px 2px #7F8487) ;
        }
        a{
            text-decoration: none;
        }
        .list-view-product-set{
            width: 200px;
            height: 220px;
            margin: 5px;
            padding: 5px;
            border:1px solid #7F8487;
            background-color: #D8D9DA;
        }
        .list-view-product-set-label{
            font-family: Arial, Helvetica, sans-serif;
            color: #7F8487;
            cursor: pointer;
        }
        .product-set-list{
            display:inline-block;
            width: fit-content;
        }
        .corner-ribbon{
            position: relative;
            top: 15px; /* Adjust the distance from the top as needed */
            left: 0px; /* Adjust the distance from the left as needed */
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: fit-content;
            display: inline-block;
            text-align: center;
        }
        .label-result {
            position: absolute;
            top: 20px; /* Adjust to position the label above the div */
            left: 20%;
            transform: translateX(-50%);
            background-color: coral;
            color: #fff;
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 12px;
            cursor: pointer;
            text-align: center;
        }
        .search-img-logo{
            position: relative;
            top: 11.5px;
            left: 214.7px;
            width: 35px;
            height: 32px;
            filter: drop-shadow(2px 2px 2px coral);
        }
        #results{
            position: absolute;
            right: 0;
            top: 150px;
            width: 45%;
            padding-right: 240px;
            z-index: 100;
        }
        
    </style>
</head>
<body bgcolor="#EEEDED">
    <center><h2>Products</h2></center>
    <hr>
    <small style="text-align:left!important;"> Home / Product Category / <b>DIY Polo T-Shirt</b></small>
    <br>
        <div class="itemcode-search">
            <form action="" method="GET">
            <?PHP 
                $document_root = $_SERVER['DOCUMENT_ROOT'];    
                // Construct the path to wp-config.php
                $wp_config_path = $document_root . '/wp-config.php';

                require_once $wp_config_path;
                $plugin_url = plugin_dir_url( __FILE__ );
                echo '<img src="' . esc_url( $plugin_url.'images/bottom-logo.png' ) . '" alt="Logo" class="search-img-logo" >'; 
                ?><input type="text" name="productcode" id="productcode" placeholder="Search Product" maxlength="15" autocomplete="off">
            </form>
        </div>
        <div id="results">
        <?php
        // Process the search query
        if (isset($_GET['productcode'])) {
            global $wpdb;
                
            $search_query = $_GET['productcode'];
            
            // Sanitize the search query using $wpdb->prepare()
            $sanitized_query = '%' . $wpdb->esc_like($search_query) . '%';

            // var_dump($sanitized_query);
            // die();

            $results = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM {$wpdb->prefix}product_set WHERE itemcode LIKE %s",
                    $sanitized_query
                )
            );

            if ($results) {
                foreach ($results as $result) {
                    // echo "<li>" . esc_html($result->product_name) . "</li>";
                    echo '<div class="corner-ribbon" style="background-color:coral;"><img class="list-view-product-set" src="'.esc_url( $plugin_url.'front_product_images/'.$result->front_thumbnail ).'" alt="Logo"><br><label for="" class="list-view-product-set-label" style="color:white;">'.$result->itemcode.'</label></div>';
                }
            } else {
                echo '<p style="font-size:small;color:red;float:left;">No Product Found</p>';
            }
        }
        ?>
    </div>

    </div>
<?PHP
    error_reporting(E_ALL ^ E_WARNING);

    $document_root = $_SERVER['DOCUMENT_ROOT'];
    
    // Construct the path to wp-config.php
    $wp_config_path = $document_root . '/wp-config.php';
    
    require_once $wp_config_path;

    global $wpdb;

    $plugin_url = plugin_dir_url( __FILE__ );

    $table_name = $wpdb->prefix . 'post_product';
    
    $query = "SELECT `p_referenceid`, `p_status` FROM $table_name";
    
    $results = $wpdb->get_results($query);
    
    $status = [];
    $ref = [];
    foreach($results as $abc){
        $status = $abc->p_status;        

        if($status==true)
        {
            $ref = $abc->p_referenceid;
        }

        if($status==true)
        {
            $product_table_name = $wpdb->prefix . 'product_set';
    
            $product_query = "SELECT * FROM $product_table_name WHERE `referenceid`='$ref'";          

            $product_results = $wpdb->get_results($product_query);
            
            
            foreach($product_results as $linkForProduct){
                
                $pName = $linkForProduct->productname;

                $productcode = $linkForProduct->itemcode;

                $productType = $linkForProduct->producttype;
                
                $frontThumbnail = $linkForProduct->front_thumbnail;

                $anchor_id = $ref;

                $diyviewpage = plugin_dir_url( __FILE__ ).'diycomposer.php?id='.$anchor_id;

            }
         
?>
            <div class="product-set-list"><div class="corner-ribbon"><span class="label-result">New</span><a href="<?php echo $diyviewpage; ?>" style="float:left;"><?PHP echo '<img class="list-view-product-set" src="'.esc_url( $plugin_url.'front_product_images/'.$frontThumbnail ).'" alt="Logo">'; ?><br><label for="" class="list-view-product-set-label"><?PHP echo $productcode;?></label></a></div></div>
<?PHP  
 } }
?>

</body>
</html>

