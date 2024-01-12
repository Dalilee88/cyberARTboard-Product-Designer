<?PHP
/*
* Plugin Name: ArtWork DIY
* Description: ArtWork DIY is product design tool by <a href="https://www.cyberartboard.com/" >Cyberartboard</a>
* Author: <a href="https://comxtech.com/">Comxsoftech</a> Development Team
* Version: 1.8
* Text Domain: ArtWork DIY
*/
if(!defined('ABSPATH')){
    exit;
}
// Note from Developer
// This plugin is developed in Comxsoftech Lab. 
// Complete Plugin is Conceptualize and developed by Er. Uday Kant | devuday187@gmail.com
// Graphical Content are design and developed by Santhosh KB | kbsanthosh888@gmail.com 


// Activate plugin hook
register_activation_hook(__FILE__,'table_creator');

// Deactivate plugin hook
register_deactivation_hook(__FILE__,'table_dropper' );

function table_creator(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix.'product_set';
    $post_table_name = $wpdb->prefix.'post_product';
    $designLib = $wpdb->prefix.'design_img';
    //table execution
    $sql = "DROP TABLE IF EXISTS $table_name;
            CREATE TABLE $table_name(
                `id` int  NOT NULL AUTO_INCREMENT,
                `referenceid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `productname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `itemcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `producttype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `productcategory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `front_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `front_body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `front_pattern_i` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `front_pattern_ii` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `front_outline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `side_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `side_body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `side_pattern_i` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `side_pattern_ii` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `side_outline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `back_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `back_body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `back_pattern_i` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `back_pattern_ii` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `back_outline` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            )
            DROP TABLE IF EXISTS $post_table_name;
            CREATE TABLE $post_table_name (
                `id` int NOT NULL AUTO_INCREMENT,
                `p_referenceid` varchar(255) NOT NULL,
                `p_status` varchar(255) NOT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (id),
                UNIQUE KEY `p_referenceid` (`p_referenceid`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
            )
            DROP TABLE IF EXISTS $designLib;
            CREATE TABLE $designLib (
                `id` int NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `type` varchar(255) NOT NULL,
                `content` varchar(255) NOT NULL,
                PRIMARY KEY (id),
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            )
            $charset_collate";
            
    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sql);
    dbDelta($postSql);
    dbDelta($design_sql);
}



// Function to drop the database table
function table_dropper() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'product_set'; 

    $post_table_name = $wpdb->prefix . 'post_product';

    $designLib = $wpdb->prefix . 'design_img';

    $sql = "DROP TABLE IF EXISTS $table_name;";

    $post_sql = "DROP TABLE IF EXISTS $post_table_name;";

    $design_sql = "DROP TABLE IF EXISTS $designLib;";

    $wpdb->query( $sql );

    $wpdb->query( $post_sql );

    $wpdb->query( $design_sql );
}



add_action('admin_menu','da_display_product_set_menu');

function da_display_product_set_menu(){
    //for productset
    add_menu_page('DIY Upload Set', 'DIY ArtWork', 'manage_options', 'product_set', 'da_product_set_list_callback');

    // for view product
    add_submenu_page('product_set', 'DIY Composer', 'View Product', 'manage_options', 'view_product', 'da_product_view_callback');
    
    // for shortcode
    add_submenu_page('product_set', 'DIY Info', 'Short Code', 'manage_options', 'short_code', 'da_product_shortcode_callback');
    
}
function da_product_view_callback(){
    $plugin_url = plugin_dir_url( __FILE__ );
    echo  "<style>
        table{
            width:90%;
            margin:10px 10px 10px 10px;
            padding:10px;
            border:1px solid transparent;
        }
        img{
            width:80px;
            height:80px;
        }
        .f-tr{
            border-top-style:none;
            border-bottom-style:none;
            border-left-style:none;
            border-right-style:none;
        }
        th{
            border:1px solid #F1F6F9;
        }
        th,td{            
            text-align:center;
            padding:5px;
        }
        tr{
            border-top-color: coral;
            border-bottom-color: coral;
            border-left-color: none;
            border-right-color:none;
        }
        button{
            margin:5px;
            border:none;
            padding:5px;
        }
        button:hover{
            background-color:transparent;
            color:coral;
            padding:5px;
            filter: drop-shadow(2px 2px 2px coral);
        }
        #footer-thankyou,#footer-upgrade{
            display:none;
        }
        
    </style>";
    echo "<center><h1>View Product</h1></center>";
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
                <style>
                .diyswitch {
                position: relative;
                display: inline-block;
                width: 40px;
                height: 18px;
                }

                .diyswitch input { 
                opacity: 0;
                width: 0;
                height: 0;
                }

                .diyslider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                -webkit-transition: .4s;
                transition: .4s;
                }

                .diyslider:before {
                position: absolute;
                content: "";
                height: 10px;
                width: 10px;
                left: 2px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
                }

                input:checked + .diyslider {
                background-color: coral;
                }

                input:focus + .diyslider {
                box-shadow: 0 0 1px coral;
                }

                input:checked + .diyslider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
                }

                /* Rounded diysliders */
                .diyslider.diyround {
                border-radius: 25px;
                }

                .diyslider.diyround:before {
                border-radius: 50%;
                }

                .img-br{
                    border:1px dashed #D8D8D8;
                }
            </style>
            <center><table rules="all" frame="box">
                <tr bgcolor="#9BA4B5" class="f-tr">
                    <th style="width:10px!important;">Id</th>
                    <th style="width:20px!important;">Product Name</th>
                    <th style="width:20px!important;">Item Code</th>
                    <th style="width:50px!important;">Thumbnail</th>
                    <th style="width:100px!important;">Actions</th>
                </tr>
                <?PHP
                    $wp_load_path = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php';
                    if (file_exists($wp_load_path)) {
                        // Include the wp-load.php file
                        require_once($wp_load_path);
                    
                        // Access the WordPress environment, including the global $wpdb object
                        global $wpdb;
                    
                        $table_name = $wpdb->prefix . 'product_set';
                        $query = "SELECT * FROM $table_name GROUP BY front_thumbnail";
                        $results = $wpdb->get_results($query);

                        // Process the query results
                        foreach ($results as $result) {
                            //Access individual row data
                            $id = $result->id;
                            $refid = $result->referenceid;
                            $productname = $result->productname;
                            $itemcode = $result->itemcode;
                            $frontThumbnail = $result->front_thumbnail;
                            $viewpage = plugin_dir_url( __FILE__ ).'viewproduct.php?id='.$refid;
                            $deleteRecord = plugin_dir_url( __FILE__ ).'delete.php?id='.$refid;
                ?>                            
                <tr>
                    <td style="width:10px!important;"><?PHP echo '#'.$id; ?></td>
                    <td style="width:50px!important;font-weight:lighter;"><?PHP echo $productname; ?></td>
                    <td style="width:50px!important;font-weight:lighter;"><?PHP echo $itemcode; ?></td>
                    <td style="width:20px!important;"><center><a hre="#"><?PHP echo '<img src="' . esc_url( $plugin_url.'front_product_images/'.$frontThumbnail ) . '" alt="Logo" class="img-br" >'; ?></a></center></td>
                    <td style="width:100px!important;"><button title="View Product" onclick="window.location.href = '<?PHP echo $viewpage;?>'"><i class="fa fa-list-alt" aria-hidden="true" style="font-size: large;"></i></button>
                    <form method="post" style="display:inline-block;">
                    <label class="diyswitch">
                    <input type="checkbox" name="checkboxValue[]" class="diyCheckboxCount" value="<?PHP echo $refid; ?>" id="diymyCheckbox_<?php echo $refid; ?>" onchange="this.form.submit()">                    
                    <span class="diyslider diyround" title="Post the Product"></span>
                    <p name="updateStatus[]" data-status="none" id="updateStatus_<?php echo $refid; ?>"></p>
                    <p></p>
                    </label>
                    </form>
                    <button title="Delete the Product" onclick="window.location.href = '<?PHP echo $deleteRecord;?>'"><i class="fa fa-trash" aria-hidden="true" style="font-size: large;"></i></button></td>
                </tr>
                
                <?PHP      
                    } 
                    } else {
                        //Handle the case where the wp-load.php file is not found
                        echo "WordPress installation not found.";
                    }
                ?>   

            </table></center>
            
                    <!-- function for toggle switcher -->
                    <script>
                        const diycheckboxes = document.getElementsByClassName('diyCheckboxCount');

                        // Function to set checkbox states in localStorage
                        function setCheckboxStates() {
                            const diycheckboxStates = {};
                            for (let j = 0; j < diycheckboxes.length; j++) {
                                diycheckboxStates[j] = diycheckboxes[j].checked;
                            }
                            localStorage.setItem('diycheckboxStates', JSON.stringify(diycheckboxStates));
                        }

                        // Add event listener to each checkbox
                        for (let i = 0; i < diycheckboxes.length; i++) {
                            diycheckboxes[i].addEventListener('change', function() {
                                setCheckboxStates();
                            });
                        }

                        // Retrieve the checkbox states from localStorage
                        const diysavedStates = JSON.parse(localStorage.getItem('diycheckboxStates'));

                        // Set the checkbox states based on the retrieved values
                        if (diysavedStates !== null) {
                            for (let i = 0; i < diycheckboxes.length; i++) {
                                diycheckboxes[i].checked = diysavedStates[i];
                                var StatusP = document.getElementById('updateStatus_' + diycheckboxes[i].value);
                                StatusP.setAttribute("data-status", diycheckboxes[i].checked.toString());
                            }
                        }
                        
                    </script>

                        <!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php
// Check if the checkbox value is present in the POST data
if (isset($_POST["checkboxValue"])) {
    // Assuming you have access to $wpdb object for database operations
    global $wpdb;

    $checkboxValues = $_POST["checkboxValue"];
    $checkboxStatuses = $_POST["updateStatus"];
    $dataStatus = array();

    foreach ($checkboxStatuses as $status) {
        // Convert the string "true" or "false" to the actual boolean value
        $dataStatus[] = ($status == 'true') ? true : false;

        // Handle the case when $status is not provided (none)
        if ($status === '' || $status==='false' || $status==='none') {
            $dataStatus[] = false;
        }
    }

    // Loop through the checkbox values and their corresponding status
    for ($i = 0; $i < count($checkboxValues); $i++) {
        $refid = sanitize_text_field($checkboxValues[$i]);
        $status = $dataStatus[$i] ? 'false' : 'true';
        

        // Check if $refid exists in the database
        $existsQuery = $wpdb->prepare(
            "SELECT COUNT(*) FROM `wp_post_product` WHERE `p_referenceid` = %s",
            $refid
        );

        $exists = $wpdb->get_var($existsQuery);

        if ($exists) {
            // If the record exists, update the status
            
            $updateQuery = $wpdb->prepare(
                "UPDATE `wp_post_product` SET `p_status` = %s WHERE `p_referenceid` = %s",
                $status,
                $refid
            );

            if ($wpdb->query($updateQuery) === false) {
                // Handle the database query error (if necessary)
                // For example: echo "Error: " . $wpdb->last_error;
            }
        } else {
            // echo 'Status: '.$status;
            // If the record does not exist, insert a new record
            $insertQuery = $wpdb->prepare(
                "INSERT INTO `wp_post_product` (p_referenceid, p_status) VALUES (%s, %s)",
                $refid,
                $status
            );

            if ($wpdb->query($insertQuery) === false) {
                // Handle the database query error (if necessary)
                // For example: echo "Error: " . $wpdb->last_error;
            }
        }
    }
}
?>
<script>
  // Assume you have jQuery included
  $(document).ready(function() {
    // Some AJAX code to send the data to the server
    var refid = <?php echo json_encode($refid); ?>;
    var statusValue = $('#updateInput_' + refid).data('status');
    
    $.ajax({
    //   url: window.location.href, // Send the AJAX request to the same page URL
      method: 'POST',
      data: { status: statusValue, refid: refid },
      success: function(response) {
        // Handle the response from the PHP script if needed
      }
    });
  });
</script>


<?PHP
}

function da_product_set_list_callback(){
    $icon_url = plugin_dir_url( __FILE__ ) . 'assets/Cyber-logo.png';
    echo '<link rel = "icon" href ="' . esc_url( $icon_url ) . '" type="image/icon type" sizes="16x16">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />';
    echo '<style>
    .info-sub{
        font-size: small;
        border: 1px dashed #146C94;
        width:fit-content;
        padding:5px;
        text-align: left;
    }
    .pattern-set{
        font-weight: lighter;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    .input-set{
        padding: 5px;
        margin: 2px;
        text-align: left;
    }
    .formFront{
        padding: 5px;
        font-family:Verdana, Geneva, Tahoma, sans-serif;
        font-size: small;
        border:1px solid white;
        background-color: red;
        width:300px;
        border-radius: 10px;
    }
    .formFront:focus{
        outline: none;
    }

    label{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: small;
    }
    .productFile{
        border:1px dashed #146C94;
        background-color: #DBDFEA;
        border-radius: 5px;
        padding: 8px!important;
    }
    span{
        display: inline-block;
    }
    .submit-bttn{
        background-color: #394867;
        width: 66.3%;
        height: 40px;
        padding: 2px;
    }
    #submit{
        width: 150px;
        height: 30px;
        margin-top: 5px;
        float: center;
    }
    #reference-number-i{
        width: 230px!important;
        font-size: xx-small;
        text-align: center;
        color: #146C94;
        font-weight: lighter;
        border: 1px dashed #146C94;
        border-radius: 10px;
    }
    #footer-thankyou,#footer-upgrade{
        display:none;
    }
    .tab-con {
        background-color: #9BA4B5;
        color: #F1F6F9;
    }
    .tab-p {
        display: inline-block;
        padding: 5px;
        text-align: center;
        font-family: verdana;
        font-size: small;
        font-weight: lighter;
    }
    .tab-p:hover,
    .tab-p.active {
        color: black;
        cursor: pointer;
    }
    .tab-frame {
        display: none;
    }
    .tab-frame.active {
        display: block;
        background-color: #ECF2FF;
        padding: 10px;
    }
    .hr{
        margin-top: -15px!important;
    }
    span{
        display: inline-block;
    }
    .radio-set{
        background-color: #EEEEEE;
        text-align: center;
        font-family: verdana;
        font-size: small;
        cursor: pointer;
        display: inline-block;
        border-bottom:1px solid transparent;
    }
    .radio-set.clicked {
        border-bottom: 1px solid orange;
      }
    .radio-set:hover{
        border-bottom:1px solid red;
    }
    input[type="radio"]{
        width: 15px;
        height: 15px;
        margin: 04px;
        display:none;
    }
    input[type="number"]{
        outline-style:none;
    }
    .radio{
        background-color: #9BA4B5;
        padding: 05px;
    }
    #Initial,#imageGrid,#containershadow,#viewselectionposition{
        width:300px;
        margin:04px;
    }
    label{
        font-weight:semi-light;
        font-family: verdana;
    }
    /* Works for Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }
      /* Works for Firefox */
      input[type="number"] {
        -moz-appearance: textfield;
      }
      .descInput{
        border:1px dotted #DBDFEA;
        // border:1px dotted #DBDFEA;
        background-color: #DDE6ED;
        display: flex;
        justify-content: center;
        align-items: center;
        margin:20px;
        width: fit-content;
        padding: 5px;
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;
      }
      *:focus {
        outline: none;
    }
    select,option{
        background-color:#DDE6ED;
    }
    #dropdown-container {
        position: relative;
        display: inline-block;
      }
      
      #add-option-product,#add-option-category {
        display: none;
      }
      
      #add-option-product.active,#add-option-category.active {
        display: block;
      }
    
      
</style>';
echo "<center><h1>DiY Product Set</h1></center>";
    $imgURL = plugin_dir_url( __FILE__ ).'images/layout-1.png';
    $imgURLRight = plugin_dir_url( __FILE__ ).'images/layout-right.png';
    ?>
    <div class="tab-con">
        <center>
            <p class="tab-p" data-tab="tab1">Layout</p>|
            <p class="tab-p" data-tab="tab2">Modules</p>|
            <p class="tab-p" data-tab="tab3">Add Product</p>|
            <p class="tab-p" data-tab="tab4">Actions</p>|
            <p class="tab-p" data-tab="tab5">Colors</p>|
            <p class="tab-p" data-tab="tab6">Design Library</p>
        </center>
    </div>
    <div class="tab-frame" id="tab1">
       <span>
            <p>Main Bar</p>
            <hr class="hr">
            <div class="radio-set clicked p" clicked>
            <p class="radio"><input type="radio" name="layout-one" value="layout-one">Default Layout</p> 
            <img src="<?PHP echo $imgURL; ?>" width="135" height="90">
            </div>
            <div class="radio-set p">
            <p class="radio"><input type="radio" name="layout-one" value="layout-one">Layout 1</p> 
            <img src="<?PHP echo $imgURLRight; ?>" width="135" height="90">
            </div>
       </span>
       <span style="float:right;display:none;">
            <p><b>Dimensions</b></p>
            <hr class="hr">
            <div class="dimension">
                <span>
                    <label for="">Canvas Width</label><br>
                    <input type="number" name="wnumber" id="wnumber" autocomplete="off">
                </span>
                <span>
                    <label for="">Canvas Height</label><br>
                    <input type="number" name="hnumber" id="hnumber" autocomplete="off">
                </span>
                <br>
                <p><b>Miscellaneous</b></p>
                <hr class="hr">
                <span>
                    <label for="">Image Grid Columns</label><br>
                    <select name="imageGrid" id="imageGrid">
                        <option value="one">One</option>
                        <option value="two">Two</option>
                        <option value="three">Three</option>
                        <option value="four">Four</option>
                        <option value="five">Five</option>
                    </select>
                </span>
                <span style="float:right;">
                <label for="">Initial Active Module</label><br>
                    <select name="Initial" id="Initial">
                        <option value="products">Products</option>
                        <option value="images">Images</option>
                        <option value="text">Text</option>
                        <option value="designs">Designs</option>
                        <option value="text-layers">Text-layers</option>
                        <option value="layouts">Layouts</option>
                        <option value="managelayer">Manage-layers</option>
                    </select>
                </span>
                <br>
                <span>
                    <label for="">Container Shadow</label><br>
                    <select name="containershadow" id="containershadow">
                        <option value="shadow1">Shadow 1</option>
                        <option value="shadow2">Shadow 2</option>
                        <option value="shadow3">Shadow 3</option>
                        <option value="shadow4">Shadow 4</option>
                        <option value="shadow5">Shadow 5</option>
                        <option value="shadow6">Shadow 6</option>
                        <option value="noshadow">No Shadow</option>
                    </select>
                </span>
                <span style="float:right;">
                <label for="">View Selection Position</label><br>
                    <select name="viewselectionposition" id="viewselectionposition">
                        <option value="insidetop">Inside Top</option>
                        <option value="insideright">Inside Right</option>
                        <option value="insidebottom">Inside Bottom</option>
                        <option value="insideleft">Inside Left</option>
                        <option value="outside">Outside</option>
                    </select>
                </span>
            </div>
       </span>
    </div>
    <div class="tab-frame" id="tab2">Content for Modules</div>
    <?PHP
        $process = plugin_dir_url( __FILE__ ).'processart.php';
        
    ?>
    <div class="tab-frame" id="tab3"><center><form action="<?PHP echo $process; ?>" method="POST" enctype="multipart/form-data"><p> Multi-Layer Product Entry Point</p><br>
    <?PHP
        $dirArt = plugin_dir_url( __FILE__ );
    ?>
    <center>
    <div class="descInput">
        <span>
        <div class="input-set">
        <label for="">Product Name<b style="color:red;">*</b></label><br>
        <input type="text" name="productname" id="product-name" class="formFront" autocomplete="off" required>
        </div>
        <br>
        <div class="input-set">
        <label for="">Item Code<b style="color:red;">*</b></label><br>
        <input type="text" name="productcode" id="product-code" class="formFront" autocomplete="off" required>
        </div>
        </span>
        <br>
        <span>
        <div class="input-set">
        <label for="">Product<b style="color:red;">*</b></label><br>
        <select name="producttype" id="product-type" class="formFront" required>
        <option value="" selected disabled>Select</option>
        <option value="poloshirts">POLO SHIRTS</option>
        <option value="tshirts">T-SHIRTS</option>
        <option value="singlets">SINGLETS</option>
        <option value="shorts">SHORTS</option>
        <option value="tracksuits">TRACKSUITS</option>
        <option value="hoodie">HOODIE TOP</option>
        <option value="stormjacket">STORM JACKET</option>
        <option value="softshell">SOFTSHELL JACKET</option>
        <option value="sportscap">SPORTS CAP</option>
        <option value="buckethat">BUCKET HAT</option>
        <option value="socks">SOCKS</option>
        <option value="addNewProduct" style="background-color: #526D82;color:white;">Add New Product</option>
        </select>
        <input type="text" id="add-option-product" placeholder="Enter new Product">
        </div><br>
        <div class="input-set">
        <label for="">Product Category<b style="color:red;">*</b></label><br>
        <select name="productcategory" id="product-category" class="formFront" required>
        <option value="" selected disabled>Select</option>
        <option value="schoolwear">SCHOOLWEAR</option>
        <option value="businesswear">BUSINESS WEAR</option>
        <option value="sportswear">SPORTS WEAR</option>
        <option value="workwear">WORK WEAR</option>
        <option value="promotional">PROMOTIONAL</option>
        <option value="leisurewear">LEISUREWEAR</option>
        <option value="addNewCategory" style="background-color: #526D82;color:white;">Add New Category</option>
        </select>
        <input type="text" id="add-option-category" placeholder="Enter new Category">
        </div>
        </span>
    </div>
    <script>
const dropdown = document.getElementById('product-type');
const dropdownCategory = document.getElementById('product-category');
const addOptionInput = document.getElementById('add-option-product');
const addOptionInputCategory = document.getElementById('add-option-category');

dropdown.addEventListener('change', function() {
  if (dropdown.value === 'addNewProduct') {
    addOptionInput.classList.add('active');
    addOptionInput.value = '';
  } else {
    addOptionInput.classList.remove('active');
  }
});

dropdownCategory.addEventListener('change', function() {
  if (dropdownCategory.value === 'addNewCategory') {
    addOptionInputCategory.classList.add('active');
    addOptionInput.value = '';
  } else {
    addOptionInputCategory.classList.remove('active');
  }
});

addOptionInput.addEventListener('input', function() {
  const newOptionValue = addOptionInput.value;
  
  if (newOptionValue.trim() !== '') {
    // Clear existing options
    while (dropdown.options.length > 13) {
      dropdown.remove(dropdown.options.length - 1);
    }
    
    // Add new option
    const newOption = new Option(newOptionValue, newOptionValue);
    dropdown.add(newOption);
  }
});

addOptionInputCategory.addEventListener('input', function() {
  const newOptionValueCategory = addOptionInputCategory.value;
  
  if (newOptionValueCategory.trim() !== '') {
    // Clear existing options
    while (dropdownCategory.options.length > 8) {
      dropdownCategory.remove(dropdownCategory.options.length - 1);
    }
    
    // Add new option
    const newOptionCategory = new Option(newOptionValueCategory, newOptionValueCategory);
    dropdownCategory.add(newOptionCategory);
  }
});
</script>
</center>
    <span style="background-color:#9BA4B5;">
    <input type="hidden" name="referencenumber" id="reference-number-i" value="" >
    <input type="hidden" name="dirArt" value="<?PHP echo $dirArt; ?>">
    <p style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#146C94;background-color:#394867;margin-top:0px;padding-bottom:15px;padding-top:5px;color:white;width:100%;">Front Part</p>
    <div class="input-set">
    <label for="">Front Thumbnail</label><br>
    <input type="file" class="productFile" name="front_thumbnail" id="front-thumbnail" required>
    </div>
    <div class="input-set">
    <label for="">Front Body</label><br>
    <input type="file" class="productFile" name="front_body" id="front-body">
    </div>
    <div class="input-set">
    <label for="">Front Pattern 1</label><br>
    <input type="file" class="productFile" name="front_pattern_i" id="front-pattern-i">
    </div>
    <div class="input-set">
    <label for="">Front Pattern 2</label><br>
    <input type="file" class="productFile" name="front_pattern_ii" id="front-pattern-ii">
    </div>
    <div class="input-set">
    <label for="">Front Outline</label><br>
    <input type="file" class="productFile" name="front_outline" id="front-outline">
    </div>
    </span>
    <span style="background-color:#9BA4B5;">
    <p style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#146C94;background-color:#394867;margin-top:0px;padding-bottom:15px;padding-top:5px;color:white;width:100%;">Side Part</p>
    <div class="input-set">
    <label for="">Side Thumbnail</label><br>
    <input type="file" class="productFile" name="side_thumbnail" id="side-thumbnail">
    </div>
    <div class="input-set">
    <label for="">Side Body</label><br>
    <input type="file" class="productFile" name="side_body" id="side-body">
    </div>
    <div class="input-set">
    <label for="">Side Pattern 1</label><br>
    <input type="file" class="productFile" name="side_pattern_i" id="side-pattern-i">
    </div>
    <div class="input-set">
    <label for="">Side Pattern 2</label><br>
    <input type="file" class="productFile" name="side_pattern_ii" id="side-pattern-ii">
    </div>
    <div class="input-set">
    <label for="">Side Outline</label><br>
    <input type="file" class="productFile" name="side_outline" id="side-outline">
    </div>
    </span>
    <span style="background-color:#9BA4B5;">
    <p style="border-bottom-style:solid;border-bottom-width:1px;border-bottom-color:#146C94;background-color:#394867;margin-top:0px;padding-bottom:15px;padding-top:5px;color:white;width:100%;">Back Part</p>
    <div class="input-set">
    <label for="">Back Thumbnail</label><br>
    <input type="file" class="productFile" name="back_thumbnail" id="back-thumbnail">
    </div>
    <div class="input-set">
    <label for="">Back Body</label><br>
    <input type="file" class="productFile" name="back_body" id="back-body">
    </div>
    <div class="input-set">
    <label for="">Back Pattern 1</label><br>
    <input type="file" class="productFile" name="back_pattern_i" id="back-pattern-i">
    </div>
    <div class="input-set">
    <label for="">Back Pattern 2</label><br>
    <input type="file" class="productFile" name="back_pattern_ii" id="back-pattern-ii">
    </div>
    <div class="input-set">
    <label for="">Back Outline</label><br>
    <input type="file" class="productFile" name="back_outline" id="back-outline">
    </div>
    </span>
    <br>
    <div class="submit-bttn">
    <input type="submit" value="Upload" name="submit" id="submit">
    </div>
</form></center></div>
    <div class="tab-frame" id="tab4">Content for Actions</div>
<div class="tab-frame" id="tab5">
    <style>
        .colorTab{
            background-color: transparent;
            display: inline-block;
            transition: transform 0.3s;
        }
        .colorTab:hover{
            transform: scale(2.2);
        }
        .colorView{
            margin: 0px;
            border-top-right-radius: 25px;
            margin: 5px;
            width: 110px;
            height: 110px;
        }
        .colorDesc{
            padding:2px;
            margin-top: -8px;
            font-family: verdana;
            width: 110px;
            background-color: white;
            border:1px solid black;
            text-align: center;
            font-size: 10px;
            cursor: pointer;
        }
        .sm{
            font-size: 8px;
        }
        .colorSetBox{
            width: 70%!important;
        }
        th{
            color: #B31312;
            padding: 3px;
            font-family: verdana;
            font-weight: lighter;
            font-size: x-small;
        }
        td{
            color: #000000;
            padding: 3px;
            font-family: verdana;
            font-weight: lighter;
            font-size: x-small; 
        }
        
    </style>    
    <div class="colorSetBox" style="display: none;">
            <table>
                <tr>
                    <th></th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>F</th>
                    <th>G</th>
                    <th>H</th>
                    <th>I</th>
                    <th>J</th>
                    <th>K</th>
                    <th>L</th>
                    <th>M</th>
                    <th>N</th>
                    <th>O</th>
                    <th>P</th>
                    <th>Q</th>
                    <th>R</th>
                    <th>S</th>
                    <th>T</th>
                    <th>U</th>
                    <th>V</th>
                    <th>W</th>
                    <th>X</th>
                    <th>Y</th>
                    <th>Z</th>
                    <th>Aa</th>
                    <th>Bb</th>
                    <th>Cc</th>
                    <th>Dd</th>
                    <th>Ee</th>
                    <th>Ff</th>
                    <th>Gg</th>
                    <th>Hh</th>
                    <th>Ii</th>
                    <th>Jj</th>
                    <th>Kk</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <!-- One -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #E7F0F9;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7F5FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:8.73 <b>M</b>:0.81 <b>Y</b>:0.99 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7F5FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:8.73 <b>M</b>:0.81 <b>Y</b>:0.99 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7F2FA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ECF7FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ECF7FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ECF7FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ECF7FD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EAF6F7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EAF6F7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EAF5F3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E8F5F0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E9F4ED;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E9F4EB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E9F4EB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EEF6EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F0F7EA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8FAE8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBFAE6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBFAE6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBFAE6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF8E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF7E7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FEF3E9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FEF3EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDEEF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDEEF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDEEF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDF0F2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDF1F6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDF1F6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDF1F6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8EFF6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8EFF6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6EEF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EDEBF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EDEBF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <!-- One -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #CDDDF2;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5E9F8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5E9F8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5EFFC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D2EEFB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5EFFC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5EFFC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D5EEF8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D3EDEF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D2EBE8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D0EAE1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CFE9D8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E9F4EB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D1E9D8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DBEDD4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E3EFD3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EDF3CE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9F7CC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9F7CA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9F7CA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF4C2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFEBCE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FEEAD4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FEF3EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDBE4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDBE4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDDE5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDFE6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDFE8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBDFEB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBE1EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8EFF6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EFDDEB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7DCEC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DED9EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D9D7EB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D9D7EB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #C3D3EC;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C8D8EF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BED7F0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B6D8F1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B3DAF4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B3DEF6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B3E3FA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BEE6F2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BDE4E7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BCE3DC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BAE1D3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BBE0CC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BADFC7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BFE1C6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C6E3C1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D6E9C0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E5EEBD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F3F3B9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FAF6BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF5BB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFE9B3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FEDCB8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDDDC7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FACAC0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8BDC9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8C0CD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8C1CE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9C6D4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9CAD9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9CEDD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9CEE1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F2CCE0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EBC9E0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DDC8E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CFC4E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C5C1E0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C3C2E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #A0B4DD;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A6BEE3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A9CBEB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ACCFED;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A2CEEE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A2D6F4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8DD7F7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A2DDF5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A7DDEB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AEDEE1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ABDCD5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A8D9C5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AEDABC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AEDAB9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B9DDB5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CAE3B5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DCE9AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EFF1B1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FAF5AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF0B2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFE2B0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDD5B0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FCD3BC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FAC2BA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7B4BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8B7C1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8B8C6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7B8C9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8BCCF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7BDD6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7BDD6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F0B7D3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E0B6D5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D1B1D4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C0AED4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B2AAD3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ADABD4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #8497CC;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #86A2D4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9CBDE4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #96C2E8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #91C7EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8FD0F2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8DD7F7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #99D9E9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #99D8E2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #99D5CD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9BD4BF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9DD4B6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9AD2AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A2D5AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B1DAAF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C2DFAC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D8E7AC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EBEEA8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FCF6A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFE9A7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFE2A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDD1A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBCDB6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9BEB2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7B0B8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7ADB7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7B0BE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7B0C3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6B1C7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6B1CC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6B1CF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EBACCD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DBAACE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C6A4CD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B5A1CD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A59DCC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A19ECD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #687CBB;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6B88C1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #80A5D6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #79AFDE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #79BEE8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #79C9F0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6FCFF6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #81D1E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #83CFCF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #86CEC0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #88CEB5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8ACDAA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8BCCA2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #95CFA2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A4D4A0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B6DA9E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CEE39F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7EB9B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF79B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFEB9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFDD9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDCD9F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBC4A7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8B2A2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6A0A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6A0AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F5A0AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F5A1B4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F5A1BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F5A4C3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F4A2C6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EA9FC5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D89BC4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C498C5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AB93C5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9891C5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9290C5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #5169B0;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5177B9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #658DC8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #64A0D6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #57B3E5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4CC0EE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #52C9F4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #62C9DF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6BC9CA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #70C8B9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #72C7AC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #72C59F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #76C695;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #86CA97;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #99CF95;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B2D894;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D1E39B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E7EB90;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDF48E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FCEB8E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFDA8E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDC991;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBBC97;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8A897;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F4929A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F4929D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F492A2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F492A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F493B2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F393B9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F394BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EA92BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D68DBC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BE8BBD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A486BD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8D84BE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8182BE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #3F5BA7;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3F6CB2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4A7BBD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5297D1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #47A9DF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #30B9EC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #18C3F3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1FC1E7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3DC1D0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4BBEAA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #52BE9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #54BE92;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #57BD87;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6EC284;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8ECB89;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A7D387;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CEE18F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E4E883;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF580;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FCE581;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFD27C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FCBF83;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8A77C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F69982;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F38286;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F37E84;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F27C89;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F28095;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F280A1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F280AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F179AF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E77FB2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CF7DB3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B37BB4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9D7CB7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8D84BE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8182BE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #3652A1;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3868B0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #266CB3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2B87C7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #099BD8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00B0E7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00BBF2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00BBD8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00BAC1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #11B9A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #21B796;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #23B684;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #42B97B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5BBC75;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7CC472;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9BCD70;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CBDE70;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DEE463;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF354;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FAD458;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FDBF58;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9A65C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6915D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F37B5C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F16660;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F16466;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F16470;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F1647B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F0668A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F06497;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EF589F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DE66A4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C763A3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A662A2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8965AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6962AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5961AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #344F9F;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F5BA7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1468B1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0675BB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0089CC;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A1E0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00B2F0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00B2D7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AFB3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AD98;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AC82;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AB6D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AF68;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #05B15C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5BBA57;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #80C353;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BFD748;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DEE242;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF22E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F9C836;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FBAF39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7923E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F3793E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F15D3E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE4240;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3F48;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3E55;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE4064;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3C73;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3A83;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3994;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D84090;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C14392;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A04895;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7A4D9B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #544F9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3D50A0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #354B9C;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2B54A3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #195FAA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #006BB4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #007DC3;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0094D7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AFEF;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00ADC7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00ABA5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AA8A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A974;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A863;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A859;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00AD57;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2BB454;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #65BC50;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ABD044;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CEDC39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #FFF212;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F8C131;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F89C32;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F47C35;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F16436;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EF4937;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ED3237;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ED323D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EE3148;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ED3054;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ED2E64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ED2A78;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EC268F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D0308A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C14392;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8E4192;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6A4695;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #484A9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #354B9C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #364997;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #314E99;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #125FA8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0668AE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0073B6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0088CB;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A0E1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A1C8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A188;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A188;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A060;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A057;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00A057;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0E9E53;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4FA850;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6CAE4D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8DB749;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B9C33F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F7CF2B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F6B432;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F29534;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EA7735;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E86036;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E64237;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E53337;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E3333D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E1314E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E33054;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E12F60;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E02D7F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DE2C89;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CB328A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A13C8D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8C408D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #794491;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #504996;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #354A97;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #36468D;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #314C93;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1A5CA0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0D62A5;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #006AAD;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #007FC2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0094D7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #008BB7;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #009095;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #009186;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00927B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00935C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #009453;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1D9751;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #52964D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #709E4A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #82A147;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9DAC43;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #EFB832;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E79835;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E27F36;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DE6E36;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D65A38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D63F37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CF3438;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D0333A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CD3544;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CB3449;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C73451;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C43273;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C2317D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B1337E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #913D85;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #833E85;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6D4288;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4C458D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #36468F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #364484;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #334889;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #255696;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1B5C9D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0A64A4;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #007CC0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0085CA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #007AAE;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #008093;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #017C7C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #008277;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #008556;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #00864D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #26864B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4F8648;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #748945;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #808E45;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #919643;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E5A335;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DB8137;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D26F37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CE6238;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BF4D38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BD3C37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BC3437;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BC363A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B43544;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B23448;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AC344F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AC344F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A93268;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A53473;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #983674;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #853B7C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7B3D7D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4C4181;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #354384;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #36417D;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #344581;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #295290;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #255696;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1B5C9B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #006FB2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0073B6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #036EA6;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0A7089;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0B727E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0E7573;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #117852;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0C7948;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2C7947;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4D7343;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #697643;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7E7D41;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #908541;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C18439;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CC6B39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C56339;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BA5238;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B84B38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AD3A37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AD3537;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AA3439;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A23442;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A23546;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9A344A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #973563;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #90366A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #89386C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7A3B75;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #743B75;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #653D78;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3E407C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #35407D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #364078;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #33447E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4E8B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #285291;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #235797;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0B62A9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0864AA;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0E6498;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #0F6A84;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #146B78;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #146D6B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #15714E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #137245;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F6B42;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #49653F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5F6840;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #746E3F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #756C3E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A7693A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AA5A39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A95239;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AC4A39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A84438;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9B3A37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #993536;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #AA3439;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8F343C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8D3340;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #893343;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #86345C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #843563;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #733769;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #763A70;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6D3A71;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #613B73;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #433E77;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #343E79;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>
                        <!-- one -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #353D72;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #334077;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #32447D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F4B8A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #28559A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2557A1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #26569C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #225685;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #245E75;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #23606B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #246163;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #206247;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #1D643F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2C633F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4A603D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #545C3D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #665D3B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #665D3B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #875238;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #804335;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8D4033;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8D4036;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8A3F35;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #893735;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #863334;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #843335;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #83333B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #83323D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #81323F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #783452;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #713257;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6D345A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #683868;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #63386B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5D396B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #403B6F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #343C72;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>
                        <!-- one  -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #323966;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #323B6A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #314072;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F4376;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #30467D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4C8A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #295190;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2C517C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2C576E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #285863;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #295C45;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #295C45;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #295D3E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #44593B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #51563B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5E5439;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5E5439;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #634134;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #664034;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6B3D33;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #703B33;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #703B33;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #783733;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #783433;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #783435;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #77343D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #76333F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #743342;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6E324D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6A3351;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #663352;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5A345A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #54365D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4B355B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #63386B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #393865;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #323867;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>
                        <!-- one  -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #313B69;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #303D6A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4171;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4372;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E457B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4679;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2A4A7D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E4F77;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #32506F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #315154;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #315141;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #315141;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #30523B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #38513A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3C513A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #44513A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4F4E39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5D4C39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #624237;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #634237;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #674238;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6C4339;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #71433A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #743F39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #743D39;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #733D3B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #743B44;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #733B47;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #723B48;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6D3950;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6B3952;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #673953;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5C395A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #573A5E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4F3A5F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3B3B67;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #303C6A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>
                        <!-- one  -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #2E3D67;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3D68;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D3F6B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D3F6B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D4171;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D3F6B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F406A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E436B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #344663;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #364853;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #374A43;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #374B3E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #374B38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3C4A38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3E4939;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #454939;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4C483A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #54473B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #62443C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #62433C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5E403C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5D403C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5E403D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #603E3C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #603F3D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #613E3E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #643E44;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #643D45;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #643D47;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #633C4B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #613B4C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #603C4F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #563B56;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #543C5C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4F3C5D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3E3C65;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F3C69;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>
                        <!-- one  -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #2E3B64;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3D64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #303C62;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #333F5D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #35414D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #34403D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #334035;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #354133;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #354033;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #393F34;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #413F36;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #483C36;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4F3B37;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503A38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503A38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503A38;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503938;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503938;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503938;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503939;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #503A3A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #52393C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #52393F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #553943;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #563945;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #583946;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #563947;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #533A4E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4C3954;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #433B5C;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #373A61;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2E3B64;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th colspan="38"></th>
                </tr>
                <tr>
                    <th></th>
                    <th>K1</th>
                    <th>K2</th>
                    <th>K3</th>
                    <th>K4</th>
                    <th>K5</th>
                    <th>K6</th>
                    <th>K7</th>
                    <th>K8</th>
                    <th>K9</th>
                    <th>K10</th>
                    <th>K11</th>
                    <th>K12</th>
                    <th>K13</th>
                    <th>K14</th>
                    <th>K15</th>
                    <th>K16</th>
                    <th>K17</th>
                    <th>K18</th>
                    <th>K19</th>
                    <th>K20</th>
                    <th>K21</th>
                    <th>K22</th>
                    <th>K23</th>
                    <th>K24</th>
                    <th>K25</th>
                    <th>K26</th>
                    <th>K27</th>
                    <th>K28</th>
                    <th>K29</th>
                    <th>K30</th>
                    <th>K31</th>
                    <th>K32</th>
                    <th>K33</th>
                    <th>K34</th>
                    <th>K35</th>
                    <th>K36</th>
                    <th>K37</th>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <!-- one  -->
                        <div class="colorTab">
                        <div class="colorView" style="background-color: #F5F8FA;"></div>
                        <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #F1F0F0;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E8E8E8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #E1E1E2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #DCDAD9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #D3D0D1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #CAC9C9;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #C3C1C1;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #BBB8B8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #B4B2B2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #ACA8A8;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #A5A1A2;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #9D9A9A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #918E8E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #8B8888;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #817E7F;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #7A7777;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #757172;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #6D6B6B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #666363;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #615E5E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #5A5858;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #565453;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #504E4E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #4B4A49;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #474646;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #434141;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3E3D3D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #3B3A3A;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #383838;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #353535;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #323232;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2F3030;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2D2E2E;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2C2D2D;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #2B2A2B;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                    <td>
                        <div class="colorTab">
                            <div class="colorView" style="background-color: #282828;"></div>
                            <div class="colorDesc">PMS: 656C <br> <small class="sm"><b>C</b>:7.51 <b>M</b>:2.62 <b>Y</b>:0.19 <b>K</b>:0 </small></div>
                        </div>
                    </td>
                </tr>
            </table>
    </div>

    
<script>
    function zoomOut() {
        var body = document.getElementsByClassName('colorSetBox')[0];
        body.style.zoom = "27%"; // Adjust the zoom level as desired
    }
        zoomOut();
</script>
    </div>
<div class="tab-frame" id="tab6">
        <!-- Content for Design Library -->
<style>
        body{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .designset{
            padding: 5px;
            background-color: #f7f7f7;
        }
        .headset{
            background-color: #e6e9ed;
            padding: 5px;
            height: fit-content;
        }
        .p{
            display: inline-block;
        }
        .whiteButton,.blackButton,.justbtn{
            width: 80px;
            height: 30px;
            padding: 0px!important;
            margin-top: -15px;
            border: none;
            border-radius: 24px;
        }
        .justbtn{
            padding: 10px!important;
            width: fit-content!important;
            background-color: #656d78;
            color: white;
            font-family: Arial, Helvetica, sans-serif;
            border-radius: 5px;
            line-height: 1;
        }
        .blackButton{
            background-color: black;
            color: white;
        }
        .whiteButton:hover,.blackButton:hover,.justbtn:hover{
            box-shadow: 2px 2px 2px black;
        }
        .cardset{
            margin: 5px;
            padding: 5px;
            background-color: transparent;
            width: 150px;
            height: fit-content;
            border: 1px solid black;
            display: inline-block;
            border-radius: 5px;
        }
        .cardhead{
            font-size: 12px;
            text-align: center;
            font-weight: 400;
            line-height:2px;
            height: 25px;
            padding-left: 4px!important;
            padding-right: 4px;
            background-color: #0000000d;
            border-radius: 25px;
            cursor: pointer;
        }
        .cardbody{
            text-align: center;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
        }
        .cardbody img{
            filter: drop-shadow(2px 2px 2px white);
        }
        .ft-btn{
            display: inline-block;
            width: 25px;
            height: 25px;
            margin: -0vw;
            padding: 8px;
            border: 0px;
            background-color: transparent;
        }
        .ft-btn i{
            font-size: large;
        }
        .ft-btn i:hover{
            color: #4477CE;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid black;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-radius: 10px;
        }
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent black */
            z-index: 999;
        }
        #closePopupButton {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336; /* Red color */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        #closePopupButton:hover {
        background-color: #d32f2f; /* Darker red color on hover */
        }
        .fileD{
            background-color: coral;
            padding: 11.2px!important;
            font-size: medium;
            display: inline-block!important;
            margin-right: 0px!important;
            box-shadow: 2px 2px 2px #2B3467;
            line-height: 1.5;
        }
        .fileD::file-selector-button {
            padding:3px;
            color: #ECF2FF;
            border: none;
            border-radius: none;
            background-color: coral !important;
        }
        @media (max-width: 501px) {
            .fileD{
                width: 60%;
            }
        }
        .submitD{
            display:inline-block!important;
            background-color: coral;
            padding: 11.8px;
            font-size: medium;
            border:1px solid coral;
            margin-left: -4px !important;
            box-shadow: 2px 2px 2px #2B3467;
            line-height: 1.4;
        }
        .submitD:hover{
            background-color: #ECF2FF;
            color: coral;
            border:1px solid #ECF2FF;
        }

</style>
<div class="designset">
        <div class="headset">
            <p class="p" style="font-weight: bold;">&nbsp;T-Shirt</p>
            <p class="p" style="margin-left: 20px;"><div class="overlay" id="overlay"></div><button class="justbtn" id="addDesignButton">Add Design</button></p>
            <div class="popup" id="designPopup">
                <button id="closePopupButton">X</button>
                <h2>Design Library</h2>
                <?PHP 
                    $plugin_url = plugin_dir_url( __FILE__ ).'designlib.php';                 
                ?>
                <form action="<?PHP echo $plugin_url; ?>" method="POST" enctype="multipart/form-data">
                    <small><label for=""><b style="color:red;">*</b><i>Upload Image to <b>Design Library</b></i></label></small><br>                               
                    <input type="file" class="fileD" name="image_file" id="image_file" accept="image/*" placeholder="Select Your Files" required>
                    <button type="submit" class="submitD" name="upload_image"" title="Upload"><i class="fa fa-upload"></i></button>
                    <span style="display:none;">Upload</span>
                </form>
              </div>
            <p style="float: right;margin-top:-40px!important;">Card Background: <button class="whiteButton">Light</button> <button class="blackButton">Dark</button></p>
        </div>
        <?PHP
            global $wpdb;
            $table_name = $wpdb->prefix . 'design_img';
            $images = $wpdb->get_results("SELECT * FROM $table_name");
            foreach ($images as $image) {
        ?>
        <div class="cardset">
            <div class="cardbody">
                <?PHP
                    echo '<img src="' . esc_url($image->content) . '" alt="' . esc_attr($image->name) . '" width="100" height="100">';
                ?>
            </div>
            <div class="cardhead">
                <p><?PHP
                    echo '<p>'.$image->name = str_replace('.png', '', $image->name).'</p>';
                ?></p>
            </div>
            <div class="cardfooter">
                <button class="ft-btn" disabled><i class="fa fa-edit"></i></button><button class="ft-btn delete-image" data-image-name="<?php echo esc_attr($image->name); ?>" style="float: right;color: red!important;"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
            
        </div>
        <?PHP
        }
        
        ?>
    </div>
<script>
jQuery(document).ready(function($) {
    $('.delete-image').click(function() {
        var imageName = $(this).data('image-name');
        
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                type: 'POST',
                url: '<?php echo plugins_url("ArtWork/designDel.php"); ?>', // Replace with the actual path
                data: {
                    imageName: imageName,
                },
                success: function(response) {
                    if (response === 'success') {
                        // Reload the page or perform any other action
                        location.reload();
                    } else {
                        alert('Failed to delete the image.');
                    }
                },
            });
        }
    });
});
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
          const addButton = document.getElementById("addDesignButton");
          const popup = document.getElementById("designPopup");
          const overlay = document.getElementById("overlay");
          const closePopupButton = document.getElementById("closePopupButton");
        
          addButton.addEventListener("click", function() {
            popup.style.display = "block";
            overlay.style.display = "block";
          });
          closePopupButton.addEventListener("click", function() {
            popup.style.display = "none";
            overlay.style.display = "none";
            });
        
          // Close the popup when clicking outside of it
          overlay.addEventListener("click", function() {
            popup.style.display = "none";
            overlay.style.display = "none";
          });
        });
        </script>
    <script>
        const designSets = document.querySelectorAll('.designset');
    
        designSets.forEach((designSet) => {
            const whiteButton = designSet.querySelector('.whiteButton');
            const blackButton = designSet.querySelector('.blackButton');
            const cardbodies = designSet.querySelectorAll('.cardbody');
    
            whiteButton.addEventListener('click', () => {
                cardbodies.forEach((cardbody) => {
                    cardbody.style.backgroundColor = 'white';
                    cardbody.style.color = 'black'; // Set text color to black for light theme
                });
            });
    
            blackButton.addEventListener('click', () => {
                cardbodies.forEach((cardbody) => {
                    cardbody.style.backgroundColor = '#354259';
                    cardbody.style.color = 'white';
                });
            });
    
            // Check the system theme
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (prefersDark) {
                // Apply dark theme
                cardbodies.forEach((cardbody) => {
                    cardbody.style.backgroundColor = '#354259';
                    cardbody.style.color = 'white';
                });
            } else {
                // Apply light theme
                cardbodies.forEach((cardbody) => {
                    cardbody.style.backgroundColor = 'white';
                    cardbody.style.color = 'black';
                });
            }
        });
    </script>

</div>



    <script>
        var tabs = document.querySelectorAll('.tab-p');
        var frames = document.querySelectorAll('.tab-frame');
        
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                var tabId = tab.getAttribute('data-tab');
                
                tabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });
                frames.forEach(function(frame) {
                    frame.classList.remove('active');
                });
                
                tab.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
        //layoutset
        // Add event listeners to each .radio-set element
        const radioSets = document.querySelectorAll('.radio-set');
        radioSets.forEach(radioSet => {
        radioSet.addEventListener('click', () => {
            // Remove 'clicked' class from all .radio-set elements
            radioSets.forEach(set => set.classList.remove('clicked'));
            // Add 'clicked' class to the clicked .radio-set element
            radioSet.classList.add('clicked');
        });
        });

    </script>
    <script>
            function generateUniqueCode() {
            const d = new Date();
            let year = d.getFullYear();
          const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'+year;
        //   console.log('letters '+letters);
        //   const specialCharacters = '!@#$%^&*';
          const specialCharacters = '@$';
          let code = '';
          
        
          // Generate first 5 letters
          for (let i = 0; i < 5; i++) {
            const randomIndex = Math.floor(Math.random() * letters.length);
            code += letters[randomIndex]+'-';
          }
        
          // Generate numbers (23 digits)
          for (let i = 0; i < 23; i++) {
            const randomNumber = Math.floor(Math.random() * 10);
            code += randomNumber;
          }
        
          // Add last 2 special characters
          for (let i = 0; i < 2; i++) {
            const randomIndex =Math.floor(Math.random() * specialCharacters.length);
            code += '/'+specialCharacters[randomIndex];
          }
        
          return code;
        }
        // Generate a unique code
        const uniqueCode = generateUniqueCode();
        var printIdI=document.getElementById('reference-number-i');
        printIdI.value=uniqueCode;
        printIdII.value=uniqueCode;
          </script>
<?PHP
}

function getMeDiY(){
    $category = plugin_dir_url( __FILE__ ).'category.php';
	//  echo '<iframe src="https://cyberartboarddiy.comxdesign.com.au/diy/1" width="1500" height="1000"></iframe>';
	 echo '<iframe src="'.$category.'" width="1500" height="1000"></iframe>';
     
	}
function getProductList(){
    echo '<center><h1>DIY PRODUCT</h1></center>';
}
function getOrderBook(){
    $category = plugin_dir_url( __FILE__ ).'orderbook.php';
	 echo '<iframe src="'.$category.'" width="100%" height="1000"></iframe>';
	}	
register_activation_hook( __FILE__, 'da_product_shortcode_callback' );

function da_product_shortcode_callback(){
    echo'<style>code{
        color:blue;
        cursor: pointer;
    }
    #footer-thankyou,#footer-upgrade{
        display:none;
    }
    </style>';
    echo '<br><li>To add DIY Product Composer | <code> [DIY-UI-Composer] </code></li>';    
    echo '<br><li>View Product on Page | <code> [View-DIY-Product] </code></li>';    
    echo '<br><li>Add Order Book on Page | <code> [Order-Book] </code></li>';    
}
add_shortcode('DIY-UI-Composer', 'getMeDiY');
add_shortcode('View-DIY-Product', 'getProductList');
add_shortcode('Order-Book', 'getOrderBook');



function viewProduct($id){
    
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
            left: 550px;
        }
    </style>
</head>
<body>
        <div class="container">
            <span class="front">
                <!-- background -->
                <img src="design (4).png" class="imgSet" width="280" height="300">
                <!-- body line -->
                <img src="design (1).png" class="imgSet" width="280" height="300">
                <!-- solder -->
                <img src="design (2).png" class="imgSet" width="280" height="300">
                <!-- stiching -->
                <img src="design (3).png" class="imgSet" width="280" height="300">
            </span>
            <span class="side">
                <!-- background -->
                <img src="side-view (4).png" class="imgSet" width="280" height="300">
                <!-- solder -->
                <img src="side-view (1).png" class="imgSet" width="280" height="300">
                <!-- body line -->
                <img src="side-view (2).png" class="imgSet" width="280" height="300">
                <!-- stiching -->
                <img src="side-view (3).png" class="imgSet" width="280" height="300">
            </span>
            <span class="back">
                <!-- background -->
                <img src="back-design (4).png" class="imgSet" width="280" height="300">
                <!-- solder -->
                <img src="back-design (1).png" class="imgSet" width="280" height="300">
                <!-- body line -->
                <img src="back-design (2).png" class="imgSet" width="280" height="300">
                <!-- stiching -->
                <img src="back-design (3).png" class="imgSet" width="280" height="300">
            </span>
        </div> 
</body>
</html>
    <?PHP
}
?>