<?php
//dash-bus-tranz
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "'.'bursary'.'"');
   if($stmt->rowCount() == 1){
       if(isset($_POST['rf'])){
           $ref = htmlentities($_POST['rf'], ENT_QUOTES);
           $fd = $db->query('select * from transactions where tranz_id = "'.$ref.'"');
           if($fd->rowCount() == 1){
               $rp = $fd->fetchAll(PDO::FETCH_ASSOC)[0];
               $dat = $db->query('select * from users where uniqid = "'.$rp['payer'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
               $pp = $db->query('select * from payments where id = "'.$rp['purpose'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
               ?>
<div class="card col-lg-12" style="padding: 10px; font-weight: bold; text-transform: uppercase;">
    <div class="col-sm-12"> <span onclick="timez('put-tranz')" style="float: right; font-size: 200%; cursor: pointer;">&times;</span></div>
    <div class="col-sm-12"><center><h4 style="font-weight: bold;">PAYER'S INFORMATION</h4></center></div>
    <div class="col-sm-8">
        <span>FIRSTNAME: <?php echo $dat['firstname']; ?></span><br><br>  
        <span>MIDDLENAME: <?php echo $dat['middlename'];  ?></span><br><br>  
        <span>LASTNAME: <?php echo $dat['lastname']; ?></span><br><br>  
        <span>PROGRAMME: <?php echo $dat['programme']; ?></span><br><br>  
        <span>FACULTY: <?php echo $dat['faculty']; ?></span><br><br>  
        <span>DEPARTMENT: <?php echo $dat['department']; ?></span><br><br>  
        <span>LEVEL: <?php echo $dat['level']; ?></span><br><br>  
        <span>DURATION OF PROGRAMME: <?php echo $dat['duration']." years"; ?></span><br><br>   
    </div>
    <div class="col-sm-4">
        <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" style="float: right; width: 100px; height: 100px; border-radius: 50%;" />
    </div>
    <div class="col-sm-12">
        <center><h4 style="font-weight: bold;">PAYMENT'S INFORMATION</h4></center>
        <span>PURPOSE: <?php echo $pp['name']; ?></span><br><br> 
        <span>AMOUNT PAID: <?php echo $rp['amount']; ?></span><br><br> 
        <span>SESSION PAID: <?php echo $rp['present_session']; ?></span><br><br> 
        <span>SEMESTER PAID: <?php echo $rp['semester']; ?></span><br><br> 
        <span>TRANSACTION ID: <?php echo $rp['tranz_id']; ?></span><br><br> 
        <span>DATE PAID: <?php echo date("H:i:s d/M/Y", $rp['date']); ?></span>
        <span></span>
    
    </div>
</div>
         <?php  }else{
               echo "<center style='margin-top: 40px;'><div style='width: 100%;' class='round error-box'>Invalid Transaction ID!</div></center>";
           }
           
       }
       
   }
   }

