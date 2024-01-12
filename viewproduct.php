<?PHP
                try{
                    $wp_load_path = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';
                    if (file_exists($wp_load_path)) {
                        // Include the wp-load.php file
                        require_once($wp_load_path);
                        $plugin_url = plugin_dir_url( __FILE__ );
                        // Access the WordPress environment, including the global $wpdb object
                        global $wpdb;
                        $refid = $_GET['id'];
                        $table_name = $wpdb->prefix . 'product_set';
                        $query = "SELECT * FROM $table_name WHERE referenceid='$refid'";
                        $results = $wpdb->get_results($query);
                        // Process the query results
                        foreach ($results as $result) {
                        //Access individual row data
                           $frontBody = $result->front_body;
                           $frontPatternI = $result->front_pattern_i;
                           $frontPatternII = $result->front_pattern_ii;
                           $frontOutline = $result->front_outline;

                           $sideBody = $result->side_body;
                           $sidePatternI = $result->side_pattern_i;
                           $sidePatternII = $result->side_pattern_ii;
                           $sideOutline = $result->side_outline;

                           $backBody = $result->back_body;
                           $backPatternI = $result->back_pattern_i;
                           $backPatternII = $result->back_pattern_ii;
                           $backOutline = $result->back_outline;
                        }
                    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Tool</title>
    <style>
        .imgSet{
            position: absolute;
            border:1px solid #9DB2BF;
        }
        .imgSet:hover{
            border:1px solid #025464;
        }
        .container{
            position: relative;
            left: 250px;
            top: 50px;
            width: fit-content;
        }
        .front{
            display: inline-block;
            position: relative;
            left: 0px;
        }
        .side{
            display: inline-block;
            position: relative;
            left: 280px;
        }
        .back{
            display: inline-block;
            position: relative;
            left: 560px;
        }
        h1{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #025464;
            text-shadow: 02px 02px 02px black;
            font-size: 50px;
        }
    </style>
</head>
<body bgcolor="#DDE6ED">
    <center><h1>Product View</h1></center>
        <div class="container">
            <span class="front">
                <!-- background -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'front_product_images/'.$frontBody ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- body line -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'front_product_images/'.$frontPatternI ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- solder -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'front_product_images/'.$frontPatternII ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- stiching -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'front_product_images/'.$frontOutline ) . '"   class="imgSet" width="280" height="300" >'; ?>
            </span>
            <span class="side">
                <!-- background -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'side_product_images/'.$sideBody ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- solder -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'side_product_images/'.$sidePatternI ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- body line -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'side_product_images/'.$sidePatternII ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- stiching -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'side_product_images/'.$sideOutline ) . '"   class="imgSet" width="280" height="300" >'; ?>
            </span>
            <span class="back">
                <!-- background -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'back_product_images/'.$backBody ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- solder -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'back_product_images/'.$backPatternI ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- body line -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'back_product_images/'.$backPatternII ) . '"   class="imgSet" width="280" height="300" >'; ?>
                <!-- stiching -->
                <?PHP echo '<img src="' . esc_url( $plugin_url.'back_product_images/'.$backOutline ) . '"   class="imgSet" width="280" height="300" >'; ?>
            </span>
        </div> 
</body>
</html>
<?PHP
    }
    catch(Exception $e){
         echo 'Unable to process';
    }
?>