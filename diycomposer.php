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
                           $frontThumbnail = $result->front_thumbnail;
                           $frontBody = $result->front_body;
                           $frontPatternI = $result->front_pattern_i;
                           $frontPatternII = $result->front_pattern_ii;
                           $frontOutline = $result->front_outline;

                           $sideThumbnail = $result->side_thumbnail;
                           $sideBody = $result->side_body;
                           $sidePatternI = $result->side_pattern_i;
                           $sidePatternII = $result->side_pattern_ii;
                           $sideOutline = $result->side_outline;

                           $backThumbnail = $result->back_thumbnail;
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
    <link href="https://fonts.cdnfonts.com/css/itc-avant-garde-gothic-std-book" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <script src="<?PHP echo $plugin_url.'js/fabric.js'; ?>"></script>   
    <script src="<?PHP echo $plugin_url.'js/hex.js'; ?>"></script>
<style>
      .can{
          float: left;
          position: relative;
          top: 20px;
          left: 220px;
      }
      .setI{
        background-color: #EEEEEE!important;
        height: 650px;
        width: 1050px;
        border: 1px dotted coral;
        border-radius: 20px;
      }
      
      #my-image-i,#my-image-layer-one,#my-image-layer-two,#my-image-layer-three{
          position: absolute;
          width: 450px;
          height: 500px;
          padding: 0px;
          background-color: transparent;
      } 
      #my-image-i-i,#my-image-layer-one-i,#my-image-layer-two-i,#my-image-layer-three-i{
        position: absolute;
          width: 450px;
          height: 500px;
          padding: 0px;
          background-color: transparent;
      }    
      #my-image-i-ii,#my-image-layer-one-ii,#my-image-layer-two-ii,#my-image-layer-three-ii{
        position: absolute;
          width: 450px;
          height: 500px;
          padding: 0px;
          background-color: transparent;
      }   
      
    img{
          position: relative;
          background-color: transparent;
      }
      
      input[type="color"]{
          width: 50px;
          height: 50px;
      }
      
      .color-controller{
          float: right;
          margin: 4px 0px 0px 0px;
          padding:10px;
          background-color: floralwhite;
          border:1px dashed coral;
          border-radius: 05px;
          font-family: Verdana, Geneva, Tahoma, sans-serif;
          text-align: left;
          position: absolute;
          left: 950px;
          top: 50px;
          height: 570px;
          width: 235px;
          overflow-y: scroll;
      }

      label{
          padding-top: 0px;
          margin: 0px;
      }
      .btn-btm{
          width: 100px;
          height: 40px;
          border:0px solid black;
      }
      .btn-btm:hover{
          border:1px solid black;
          box-shadow: 2px 2px 2px black;
      }
      .color-item{
          width: 25px;
          height: 25px;
          float: left;
          margin: 1px;
          cursor: pointer;
          box-shadow: 1px 1px 1px #212A3E;
      }
      
      .setOfColor{
          width: 365px;
          height: 175px;
          background-color: #F1F6F9;
          padding: 10px;
          margin: 10px;
          border-radius: 10px;
          border:1px dashed coral;
          display: none;
      }
      .primary-color{
          border: 1px solid coral;
          padding: 2px;
          margin: 3px;
          text-align: center;
          width: 410px;
          cursor: pointer;
      }
      
      .primary-color h4{
          background-color: transparent;
          height: 50px;
          margin: 0px;
          line-height: 3!important;
          color: #05BFDB;
          display: inline-block!important;
          font-weight: normal;
      }
      
      #result_color_i,#result_color_ii,#result_color_iii,#result_color_iv{
          width: 45px;
          height: 45px;
          /* background-color: coral; */
          display: inline-block;
          margin-top: 0px;
          margin-left: 0px;
          padding: 0px;
          box-shadow: 1px 1px 1px #212A3E;
          float: left;
      }
      .button-text{
          display: inline-block;
          background-color: #F0F0F0;
          width: 100%;
      }
      .button-text:hover{
          background-color: transparent;
          color:#F0F0F0;
          user-select: none;
          -moz-user-select: none; /* Firefox */
          -webkit-user-select: none; /* Chrome, Safari, Opera */
          -ms-user-select: none; /* Internet Explorer/Edge */
          width: 100%;
      }
    .side-view{
        width: fit-content;
        margin-top:05px;
        margin-left:05px; 
        padding:05px;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border:1px solid #FF7B54;
    }
    #imgviewi,#imgviewii,#imgviewiii{
      position: relative;
    }
    .side-view:hover{
        filter:drop-shadow(2px 2px 2px #FF7B54) ;
    }
    .genimg{
      position: absolute;
      width: 450px;
      height: 500px;
    }
    canvas{
      display: none;
    }

   
    .primary-color-item-i,.primary-color-item-ii,.primary-color-item-iii,.primary-color-item-iv{
      width: 28px;
      height: 28px;
      float: left;
      margin: 1px;
      cursor: pointer;
      /* transform: scale(0.75); */
      box-shadow: 1px 1px 1px #212A3E;
  }
  
  
  .primary-setOfColor{
    width:75%!important;
    height: 350px;
    background-color: #F1F6F9;
    padding: 15px;
    margin: 5px 5px;
    border-radius: 10px;
    border:1px dashed coral;
    display: none;
  }
  .primary-color{
      border-bottom: 1px solid #7F8487;
      border-left-style: none;
      border-right-style: none;
      border-top-style: none;
      padding: 2px;
      margin: 3px;
      text-align: center;
      width: 200px;
      cursor: pointer;
  }
  .primary-color:hover{
    border-bottom: 1px solid coral;
  }
  
  .primary-color h4{
      background-color: transparent;
      height: 50px;
      margin: 0px;
      line-height: 3!important;
      color: #394867;
      font-weight: normal;
      font-size: small;
      display: inline-block!important;
  }
  
  #result_color_i,#result_color_ii,#result_color_iii,#result_color_iv{
      width: 45px;
      height: 56px;
      /* background-color: coral; */
      display: inline-block;
      margin-top: 0px;
      margin-left: 0px;
      margin-bottom: 0px!important;
      padding: 0px;
      box-shadow: 1px 1px 1px #212A3E;
      float: left;
  }
  .primary-button-text{
      display: inline-block;
      background-color: #F0F0F0;
      width: 100%;
  }
  .primary-button-text:hover{
      background-color: transparent;
      color:#F0F0F0;
      user-select: none;
      -moz-user-select: none; /* Firefox */
      -webkit-user-select: none; /* Chrome, Safari, Opera */
      -ms-user-select: none; /* Internet Explorer/Edge */
      width: 100%;
  }
  span{
    display: inline-block;
  }
  #color-picker {
    display: flex;
    flex-wrap: wrap;
    max-width: 200px;
  }
  
  .color {
    width: 20px;
    height: 20px;
    margin: 5px;
    cursor: pointer;
  }
  .view{
    position: absolute;
    bottom: 350px!important;
    left: 250px;
    filter:drop-shadow(2px 2px 2px #7F8487) ;
  }
  .fieldset-color,.fieldset-color-trash{
    width: 80%;
    background-color:whitesmoke;
    border: none;
    margin-top: 03px;
    margin-bottom: 03px;
    cursor: pointer;
}
.fieldset-color:hover{
    background-color: #FF7B54;
    color: whitesmoke;
}
.fieldset-color-trash button:hover{
    background-color:#7F8487;
    color: white!important;
    cursor: pointer;
}
.product-icon-option{
    padding: 04px;
}
#add-text,#reset,#clr,#save,#downloadButton,#printer,#share,#chat,#textButton,#uploadButton,#imgButton,#reset-text,#clr-canvas{
  border-bottom: 1px solid #7F8487;
  border-left-style: none;
  border-right-style: none;
  border-top-style: none;
  margin: 05px;
  font-size: large;
  color:#FF7B54;
  padding:3px;
}
#add-text:hover,#reset-text:hover,#clr-canvas:hover,#textButton:hover,#imgButton:hover,#uploadButton:hover{
  box-shadow: 2px 2px 2px #7F8487;
}
#my-image-layer-one,#my-image-layer-one-i,#my-image-layer-one-ii{
  filter:drop-shadow(2px 2px 2px #7F8487) ;
}
::-webkit-scrollbar{
  width:6px;
  height: 6px;
}
::-webkit-scrollbar-track{
  background: #F0F3F4;
  border-radius: 50px;
}
::-webkit-scrollbar-thumb{
  background: #2E4053;
  border-radius: 50px;
}

.hidden {
  display: none;
}

.pagination-container {
  width: 250px;
  display: flex;
  align-items: left;
  position: absolute;
  bottom: 80px;
  padding: 2px;
  left: 50px!important;
  justify-content: left;
}
.pagination-container-ii {
width: 250px;
display: flex;
align-items: left;
position: absolute;
bottom: -40px;
padding: 2px;
left: 50px!important;
justify-content: left;
}
.pagination-container-iii {
width: 250px;
display: flex;
align-items: left;
position: absolute;
bottom: -150px;
padding: 2px;
left: 50px!important;
justify-content: left;
}

.pagination-container-iv {
width: 250px;
display: flex;
align-items: left;
position: absolute;
bottom: -280px;
padding: 2px;
left: 50px!important;
justify-content: left;
}

.pagination-number,
.pagination-button,.pagination-button-ii,.pagination-button-iii,.pagination-button-iv,.pagination-number-ii,.pagination-number-iii,.pagination-number-iv{
  font-size: small;
  background-color: transparent;
  border: none;
  cursor: pointer; 
  width: 1.5rem;
  border-radius: .2rem;
}

.pagination-number:hover,
.pagination-button:not(.disabled):hover,.pagination-button-ii:not(.disabled):hover,.pagination-button-iii:not(.disabled):hover ,.pagination-button-iv:not(.disabled):hover,.pagination-number-ii:hover,.pagination-number-iii:hover,.pagination-number-iv:hover {
  background: #fff;
}

.pagination-number.active,.pagination-number-ii.active ,.pagination-number-iii.active,.pagination-number-iv.active {
  color: #fff;
  background: #0085b6;
}
        .textForm{
            margin:05px;
            padding:10px;
            width:400px;
            background-color: #dee2e4e3;
            float: left;
            overflow:hidden;
            z-index: 90;
        }
        #input-text{
            outline: none;
            width: 95%;
            height:100px;
            border: 1px solid #7F8487;
            font-size: large;
            padding: 05px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        #font-name{
            width: 100%;
            height: 40px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: large;
            color: #7F8487;
            border-bottom: 1px solid #7F8487;
            border-left-style: none;
            border-right-style: none;
            border-top-style: none;
            margin: 05px;
        }
        #text-size{
            width: 60px;
            height: 35px;
            outline: none;
            font-size: large;
            margin: 0px;
            border:none;
            text-align: center;
            border-bottom: 1px solid #7F8487;
            border-left-style: none;
            border-right-style: none;
            border-top-style: none;
        }
        #text-weight{
            height: 35px;
            font-size: medium;
            color: #7F8487;
            border-bottom: 1px solid #7F8487;
            border-left-style: none;
            border-right-style: none;
            border-top-style: none;
        }
        #btn-add-text{
            border-bottom: 1px solid #7F8487;
            border-left-style: none;
            border-right-style: none;
            border-top-style: none;
            margin: 05px;
            font-size: large;
            color:#FF7B54;
            padding:3px;
            width: 50%;
        }
        #btn-add-text:hover{
            box-shadow: 2px 2px 2px #7F8487;
        }
        #font-color{
          width: 25px!important;
          height: 25px!important;
        }
        a .process-btn-for-product p{
          text-decoration: none;
        }
        .process-btn-for-product{
          background-color: transparent;
          border: 1px solid transparent;
          padding: 5px;
          display: inline-block;
          height: 35px;
        }
        .process-btn-for-product p{
          position: relative;
          top: -4px;
          display: inline-block;
        }
        .process-btn-for-product:hover{
          color: coral;
          border-bottom: 1px solid coral;
          cursor: pointer;
        }
        #preview-image{
          position: absolute;
          width: fit-content;
          height: fit-content;
        }

</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
</head>
<body>
    <br>
       <center>
        <div class="setI">
          
            <div class="can" id="viewi" style="display:block;">
              <!-- background -->
              <?PHP echo '<img id="my-image-layer-one" src="' . esc_url( $plugin_url.'front_product_images/'.$frontBody ) . '" >'; ?>
                <!-- body line -->
                <?PHP echo '<img id="my-image-layer-two" src="' . esc_url( $plugin_url.'front_product_images/'.$frontPatternI ) . '" >'; ?>
                <!-- solder -->
                <?PHP echo '<img id="my-image-layer-three" src="' . esc_url( $plugin_url.'front_product_images/'.$frontPatternII ) . '">'; ?>
                <!-- stiching -->
                <?PHP echo '<img id="my-image-i" src="' . esc_url( $plugin_url.'front_product_images/'.$frontOutline ) . '">'; ?>
                <img id="preview-image" src="" alt="Preview Image" style="display: none;">
              </div>
                
            <div class="can" id="viewii" style="display:none;">
              <!-- background -->
              <?PHP echo '<img id="my-image-layer-one-i" src="' . esc_url( $plugin_url.'side_product_images/'.$sideBody ) . '">'; ?>
                <!-- solder -->
                <?PHP echo '<img id="my-image-layer-two-i" src="' . esc_url( $plugin_url.'side_product_images/'.$sidePatternI ) . '">'; ?>
                <!-- body line -->
                <?PHP echo '<img id="my-image-layer-three-i" src="' . esc_url( $plugin_url.'side_product_images/'.$sidePatternII ) . '">'; ?>
                <!-- stiching -->
                <?PHP echo '<img id="my-image-i-i" src="' . esc_url( $plugin_url.'side_product_images/'.$sideOutline ) . '">'; ?>

            </div>
            <div class="can" id="viewiii" style="display:none;">
              <!-- background -->
              <?PHP echo '<img id="my-image-layer-one-ii" src="' . esc_url( $plugin_url.'back_product_images/'.$backBody ) . '">'; ?>
                <!-- solder -->
                <?PHP echo '<img id="my-image-layer-two-ii" src="' . esc_url( $plugin_url.'back_product_images/'.$backPatternI ) . '">'; ?>
                <!-- body line -->
                <?PHP echo '<img id="my-image-layer-three-ii" src="' . esc_url( $plugin_url.'back_product_images/'.$backPatternII ) . '">'; ?>
                <!-- stiching -->
                <?PHP echo '<img id="my-image-i-ii" src="' . esc_url( $plugin_url.'back_product_images/'.$backOutline ) . '">'; ?>

            </div>
            <div class="view">
              <span>
                <fieldset class="side-view">
                  <?PHP echo '<img id="imgviewi" src="' . esc_url( $plugin_url.'front_product_images/'.$frontThumbnail ) . '" alt="Product" width="60" height="50">'; ?>
              </fieldset></span>
              <span>
              <fieldset class="side-view">
              <?PHP echo '<img id="imgviewii" src="' . esc_url( $plugin_url.'side_product_images/'.$sideThumbnail ) . '" alt="Product" width="60" height="50" title="!Activated">'; ?>
              </fieldset></span>
              <span>
              <fieldset class="side-view">
              <?PHP echo '<img id="imgviewiii" src="' . esc_url( $plugin_url.'back_product_images/'.$backThumbnail ) . '" alt="Product" width="60" height="50">'; ?>
              </fieldset></span>
             
              <span>
                <div class="textForm" style="display:none;">            
                  <textarea name="input-text" id="text"  rows="4" placeholder="Enter Your Text Here" required></textarea>
                  <select name="font-name" id="font-name">
                      <option selected disabled>Select Font</option>
                      <option value="Arial, sans-serif">Arial</option>
                      <option value="Verdana, sans-serif">Verdana</option>
                      <option value="Tahoma, sans-serif">Tahoma</option>
                      <option value="'Trebuchet MS', sans-serif">Trebuchet MS</option>
                      <option value="'Times New Roman', serif">Times New Roma</option>
                  </select><br>
                  <label for="text-size">Text Size</label>
                      <input type="text" name="text-size" id="text-size" maxlength="2" placeholder="🗚">
                      <label for="font-weight">Font Thickness</label>
                      <select name="text-weight" id="text-weight">
                          <option disabled selected>Select</option>
                          <option value="bold">Bold</option>
                          <option value="italic">Italic</option>
                          <option value="normal">Normal</option>
                          <option value="lighter">Lighter</option>
                          <option value="bolder">Bolder</option>
                      </select>
                      <label for="font-color">Color</label>
                      <input type="color" name="font-color" id="font-color" value="#FF7B54">
                  <div class="btn-set">
                    <button id="btn-add-text" title="Add Text">Add Text</button>
                  </div>
                </div>
              </span>
            </div>        
            <div class="color-controller" id="color-controller">
              <center><label style="background-color: #FFE6C7;padding: 5px;"><small style="color:#FF6000;text-transform: uppercase;text-shadow: 1px 1px 1px black;font-size:large;"><i class="bi bi-gear"></i> Controller</small></label></center><br>
              <span><label><p>Body<b style="color:red;">*</b></p></label>
                <div class="primary-color">
                  <div class="primary-button-text" id="toggle-button-i"><div id="result_color_i" ></div><h4  style="display: inline-block;"> &nbsp; Body </h4></div><center>
                  <div class="primary-setOfColor" id="primary-setOfColor-i"><div id="paginated-list" data-current-page="1" aria-live="polite">
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fffa84;" data-color="#fffa84"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fee837;" data-color="#fee837"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fcd60f;" data-color="#fcd60f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fac80b;" data-color="#fac80b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #e4b010;" data-color="#e4b010"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffcd55;" data-color="#ffcd55"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffb637;" data-color="#ffb637"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ff8326;" data-color="#ff8326"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f95c1b;" data-color="#f95c1b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #cf4216;" data-color="#cf4216"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffba9c;" data-color="#ffba9c"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ff7a62;" data-color="#ff7a62"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f03b2b;" data-color="#f03b2b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c12519;" data-color="#c12519"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #801e1e;" data-color="#801e1e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffafa5;" data-color="#ffafa5"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f95552;" data-color="#f95552"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #d52231;" data-color="#d52231"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #b92b32;" data-color="#b92b32"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #6d2a31;" data-color="#6d2a31"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffa6a9;" data-color="#ffa6a9"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ff5e75;" data-color="#ff5e75"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #e91c56;" data-color="#e91c56"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a5123d;" data-color="#a5123d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #7d2041;" data-color="#7d2041"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ff9fc1;" data-color="#ff9fc1"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fa72a9;" data-color="#fa72a9"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #da3b6f;" data-color="#da3b6f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #bc3266;" data-color="#bc3266"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #862b5a;" data-color="#862b5a"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #efc3e1;" data-color="#efc3e1"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ce89bb;" data-color="#ce89bb"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #af5589;" data-color="#af5589"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #833f6e;" data-color="#833f6e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #6d3359;" data-color="#6d3359"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c0afd0;" data-color="#c0afd0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a081ba;" data-color="#a081ba"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #695190;" data-color="#695190"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #593979;" data-color="#593979"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #452757;" data-color="#452757"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #bfcdd0;" data-color="#bfcdd0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9bb3bd;" data-color="#9bb3bd"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #5b7f96;" data-color="#5b7f96"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #3b5769;" data-color="#3b5769"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #282e3b;" data-color="#282e3b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a0bcd4;" data-color="#a0bcd4"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #628ec0;" data-color="#628ec0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #345188;" data-color="#345188"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #2d3f6d;" data-color="#2d3f6d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #323950;" data-color="#323950"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #96c8da;" data-color="#96c8da"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #4aaad6;" data-color="#4aaad6"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #017abb;" data-color="#017abb"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #1f5a91;" data-color="#1f5a91"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #2a415f;" data-color="#2a415f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #95d5e6;" data-color="#95d5e6"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #66bdd0;" data-color="#66bdd0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #1287ab;" data-color="#1287ab"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #116c8a;" data-color="#116c8a"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #0b4861;" data-color="#0b4861"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #8fdad5;" data-color="#8fdad5"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #60c8c2;" data-color="#60c8c2"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #299c9d;" data-color="#299c9d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #12797c;" data-color="#12797c"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #0a5860;" data-color="#0a5860"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c5dedc;" data-color="#c5dedc"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9cc2c4;" data-color="#9cc2c4"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #6fa2aa;" data-color="#6fa2aa"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #4d7c87;" data-color="#4d7c87"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #195b6d;" data-color="#195b6d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #baeed1;" data-color="#baeed1"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #7fc9b1;" data-color="#7fc9b1"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #29a67f;" data-color="#29a67f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #06826d;" data-color="#06826d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #0c5b56;" data-color="#0c5b56"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #cbe8bc;" data-color="#cbe8bc"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #87d18c;" data-color="#87d18c"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #37a469;" data-color="#37a469"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #138b63;" data-color="#138b63"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #166d56;" data-color="#166d56"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c1e1c4;" data-color="#c1e1c4"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a1c99d;" data-color="#a1c99d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #70a479;" data-color="#70a479"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #518365;" data-color="#518365"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #2b4f43;" data-color="#2b4f43"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9bd68d;" data-color="#9bd68d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #5fae40;" data-color="#5fae40"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #2e8c3e;" data-color="#2e8c3e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #01733a;" data-color="#01733a"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #214a35;" data-color="#214a35"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #cae76e;" data-color="#cae76e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9bc94a;" data-color="#9bc94a"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #6c9f3f;" data-color="#6c9f3f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #577b3d;" data-color="#577b3d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #365535;" data-color="#365535"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #cfd958;" data-color="#cfd958"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c0bb16;" data-color="#c0bb16"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #949029;" data-color="#949029"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #5b5d20;" data-color="#5b5d20"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #414523;" data-color="#414523"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ded45b;" data-color="#ded45b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #d7bc32;" data-color="#d7bc32"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c6a02e;" data-color="#c6a02e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a18528;" data-color="#a18528"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #5f521b;" data-color="#5f521b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #e2d5b3;" data-color="#e2d5b3"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #cdba91;" data-color="#cdba91"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #b09a6d;" data-color="#b09a6d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9e7f4b;" data-color="#9e7f4b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #725b35;" data-color="#725b35"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f7bb75;" data-color="#f7bb75"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #b48844;" data-color="#b48844"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #8e5d29;" data-color="#8e5d29"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #644a25;" data-color="#644a25"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #4d3f27;" data-color="#4d3f27"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f3bb79;" data-color="#f3bb79"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c68448;" data-color="#c68448"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ab5b2d;" data-color="#ab5b2d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #753a1b;" data-color="#753a1b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #543826;" data-color="#543826"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f2d7b8;" data-color="#f2d7b8"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #edbe91;" data-color="#edbe91"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c87f58;" data-color="#c87f58"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #a85541;" data-color="#a85541"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #603a36;" data-color="#603a36"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f2d2b9;" data-color="#f2d2b9"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ecb59f;" data-color="#ecb59f"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #c57d75;" data-color="#c57d75"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ae4d53;" data-color="#ae4d53"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #85343b;" data-color="#85343b"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ced2cd;" data-color="#ced2cd"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #aeb3b0;" data-color="#aeb3b0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #939794;" data-color="#939794"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #676d69;" data-color="#676d69"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #3a403e;" data-color="#3a403e"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #dbd2c3;" data-color="#dbd2c3"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #bab1a0;" data-color="#bab1a0"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #9d9180;" data-color="#9d9180"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #837969;" data-color="#837969"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #585047;" data-color="#585047"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #e0eae9;" data-color="#e0eae9"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #e5f7e2;" data-color="#e5f7e2"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffd9cf;" data-color="#ffd9cf"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #faebf4;" data-color="#faebf4"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ffffc1;" data-color="#ffffc1"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #1bb0dd;" data-color="#1bb0dd"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #b3e754;" data-color="#b3e754"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #ff366d;" data-color="#ff366d"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #fd3832;" data-color="#fd3832"></div>
                    <div class="primary-color-item-i" id="primary-color-item" style="background-color: #f9f944;" data-color="#f9f944"></div>
                    
                    <nav class="pagination-container">
                        <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                          &lt;
                        </button>
                        <div id="pagination-numbers">
                        </div>
                        <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                          &gt;
                        </button>
                      </nav>    
                </div>
                  </div>
                </center>
              </div>

              <label><p>Pattern 1<b style="color:red;">*</b></p></label>
              <div class="primary-color">
                <div class="primary-button-text" id="toggle-button-ii"><div id="result_color_ii"></div><h4  style="display: inline-block;"> &nbsp; Pattern 1 </h4></div><center>
                <div class="primary-setOfColor" id="primary-setOfColor-ii"><div id="paginated-list-ii" data-current-page-layerone="1" aria-live="polite">
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fffa84;" data-color="#fffa84"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fee837;" data-color="#fee837"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fcd60f;" data-color="#fcd60f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fac80b;" data-color="#fac80b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #e4b010;" data-color="#e4b010"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffcd55;" data-color="#ffcd55"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffb637;" data-color="#ffb637"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ff8326;" data-color="#ff8326"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f95c1b;" data-color="#f95c1b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #cf4216;" data-color="#cf4216"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffba9c;" data-color="#ffba9c"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ff7a62;" data-color="#ff7a62"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f03b2b;" data-color="#f03b2b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c12519;" data-color="#c12519"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #801e1e;" data-color="#801e1e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffafa5;" data-color="#ffafa5"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f95552;" data-color="#f95552"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #d52231;" data-color="#d52231"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #b92b32;" data-color="#b92b32"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #6d2a31;" data-color="#6d2a31"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffa6a9;" data-color="#ffa6a9"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ff5e75;" data-color="#ff5e75"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #e91c56;" data-color="#e91c56"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a5123d;" data-color="#a5123d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #7d2041;" data-color="#7d2041"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ff9fc1;" data-color="#ff9fc1"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fa72a9;" data-color="#fa72a9"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #da3b6f;" data-color="#da3b6f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #bc3266;" data-color="#bc3266"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #862b5a;" data-color="#862b5a"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #efc3e1;" data-color="#efc3e1"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ce89bb;" data-color="#ce89bb"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #af5589;" data-color="#af5589"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #833f6e;" data-color="#833f6e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #6d3359;" data-color="#6d3359"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c0afd0;" data-color="#c0afd0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a081ba;" data-color="#a081ba"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #695190;" data-color="#695190"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #593979;" data-color="#593979"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #452757;" data-color="#452757"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #bfcdd0;" data-color="#bfcdd0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9bb3bd;" data-color="#9bb3bd"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #5b7f96;" data-color="#5b7f96"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #3b5769;" data-color="#3b5769"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #282e3b;" data-color="#282e3b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a0bcd4;" data-color="#a0bcd4"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #628ec0;" data-color="#628ec0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #345188;" data-color="#345188"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #2d3f6d;" data-color="#2d3f6d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #323950;" data-color="#323950"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #96c8da;" data-color="#96c8da"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #4aaad6;" data-color="#4aaad6"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #017abb;" data-color="#017abb"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #1f5a91;" data-color="#1f5a91"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #2a415f;" data-color="#2a415f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #95d5e6;" data-color="#95d5e6"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #66bdd0;" data-color="#66bdd0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #1287ab;" data-color="#1287ab"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #116c8a;" data-color="#116c8a"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #0b4861;" data-color="#0b4861"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #8fdad5;" data-color="#8fdad5"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #60c8c2;" data-color="#60c8c2"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #299c9d;" data-color="#299c9d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #12797c;" data-color="#12797c"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #0a5860;" data-color="#0a5860"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c5dedc;" data-color="#c5dedc"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9cc2c4;" data-color="#9cc2c4"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #6fa2aa;" data-color="#6fa2aa"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #4d7c87;" data-color="#4d7c87"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #195b6d;" data-color="#195b6d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #baeed1;" data-color="#baeed1"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #7fc9b1;" data-color="#7fc9b1"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #29a67f;" data-color="#29a67f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #06826d;" data-color="#06826d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #0c5b56;" data-color="#0c5b56"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #cbe8bc;" data-color="#cbe8bc"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #87d18c;" data-color="#87d18c"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #37a469;" data-color="#37a469"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #138b63;" data-color="#138b63"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #166d56;" data-color="#166d56"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c1e1c4;" data-color="#c1e1c4"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a1c99d;" data-color="#a1c99d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #70a479;" data-color="#70a479"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #518365;" data-color="#518365"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #2b4f43;" data-color="#2b4f43"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9bd68d;" data-color="#9bd68d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #5fae40;" data-color="#5fae40"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #2e8c3e;" data-color="#2e8c3e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #01733a;" data-color="#01733a"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #214a35;" data-color="#214a35"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #cae76e;" data-color="#cae76e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9bc94a;" data-color="#9bc94a"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #6c9f3f;" data-color="#6c9f3f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #577b3d;" data-color="#577b3d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #365535;" data-color="#365535"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #cfd958;" data-color="#cfd958"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c0bb16;" data-color="#c0bb16"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #949029;" data-color="#949029"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #5b5d20;" data-color="#5b5d20"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #414523;" data-color="#414523"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ded45b;" data-color="#ded45b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #d7bc32;" data-color="#d7bc32"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c6a02e;" data-color="#c6a02e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a18528;" data-color="#a18528"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #5f521b;" data-color="#5f521b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #e2d5b3;" data-color="#e2d5b3"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #cdba91;" data-color="#cdba91"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #b09a6d;" data-color="#b09a6d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9e7f4b;" data-color="#9e7f4b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #725b35;" data-color="#725b35"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f7bb75;" data-color="#f7bb75"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #b48844;" data-color="#b48844"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #8e5d29;" data-color="#8e5d29"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #644a25;" data-color="#644a25"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #4d3f27;" data-color="#4d3f27"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f3bb79;" data-color="#f3bb79"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c68448;" data-color="#c68448"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ab5b2d;" data-color="#ab5b2d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #753a1b;" data-color="#753a1b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #543826;" data-color="#543826"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f2d7b8;" data-color="#f2d7b8"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #edbe91;" data-color="#edbe91"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c87f58;" data-color="#c87f58"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #a85541;" data-color="#a85541"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #603a36;" data-color="#603a36"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f2d2b9;" data-color="#f2d2b9"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ecb59f;" data-color="#ecb59f"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #c57d75;" data-color="#c57d75"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ae4d53;" data-color="#ae4d53"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #85343b;" data-color="#85343b"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ced2cd;" data-color="#ced2cd"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #aeb3b0;" data-color="#aeb3b0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #939794;" data-color="#939794"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #676d69;" data-color="#676d69"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #3a403e;" data-color="#3a403e"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #dbd2c3;" data-color="#dbd2c3"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #bab1a0;" data-color="#bab1a0"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #9d9180;" data-color="#9d9180"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #837969;" data-color="#837969"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #585047;" data-color="#585047"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #e0eae9;" data-color="#e0eae9"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #e5f7e2;" data-color="#e5f7e2"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffd9cf;" data-color="#ffd9cf"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #faebf4;" data-color="#faebf4"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ffffc1;" data-color="#ffffc1"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #1bb0dd;" data-color="#1bb0dd"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #b3e754;" data-color="#b3e754"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #ff366d;" data-color="#ff366d"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #fd3832;" data-color="#fd3832"></div>
                  <div class="primary-color-item-ii" id="primary-color-item" style="background-color: #f9f944;" data-color="#f9f944"></div>
                  
                  <nav class="pagination-container-ii">
                      <button class="pagination-button-ii" id="prev-button-ii" aria-label="Previous page" title="Previous page">
                        &lt;
                      </button>                  
                      <div id="pagination-numbers-ii">
                      </div>                  
                      <button class="pagination-button-ii" id="next-button-ii" aria-label="Next page" title="Next page">
                        &gt;
                      </button>
                  </nav>    
                  </div>
              </div>
            </center>
            </div>
            
            <label><p>Pattern 2<b style="color:red;">*</b></p></label>
            <div class="primary-color">
              <div class="primary-button-text" id="toggle-button-iii"><div id="result_color_iii"></div><h4  style="display: inline-block;"> &nbsp; Pattern 2 </h4></div><center>
                <div class="primary-setOfColor" id="primary-setOfColor-iii"><div id="paginated-list-iii" data-current-page-layerone="1" aria-live="polite">
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fffa84;" data-color="#fffa84"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fee837;" data-color="#fee837"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fcd60f;" data-color="#fcd60f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fac80b;" data-color="#fac80b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #e4b010;" data-color="#e4b010"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffcd55;" data-color="#ffcd55"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffb637;" data-color="#ffb637"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ff8326;" data-color="#ff8326"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f95c1b;" data-color="#f95c1b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #cf4216;" data-color="#cf4216"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffba9c;" data-color="#ffba9c"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ff7a62;" data-color="#ff7a62"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f03b2b;" data-color="#f03b2b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c12519;" data-color="#c12519"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #801e1e;" data-color="#801e1e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffafa5;" data-color="#ffafa5"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f95552;" data-color="#f95552"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #d52231;" data-color="#d52231"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #b92b32;" data-color="#b92b32"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #6d2a31;" data-color="#6d2a31"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffa6a9;" data-color="#ffa6a9"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ff5e75;" data-color="#ff5e75"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #e91c56;" data-color="#e91c56"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a5123d;" data-color="#a5123d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #7d2041;" data-color="#7d2041"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ff9fc1;" data-color="#ff9fc1"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fa72a9;" data-color="#fa72a9"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #da3b6f;" data-color="#da3b6f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #bc3266;" data-color="#bc3266"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #862b5a;" data-color="#862b5a"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #efc3e1;" data-color="#efc3e1"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ce89bb;" data-color="#ce89bb"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #af5589;" data-color="#af5589"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #833f6e;" data-color="#833f6e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #6d3359;" data-color="#6d3359"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c0afd0;" data-color="#c0afd0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a081ba;" data-color="#a081ba"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #695190;" data-color="#695190"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #593979;" data-color="#593979"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #452757;" data-color="#452757"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #bfcdd0;" data-color="#bfcdd0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9bb3bd;" data-color="#9bb3bd"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #5b7f96;" data-color="#5b7f96"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #3b5769;" data-color="#3b5769"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #282e3b;" data-color="#282e3b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a0bcd4;" data-color="#a0bcd4"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #628ec0;" data-color="#628ec0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #345188;" data-color="#345188"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #2d3f6d;" data-color="#2d3f6d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #323950;" data-color="#323950"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #96c8da;" data-color="#96c8da"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #4aaad6;" data-color="#4aaad6"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #017abb;" data-color="#017abb"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #1f5a91;" data-color="#1f5a91"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #2a415f;" data-color="#2a415f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #95d5e6;" data-color="#95d5e6"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #66bdd0;" data-color="#66bdd0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #1287ab;" data-color="#1287ab"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #116c8a;" data-color="#116c8a"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #0b4861;" data-color="#0b4861"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #8fdad5;" data-color="#8fdad5"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #60c8c2;" data-color="#60c8c2"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #299c9d;" data-color="#299c9d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #12797c;" data-color="#12797c"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #0a5860;" data-color="#0a5860"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c5dedc;" data-color="#c5dedc"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9cc2c4;" data-color="#9cc2c4"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #6fa2aa;" data-color="#6fa2aa"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #4d7c87;" data-color="#4d7c87"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #195b6d;" data-color="#195b6d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #baeed1;" data-color="#baeed1"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #7fc9b1;" data-color="#7fc9b1"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #29a67f;" data-color="#29a67f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #06826d;" data-color="#06826d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #0c5b56;" data-color="#0c5b56"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #cbe8bc;" data-color="#cbe8bc"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #87d18c;" data-color="#87d18c"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #37a469;" data-color="#37a469"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #138b63;" data-color="#138b63"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #166d56;" data-color="#166d56"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c1e1c4;" data-color="#c1e1c4"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a1c99d;" data-color="#a1c99d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #70a479;" data-color="#70a479"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #518365;" data-color="#518365"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #2b4f43;" data-color="#2b4f43"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9bd68d;" data-color="#9bd68d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #5fae40;" data-color="#5fae40"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #2e8c3e;" data-color="#2e8c3e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #01733a;" data-color="#01733a"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #214a35;" data-color="#214a35"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #cae76e;" data-color="#cae76e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9bc94a;" data-color="#9bc94a"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #6c9f3f;" data-color="#6c9f3f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #577b3d;" data-color="#577b3d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #365535;" data-color="#365535"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #cfd958;" data-color="#cfd958"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c0bb16;" data-color="#c0bb16"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #949029;" data-color="#949029"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #5b5d20;" data-color="#5b5d20"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #414523;" data-color="#414523"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ded45b;" data-color="#ded45b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #d7bc32;" data-color="#d7bc32"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c6a02e;" data-color="#c6a02e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a18528;" data-color="#a18528"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #5f521b;" data-color="#5f521b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #e2d5b3;" data-color="#e2d5b3"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #cdba91;" data-color="#cdba91"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #b09a6d;" data-color="#b09a6d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9e7f4b;" data-color="#9e7f4b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #725b35;" data-color="#725b35"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f7bb75;" data-color="#f7bb75"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #b48844;" data-color="#b48844"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #8e5d29;" data-color="#8e5d29"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #644a25;" data-color="#644a25"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #4d3f27;" data-color="#4d3f27"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f3bb79;" data-color="#f3bb79"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c68448;" data-color="#c68448"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ab5b2d;" data-color="#ab5b2d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #753a1b;" data-color="#753a1b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #543826;" data-color="#543826"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f2d7b8;" data-color="#f2d7b8"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #edbe91;" data-color="#edbe91"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c87f58;" data-color="#c87f58"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #a85541;" data-color="#a85541"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #603a36;" data-color="#603a36"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f2d2b9;" data-color="#f2d2b9"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ecb59f;" data-color="#ecb59f"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #c57d75;" data-color="#c57d75"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ae4d53;" data-color="#ae4d53"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #85343b;" data-color="#85343b"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ced2cd;" data-color="#ced2cd"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #aeb3b0;" data-color="#aeb3b0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #939794;" data-color="#939794"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #676d69;" data-color="#676d69"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #3a403e;" data-color="#3a403e"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #dbd2c3;" data-color="#dbd2c3"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #bab1a0;" data-color="#bab1a0"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #9d9180;" data-color="#9d9180"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #837969;" data-color="#837969"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #585047;" data-color="#585047"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #e0eae9;" data-color="#e0eae9"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #e5f7e2;" data-color="#e5f7e2"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ffd9cf;" data-color="#ffd9cf"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #F7F7F7;" data-color="#F7F7F7"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #EEEEEE;" data-color="#EEEEEE"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #1bb0dd;" data-color="#1bb0dd"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #b3e754;" data-color="#b3e754"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #ff366d;" data-color="#ff366d"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #fd3832;" data-color="#fd3832"></div>
                  <div class="primary-color-item-iii" id="primary-color-item" style="background-color: #f9f944;" data-color="#f9f944"></div>                  
                  <nav class="pagination-container-iii">
                      <button class="pagination-button-iii" id="prev-button-iii" aria-label="Previous page" title="Previous page">
                        &lt;
                      </button>                  
                      <div id="pagination-numbers-iii">
                      </div>                  
                      <button class="pagination-button-iii" id="next-button-iii" aria-label="Next page" title="Next page">
                        &gt;
                      </button>
                  </nav>    
                  </div>
              </div>
            </center>
          </div>


          <label><p>Outline<b style="color:red;">*</b></p></label>
            <div class="primary-color">
              <div class="primary-button-text" id="toggle-button-iv"><div id="result_color_iv"></div><h4  style="display: inline-block;"> &nbsp; Outline </h4></div><center>
                <div class="primary-setOfColor" id="primary-setOfColor-iv"><div id="paginated-list-iv" data-current-page-layertwo="1" aria-live="polite">
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fffa84;" data-color="#fffa84"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fee837;" data-color="#fee837"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fcd60f;" data-color="#fcd60f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fac80b;" data-color="#fac80b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #e4b010;" data-color="#e4b010"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffcd55;" data-color="#ffcd55"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffb637;" data-color="#ffb637"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ff8326;" data-color="#ff8326"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f95c1b;" data-color="#f95c1b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #cf4216;" data-color="#cf4216"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffba9c;" data-color="#ffba9c"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ff7a62;" data-color="#ff7a62"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f03b2b;" data-color="#f03b2b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c12519;" data-color="#c12519"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #801e1e;" data-color="#801e1e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffafa5;" data-color="#ffafa5"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f95552;" data-color="#f95552"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #d52231;" data-color="#d52231"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #b92b32;" data-color="#b92b32"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #6d2a31;" data-color="#6d2a31"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffa6a9;" data-color="#ffa6a9"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ff5e75;" data-color="#ff5e75"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #e91c56;" data-color="#e91c56"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a5123d;" data-color="#a5123d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #7d2041;" data-color="#7d2041"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ff9fc1;" data-color="#ff9fc1"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fa72a9;" data-color="#fa72a9"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #da3b6f;" data-color="#da3b6f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #bc3266;" data-color="#bc3266"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #862b5a;" data-color="#862b5a"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #efc3e1;" data-color="#efc3e1"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ce89bb;" data-color="#ce89bb"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #af5589;" data-color="#af5589"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #833f6e;" data-color="#833f6e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #6d3359;" data-color="#6d3359"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c0afd0;" data-color="#c0afd0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a081ba;" data-color="#a081ba"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #695190;" data-color="#695190"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #593979;" data-color="#593979"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #452757;" data-color="#452757"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #bfcdd0;" data-color="#bfcdd0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9bb3bd;" data-color="#9bb3bd"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #5b7f96;" data-color="#5b7f96"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #3b5769;" data-color="#3b5769"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #282e3b;" data-color="#282e3b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a0bcd4;" data-color="#a0bcd4"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #628ec0;" data-color="#628ec0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #345188;" data-color="#345188"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #2d3f6d;" data-color="#2d3f6d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #323950;" data-color="#323950"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #96c8da;" data-color="#96c8da"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #4aaad6;" data-color="#4aaad6"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #017abb;" data-color="#017abb"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #1f5a91;" data-color="#1f5a91"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #2a415f;" data-color="#2a415f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #95d5e6;" data-color="#95d5e6"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #66bdd0;" data-color="#66bdd0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #1287ab;" data-color="#1287ab"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #116c8a;" data-color="#116c8a"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #0b4861;" data-color="#0b4861"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #8fdad5;" data-color="#8fdad5"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #60c8c2;" data-color="#60c8c2"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #299c9d;" data-color="#299c9d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #12797c;" data-color="#12797c"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #0a5860;" data-color="#0a5860"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c5dedc;" data-color="#c5dedc"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9cc2c4;" data-color="#9cc2c4"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #6fa2aa;" data-color="#6fa2aa"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #4d7c87;" data-color="#4d7c87"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #195b6d;" data-color="#195b6d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #baeed1;" data-color="#baeed1"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #7fc9b1;" data-color="#7fc9b1"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #29a67f;" data-color="#29a67f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #06826d;" data-color="#06826d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #0c5b56;" data-color="#0c5b56"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #cbe8bc;" data-color="#cbe8bc"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #87d18c;" data-color="#87d18c"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #37a469;" data-color="#37a469"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #138b63;" data-color="#138b63"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #166d56;" data-color="#166d56"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c1e1c4;" data-color="#c1e1c4"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a1c99d;" data-color="#a1c99d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #70a479;" data-color="#70a479"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #518365;" data-color="#518365"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #2b4f43;" data-color="#2b4f43"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9bd68d;" data-color="#9bd68d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #5fae40;" data-color="#5fae40"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #2e8c3e;" data-color="#2e8c3e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #01733a;" data-color="#01733a"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #214a35;" data-color="#214a35"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #cae76e;" data-color="#cae76e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9bc94a;" data-color="#9bc94a"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #6c9f3f;" data-color="#6c9f3f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #577b3d;" data-color="#577b3d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #365535;" data-color="#365535"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #cfd958;" data-color="#cfd958"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c0bb16;" data-color="#c0bb16"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #949029;" data-color="#949029"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #5b5d20;" data-color="#5b5d20"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #414523;" data-color="#414523"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ded45b;" data-color="#ded45b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #d7bc32;" data-color="#d7bc32"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c6a02e;" data-color="#c6a02e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a18528;" data-color="#a18528"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #5f521b;" data-color="#5f521b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #e2d5b3;" data-color="#e2d5b3"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #cdba91;" data-color="#cdba91"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #b09a6d;" data-color="#b09a6d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9e7f4b;" data-color="#9e7f4b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #725b35;" data-color="#725b35"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f7bb75;" data-color="#f7bb75"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #b48844;" data-color="#b48844"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #8e5d29;" data-color="#8e5d29"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #644a25;" data-color="#644a25"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #4d3f27;" data-color="#4d3f27"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f3bb79;" data-color="#f3bb79"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c68448;" data-color="#c68448"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ab5b2d;" data-color="#ab5b2d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #753a1b;" data-color="#753a1b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #543826;" data-color="#543826"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f2d7b8;" data-color="#f2d7b8"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #edbe91;" data-color="#edbe91"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c87f58;" data-color="#c87f58"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #a85541;" data-color="#a85541"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #603a36;" data-color="#603a36"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f2d2b9;" data-color="#f2d2b9"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ecb59f;" data-color="#ecb59f"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #c57d75;" data-color="#c57d75"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ae4d53;" data-color="#ae4d53"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #85343b;" data-color="#85343b"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ced2cd;" data-color="#ced2cd"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #aeb3b0;" data-color="#aeb3b0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #939794;" data-color="#939794"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #676d69;" data-color="#676d69"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #3a403e;" data-color="#3a403e"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #dbd2c3;" data-color="#dbd2c3"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #bab1a0;" data-color="#bab1a0"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #9d9180;" data-color="#9d9180"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #837969;" data-color="#837969"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #585047;" data-color="#585047"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #e0eae9;" data-color="#e0eae9"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #e5f7e2;" data-color="#e5f7e2"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ffd9cf;" data-color="#ffd9cf"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #F7F7F7;" data-color="#F7F7F7"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #EEEEEE;" data-color="#EEEEEE"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #1bb0dd;" data-color="#1bb0dd"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #b3e754;" data-color="#b3e754"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #ff366d;" data-color="#ff366d"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #fd3832;" data-color="#fd3832"></div>
                  <div class="primary-color-item-iv" id="primary-color-item" style="background-color: #f9f944;" data-color="#f9f944"></div>
                  <nav class="pagination-container-iv">
                      <button class="pagination-button-iv" id="prev-button-iv" aria-label="Previous page" title="Previous page">
                        &lt;
                      </button>                  
                      <div id="pagination-numbers-iv">
                      </div>                  
                      <button class="pagination-button-iv" id="next-button-iv" aria-label="Next page" title="Next page">
                        &gt;
                      </button>
                  </nav>    
                  </div>
              </div>
            </center>
            <br>
             <hr> 
            
            <center>
            <fieldset class="fieldset-color-trash">
              <button name="setThreeColor" class="setThreeColor" id="textButton" title="Text"><i class="bi bi-fonts"></i></button>
              <button name="setThreeColor" class="setThreeColor" id="imgButton"  title="Add Image(Not Activated)" disabled><i class="bi bi-images"></i></button><span style="display:none;">Add Image</span>
              <button name="setThreeColor" class="setThreeColor" id="uploadButton"  title="Upload(Not Activated)" disabled><i class="bi bi-upload"></i></button><span style="display:none;">Upload Your design</span>
              <button name="setThreeColor" class="setThreeColor" id="reset" onclick="resetColor()" value="#ffffff" title="Reset Colour"><i class="bi bi-trash"></i></button><span style="display:none;">Reset Colour</span>
              <button name="setThreeColor" class="setThreeColor" id="downloadButton"  title="Generate and Download"><i class="bi bi-save"></i></button><span style="display:none;">Save</span>
              <button name="setThreeColor" class="setThreeColor" id="printer"  title="Print(Not Activated)" disabled><i class="bi bi-printer"></i></button><span style="display:none;">Printer</span>
              <button name="setThreeColor" class="setThreeColor" id="share"  title="Share(Not Activated)" disabled><i class="bi bi-share"></i></button><span style="display:none;">Share</span>
              <button name="setThreeColor" class="setThreeColor" id="chat"  title="Chat(Not Activated)" disabled><i class="bi bi-chat"></i></button><span style="display:none;">Chat</span>
            </fieldset>
            <hr>
           <a href="./orderbook.php?id=<?PHP echo $refid ;?>"><button class="process-btn-for-product"><img src="./images/process.png" width="20" height="20"> <p>Order this Product</p></button></a>
          </center>
          </div>
          
          </p>
        </div>
        
        </div>
       </center>
       
       
      <script>
        function attachDateAndTime(name) {
            // Get the current date and time
            const currentDate = new Date();

            // Format the date and time as a string
            const formattedDate = currentDate.toLocaleDateString();
            const formattedTime = currentDate.toLocaleTimeString();

            // Combine the name with the date and time
            const result = `${name}_${formattedDate}_${formattedTime}`;

            return result;
        }

         function resetColor() {
          document.getElementById("result_color_i").style.backgroundColor = "#00C4FF";
          document.getElementById("result_color_ii").style.backgroundColor = "#19376D";
          document.getElementById("result_color_iii").style.backgroundColor = "#FFFFFF";
          document.getElementById("result_color_iv").style.backgroundColor = "#000000";
      }
      function attachDateAndTime(name) {
          // Get the current date and time
          const currentDate = new Date();

          // Format the date and time as a string
          const formattedDate = currentDate.toLocaleDateString();
          const formattedTime = currentDate.toLocaleTimeString();

          // Combine the name with the date and time
          const result = `${name}_${formattedDate}_${formattedTime}`;

          return result;
        }

        $(document).ready(function($) {
        $(".uploadlogo").change(function() {
          var filename = readURL(this);
          $(this).parent().children('span').html(filename);
        });
        function readURL(input) {
          var url = input.value;
          var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
          if (input.files && input.files[0] && (
            ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf"            
            )) {
            var path = $(input).val();
            var filename = path.replace(/^.*\\/, "");
            $('.fileUpload span').html('Uploaded Proof : ' + filename);
            return "Uploaded file : "+filename;
          } else {
            $(input).val("");
            return "Only jpg,pdf,zip,psd,png,eps,ai,dst,emb formats are allowed!";
          }
        }
        });
      </script>
       <script>
        function rgbToHex(rgbString) {
          // Convert the RGB string to an array of integers
          const rgb = rgbString.substring(4, rgbString.length - 1)
                               .replace(/ /g, '')
                               .split(',');
          const r = parseInt(rgb[0]);
          const g = parseInt(rgb[1]);
          const b = parseInt(rgb[2]);
        
          // Convert the RGB values to a hexadecimal color code
          const hex = '#' + ((r << 16) | (g << 8) | b).toString(16).padStart(6, '0');
          return hex;
        }

       </script>
       <script>
          $(document).ready(function () {
            $("#show").click(function(){
                $("#hiddent-data").attr("style", "display:block").show();
          });
          $("#hidden-fieldset-i").click(function () {
                $("#hiddent-data").attr("style", "display:none").hide();
          }); 
          $('#textButton').click(function() {
                $('.textForm').toggle();             
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>      

      $(document).ready(function() {
  
          let imgLayerOne = document.getElementById('my-image-layer-one');
          let imgLayerTwo = document.getElementById('my-image-layer-two');
          let imgLayerThree = document.getElementById('my-image-layer-three');
          let imgLayer = document.getElementById('my-image-i');
                  
          // Create a canvas element
          const canvas = document.createElement('canvas');
          
          
          //-----------------------------------------------START-------------------------------------------------------
          // first layer start here & Wait for the image to load before setting the canvas dimensions
          imgLayerOne.onload = function() {
                  canvas.width = imgLayerOne.width;
                  canvas.height = imgLayerOne.height;
  
          // Get the canvas context and draw the image onto it
          const ctx = canvas.getContext('2d');
          
          ctx.drawImage(imgLayerOne, 0, 0, imgLayerOne.width, imgLayerOne.height);
          
          // Get the image data for the canvas
          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
          
              // Change the color of non-transparent pixels
          function changeColor(selectedColor) {
            for (let i = 0; i < imageData.data.length; i += 4) {
              const r = imageData.data[i];
              const g = imageData.data[i + 1];
              const b = imageData.data[i + 2];
              const a = imageData.data[i + 3];     
  
              // If the pixel is not transparent, change its color
              if (a !== 0) {
                imageData.data[i] = getRed(selectedColor); // Red component
                imageData.data[i + 1] = getGreen(selectedColor); // Green component
                imageData.data[i + 2] = getBlue(selectedColor); // Blue component
                imageData.data[i + 3] = a; // Alpha component
              }
            }
            
              // Put the modified image data back onto the canvas
              ctx.putImageData(imageData, 0, 0);
  
              // Convert the canvas back to an image
              const newImg = new Image();
              newImg.onload = function() {
              imgLayerOne.parentNode.replaceChild(newImg, imgLayerOne);
              imgLayerOne = newImg;
              };

              newImg.src = canvas.toDataURL('image/png');
              newImg.setAttribute('class','genimg');
              }

              // Change the color when the input value changes
            const colorPicker = document.getElementById('primary-setOfColor-i');
            const colors = colorPicker.querySelectorAll('.primary-color-item-i');

            // Select the new color div and set its background color to white
            const newColor = document.getElementById('result_color_i');
            newColor.style.backgroundColor = '#87CEEB';

          // Add a click event listener to each color div
          colors.forEach(color => {
            color.addEventListener('click', () => {
              // Get the selected color and set it as the background color of the new color div
              const selectedColor = color.style.backgroundColor;
              const hexColor = rgbToHex(selectedColor);
              newColor.style.backgroundColor = hexColor;
              newColor.setAttribute('data-color', hexColor);
              // Change the color of the image
              changeColor(hexColor);
            });
          });
        };
  
              
          //-------------------------------------------------END-------------------------------------------------------
  
          
          //-----------------------------------------------START-------------------------------------------------------  
  
          //Second layer start here
          imgLayerTwo.onload = function() {
                  canvas.width = imgLayerTwo.width;
                  canvas.height = imgLayerTwo.height;
  
          // Get the canvas context and draw the image onto it
          const ctx = canvas.getContext('2d');
          
          ctx.drawImage(imgLayerTwo, 0, 0, imgLayerTwo.width, imgLayerTwo.height);
  
          // Get the image data for the canvas
          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                          
           // Change the color of non-transparent pixels
           function changeColor(selectedColor) {
            for (let i = 0; i < imageData.data.length; i += 4) {
              const r = imageData.data[i];
              const g = imageData.data[i + 1];
              const b = imageData.data[i + 2];
              const a = imageData.data[i + 3];     
  
              // If the pixel is not transparent, change its color
              if (a !== 0) {
                imageData.data[i] = getRed(selectedColor); // Red component
                imageData.data[i + 1] = getGreen(selectedColor); // Green component
                imageData.data[i + 2] = getBlue(selectedColor); // Blue component
                imageData.data[i + 3] = a; // Alpha component
              }
            }
  
              // Put the modified image data back onto the canvas
              ctx.putImageData(imageData, 0, 0);
  
              // Convert the canvas back to an image
              const newImg = new Image();
              newImg.onload = function() {
              imgLayerTwo.parentNode.replaceChild(newImg, imgLayerTwo);
              imgLayerTwo = newImg;
            };
            newImg.src = canvas.toDataURL('image/png');
            newImg.setAttribute('class','genimg');
          }
  
              // Change the color when the input value changes
          // Change the color when the input value changes
          const colorPickerI = document.getElementById('primary-setOfColor-ii');
          const colorsI = colorPickerI.querySelectorAll('.primary-color-item-ii');

          // Select the new color div and set its background color to white
          const newColorI = document.getElementById('result_color_ii');
          newColorI.style.backgroundColor = '#000080';

        // Add a click event listener to each color div
        colorsI.forEach(color => {
          color.addEventListener('click', () => {
            // Get the selected color and set it as the background color of the new color div
            const selectedColorI = color.style.backgroundColor;
            const hexColorI = rgbToHex(selectedColorI);
            newColorI.style.backgroundColor = hexColorI;
            newColorI.setAttribute('data-color', hexColorI);
            // Change the color of the image
            changeColor(hexColorI);
          });
        });
        };
  
          //-------------------------------------------------END-------------------------------------------------------
          
          //-----------------------------------------------START------------------------------------------------------- 
  
          //third layer start
          imgLayerThree.onload = function() {
                  canvas.width = imgLayerThree.width;
                  canvas.height = imgLayerThree.height;
  
          // Get the canvas context and draw the image onto it
          const ctx = canvas.getContext('2d');
          
          ctx.drawImage(imgLayerThree, 0, 0, imgLayerThree.width, imgLayerThree.height);
  
          // Get the image data for the canvas
          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
          
          function changeColor(selectedColor) {
            for (let i = 0; i < imageData.data.length; i += 4) {
              const r = imageData.data[i];
              const g = imageData.data[i + 1];
              const b = imageData.data[i + 2];
              const a = imageData.data[i + 3];     
              
              // If the pixel is not transparent, change its color
              if (a !== 0) {
                imageData.data[i] = getRed(selectedColor); // Red component
                imageData.data[i + 1] = getGreen(selectedColor); // Green component
                imageData.data[i + 2] = getBlue(selectedColor);
                imageData.data[i + 3] = a; // Alpha component
              }
            }
  
              // Put the modified image data back onto the canvas
              ctx.putImageData(imageData, 0, 0);
  
              // Convert the canvas back to an image
              const newImg = new Image();
              newImg.onload = function() {
              imgLayerThree.parentNode.replaceChild(newImg, imgLayerThree);
              imgLayerThree = newImg;
            };
            newImg.src = canvas.toDataURL('image/png');
            newImg.setAttribute('class','genimg');
          }
             // Change the color when the input value changes
          // Change the color when the input value changes
          const colorPickerII = document.getElementById('primary-setOfColor-iii');
          const colorsII = colorPickerII.querySelectorAll('.primary-color-item-iii');

          // Select the new color div and set its background color to white
          const newColorII = document.getElementById('result_color_iii');
          newColorII.style.backgroundColor = '#FFFFFF';

        // Add a click event listener to each color div
        colorsII.forEach(color => {
          color.addEventListener('click', () => {
            // Get the selected color and set it as the background color of the new color div
            const selectedColorII = color.style.backgroundColor;
            const hexColorII = rgbToHex(selectedColorII);
            newColorII.style.backgroundColor = hexColorII;
            newColorII.setAttribute('data-color', hexColorII);
            // Change the color of the image
            changeColor(hexColorII);
          });
        });
        };
  
  
          //-------------------------------------------------END-------------------------------------------------------
          //-----------------------------------------------START-------------------------------------------------------     
  
          // outline start here
          imgLayer.onload = function() {
                  canvas.width = imgLayer.width;
                  canvas.height = imgLayer.height;
  
          // Get the canvas context and draw the image onto it
          const ctx = canvas.getContext('2d');
          
          ctx.drawImage(imgLayer, 0, 0, imgLayer.width, imgLayer.height);
  
          // Get the image data for the canvas
          const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
       
        function changeColor(selectedColor) {                   
          // Loop through each pixel of the image data
          for (let i = 0; i < imageData.data.length; i += 4) {
              const r = imageData.data[i];
              const g = imageData.data[i + 1];
              const b = imageData.data[i + 2];
              const a = imageData.data[i + 3];     
              
              // If the pixel is not transparent, change its color
              if (a !== 0) {
                  imageData.data[i] = 0; // Red component
                  imageData.data[i + 1] = 0; // Green component
                  imageData.data[i + 2] = 0; // Blue component
                  imageData.data[i + 3] = a; // Alpha component
              }
          }
  
              // Put the modified image data back onto the canvas
              ctx.putImageData(imageData, 0, 0);

              // Convert the canvas back to an image
              const newImg = new Image();
                newImg.onload = function() {
                  imgLayer.parentNode.replaceChild(newImg, imgLayer);
                  imgLayer = newImg;
                };
              newImg.src = canvas.toDataURL('image/png');
              newImg.setAttribute('class','genimg');
        }
              // Replace the original image with the modified image
              // imgLayer.parentNode.replaceChild(newImg, imgLayer);
              const colorPickerIV = document.getElementById('primary-setOfColor-iv');
          const colorsIV = colorPickerIV.querySelectorAll('.primary-color-item-iv');

          // Select the new color div and set its background color to white
          const newColorIV = document.getElementById('result_color_iv');
          newColorIV.style.backgroundColor = '#000000';

        // Add a click event listener to each color div
        colorsIV.forEach(color => {
          color.addEventListener('click', () => {
            // Get the selected color and set it as the background color of the new color div
            const selectedColorIV = color.style.backgroundColor;
            const hexColorIV = rgbToHex(selectedColorIV);
            newColorIV.style.backgroundColor = hexColorIV;
            newColorIV.setAttribute('data-color', hexColorIV);
            // Change the color of the image
            changeColor(hexColorIV);
          });
        });

              };
  
      //-------------------------------------------------END-------------------------------------------------------

      // Set the source of the front-image      
      imgLayerOne.src = "<?PHP echo esc_url( $plugin_url.'front_product_images/'.$frontBody, true  ); ?>";     
      imgLayerTwo.src = "<?PHP echo esc_url( $plugin_url.'front_product_images/'.$frontPatternI, true  ); ?>";     
      imgLayerThree.src = "<?PHP echo esc_url( $plugin_url.'front_product_images/'.$frontPatternII, true  ); ?>";     
      imgLayer.src = "<?PHP echo esc_url( $plugin_url.'front_product_images/'.$frontOutline, true  ); ?>";      
     
      function downloadCanvas() {
              const canvas = document.createElement('canvas');
              const ctx = canvas.getContext('2d');

              // Set the canvas dimensions to match the largest image
              canvas.width = Math.max(
                imgLayerOne.width,
                imgLayerTwo.width,
                imgLayerThree.width,
                imgLayer.width
              );
              canvas.height = Math.max(
                imgLayerOne.height,
                imgLayerTwo.height,
                imgLayerThree.height,
                imgLayer.height
              );

              // Draw each modified image on the canvas
              ctx.drawImage(imgLayerOne, 0, 0);
              ctx.drawImage(imgLayerTwo, 0, 0);
              ctx.drawImage(imgLayerThree, 0, 0);
              ctx.drawImage(imgLayer, 0, 0);

              // Get the text from the textarea
              const textToAdd = document.getElementById('text').value;
              const selectedFont = document.getElementById('font-name').value;
              const textSize = document.getElementById('text-size').value;
              const fontWeight = document.getElementById('text-weight').value;
              const fontColor = document.getElementById('font-color').value;

              // Configure text style based on form inputs
              ctx.font = `${fontWeight} ${textSize}px ${selectedFont}`;
              ctx.fillStyle = fontColor;

              // Calculate the position to center the text at the top
              const textWidth = ctx.measureText(textToAdd).width;
              const centerX = (canvas.width - textWidth) / 2;
              const centerY = (canvas.height - 30) / 2; // Adjust this value to control the vertical position

              // Add the text to the canvas at the calculated position
              ctx.fillText(textToAdd, centerX, centerY);

              // Create a download link for the canvas
              const downloadLink = document.createElement('a');
              downloadLink.href = canvas.toDataURL('image/png');
              const name = "Cyberartboard_FrontView";
              const FrontfinalImage = attachDateAndTime(name) + ".png";
              downloadLink.download = FrontfinalImage;

              // Trigger a click event to initiate the download
              downloadLink.click();
            }

            // Attach the download function to the button
            const downloadButton = document.getElementById('downloadButton');
            downloadButton.addEventListener('click', downloadCanvas);

            // Function to generate and display the preview image
            function generatePreview() {
              const canvas = document.createElement('canvas');
              const ctx = canvas.getContext('2d');

              // Set the canvas dimensions to match the largest image
              canvas.width = Math.max(
                imgLayerOne.width,
                imgLayerTwo.width,
                imgLayerThree.width,
                imgLayer.width
              );

              canvas.height = Math.max(
                imgLayerOne.height,
                imgLayerTwo.height,
                imgLayerThree.height,
                imgLayer.height
              );

              // Draw each modified image on the canvas
              ctx.drawImage(imgLayerOne, 0, 0);
              ctx.drawImage(imgLayerTwo, 0, 0);
              ctx.drawImage(imgLayerThree, 0, 0);
              ctx.drawImage(imgLayer, 0, 0);

              // Get the text from the textarea
              const textToAdd = document.getElementById('text').value;
              const selectedFont = document.getElementById('font-name').value;
              const textSize = document.getElementById('text-size').value;
              const fontWeight = document.getElementById('text-weight').value;
              const fontColor = document.getElementById('font-color').value;

              // Configure text style based on form inputs
              ctx.font = `${fontWeight} ${textSize}px ${selectedFont}`;
              ctx.fillStyle = fontColor;

              // Calculate the position to center the text
              const textWidth = ctx.measureText(textToAdd).width;
              const centerX = (canvas.width - textWidth) / 2;
              const centerY = (canvas.height - 30) / 2; // Adjust this value to vertically center the text

              // Add the text to the canvas at the calculated position
              ctx.fillText(textToAdd, centerX, centerY);

              // Convert the canvas to a data URL and set it as the src of the preview image
              const dataURL = canvas.toDataURL('image/png');
              const previewImage = document.getElementById('preview-image');
              previewImage.src = dataURL;

              // Display the preview image
              previewImage.style.display = 'block';
            }

            // Attach the generatePreview function to the "Add Text" button
            const addTextButton = document.getElementById('btn-add-text');
            addTextButton.addEventListener('click', generatePreview);

      });
      
  </script>



  <script>      

    $(document).ready(function() {

        let imgLayerOneI = document.getElementById('my-image-layer-one-i');
        let imgLayerTwoI = document.getElementById('my-image-layer-two-i');
        let imgLayerThreeI = document.getElementById('my-image-layer-three-i');
        let imgLayerI = document.getElementById('my-image-i-i');

        
        // Create a canvas element
        const canvas = document.createElement('canvas');
        
        //-----------------------------------------------START-------------------------------------------------------
        // first layer start here & Wait for the image to load before setting the canvas dimensions
        imgLayerOneI.onload = function() {
                canvas.width = imgLayerOneI.width;
                canvas.height = imgLayerOneI.height;

        // Get the canvas context and draw the image onto it
        const ctx = canvas.getContext('2d');
        
        ctx.drawImage(imgLayerOneI, 0, 0, imgLayerOneI.width, imgLayerOneI.height);
        
        // Get the image data for the canvas
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        
            // Change the color of non-transparent pixels
        function changeColor(selectedColor) {
          for (let i = 0; i < imageData.data.length; i += 4) {
            const r = imageData.data[i];
            const g = imageData.data[i + 1];
            const b = imageData.data[i + 2];
            const a = imageData.data[i + 3];     

            // If the pixel is not transparent, change its color
            if (a !== 0) {
              imageData.data[i] = getRed(selectedColor); // Red component
              imageData.data[i + 1] = getGreen(selectedColor); // Green component
              imageData.data[i + 2] = getBlue(selectedColor); // Blue component
              imageData.data[i + 3] = a; // Alpha component
            }
          }

            // Put the modified image data back onto the canvas
            ctx.putImageData(imageData, 0, 0);

            // Convert the canvas back to an image
            const newImg = new Image();
            newImg.onload = function() {
            imgLayerOneI.parentNode.replaceChild(newImg, imgLayerOneI);
            imgLayerOneI = newImg;
            };
            newImg.src = canvas.toDataURL('image/png');
            newImg.setAttribute('class','genimg');
            }
            // Change the color when the input value changes
        // Change the color when the input value changes
        const colorPicker = document.getElementById('primary-setOfColor-i');
        const colors = colorPicker.querySelectorAll('.primary-color-item-i');

        // Select the new color div and set its background color to white
        const newColor = document.getElementById('result_color_i');
        newColor.style.backgroundColor = '#87CEEB';

      // Add a click event listener to each color div
      colors.forEach(color => {
        color.addEventListener('click', () => {
          // Get the selected color and set it as the background color of the new color div
          const selectedColor = color.style.backgroundColor;
          const hexColor = rgbToHex(selectedColor);
          newColor.style.backgroundColor = hexColor;
          newColor.setAttribute('data-color', hexColor);
          // Change the color of the image
          changeColor(hexColor);
        });
      });
      };

            
        //-------------------------------------------------END-------------------------------------------------------

        
        //-----------------------------------------------START-------------------------------------------------------  

        //Second layer start here
        imgLayerTwoI.onload = function() {
                canvas.width = imgLayerTwoI.width;
                canvas.height = imgLayerTwoI.height;

        // Get the canvas context and draw the image onto it
        const ctx = canvas.getContext('2d');
        
        ctx.drawImage(imgLayerTwoI, 0, 0, imgLayerTwoI.width, imgLayerTwoI.height);

        // Get the image data for the canvas
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        
         // Change the color of non-transparent pixels
         function changeColor(selectedColor) {
          for (let i = 0; i < imageData.data.length; i += 4) {
            const r = imageData.data[i];
            const g = imageData.data[i + 1];
            const b = imageData.data[i + 2];
            const a = imageData.data[i + 3];     

            // If the pixel is not transparent, change its color
            if (a !== 0) {
              imageData.data[i] = getRed(selectedColor); // Red component
              imageData.data[i + 1] = getGreen(selectedColor); // Green component
              imageData.data[i + 2] = getBlue(selectedColor); // Blue component
              imageData.data[i + 3] = a; // Alpha component
            }
          }

            // Put the modified image data back onto the canvas
            ctx.putImageData(imageData, 0, 0);

            // Convert the canvas back to an image
            const newImg = new Image();
            newImg.onload = function() {
            imgLayerTwoI.parentNode.replaceChild(newImg, imgLayerTwoI);
            imgLayerTwoI = newImg;
          };
          newImg.src = canvas.toDataURL('image/png');
          newImg.setAttribute('class','genimg');
        }

            // Change the color when the input value changes
       // Change the color when the input value changes
       const colorPickerI = document.getElementById('primary-setOfColor-ii');
       const colorsI = colorPickerI.querySelectorAll('.primary-color-item-ii');

       // Select the new color div and set its background color to white
       const newColorI = document.getElementById('result_color_ii');
       newColorI.style.backgroundColor = '#000080';

     // Add a click event listener to each color div
     colorsI.forEach(color => {
       color.addEventListener('click', () => {
         // Get the selected color and set it as the background color of the new color div
         const selectedColorI = color.style.backgroundColor;
         const hexColorI = rgbToHex(selectedColorI);
         newColorI.style.backgroundColor = hexColorI;
         newColorI.setAttribute('data-color', hexColorI);
         // Change the color of the image
         changeColor(hexColorI);
       });
     });
      };

        //-------------------------------------------------END-------------------------------------------------------
        
        //-----------------------------------------------START------------------------------------------------------- 

        //third layer start
        imgLayerThreeI.onload = function() {
                canvas.width = imgLayerThreeI.width;
                canvas.height = imgLayerThreeI.height;

        // Get the canvas context and draw the image onto it
        const ctx = canvas.getContext('2d');
        
        ctx.drawImage(imgLayerThreeI, 0, 0, imgLayerThreeI.width, imgLayerThreeI.height);

        // Get the image data for the canvas
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        
        function changeColor(selectedColor) {
          for (let i = 0; i < imageData.data.length; i += 4) {
            const r = imageData.data[i];
            const g = imageData.data[i + 1];
            const b = imageData.data[i + 2];
            const a = imageData.data[i + 3];     
            
            // If the pixel is not transparent, change its color
            if (a !== 0) {
              imageData.data[i] = getRed(selectedColor); // Red component
              imageData.data[i + 1] = getGreen(selectedColor); // Green component
              imageData.data[i + 2] = getBlue(selectedColor);
              imageData.data[i + 3] = a; // Alpha component
            }
          }

            // Put the modified image data back onto the canvas
            ctx.putImageData(imageData, 0, 0);

            // Convert the canvas back to an image
            const newImg = new Image();
            newImg.onload = function() {
            imgLayerThreeI.parentNode.replaceChild(newImg, imgLayerThreeI);
            imgLayerThreeI = newImg;
          };
          newImg.src = canvas.toDataURL('image/png');
          newImg.setAttribute('class','genimg');
        }
           // Change the color when the input value changes
       // Change the color when the input value changes
       const colorPickerII = document.getElementById('primary-setOfColor-iii');
       const colorsII = colorPickerII.querySelectorAll('.primary-color-item-iii');

       // Select the new color div and set its background color to white
       const newColorII = document.getElementById('result_color_iii');
       newColorII.style.backgroundColor = '#FFFFFF';

     // Add a click event listener to each color div
     colorsII.forEach(color => {
       color.addEventListener('click', () => {
         // Get the selected color and set it as the background color of the new color div
         const selectedColorII = color.style.backgroundColor;
         const hexColorII = rgbToHex(selectedColorII);
         newColorII.style.backgroundColor = hexColorII;
         newColorII.setAttribute('data-color', hexColorII);
         // Change the color of the image
         changeColor(hexColorII);
       });
     });
      };


        //-------------------------------------------------END-------------------------------------------------------
        //-----------------------------------------------START-------------------------------------------------------     

        // outline start here
        imgLayerI.onload = function() {
                canvas.width = imgLayerI.width;
                canvas.height = imgLayerI.height;

        // Get the canvas context and draw the image onto it
        const ctx = canvas.getContext('2d');
        
        ctx.drawImage(imgLayerI, 0, 0, imgLayerI.width, imgLayerI.height);

        // Get the image data for the canvas
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                        
        // Loop through each pixel of the image data
        for (let i = 0; i < imageData.data.length; i += 4) {
            const r = imageData.data[i];
            const g = imageData.data[i + 1];
            const b = imageData.data[i + 2];
            const a = imageData.data[i + 3];     
            
            // If the pixel is not transparent, change its color
            if (a !== 0) {
                imageData.data[i] = 0; // Red component
                imageData.data[i + 1] = 0; // Green component
                imageData.data[i + 2] = 0; // Blue component
                imageData.data[i + 3] = a; // Alpha component
            }
        }

            // Put the modified image data back onto the canvas
            ctx.putImageData(imageData, 0, 0);

            // Convert the canvas back to an image
            const newImg = new Image();
            
            newImg.src = canvas.toDataURL('image/png');
            newImg.setAttribute('class','genimg');

            // Replace the original image with the modified image
            imgLayerI.parentNode.replaceChild(newImg, imgLayerI);
            };

    //-------------------------------------------------END-------------------------------------------------------

    // Set the source of the sides-image    
    imgLayerOneI.src = "<?PHP echo esc_url( $plugin_url.'side_product_images/'.$sideBody, true ); ?>";     
    imgLayerTwoI.src = "<?PHP echo esc_url( $plugin_url.'side_product_images/'.$sidePatternI, true  ); ?>";     
    imgLayerThreeI.src = "<?PHP echo esc_url( $plugin_url.'side_product_images/'.$sidePatternII, true  ); ?>";     
    imgLayerI.src = "<?PHP echo esc_url( $plugin_url.'side_product_images/'.$sideOutline, true  ); ?>";     



    function downloadCanvas() {
              const canvas = document.createElement('canvas');
              const ctx = canvas.getContext('2d');

              // Set the canvas dimensions to match the largest image
              canvas.width = Math.max(
                imgLayerOneI.width,
                imgLayerTwoI.width,
                imgLayerThreeI.width,
                imgLayerI.width
              );
              canvas.height = Math.max(
                imgLayerOneI.height,
                imgLayerTwoI.height,
                imgLayerThreeI.height,
                imgLayerI.height
              );

              // Draw each modified image on the canvas
              ctx.drawImage(imgLayerOneI, 0, 0);
              ctx.drawImage(imgLayerTwoI, 0, 0);
              ctx.drawImage(imgLayerThreeI, 0, 0);
              ctx.drawImage(imgLayerI, 0, 0);

              // Create a download link for the canvas
              const downloadLink = document.createElement('a');
              downloadLink.href = canvas.toDataURL('image/png');
              const nameImageS = "Cyberartboard_SideView";
              const SidefinalImage = attachDateAndTime(nameImageS)+".png";
              downloadLink.download = SidefinalImage;

              // Trigger a click event to initiate the download
              downloadLink.click();
            }

            // Attach the download function to the button
            const downloadButton = document.getElementById('downloadButton');
            downloadButton.addEventListener('click', downloadCanvas);


    });
</script>

<script>      

  $(document).ready(function() {

    let imgLayerOneII = document.getElementById('my-image-layer-one-ii');
    let imgLayerTwoII = document.getElementById('my-image-layer-two-ii');
    let imgLayerThreeII = document.getElementById('my-image-layer-three-ii');
    let imgLayerII = document.getElementById('my-image-i-ii');
              
      // Create a canvas element
      const canvas = document.createElement('canvas');
      
      //-----------------------------------------------START-------------------------------------------------------
      // first layer start here & Wait for the image to load before setting the canvas dimensions
      imgLayerOneII.onload = function() {
              canvas.width = imgLayerOneII.width;
              canvas.height = imgLayerOneII.height;

      // Get the canvas context and draw the image onto it
      const ctx = canvas.getContext('2d');
      
      ctx.drawImage(imgLayerOneII, 0, 0, imgLayerOneII.width, imgLayerOneII.height);
      
      // Get the image data for the canvas
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
      
          // Change the color of non-transparent pixels
      function changeColor(selectedColor) {
        for (let i = 0; i < imageData.data.length; i += 4) {
          const r = imageData.data[i];
          const g = imageData.data[i + 1];
          const b = imageData.data[i + 2];
          const a = imageData.data[i + 3];     

          // If the pixel is not transparent, change its color
          if (a !== 0) {
            imageData.data[i] = getRed(selectedColor); // Red component
            imageData.data[i + 1] = getGreen(selectedColor); // Green component
            imageData.data[i + 2] = getBlue(selectedColor); // Blue component
            imageData.data[i + 3] = a; // Alpha component
          }
        }

          // Put the modified image data back onto the canvas
          ctx.putImageData(imageData, 0, 0);

          // Convert the canvas back to an image
          const newImg = new Image();
          newImg.onload = function() {
          imgLayerOneII.parentNode.replaceChild(newImg, imgLayerOneII);
          imgLayerOneII = newImg;
          };
          newImg.src = canvas.toDataURL('image/png');
          newImg.setAttribute('class','genimg');
          }
          // Change the color when the input value changes
      // Change the color when the input value changes
      const colorPicker = document.getElementById('primary-setOfColor-i');
      const colors = colorPicker.querySelectorAll('.primary-color-item-i');

      // Select the new color div and set its background color to white
      const newColor = document.getElementById('result_color_i');
      newColor.style.backgroundColor = '#87CEEB';

    // Add a click event listener to each color div
    colors.forEach(color => {
      color.addEventListener('click', () => {
        // Get the selected color and set it as the background color of the new color div
        const selectedColor = color.style.backgroundColor;
        const hexColor = rgbToHex(selectedColor);
        newColor.style.backgroundColor = hexColor;
        newColor.setAttribute('data-color', hexColor);
        // Change the color of the image
        changeColor(hexColor);
      });
    });
    };

          
      //-------------------------------------------------END-------------------------------------------------------

      
      //-----------------------------------------------START-------------------------------------------------------  

      //Second layer start here
      imgLayerTwoII.onload = function() {
              canvas.width = imgLayerTwoII.width;
              canvas.height = imgLayerTwoII.height;

      // Get the canvas context and draw the image onto it
      const ctx = canvas.getContext('2d');
      
      ctx.drawImage(imgLayerTwoII, 0, 0, imgLayerTwoII.width, imgLayerTwoII.height);

      // Get the image data for the canvas
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                      
       // Change the color of non-transparent pixels
       function changeColor(selectedColor) {
        for (let i = 0; i < imageData.data.length; i += 4) {
          const r = imageData.data[i];
          const g = imageData.data[i + 1];
          const b = imageData.data[i + 2];
          const a = imageData.data[i + 3];     

          // If the pixel is not transparent, change its color
          if (a !== 0) {
            imageData.data[i] = getRed(selectedColor); // Red component
            imageData.data[i + 1] = getGreen(selectedColor); // Green component
            imageData.data[i + 2] = getBlue(selectedColor); // Blue component
            imageData.data[i + 3] = a; // Alpha component
          }
        }

          // Put the modified image data back onto the canvas
          ctx.putImageData(imageData, 0, 0);

          // Convert the canvas back to an image
          const newImg = new Image();
          newImg.onload = function() {
          imgLayerTwoII.parentNode.replaceChild(newImg, imgLayerTwoII);
          imgLayerTwoII = newImg;
        };
        newImg.src = canvas.toDataURL('image/png');
        newImg.setAttribute('class','genimg');
      }

          // Change the color when the input value changes
      // Change the color when the input value changes
      const colorPickerI = document.getElementById('primary-setOfColor-ii');
      const colorsI = colorPickerI.querySelectorAll('.primary-color-item-ii');

      // Select the new color div and set its background color to white
      const newColorI = document.getElementById('result_color_ii');
      newColorI.style.backgroundColor = '#000080';

    // Add a click event listener to each color div
    colorsI.forEach(color => {
      color.addEventListener('click', () => {
        // Get the selected color and set it as the background color of the new color div
        const selectedColorI = color.style.backgroundColor;
        const hexColorI = rgbToHex(selectedColorI);
        newColorI.style.backgroundColor = hexColorI;
        newColorI.setAttribute('data-color', hexColorI);
        // Change the color of the image
        changeColor(hexColorI);
      });
    });
    };

      //-------------------------------------------------END-------------------------------------------------------
      
      //-----------------------------------------------START------------------------------------------------------- 

      //third layer start
      imgLayerThreeII.onload = function() {
              canvas.width = imgLayerThreeII.width;
              canvas.height = imgLayerThreeII.height;

      // Get the canvas context and draw the image onto it
      const ctx = canvas.getContext('2d');
      
      ctx.drawImage(imgLayerThreeII, 0, 0, imgLayerThreeII.width, imgLayerThreeII.height);

      // Get the image data for the canvas
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
      
      function changeColor(selectedColor) {
        for (let i = 0; i < imageData.data.length; i += 4) {
          const r = imageData.data[i];
          const g = imageData.data[i + 1];
          const b = imageData.data[i + 2];
          const a = imageData.data[i + 3];     
          
          // If the pixel is not transparent, change its color
          if (a !== 0) {
            imageData.data[i] = getRed(selectedColor); // Red component
            imageData.data[i + 1] = getGreen(selectedColor); // Green component
            imageData.data[i + 2] = getBlue(selectedColor);
            imageData.data[i + 3] = a; // Alpha component
          }
        }

          // Put the modified image data back onto the canvas
          ctx.putImageData(imageData, 0, 0);

          // Convert the canvas back to an image
          const newImg = new Image();
          newImg.onload = function() {
          imgLayerThreeII.parentNode.replaceChild(newImg, imgLayerThreeII);
          imgLayerThreeII = newImg;
        };
        newImg.src = canvas.toDataURL('image/png');
        newImg.setAttribute('class','genimg');
      }
         // Change the color when the input value changes
     // Change the color when the input value changes
     const colorPickerII = document.getElementById('primary-setOfColor-iii');
     const colorsII = colorPickerII.querySelectorAll('.primary-color-item-iii');

     // Select the new color div and set its background color to white
     const newColorII = document.getElementById('result_color_iii');
     newColorII.style.backgroundColor = '#FFFFFF';

   // Add a click event listener to each color div
   colorsII.forEach(color => {
     color.addEventListener('click', () => {
       // Get the selected color and set it as the background color of the new color div
       const selectedColorII = color.style.backgroundColor;
       const hexColorII = rgbToHex(selectedColorII);
       newColorII.style.backgroundColor = hexColorII;
       newColorII.setAttribute('data-color', hexColorII);
       // Change the color of the image
       changeColor(hexColorII);
     });
   });
    };


      //-------------------------------------------------END-------------------------------------------------------
      //-----------------------------------------------START-------------------------------------------------------     

      // outline start here
      imgLayerII.onload = function() {
              canvas.width = imgLayerII.width;
              canvas.height = imgLayerII.height;

      // Get the canvas context and draw the image onto it
      const ctx = canvas.getContext('2d');
      
      ctx.drawImage(imgLayerII, 0, 0, imgLayerII.width, imgLayerII.height);

      // Get the image data for the canvas
      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                      
      // Loop through each pixel of the image data
      for (let i = 0; i < imageData.data.length; i += 4) {
          const r = imageData.data[i];
          const g = imageData.data[i + 1];
          const b = imageData.data[i + 2];
          const a = imageData.data[i + 3];     
          
          // If the pixel is not transparent, change its color
          if (a !== 0) {
              imageData.data[i] = 0; // Red component
              imageData.data[i + 1] = 0; // Green component
              imageData.data[i + 2] = 0; // Blue component
              imageData.data[i + 3] = a; // Alpha component
          }
      }

          // Put the modified image data back onto the canvas
          ctx.putImageData(imageData, 0, 0);

          // Convert the canvas back to an image
          const newImg = new Image();
          
          newImg.src = canvas.toDataURL('image/png');
          newImg.setAttribute('class','genimg');

          // Replace the original image with the modified image
          imgLayerII.parentNode.replaceChild(newImg, imgLayerII);
          };

  //-------------------------------------------------END-------------------------------------------------------

  // Set the source of the back-image
  imgLayerOneII.src = "<?PHP echo esc_url( $plugin_url.'back_product_images/'.$backBody, true  ); ?>";     
  imgLayerTwoII.src = "<?PHP echo esc_url( $plugin_url.'back_product_images/'.$backPatternI, true  ); ?>";     
  imgLayerThreeII.src = "<?PHP echo esc_url( $plugin_url.'back_product_images/'.$backPatternII, true  ); ?>";     
  imgLayerII.src = "<?PHP echo esc_url( $plugin_url.'back_product_images/'.$backOutline, true  ); ?>";     
 

  function downloadCanvas() {
              const canvas = document.createElement('canvas');
              const ctx = canvas.getContext('2d');

              // Set the canvas dimensions to match the largest image
              canvas.width = Math.max(
                imgLayerOneII.width,
                imgLayerTwoII.width,
                imgLayerThreeII.width,
                imgLayerII.width
              );
              canvas.height = Math.max(
                imgLayerOneII.height,
                imgLayerTwoII.height,
                imgLayerThreeII.height,
                imgLayerII.height
              );

              // Draw each modified image on the canvas
              ctx.drawImage(imgLayerOneII, 0, 0);
              ctx.drawImage(imgLayerTwoII, 0, 0);
              ctx.drawImage(imgLayerThreeII, 0, 0);
              ctx.drawImage(imgLayerII, 0, 0);

              // Create a download link for the canvas
              const downloadLink = document.createElement('a');
              downloadLink.href = canvas.toDataURL('image/png');
              const nameImageB = "Cyberartboard_BackView";
              const BackfinalImage = attachDateAndTime(nameImageB)+".png";
              downloadLink.download = BackfinalImage;

              // Trigger a click event to initiate the download
              downloadLink.click();
            }

            // Attach the download function to the button
            const downloadButton = document.getElementById('downloadButton');
            downloadButton.addEventListener('click', downloadCanvas);
  
  });
</script>

  <script>
    $(document).ready(function($) {
      $('#imgviewi').click(function() {
        $('#viewi').show();
        $('#viewii').hide();
        $('#viewiii').hide();
    });

    $('#imgviewii').click(function() {
        $('#viewi').hide();
        $('#viewii').show();
        $('#viewiii').hide();
    });

    $('#imgviewiii').click(function() {
        $('#viewi').hide();
        $('#viewii').hide();
        $('#viewiii').show();
    });
    });
  </script>





  <script>
    $(document).ready(function() {
       $('#toggle-button-i').click(function() {
           $('#primary-setOfColor-i').toggle();
           $('#primary-setOfColor-ii').hide();
           $('#primary-setOfColor-iii').hide();
           $('#primary-setOfColor-iv').hide();
       });
       $('#toggle-button-ii').click(function() {
        $('#primary-setOfColor-ii').toggle();
        $('#primary-setOfColor-i').hide();
        $('#primary-setOfColor-iii').hide();
        $('#primary-setOfColor-iv').hide();
    });
    $('#toggle-button-iii').click(function() {
      $('#primary-setOfColor-iii').toggle();
      $('#primary-setOfColor-i').hide();
      $('#primary-setOfColor-ii').hide();
      $('#primary-setOfColor-iv').hide();
  });
  $('#toggle-button-iv').click(function() {
      $('#primary-setOfColor-iv').toggle();
      $('#primary-setOfColor-i').hide();
      $('#primary-setOfColor-ii').hide();
      $('#primary-setOfColor-iii').hide();
  });
       

       var myDivsi = document.querySelectorAll('.primary-color-item-i');
       var myDivsii = document.querySelectorAll('.primary-color-item-ii');
       var myDivsiii = document.querySelectorAll('.primary-color-item-iii');
       var myDivsiv = document.querySelectorAll('.primary-color-item-iv');
       var elei = document.querySelectorAll('#result_color_i');
       var eleii = document.querySelectorAll('#result_color_ii');
       var eleiii = document.querySelectorAll('#result_color_iii');
       var eleiv = document.querySelectorAll('#result_color_iv');
       
       myDivsi.forEach(function(myDivi) {
               myDivi.addEventListener('click', function() {
                   var backgroundColor = window.getComputedStyle(myDivi).getPropertyValue('background-color');
                   $('#result_color_i').css('background-color', backgroundColor);
                   elei.setAttribute('data-color', backgroundColor);
               });
       });
            myDivsii.forEach(function(myDivii) {
              myDivii.addEventListener('click', function() {
                  var backgroundColor = window.getComputedStyle(myDivii).getPropertyValue('background-color');
                  $('#result_color_ii').css('background-color', backgroundColor);
                  eleii.setAttribute('data-color', backgroundColor);
              });
      });
      myDivsiii.forEach(function(myDiviii) {
        myDiviii.addEventListener('click', function() {
            var backgroundColor = window.getComputedStyle(myDiviii).getPropertyValue('background-color');
            $('#result_color_iii').css('background-color', backgroundColor);
            eleiii.setAttribute('data-color', backgroundColor);
        });
      });
      myDivsiv.forEach(function(myDiviv) {
        myDiviv.addEventListener('click', function() {
            var backgroundColor = window.getComputedStyle(myDiviv).getPropertyValue('background-color');
            $('#result_color_iv').css('background-color', backgroundColor);
            eleiv.setAttribute('data-color', backgroundColor);
        });
      });
   });
   
</script>

<script>
  const paginationNumbers = document.getElementById("pagination-numbers");
  const paginatedList = document.getElementById("paginated-list");
  const listItems = paginatedList.querySelectorAll(".primary-color-item-i");
  const nextButton = document.getElementById("next-button");
  const prevButton = document.getElementById("prev-button");
  
  const paginationLimit = 50;
  const pageCount = Math.ceil(listItems.length / paginationLimit);
  let currentPage = 1;
  
  const disableButton = (button) => {
    button.classList.add("disabled");
    button.setAttribute("disabled", true);
  };
  
  const enableButton = (button) => {
    button.classList.remove("disabled");
    button.removeAttribute("disabled");
  };
  
  const handlePageButtonsStatus = () => {
    if (currentPage === 1) {
      disableButton(prevButton);
    } else {
      enableButton(prevButton);
    }
  
    if (pageCount === currentPage) {
      disableButton(nextButton);
    } else {
      enableButton(nextButton);
    }
  };
  
  const handleActivePageNumber = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
      button.classList.remove("active");
      const pageIndex = Number(button.getAttribute("page-index"));
      if (pageIndex == currentPage) {
        button.classList.add("active");
      }
    });
  };
  
  const appendPageNumber = (index) => {
    const pageNumber = document.createElement("button");
    pageNumber.className = "pagination-number";
    pageNumber.innerHTML = index;
    pageNumber.setAttribute("page-index", index);
    pageNumber.setAttribute("aria-label", "Page " + index);
  
    paginationNumbers.appendChild(pageNumber);
  };
  
  const getPaginationNumbers = () => {
    for (let i = 1; i <= pageCount; i++) {
      appendPageNumber(i);
    }
  };
  
  const setCurrentPage = (pageNum) => {
    currentPage = pageNum;
  
    handleActivePageNumber();
    handlePageButtonsStatus();
    
    const prevRange = (pageNum - 1) * paginationLimit;
    const currRange = pageNum * paginationLimit;
  
    listItems.forEach((item, index) => {
      item.classList.add("hidden");
      if (index >= prevRange && index < currRange) {
        item.classList.remove("hidden");
      }
    });
  };
  
  window.addEventListener("load", () => {
    getPaginationNumbers();
    setCurrentPage(1);
  
    prevButton.addEventListener("click", () => {
      setCurrentPage(currentPage - 1);
    });
  
    nextButton.addEventListener("click", () => {
      setCurrentPage(currentPage + 1);
    });
  
    document.querySelectorAll(".pagination-number").forEach((button) => {
      const pageIndex = Number(button.getAttribute("page-index"));
  
      if (pageIndex) {
        button.addEventListener("click", () => {
          setCurrentPage(pageIndex);
        });
      }
    });
  });
  </script>

  
  <script>
  const paginationNumbersII = document.getElementById("pagination-numbers-ii");
  const paginatedListII = document.getElementById("paginated-list-ii");
  const listItemsII = paginatedListII.querySelectorAll(".primary-color-item-ii");
  const nextButtonII = document.getElementById("next-button-ii");
  const prevButtonII = document.getElementById("prev-button-ii");
  
  const paginationLimitII = 50;
  const pageCountII = Math.ceil(listItemsII.length / paginationLimitII);
  let currentPageII = 1;
  
  const disableButtonII = (button) => {
    button.classList.add("disabled");
    button.setAttribute("disabled", true);
  };
  
  const enableButtonII = (button) => {
    button.classList.remove("disabled");
    button.removeAttribute("disabled");
  };
  
  const handlePageButtonsStatusII = () => {
    if (currentPageII === 1) {
      disableButtonII(prevButtonII);
    } else {
      enableButtonII(prevButtonII);
    }
  
    if (pageCountII === currentPageII) {
      disableButtonII(nextButtonII);
    } else {
      enableButtonII(nextButtonII);
    }
  };
  
  const handleActivePageNumberII = () => {
    document.querySelectorAll(".pagination-number-ii").forEach((button) => {
      button.classList.remove("active");
      const pageIndexII = Number(button.getAttribute("page-index"));
      if (pageIndexII == currentPageII) {
        button.classList.add("active");
      }
    });
  };
  
  const appendPageNumberII = (index) => {
    const pageNumberII = document.createElement("button");
    pageNumberII.className = "pagination-number-ii";
    pageNumberII.innerHTML = index;
    pageNumberII.setAttribute("page-index", index);
    pageNumberII.setAttribute("aria-label", "Page " + index);
  
    paginationNumbersII.appendChild(pageNumberII);
  };
  
  const getPaginationNumbersII = () => {
    for (let i = 1; i <= pageCountII; i++) {
      appendPageNumberII(i);
    }
  };
  
  const setCurrentPageII = (pageNum) => {
    currentPageII = pageNum;
  
    handleActivePageNumberII();
    handlePageButtonsStatusII();
    
    const prevRangeII = (pageNum - 1) * paginationLimitII;
    const currRangeII = pageNum * paginationLimitII;
  
    listItemsII.forEach((item, index) => {
      item.classList.add("hidden");
      if (index >= prevRangeII && index < currRangeII) {
        item.classList.remove("hidden");
      }
    });
  };
  
  window.addEventListener("load", () => {
    getPaginationNumbersII();
    setCurrentPageII(1);
  
    prevButtonII.addEventListener("click", () => {
      setCurrentPageII(currentPageII - 1);
    });
  
    nextButtonII.addEventListener("click", () => {
      setCurrentPageII(currentPageII + 1);
    });
  
    document.querySelectorAll(".pagination-number-ii").forEach((button) => {
      const pageIndexII = Number(button.getAttribute("page-index"));
  
      if (pageIndexII) {
        button.addEventListener("click", () => {
          setCurrentPageII(pageIndexII);
        });
      }
    });
  });
  </script>

  <script>
    const paginationNumbersIII = document.getElementById("pagination-numbers-iii");
    const paginatedListIII = document.getElementById("paginated-list-iii");
    const listItemsIII = paginatedListIII.querySelectorAll(".primary-color-item-iii");
    const nextButtonIII = document.getElementById("next-button-iii");
    const prevButtonIII = document.getElementById("prev-button-iii");
  
    const paginationLimitIII = 50;
    const pageCountIII = Math.ceil(listItemsIII.length / paginationLimitIII);
    let currentPageIII = 1;
  
    const disableButtonIII = (button) => {
      button.classList.add("disabled");
      button.setAttribute("disabled", true);
    };
  
    const enableButtonIII = (button) => {
      button.classList.remove("disabled");
      button.removeAttribute("disabled");
    };
  
    const handlePageButtonsStatusIII = () => {
      if (currentPageIII === 1) {
        disableButtonIII(prevButtonIII);
      } else {
        enableButtonIII(prevButtonIII);
      }
  
      if (pageCountIII === currentPageIII) {
        disableButtonIII(nextButtonIII);
      } else {
        enableButtonIII(nextButtonIII);
      }
    };
  
    const handleActivePageNumberIII = () => {
      document.querySelectorAll(".pagination-number-iii").forEach((button) => {
        button.classList.remove("active");
        const pageIndexIII = Number(button.getAttribute("page-index"));
        if (pageIndexIII == currentPageIII) {
          button.classList.add("active");
        }
      });
    };
  
    const appendPageNumberIII = (index) => {
      const pageNumberIII = document.createElement("button");
      pageNumberIII.className = "pagination-number-iii";
      pageNumberIII.innerHTML = index;
      pageNumberIII.setAttribute("page-index", index);
      pageNumberIII.setAttribute("aria-label", "Page " + index);
  
      paginationNumbersIII.appendChild(pageNumberIII);
    };
  
    const getPaginationNumbersIII = () => {
      for (let i = 1; i <= pageCountIII; i++) {
        appendPageNumberIII(i);
      }
    };
  
    const setCurrentPageIII = (pageNum) => {
      currentPageIII = pageNum;
  
      handleActivePageNumberIII();
      handlePageButtonsStatusIII();
  
      const prevRangeIII = (pageNum - 1) * paginationLimitIII;
      const currRangeIII = pageNum * paginationLimitIII;
  
      listItemsIII.forEach((item, index) => {
        item.classList.add("hidden");
        if (index >= prevRangeIII && index < currRangeIII) {
          item.classList.remove("hidden");
        }
      });
    };
  
    window.addEventListener("load", () => {
      getPaginationNumbersIII();
      setCurrentPageIII(1);
  
      prevButtonIII.addEventListener("click", () => {
        setCurrentPageIII(currentPageIII - 1);
      });
  
      nextButtonIII.addEventListener("click", () => {
        setCurrentPageIII(currentPageIII + 1);
      });
  
      document.querySelectorAll(".pagination-number-iii").forEach((button) => {
        const pageIndexIII = Number(button.getAttribute("page-index"));
  
        if (pageIndexIII) {
          button.addEventListener("click", () => {
            setCurrentPageIII(pageIndexIII);
          });
        }
      });
    });
  </script>

<script>
    const paginationNumbersIV = document.getElementById("pagination-numbers-iv");
    const paginatedListIV = document.getElementById("paginated-list-iv");
    const listItemsIV = paginatedListIV.querySelectorAll(".primary-color-item-iv");
    const nextButtonIV = document.getElementById("next-button-iv");
    const prevButtonIV = document.getElementById("prev-button-iv");
  
    const paginationLimitIV = 50;
    const pageCountIV = Math.ceil(listItemsIV.length / paginationLimitIV);
    let currentPageIV = 1;
  
    const disableButtonIV = (button) => {
      button.classList.add("disabled");
      button.setAttribute("disabled", true);
    };
  
    const enableButtonIV = (button) => {
      button.classList.remove("disabled");
      button.removeAttribute("disabled");
    };
  
    const handlePageButtonsStatusIV = () => {
      if (currentPageIV === 1) {
        disableButtonIV(prevButtonIV);
      } else {
        enableButtonIV(prevButtonIV);
      }
  
      if (pageCountIV === currentPageIV) {
        disableButtonIV(nextButtonIV);
      } else {
        enableButtonIV(nextButtonIV);
      }
    };
  
    const handleActivePageNumberIV = () => {
      document.querySelectorAll(".pagination-number-iv").forEach((button) => {
        button.classList.remove("active");
        const pageIndexIV = Number(button.getAttribute("page-index"));
        if (pageIndexIV == currentPageIV) {
          button.classList.add("active");
        }
      });
    };
  
    const appendPageNumberIV = (index) => {
      const pageNumberIV = document.createElement("button");
      pageNumberIV.className = "pagination-number-iv";
      pageNumberIV.innerHTML = index;
      pageNumberIV.setAttribute("page-index", index);
      pageNumberIV.setAttribute("aria-label", "Page " + index);
  
      paginationNumbersIV.appendChild(pageNumberIV);
    };
  
    const getPaginationNumbersIV = () => {
      for (let i = 1; i <= pageCountIV; i++) {
        appendPageNumberIV(i);
      }
    };
  
    const setCurrentPageIV = (pageNum) => {
      currentPageIV = pageNum;
  
      handleActivePageNumberIV();
      handlePageButtonsStatusIV();
  
      const prevRangeIV = (pageNum - 1) * paginationLimitIV;
      const currRangeIV = pageNum * paginationLimitIV;
  
      listItemsIV.forEach((item, index) => {
        item.classList.add("hidden");
        if (index >= prevRangeIV && index < currRangeIV) {
          item.classList.remove("hidden");
        }
      });
    };
  
    window.addEventListener("load", () => {
      getPaginationNumbersIV();
      setCurrentPageIV(1);
  
      prevButtonIV.addEventListener("click", () => {
        setCurrentPageIV(currentPageIV - 1);
      });
  
      nextButtonIV.addEventListener("click", () => {
        setCurrentPageIV(currentPageIV + 1);
      });
  
      document.querySelectorAll(".pagination-number-iv").forEach((button) => {
        const pageIndexIV = Number(button.getAttribute("page-index"));
  
        if (pageIndexIV) {
          button.addEventListener("click", () => {
            setCurrentPageIV(pageIndexIV);
          });
        }
      });
    });
  </script>
 
</body>
</html>
<?PHP
    }
    catch(Exception $e){
         echo 'Unable to process';
    }
?>