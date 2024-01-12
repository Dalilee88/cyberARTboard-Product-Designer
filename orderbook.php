<?PHP 

$refid = $_GET['id']; 
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href ="./images/Cyber FV.png" type="image/icon type" sizes="16x16">
    <title>Order Product</title>
    <link href="https://fonts.cdnfonts.com/css/itc-avant-garde-gothic-std-book" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <link rel="stylesheet" href="./css/orderbook.css" type="text/css">     
    <style>
      .generatedImg{
       
        display: inline-block;
      }
      .GenfileUpload{
        width: 450px;
      }
      span .frontView{
        display: inline-block;
      }
      span .sideView{
        display: inline-block;
      }
      span .backView{
        display: inline-block;
      }

    </style>
</head>
<body>
       <center>
        <!-- <div class="setI">
          <p class="item-product-back">Product Module</p>
        </div> -->

        <br>
        <div class="setIII">
          <p><b>DESIGNER NOTES</b> : The dye sublimation provides you with the unlimited sky for your creation, our design team always can assist you to get your game onto the next level. If you would like to see the different designs . Please Complete the <b>Sample Request Form,</b> and sent it to your distributor.</p> 
        </div>
        <div class="setII">
        <p>Polo T-Shirt - STYLE PSS002</p>
        <p style="font-size:small;">There is always so much we can do sa stock line service. The sky is unlimited. Australian Spirit is always willing to take extra mile further to satisfy your needs. Our fabric inventory stock in China makes that you are not  only able to build up your own colour way but you can also use your own designs to suit your individual needs.</p>
        <small>ORDER FORM:</small>
        <button class="btn-on-form">PRODUCT SHEET</button>
        <button class="btn-on-form">SIZE GUIDE</button>
        <button class="btn-on-form">Q & A</button>
        </div>
        <br>
        <div class="main-form">
        <form action="./checkoutProcess.php" method="POST" enctype="multipart/form-data">
          <p>Your Product RID:<b style="color:coral;"> <?PHP echo $refid;?></b></p>
          <div class="generatedImg">
              <span class="frontView">
                <label for="">Upload FrontView Generated Image File:</label><br>
                <div class="GenfileUpload blue-btn btn width100">
                <span> <img src="./images/Cyber FV.png" type="image/icon type" sizes="15x30"> <small style="font-size:large;margin-top:-05px;">&nbsp;Select Your <b style="color:coral;">FrontView</b> Generated Image File</small>  </span>
                <input type="file" name="FrontfileUpload" id="FrontfileUpload" class="input-set input-file uploadlogo" accept="image/'*',.png">
                </div>
              </span>
           <span class="sideView">
              <label for="">Upload SideView Generated Image File:</label><br>
                <div class="GenfileUpload blue-btn btn width100">
                <span> <img src="./images/Cyber FV.png" type="image/icon type" sizes="15x30"> <small style="font-size:large;margin-top:-05px;">&nbsp;Select Your <b style="color:coral;">SideView</b> Generated Image File</small>  </span>
                <input type="file" name="SidefileUpload" id="SidefileUpload" class="input-set input-file uploadlogo" accept="image/'*',.png">
                </div>
           </span>
            <span class="backView">
              <label for="">Upload BackView Generated Image File:</label><br>
              <div class="GenfileUpload blue-btn btn width100">
              <span> <img src="./images/Cyber FV.png" type="image/icon type" sizes="15x30"> <small style="font-size:large;margin-top:-05px;">&nbsp;Select Your <b style="color:coral;">BackView</b> Generated Image File</small>  </span>
              <input type="file" name="BackfileUpload" id="BackfileUpload" class="input-set input-file uploadlogo" accept="image/'*',.png">
              </div>
            </span>
          </div>
          <br>

          <label for="">Fabric Option:<b class="b">*</b></label><br>
          <select name="fabric-option" id="" required>
            <option value="" selected disabled>Choose Option</option>
            <option value="">Fabric J : 165gsm 100% polyester micro mesh birdseye moisture management fabric</option>
            <option value="">Fabric D : 180gsm 80% polyester and 20% cotton backed fabric</option>
            <option value="">Fabric L : 165gsm 100% polyester mini waffler moisture management fabric</option>
          </select><br><br>
          <label for="">Mens : </label><br><br>
          <button class="btn-on-form-size" disabled>S</button>
          <button class="btn-on-form-size" disabled>M</button>
          <button class="btn-on-form-size" disabled>L</button>
          <button class="btn-on-form-size" disabled>XL</button>
          <button class="btn-on-form-size" disabled>2XL</button>
          <button class="btn-on-form-size" disabled>3XL</button>
          <button class="btn-on-form-size" disabled>4XL</button>
          <button class="btn-on-form-size" disabled>5XL</button>
          <button class="btn-on-form-size" disabled>6XL</button>
          <button class="btn-on-form-size" disabled>7XL</button><br><br>
          <input type="number" class="size-input" name="s" id="s">
          <input type="number" class="size-input" name="m" id="m">
          <input type="number" class="size-input" name="l" id="l">
          <input type="number" class="size-input" name="xl" id="xl">
          <input type="number" class="size-input" name="2xl" id="2xl">
          <input type="number" class="size-input" name="3xl" id="3xl">
          <input type="number" class="size-input" name="4xl" id="4xl">
          <input type="number" class="size-input" name="5xl" id="5xl">
          <input type="number" class="size-input" name="6xl" id="6xl">
          <input type="number" class="size-input" name="7xl" id="7xl">
          <br><br>
          <label for="">Ladies : </label><br><br>
          <button class="btn-on-form-size-ladies" disabled>5</button>
          <button class="btn-on-form-size-ladies" disabled>8</button>
          <button class="btn-on-form-size-ladies" disabled>10</button>
          <button class="btn-on-form-size-ladies" disabled>12</button>
          <button class="btn-on-form-size-ladies" disabled>14</button>
          <button class="btn-on-form-size-ladies" disabled>16</button>
          <button class="btn-on-form-size-ladies" disabled>18</button>
          <button class="btn-on-form-size-ladies" disabled>20</button>
          <button class="btn-on-form-size-ladies" disabled>22</button>
          <button class="btn-on-form-size-ladies" disabled>24</button>
          <button class="btn-on-form-size-ladies" disabled>25</button><br><br>
          <input type="number" class="size-input-ladies size-input" name="5" id="ls">
          <input type="number" class="size-input-ladies size-input" name="8" id="lm">
          <input type="number" class="size-input-ladies size-input" name="10" id="ll">
          <input type="number" class="size-input-ladies size-input" name="12" id="lxl">
          <input type="number" class="size-input-ladies size-input" name="14" id="l2xl">
          <input type="number" class="size-input-ladies size-input" name="16" id="l3xl">
          <input type="number" class="size-input-ladies size-input" name="18" id="l4xl">
          <input type="number" class="size-input-ladies size-input" name="20" id="l5xl">
          <input type="number" class="size-input-ladies size-input" name="22" id="l6xl">
          <input type="number" class="size-input-ladies size-input" name="24" id="l7xl">
          <input type="number" class="size-input-ladies size-input" name="25" id="l8xl">
          <br><br>
          <label for="">Junior : </label><br><br>
          <button class="btn-on-form-size-ladies" disabled>5</button>
          <button class="btn-on-form-size-ladies" disabled>8</button>
          <button class="btn-on-form-size-ladies" disabled>10</button>
          <button class="btn-on-form-size-ladies" disabled>12</button>
          <button class="btn-on-form-size-ladies" disabled>14</button>
          <button class="btn-on-form-size-ladies" disabled>16</button><br><br>
          <input type="number" class="size-input-ladies size-input" name="5" id="js">
          <input type="number" class="size-input-ladies size-input" name="8" id="jm">
          <input type="number" class="size-input-ladies size-input" name="10" id="jl">
          <input type="number" class="size-input-ladies size-input" name="12" id="jxl">
          <input type="number" class="size-input-ladies size-input" name="14" id="j2xl">
          <input type="number" class="size-input-ladies size-input" name="16" id="j3xl">
          <br><br><br>
          <div class="total-i">
          <label for="" >Total QTY</label>
          <input type="number" name="totalqty" id="totalqty" class="total" readonly>
          </div>
          <div class="bottom-box">
            <span class="span-block">
              <label for="">Requested By:<b class="b">*</b></label><br>
              <input type="text" name="requested-by" id="" class="input-set" placeholder="Requested By : " required>
            </span>
            <span class="span-block">
              <label for="">Contact Details:<b class="b">*</b></label><br>
              <input type="text" name="contact-details" id="" class="input-set" placeholder="Contact Details : " required>
            </span>
          </div>
          <div class="bottom-box">
            <span class="span-block">
              <label for="">Job Description:<b class="b">*</b></label><br>
              <input type="text" name="jobDescription" id="" class="input-set" placeholder="Job Description : " required>
            </span>
            <span class="span-block">
            <br><label for="">Job PO/NO:<b class="b">*</b></label><br>
              <input type="text" name="jobPONO" id="" class="input-set" placeholder="Job PO/NO : " required>
            </span>
            </div><br>
            <label for="">Requested Date:<b class="b">*</b></label><br>
            <input type="date" name="requestedDate" id="" class="input-set" required>
            <br><br>
            <!-- <label for="">Upload File:</label><small style="font-size:xx-small;">&nbsp;&nbsp;&nbsp;File types allowed are jpg,pdf,zip,psd,png,eps,ai,dst,emb(File Size:1 MB)</small><br>
            <div class="fileUpload blue-btn btn width100">
            <span> <img src="./images/Cyber FV.png" type="image/icon type" sizes="15x30"> <small style="font-size:large;margin-top:-05px;">&nbsp;Select Your File</small>  </span>
            <input type="file" name="fileUpload" id="fileUpload" class="input-set input-file uploadlogo" accept="image/'*',.pdf,.jpg,.zip,.png,.psd,.ai,.dst">
            </div> -->
            <p style="float:right;text-decoration: none;color:orangered;font-weight:bold;cursor:pointer;" id="show">+ More Details</p>
            <br><br><br>
            <div id="hiddent-data" class="hiddent-data">
              <fieldset class="hidden-fieldset-i">
              <p id="hidden-fieldset-i" style="float:right;color:orangered;border-radius:50%;border:0px solid orangered;text-shadow:01px 01px 01px black;cursor:pointer;">X</p><br><br>
              <fieldset class="hidden-fieldset">
              <label for="">Checklist get your Custom Apparel Design Ready! </label><br>
              <input type="checkbox" name="" id=""><small>I have attached digital vector mockup</small> 
              <input type="checkbox" name="" id=""><small>I have attached all assets in vector format</small> <br>
              <input type="checkbox" name="" id=""><small>I have attached a JPG Mockup</small> <br>
              </fieldset>
              <br><br>
              <div style="display: inline-block;">
              <label for="">Design Concepts: </label><br>
              <textarea name="" class="input-textarea-mini" id="" placeholder="Design Concepts"></textarea>
              </div>
              <div style="display: inline-block;">
              <label for="">Logo Size/Position: </label><br>
              <textarea name="" class="input-textarea-mini" id="" placeholder="Logo Size/Position"></textarea>
              </div>
              <div style="display: inline-block;">
              <label for="">Colour ( PMS/CMYK ): <b class="b">*</b></label><br>
              <textarea name="" class="input-textarea-mini" id="" placeholder="Colour ( PMS/CMYK )" ></textarea>
              </div>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:48%;">
              <label for="">Extra: </label><small>per each size/per garment over 5x1</small><br>
              <input type="checkbox" name="" id=""><small>Individual Names</small> 
              <input type="checkbox" name="" id=""><small>Individual Numbers</small> <br>
              <input type="checkbox" name="" id=""><small>Plus Sizes</small> <br>
              </fieldset>
              <fieldset class="hidden-fieldset" style="border:0px solid black!important;width:30%;display:inline-block;">
              <label for="">Repeat Order: </label><br>
              <input type="radio" name="repeat-order" id=""><small><b>Yes</b></small><br> 
              <input type="radio" name="repeat-order" id=""><small><b>No</b></small>
              </fieldset>
              <fieldset class="hidden-fieldset" style="border:0px solid black!important;width:100%;display:inline-block;">
              <label for="">Custom Label: </label><small>please provide label Artwork or vector of your logo</small><br>
              <input type="radio" name="custom-label" id=""><small><b>Yes</b></small><br> 
              <input type="radio" name="custom-label" id=""><small><b>No</b></small>
              </fieldset>
              <label for="">Previous Job Number : </label>
              <input type="number" inputmode="numeric" name="" id="" class="input-set" placeholder="Previous Job Number"><br><br>
              <fieldset class="hidden-fieldset">
              <label for=""><b>Extra </b></label><small>**Colours may vary slightly from order to order. A 5% tolerance to normal and acceptable in the printing industry </small><br><br>
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Design/Logo/Colour stays exactly the same</b></small><br> 
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Logos had changed</b></small><br>
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Individual Name/Number added </b></small><br>
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Colour match to previous order </b></small><br>
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Colours had changed </b></small>
              <input type="checkbox" name="" id=""><small style="font-size:medium;padding:04px;"><b>Design is altered </b></small>
              </fieldset><br>
              <fieldset class="hidden-fieldset" style="border:0px solid black!important;width:30%;display:inline-block;">
              <label for="">Fabric Type: </label><br>
              <input type="radio" name="fabric-type" id=""><small><b>Normal</b></small><br> 
              <input type="radio" name="fabric-type" id=""><small><b>Reverse</b></small>
              </fieldset>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:48%;">
              <label for=""><b>Colour Match</b> :</label><br>
              <input type="checkbox" name="" id=""><small><b>Colour match to the original Sample</b></small> 
              <input type="checkbox" name="" id=""><small><b>Colour match to the Another Sample</b></small> <br>
              </fieldset><br><br>
              <label for="">Others : </label>
              <input type="text" name="" id="" class="input-set" placeholder="Others :"><br><br>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:42%;">
              <label for=""><b>Garment Type:</b></label><br>
              <input type="checkbox" name="" id=""><small><b>POLO Shirt-Sleeve</b></small> <br>
              <input type="checkbox" name="" id=""><small><b>POLO Long-Sleeve</b></small> <br>
              <input type="checkbox" name="" id=""><small><b>Custom Apparel Dye Sublimation</b></small> <br>
              <input type="checkbox" name="" id=""><small><b>Cut & Sew ( Indent Express )</b></small>
              </fieldset>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:46%;">
              <label for=""><b>Physical Samples:</b></label><br>
              <input type="checkbox" name="" id=""><small><b>I would like to have a Physical Sample for Approval</b></small> <br>
              <input type="checkbox" name="" id=""><small><b>Don't Request a Physical Sample for Approval, but I would like to have Digital Images for Approval</b></small> <br>
              </fieldset><br><br>

              <!-- sectionforimage-empty -->
              
              <fieldset class="hidden-fieldset" style="display:inline-block;width:auto;">
              <label for=""><b>Design Pattern</b></label><br>
              <input type="checkbox" name="" id=""><small><b>3 Buttons</b></small>
              <input type="checkbox" name="" id=""><small><b>2 Buttons</b></small>
              <input type="checkbox" name="" id=""><small><b>V - Neck Collar (L)</b></small>
              <input type="checkbox" name="" id=""><small><b>Set in Sleeve</b></small>
              <input type="checkbox" name="" id=""><small><b>Raglan Sleeve</b></small><br>
              <input type="checkbox" name="" id=""><small><b>Conceal Pocket</b></small>
              <input type="checkbox" name="" id=""><small><b>Chest Pocket</b></small>
              <input type="checkbox" name="" id=""><small><b>Side Split</b></small>
              <input type="checkbox" name="" id=""><small><b>Self Fabric Cuff</b></small>
              </fieldset><br><br>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:46%;">
              <label for=""><b>Extras</b></label><br>
              <input type="checkbox" name="" id=""><small><b>Orange Hivis</b></small>
              <input type="checkbox" name="" id=""><small><b>Yellow Hivis</b></small><br>
              <input type="checkbox" name="" id=""><small><b>Knitted Collar</b></small>
              <input type="checkbox" name="" id=""><small><b>Knitted Cuff</b></small><br>
              <input type="checkbox" name="" id=""><small><b>Knitted Hem</b></small><br>
              <br>
              </fieldset>
              <div style="display: inline-block;width:40%!important;">
              <label for="">Sample Size Requested</label><br>
              <textarea name="" class="input-textarea-mini" id="" placeholder="Sample Size Requested"></textarea>
              </div><br><br>
              <fieldset class="hidden-fieldset" style="display:inline-block;width:auto;">
              <label for=""><b>Logos</b></label>&nbsp;<small>Recomended for the best print Quality</small><br>
              <input type="checkbox" name="" id=""><small><b>I have attached hi res logos ( Vector/eps/pdf/ai)</b></small><br>
              <input type="checkbox" name="" id=""><small><b>I have attached embroidery files, DST/EMB for cut & sew</b></small><br>
              <input type="checkbox" name="" id=""><small><b>I'd request the logo to be redrawn</b></small>
              <br>
              </fieldset>
              <br><br>
              <label for="" style="font-weight:lighter;">Images (PNG/JPG/TIFF) : </label><br>
              <b>All Images Need to be 300DPI and size 2000x2000 pixel for large print</b>
              <br>
              <p>NOTE:<small> To avoid anyu extra charges during the artwork process. Please ensure all the relevent information necessary on the form or contact the designer.</small></p>
            </div>
            </fieldset><br>
            <label for="">Commons:</label>
            <textarea name="commons" id="" cols="30" rows="4" class="input-textarea"></textarea>
            <br>
            <button class="input-set save-checkout" disabled>SAVE</button>&nbsp;<input  type="submit" value="CHECKOUT" class="input-set save-checkout">

        </form>
        </div>
       </center>
       
       <script src="./js/orderbook.js"></script>
       
       <script>         
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
            return " Uploaded file : "+filename;
          } else {
            $(input).val("");
            return " Only jpg,pdf,zip,psd,png,eps,ai,dst,emb formats are allowed!";
          }
        }
      });
       </script>
       <script>
          $(document).ready(function () {
            $("#show").click(function(){
                $("#hiddent-data").attr("style", "display:block").show();
          });
          $("#hidden-fieldset-i").click(function () {
                $("#hiddent-data").attr("style", "display:none").hide();
          }); 
        });
    </script>
</body>
</html>
