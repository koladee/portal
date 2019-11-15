<?php
//dash-payments
include '../../configs.php';
 define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}

if(isset($_SESSION['status'], $_SESSION['uniqid'])){
    if(isset($_POST['std'])){
     if($_POST['std'] == $_SESSION['uniqid'] && $_SESSION['status'] == "student"){
         $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "student"');
         if($stmt->rowCount() == 1){
             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
             $dat = $rows[0];
         ?>


<div class="col-lg-12">
    <style>
       div.col-sm-4 span{
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
    
    
          <?php 
        $spt = $db->query('select * from payments where (faculty = "'.$dat['faculty'].'" && ( department = "'.$dat['department'].'" || department = "all") && (level like "%'.$dat['level'].'%" || level = "all") && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" ) ) || (faculty = "all" && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" )) order by name asc ');
        $rop = $spt->fetchAll(PDO::FETCH_ASSOC);
        foreach($rop as $py){ 
            $fp = strpos($py['level'], $dat['level']);
            if($py['level'] != "all"){
                $fg = strpos($py['level'], "//");
                if($fg != ""){
                    //it contains special char
                    $fr = explode("//", $py['level']);
                    $l = "";
                    for($r =0; $r < count($fr); $r++){
                        if($fr[$r] == $dat['level']){
                            $l = $r;
                        }
                    }
                    //check if payment is spilited as well 
                    $fc = strpos($py['amount'], "//");
                    if($fc != ""){
                       //payment splitted
                        $mx = explode("//", $py['amount']);
                        $mnt = $mx[$l];
                    }else{
                       //payment not splitted
                        $mnt = $py['amount'];
                    }
                   
                }else{
                 // echo "NO</br>"  ;
                  $mnt = $py['amount'];
                }
                

            }else{
              $mnt = $py['amount'] ;
            }
            if( $fp != "" || $py['level'] == "all"){
              $bl = $db->query('select * from transactions where payer = "'.$_SESSION['uniqid'].'" and purpose = "'.$py['id'].'" and present_session = "'.$dat['present_session'].'" and criteria = "'.'fresh'.'"');
               $bg = 0;
               if($bl->rowCount() > 0){
                $rk = $bl->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rk as $rrk){
                    $bg = $bg + ($rrk['amount']);
                }
               }
               $dif = $mnt - $bg;
            ?>
    
    <div id="pay_bt<?php echo $py['id']; ?>" class="col-sm-4" style="padding: 10px;">
        <span <?php if($dif > 0){ ?> onclick="pay('<?php echo $py['id']; ?>', '<?php echo $dif; ?>', '')" <?php } ?> class="btn <?php if($dif < $mnt && $dif > 0){ ?>btn-warning<?php }elseif($dif == 0){ ?>btn-success<?php }else{ ?>btn-danger<?php } ?>" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php if($dif == 0){ ?><i style="float: left;" class="glyphicon glyphicon-ok"></i><?php } ?><?php if($py['name'] === "School Fees" && $dif == $mnt){echo "Full "; }elseif($py['name'] === "School Fees" && $dif < $mnt && $dif > 0){echo "Balance "; } echo $py['name']." #"; ?><?php if($dif < $mnt && $dif > 0){ echo $dif; }elseif($dif == 0){ echo $mnt; }else{ echo $dif; } ?></span>
    </div>
    <?php 
    if($py['name'] === "School Fees" && $dif == $mnt){ ?>
        
       <div id="pay_bt<?php echo $py['id']; ?>h" class="col-sm-4" style="padding: 10px;">
          <span onclick="pay('<?php echo $py['id']; ?>', 'h', '')" class="btn btn-danger" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php echo "Half ".$py['name']." #".($mnt/2) ?></span>
    </div> 
   <?php }
    
    
            } }
         }
        
        ?>
    <div class="col-sm-12" style="margin-top: 5%;">
         <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" >
					
                                            <h3 class="fl" style="font-size: 120%;">PAYMENTS HISTORY</h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf" style="min-height: 20px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 30%; font-weight: bold;">PAYMENT NAME</th>
									<th style="width: 15%; font-weight: bold;">AMOUNT</th>
									<th style="width: 20%; font-weight: bold;">TRANSACTION ID</th>
									<th style="width: 15%; font-weight: bold;">DATE</th>
									<th style="width: 10%; font-weight: bold;">REMARK</th>
									<th style="width: 10%; font-weight: bold;">RECEIPT</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
<?php  
$mu = $db->query('select * from transactions where payer = "'.$_SESSION['uniqid'].'" and amount != "" order by id asc');
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
                                                                        <td style="text-transform: capitalize; font-weight: bold;"><b onclick="receipt('<?php echo $dn['id']; ?>', '<?php echo $dn['id']; ?>')" id="reci<?php echo $dn['id']; ?>" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> <b>Receipt</b></b></td>
									
								</tr>
                                                               
     <?php
     
} }else{ ?>
                                                                <tr>
                                                                    <td colspan="6">
                                                                        <h5 style="text-transform: uppercase; font-weight: bold;">You are yet to make your first payment.</h5>
                                                                    </td>
                                                                </tr>
<?php } ?>
	
                                                                
							</tbody>
							
						</table>
                                </div>
                                    </div>
                </div>
    </div>
    <div class="col-sm-12 hidden" id="put-receipt">
        
    </div>
</div>    
         
   <?php  }
        
    }
    
}

