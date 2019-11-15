<?php
//dash-bus-student
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and (status = "'.'bursary'.'" || status = "super admin")');
   if($stmt->rowCount() == 1){
       if(isset($_POST['ud'])){
           $uid = htmlentities($_POST['ud'], ENT_QUOTES);
           $fn = $db->query('select * from users where uid = "'.$uid.'"');
           if($fn->rowCount() == 1){
               $dat = $fn->fetchAll(PDO::FETCH_ASSOC)[0];
             
               
               ?>
               <div class="card col-lg-12" style="padding: 10px; font-weight: bold; text-transform: uppercase;">
    <div class="col-sm-12"> <span onclick="timez('put-bus-student')" style="float: right; font-size: 200%; cursor: pointer;">&times;</span></div>
    <div class="col-sm-12"><center><h4 style="font-weight: bold;">STUDENT'S INFORMATION</h4></center></div>
    <div class="col-sm-8">
        <span>FIRSTNAME: <?php echo $dat['firstname']; ?></span><br><br>  
        <span>MIDDLENAME: <?php echo $dat['middlename'];  ?></span><br><br>  
        <span>LASTNAME: <?php echo $dat['lastname']; ?></span><br><br>  
        <span>PROGRAMME: <?php echo $dat['programme']; ?></span><br><br>  
        <span>FACULTY: <?php echo $dat['faculty']; ?></span><br><br>  
        <span>DEPARTMENT : <?php echo $dat['department']; ?></span><br><br>  
        <span>LEVEL: <?php echo $dat['level']; ?></span><br><br>  
        <span>DURATION OF PROGRAMME: <?php echo $dat['duration']." years"; ?></span><br><br>   
    </div>
    <div class="col-sm-4">
        <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" style="float: right; width: 100px; height: 100px; border-radius: 50%;" />
    </div>
  <div class="col-sm-12"><center><h4 style="font-weight: bold;">PAYMENTS HISTORY</h4></center></div>
  <table>
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold;">PAYMENT NAME</th>
									<th style="width: 20%; font-weight: bold;">AMOUNT</th>
									<th style="width: 20%; font-weight: bold;">TRANSACTION ID</th>
									<th style="width: 20%; font-weight: bold;">DATE</th>
									<th style="width: 15%; font-weight: bold;">REMARK</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
<?php  
$mu = $db->query('select * from transactions where payer = "'.$dat['uniqid'].'" and amount != "" order by id asc');
if($mu->rowCount() > 0){
$fg = $mu->fetchAll(PDO::FETCH_ASSOC);
foreach($fg as $dn){
    $hn = $db->query('select name from payments where id = "'.$dn['purpose'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
?>
								<tr>
									
									<td style="text-transform: capitalize; font-weight: bold;"><?php echo $hn['name']; ?></td>
									<td style="text-transform: capitalize; font-weight: bold;"><?php echo "#".$dn['amount']." NGN"; ?></td>
									<td style="text-transform: capitalize; font-weight: bold;"><?php echo $dn['tranz_id']; ?></td>
									<td style="text-transform: capitalize; font-weight: bold;"><?php echo date("H:i:s D d-M-Y",$dn['date']); ?></td>
                                                                        <td style="text-transform: capitalize; font-weight: bold;"><?php $vm = $dn['criteria']; if($vm == "fresh"){echo "Paid when due"; }else{ echo $vm;} ?></td>
                                                                       
									
								</tr>
                                                               
     <?php
     
} }else{ ?>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <h5 style="text-transform: uppercase; font-weight: bold;">No payment made yet.</h5>
                                                                    </td>
                                                                </tr>
<?php } ?>
	
                                                                
							</tbody>
							
  </table><br><br>
  <div class="col-sm-12">
      <center><h4 style="font-weight: bold;">OUTSTANDING PAYMENTS</h4></center>
       <?php
        if($dat['outstandings'] != ""){
        $df = explode("{:||:}", $dat['outstandings']);
        $v = 0;
        foreach($df as $pk){ 
            $pl = explode("//", $pk);
//            var_dump($pl); 
            $py = $db->query('select id, name from payments where id = "'.$pl[0].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
            $mu = $pl[3];
            $mk = substr($mu, 0, 1);
            $lnn = strlen($mu);
            ?>
        <div style="padding: 10px;">
             <?php if($mk == "-"){ ?>
           <span class="btn btn-primary btn-block" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php echo $py['name']." #".substr($pl[3], 1,$lnn); ?></span>
                <?php }else{ ?>
            <span class="btn btn-danger btn-block" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php echo $py['name']." #".$pl[3] ?></span>
                <?php } ?>
            
            
        </div>   
       <?php 
       
       $v =  $v + 1;
        }
                  }else{ ?>
        <center style="margin-top: 10%;"> <h6>NO OUTSTANDING PAYMENT</h6></center>
               <?php   }
        ?>
               </div>
        <div class="col-sm-12"><center><h4 style="font-weight: bold;">PAYMENTS DUE</h4></center>
        <?php
        $sppt = $db->query('select * from payments where (faculty = "'.$dat['faculty'].'" && ( department = "'.$dat['department'].'" || department = "all") && (level like "%'.$dat['level'].'%" || level = "all") && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" ) ) || ((faculty = "all") && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" )) order by name asc ');
        $roop = $sppt->fetchAll(PDO::FETCH_ASSOC);
        $zz = 4;
        $cl = 0;
        foreach($roop as $py){ 
            $fp = strpos($py['level'], $dat['level']);
            if($py['level'] != "all"){
                $fg = strpos($py['level'], "//");
                if($fg != ""){
                    //it contains special char
                    $fr = explode("//", $py['level']);
                    $l = "";
                    for($r =0; $r < count($fr); $r++){
                        if($fr[$r] == $dat['level']){
                          // echo $fr[$r];
                            $l = $r;
                        }
                    }
                    //check if payment is spilited as well 
                    $fc = strpos($py['amount'], "//");
                    if($fc != ""){
                       //payment splitted
                        $mx = explode("//", $py['amount']);
                        $mnt = $mx[$l];
                       // echo "<br>".$mnt."<br>";
                    }else{
                       //payment not splitted
                        $mnt = $py['amount'];
                    }
                   
                }else{
                 // echo "NO</br>"  ;
                  $mnt = $py['amount'];
                }
                
//          $mt =  explode("//", $py['amount']);
//          $iy = (substr($dat['level'], 0, 1)) - 1;
//          $mnt = $mt[$iy];
            }else{
              $mnt = $py['amount'] ;
            }
            if( $fp != "" || $py['level'] == "all"){
                if($py['name'] === "School Fees" || $py['name'] === "Portal Fee"  || $py['name'] === "EKSU Smart School" || $py['name'] === "faculty due"){
                    $bv = $db->query('select * from transactions where (payer = "'.$dat['uniqid'].'" && purpose  = "'.$py['id'].'" && present_session = "'.$dat['present_session'].'" && criteria = "fresh")');
                    $paid = 0 ;
                    if($bv->rowCount() > 0){
                    $rpt = $bv->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rpt as $rpk){
                        $paid = $paid + $rpk['amount'];
                    }
                    }
                    $dif = $mnt - $paid;
//                    echo $dif."<br>";
                    if($dif > 0){
            ?>
    
    <div style="padding: 10px;">
          <span class="btn btn-warning" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php if($dif > 0 && $dif < $mnt){ echo "balance "; } echo $py['name']." #".$dif ?></span>
    </div>
    <?php 
                    }else{
                      $cl = $cl + 1  ;
                    }
     } $zz = $zz - 1;
            }
            
            
                    }
                    if($cl >= 4){
                        ?>
        <center> <h6>CLEARED</h6></center>
                            <?php
                    }
        
        ?>
        </div>
        <div class="col-sm-12" style="">
            <center><h4 style="font-weight: bold;">MANAGE OVERPAYMENT</h4></center>
        <form>
            <fieldset>
                 <p>
                   <label>{PAYMENT NAME} [PROGRAMME] (FACULTY)</label>
                                                                <select id="bus-overpmt-p-type" class="full-width-input" style="text-transform: uppercase;">
                                                                    <option value="">---Select Payment Type---</option>
                                                                    
                                                                    <?php
                                                                    $op = $db->query('select * from payments order by name asc');
                                                    $lp = $op->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach($lp as $rt){
                                                                    ?>
                                                                    <option value="<?php echo $rt['id']; ?>"><?php echo "<b style='color:red;'>{".$rt['name']."}</b> <b style='color:blue;'>[".$rt['programme']."]</b> <b style='color:green;'>(".$rt['faculty'].")</b>" ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </p>
                <p>
                    <label>Amount</label>
                    <input type="text" id="bus-overpmt-amt" class="full-width-input" placeholder="Enter Amount" />
                </p>
                <p>
                    <label>SESSION</label>
                    <input type="text" id="bus-overpmt-sess" class="full-width-input" placeholder="Enter Session Format (yyyy/YYYY)" />
                </p>
            </fieldset>
        </form>
            <div id="bus-overpmt-mes"></div>
                                                    <center>
                                                        <div id="put-bus-overpmt-bt" style="padding: 30px;">
                                                            <b onclick="bus_oupmnt('<?php echo $dat['uniqid']; ?>', 'over')"  class="btn btn-primary">SUBMIT <i class="glyphicon glyphicon-arrow-right"></i></b> 
                                                    </div>
                                                    </center>
        </div>
        <div class="col-sm-12"><center><h4 style="font-weight: bold;">MANAGE UNDERPAYMENT</h4></center>
        <form>
            <fieldset>
                 <p>
                   <label>{PAYMENT NAME} [PROGRAMME] (FACULTY)</label>
                                                                <select id="bus-underpmt-p-type" class="full-width-input" style="text-transform: uppercase;">
                                                                    <option value="">---Select Payment Type---</option>
                                                                    
                                                                    <?php
                                                                    $op = $db->query('select * from payments order by name asc');
                                                    $lp = $op->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach($lp as $rt){
                                                                    ?>
                                                                    <option value="<?php echo $rt['id']; ?>"><?php echo "<b style='color:red;'>{".$rt['name']."}</b> <b style='color:blue;'>[".$rt['programme']."]</b> <b style='color:green;'>(".$rt['faculty'].")</b>" ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </p>
                <p>
                    <label>Amount</label>
                    <input type="text" id="bus-underpmt-amt" class="full-width-input" placeholder="Enter Amount" />
                </p>
                <p>
                    <label>SESSION</label>
                    <input type="text" id="bus-underpmt-sess" class="full-width-input" placeholder="Enter Session Format (yyyy/YYYY)" />
                </p>
            </fieldset>
        </form>
         <div id="bus-underpmt-mes"></div>
                                                    <center>
                                                        <div id="put-bus-underpmt-bt" style="padding: 30px;">
                                                            <b onclick="bus_oupmnt('<?php echo $dat['uniqid']; ?>', 'under')"  class="btn btn-primary">SUBMIT <i class="glyphicon glyphicon-arrow-right"></i></b> 
                                                    </div>
                                                    </center>
         </div>
</div>


        <?php   }else{
               echo "<center style='margin-top: 40px;'><div style='width: 100%;' class='round error-box'>This matriculation number or registration ID dose not exist.</div></center>";
           }
           
       }
       }
       }
