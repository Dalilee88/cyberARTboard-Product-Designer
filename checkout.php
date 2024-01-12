<?php
// Retrieve data from query parameters
$totalQty = $_GET['totalQty'];
$fabricOption = $_GET['fabricOption'];
$fabricOptionDescription = $_GET['fabricOptionDescription'];
$requestedBy = $_GET['requestedBy'];
$contactDetails = $_GET['contactDetails'];
$jobDescription = $_GET['jobDescription'];
$jobPONO = $_GET['jobPONO'];
$requestedDate = $_GET['requestedDate'];
$frontImg = $_GET['frontName'];
$sideImg = $_GET['sideName'];
$backImg = $_GET['backName'];

// Use the retrieved data as needed in your checkout.php page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/itc-avant-garde-gothic-std-book" rel="stylesheet">
    <title>Checkout</title>
    <link rel="stylesheet" href="./css/checkout.css" type="text/css">
</head>
<body>
<center>
<div class="bill-i">
<h1>Thanks very much for your order</h1>
<fieldset class="fieldset-box" style="border:0px;">
<p class="p" style="padding:03px !important;">Supplier: Kootex International Pty. Ltd. <br>
 <small> Contact Email: order@kootex.com.au <br> Contact Phone:(02)</small></p>
</fieldset>
<fieldset class="fieldset-box" style="border:0px;">
<div style="text-align:right;"><h2 style="text-transform: uppercase;font-weight:lighter;">Purchae Order:</h2><p style="margin-top:-15px;font-size:small;">(Own Design)</p></div>
</fieldset>
<br>
<div class="tnx">
<center>
<p class="buyer-title">Buyer:
<br></p>
<fieldset class="fieldset-box">
    <p>Billing To:</p>
    <p>Bussiness Name:</p>
    <p>Contact Details:</p>
    <hr><br><hr><br><hr>
</fieldset>
<fieldset class="fieldset-box">
    <p style="margin-bottom:-3px;">Delivery Options:</p>
    <p> <input type="checkbox" name="office-address" id=""> Office Address:</p>
    <p> <input type="checkbox" name="third-party" id=""> Third Party:</p>
    <hr><br><hr><br><hr>
</fieldset>
<br>
<fieldset class="fieldset-box" style="border:0px;">
<p align="left">Job No : XXX</p>
<p align="left">Order Date : <?PHP echo $requestedDate; ?></p>
</fieldset>
<fieldset class="fieldset-box" style="border:0px;">
<p align="left">P/O No : <?PHP echo $jobPONO; ?></p>
<p align="left">Request Date : <?PHP echo $requestedDate; ?></p>
</fieldset>
<br>
<p align="left" style="margin-left:20px;margin-bottom:-3px;">Special Notes: </p>
<fieldset class="fieldset-box" style="width:90%!important;height:100px;">
<p>$jobDescription</p>
</fieldset>
</center>
</div>
<fieldset class="fieldset-box" style="border:0px;width:50% !important;">
<p>ARTWORK JOB CODE: XXX-XXXX-XXXXXXXX</p>
<p>FRONT ATTACHMENT : <?PHP echo $frontImg; ?></p>
<p>SIDE ATTACHMENT : <?PHP echo $sideImg; ?></p>
<p>BACK ATTACHMENT : <?PHP echo $backImg; ?></p>
</fieldset>
<fieldset class="fieldset-box" style="border:0px!important;text-align:right;">
<p>VIEW DETAILS</p>
<p><a href="NULL">VIEW DETAILS</a></p>
<p><a href="NULL">VIEW DETAILS</a></p>
</fieldset>
<center>
    <table class="table-i" rules="all" frame="box">
            <tr class="tr-i">
            <th class="th-i">QTY.</th>
            <th class="th-i">Item Code</th>
            <th class="th-i">Size</th>
            <th class="th-i">Unit Cost</th>
            <th class="th-i">Discount</th>
            <th class="th-i">Total Cost</th>
        </tr>
        <tr class="tr-i">
            <td class="td-i"><?PHP echo $totalQty ?></td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
        </tr>
        <tr class="tr-i">
            <td class="td-i"><?PHP echo $totalQty ?></td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
            <td class="td-i">XXXXXX</td>
        </tr>
    </table>
</center>

<fieldset class="fieldset-box" style="border:0px;width:50% !important;">
<p>Shipping/Delivery Type:</p>
<p> <input type="checkbox" name="dhl" id=""> DHL</p>
<p> <input type="checkbox" name="air" id="">AIR FREIGHT</p>
<p><input type="checkbox" name="sea" id="">SEA</p>
</fieldset>
<fieldset class="fieldset-box" style="border:0px;text-align:left;">
<p>Currency: USD</p>
<p>Sub Total(Ext. GST): $XXXX</p>
<p>GST:$XXXX</p>
<p>Freight:N/A</p>
<p>Total Amount: $$$$$$</p>
</fieldset><br>
<hr width="100%">
<fieldset class="fieldset-box" style="border:0px;width:50% !important;">
<input type="submit" value="Submit" class="save-checkout" disabled>
</fieldset>
</div>
</center>
</body>
</html>