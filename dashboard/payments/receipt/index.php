<?php
//dash-payments-receipt
include '../../../configs.php';
 define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}

if(isset($_SESSION['status'], $_SESSION['uniqid'])){
    if(isset($_POST['ref'])){
        $ref = htmlentities($_POST['ref'], ENT_QUOTES);
        $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"');
        if($stmt->rowCount() == 1){
           $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
           $dat = $rows[0];
           $qc = $db->query('select * from transactions where id = "'.$ref.'"');
           if($qc->rowCount() == 1){
               $cv = $qc->fetchAll(PDO::FETCH_ASSOC)[0];
               $mk = $db->query('select * from payments where id = "'.$cv['purpose'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
               ?>
<table style="width: 100%;">

    <tr style="background-color: rgba(0,0,0,0);">
        
        <td style="border: 0px solid #eee; width: 100%;" colspan="4">
        
    <center>
        <img src="../images/logo.png" style="width: 100px;" >
        <h1 style="font-size: 300%; font-weight: bolder;">EKITI STATE UNIVERSITY</h1>
        <h3 style="font-size: 200%; font-weight: bolder;">PMB 5363, ADO-EKITI, EKITI STATE, NIGERIA</h3>
        <h5 style="font-size: 150%; font-weight: bolder;">www.eksu.edu.ng</h5>
        </center>
    <br><br>
    </td>
    
    </tr>
    <tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
        <label>FIRSTNAME : <span style="text-transform: capitalize;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label>MIDDLENAME : <span style="text-transform: capitalize;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label>LASTNAME : <span style="text-transform: capitalize;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label>MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label>FACULTY : <span style="text-transform: capitalize;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label>DEPARTMENT : <span style="text-transform: capitalize;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label>LEVEL : <?php echo $dat['level']."L"; ?></label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
    <td style="border: 0px solid #eee; width: 100%;" colspan="4">
    <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
    <td style="border: 0px solid #eee; width: 100%;" colspan="4">
        <center>
            <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; width: 100%;border-radius: 20px; color: #1c94c4;">PAYMENT RECEIPT FOR <?php echo $mk['name']; ?></div>
        </center>
</td>
</tr>
    <tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%;" colspan="4">
    <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
    <td style="border: 0px solid #eee; width: 25%;" colspan="1" weight="1">
       <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4; text-align: left !important;;">AMOUNT</div> 
       <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
       <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4; text-align: left !important;"><?php echo "# ".$cv['amount']; ?></div> 
    </td>
    
    <td style="border: 0px solid #eee; width: 25%;" colspan="1" weight="1">
       <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4;">TRANSACTION ID</div> 
       <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
       <div style="font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4;"><?php echo $cv['tranz_id']; ?></div> 
       
    </td>
    <td style="border: 0px solid #eee; width: 25%;" colspan="1" weight="1">
       <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4;">DATE</div> 
       <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
       <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; border-radius: 20px; color: #1c94c4;"><?php echo date("D d-M-Y",$cv['date']); ?></div> 
      
    </td>
    
    <td style="border: 0px solid #eee; width: 25%;" colspan="1" weight="1">
        <img style="float: right;" src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo "Amount:%20".$cv['amount']."%20Paid%20By:%20".$dat['uid']."%20On:%20".date("H:i:s D d-M-Y",$cv['date'])."%20TID: ".$cv['tranz_id']; ?>&chs=250x250&chld=L|0" class="qr-code img-thumbnail img-responsive">

    </td>
</tr>
  <tr style="background-color: rgba(0,0,0,0);">
      <td style="border: 0px solid #eee; width: 100%;" colspan="4">
    <div  style="background: transparent url('../images/separator-bg.png') repeat-x left center; height: 0.562em; display: block; margin: 1.25em 0; ">  </div>
    <br><br>
    </td>
</tr>

</table>


       <?php    }
           
           
        }
    }
}
