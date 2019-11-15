<?php
        //dash-dash
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
            if(isset($_POST['stat'], $_POST['uid'])){
            if(!empty($_POST['stat'] && $_POST['uid'])){
                $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and uniqid = "'.$_POST['uid'].'" and status = "'.$_SESSION['status'].'" and status = "'.$_POST['stat'].'" ');
               $row_count = $stmt->rowCount();
               if($row_count > 0){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
                  if($_SESSION['status'] == "student"){
                       
                        $sch_f = 0 ;
                        $portal_f = 0 ;
                        $ss_f = 0 ;
                        $f_d = 0 ;
                        
                ?>

<div class="col-lg-12" style="padding: 0px;">
 <div class="col-sm-4">
    <div class="round" style="min-height: 200px; background: #fde8e4; border: 1px solid #e6bbb3; color: #cf4425;">
        <center><h4>OUTSTANDING FEES</h4></center>
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
        <?php if($mk == "-"){ ?>
        <div style="padding: 10px;">
           <span class="btn btn-primary btn-block" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php echo $py['name']." #".substr($pl[3], 1,$lnn); ?></span>
        </div> 
               <?php }else{ ?>
        <div id="pay_bt<?php echo $py['id']; ?>rr<?php echo $v; ?>"  style="padding: 10px;">
          <span onclick="pay('<?php echo $py['id']; ?>', '<?php echo $pl[3]; ?>', '<?php echo $v; ?>')" class="btn btn-danger" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php echo $py['name']." #".$pl[3] ?></span>
        </div>   
       <?php 
                }
       $v =  $v + 1;
        }
                  }else{ ?>
        <center style="margin-top: 15%;"> <h6>NO OUTSTANDING PAYMENT</h6></center>
               <?php   }
        ?>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="round" style="min-height: 200px; border: 1px solid #e5d9b2; color: #b28a0b; background: #fdf7e4;">
        <center><h4>PAYMENTS DUE</h4></center>
        <?php
        $sppt = $db->query('select * from payments where (faculty = "'.$dat['faculty'].'" && ( department = "'.$dat['department'].'" || department = "all") && (level like "%'.$dat['level'].'%" || level = "all") && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" ) ) || ((faculty = "all") && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" )) order by name asc ');
        $roop = $sppt->fetchAll(PDO::FETCH_ASSOC);
        $zz = 4;
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
                    $bv = $db->query('select * from transactions where (payer = "'.$_SESSION['uniqid'].'" && purpose  = "'.$py['id'].'" && present_session = "'.$dat['present_session'].'" && criteria = "fresh")');
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
    
    <div id="pay_bt<?php echo $py['id']; ?>"  style="padding: 10px;">
          <span onclick="pay('<?php echo $py['id']; ?>', '<?php echo $dif; ?>', '')" class="btn btn-warning" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><?php if($dif > 0 && $dif < $mnt){ echo "balance "; } echo $py['name']." #".$dif ?></span>
    </div>
    <?php 
                    }
     } $zz = $zz - 1;
            }
            
            
                    }
                    if($zz > 0){
            ?>
        <div  style="padding: 10px;">
          <span onclick="payments()" class="btn btn-warning" style="width: 100%; text-transform: uppercase; font-weight: bold;" >OTHER Payments</span>
    </div>
        <?php 
                    }else{ ?>
                         <!--<center style="margin-top: 15%;"> <h6>CLEARED</h6></center>-->
                  <?php  }
        ?>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="confirmation-box round" style="min-height: 200px; border: 1px solid #b7cbb6; color: #52964f; background: #e7fae6;">
        <center> <h4>PAID FEES</h4></center>
          <?php
        $spt = $db->query('select * from payments where (faculty = "'.$dat['faculty'].'" && ( department = "'.$dat['department'].'" || department = "all") && (level like "%'.$dat['level'].'%" || level = "all")  && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" ) ) || (faculty = "all"  && (programme = "'.$dat['programme'].'" || programme = "all" || programme = "" )) ');
        $rop = $spt->fetchAll(PDO::FETCH_ASSOC);
        $z = 0;
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
                
//          $mt =  explode("//", $py['amount']);
//          $iy = (substr($dat['level'], 0, 1)) - 1;
//          $mnt = $mt[$iy];
            }else{
              $mnt = $py['amount'] ;
            }
            if( $fp != "" || $py['level'] == "all"){
                if($py['name'] === "School Fees" || $py['name'] === "Portal Fee"  || $py['name'] === "EKSU Smart School" || $py['name'] === "faculty due"){
                    $bv = $db->query('select * from transactions where (payer = "'.$_SESSION['uniqid'].'" && purpose  = "'.$py['id'].'" && present_session = "'.$dat['present_session'].'" && criteria = "fresh")');
                    $paid = 0 ;
                    if($bv->rowCount() > 0){
                    $rpt = $bv->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rpt as $rpk){
                        $paid = $paid + $rpk['amount'];
                       
                    }
                    }
                     if($py['name'] === "School Fees"){
                            $sch_f = $mnt ;
                        }
                     if($py['name'] === "Portal Fee"){
                            $portal_f = $mnt ;
                        }
                     if($py['name'] === "EKSU Smart School"){
                            $ss_f = $mnt ;
                        }
                     if($py['name'] === "faculty due"){
                            $f_d = $mnt ;
                        }
                    if($paid > 0){
            ?>
    
    <div  style="padding: 10px;">
        <span class="btn btn-success" style="width: 100%; text-transform: uppercase; font-weight: bold;" ><i class="glyphicon glyphicon-ok" style="float: left;"></i><?php echo $py['name']." #".$paid ?></span>
    </div>
    <?php 
                    }
     }
            }
            
            $z = $z + 1;
                    }
          ?>
    </div>
    </div>
    <div class="col-sm-12 hidden" id="permit_cont">
        <?php
        $passed = "";
        $lo = $db->query('select id, purpose, amount from transactions where payer = "'.$_SESSION['uniqid'].'" && present_session = "'.$dat['present_session'].'" and criteria = "'.'fresh'.'"')->fetchAll(PDO::FETCH_ASSOC);
        if(count($lo) > 0){
            $ver = 0 ;
            $pd_s = 0;
        foreach ($lo as $bx){
            $gu = $db->query('select * from payments where id = "'.$bx['purpose'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
            if($dat['semester'] == "1"){
              //first semester
//               $sch_f = 0 ;
//                        $portal_f = 0 ;
//                        $ss_f = 0 ;
//                        $f_d = 0 ;
                if($gu['name'] == "School Fees" ){
                    $pd_s = $pd_s + $bx['amount'];
                }elseif($gu['name'] == "Portal Fee"){
                    $ver = $ver + 1;
                }elseif($gu['name'] == "EKSU Smart School"){
                 $ver = $ver + 1;   
                }elseif($gu['name'] == "faculty due"){
                $ver = $ver + 1;    
                }
                
            }else{
             //second semester
               if($gu['name'] == "School Fees" ){
                    $pd_s = $pd_s + $bx['amount'];
                }elseif($gu['name'] == "Portal Fee"){
                    $ver = $ver + 1;
                }elseif($gu['name'] == "EKSU Smart School"){
                 $ver = $ver + 1;   
                }elseif($gu['name'] == "faculty due"){
                $ver = $ver + 1;    
                }  
                
            }
        }
      
        
        if($dat['semester'] == "1"){
            if($ver == 3 && $pd_s >= ($sch_f/2)){ 
             if($dat['outstandings'] == ""){
             $passed = "passed"    ;
            }else{
              $by = explode("{:||:}", $dat['outstandings']);
              $tot = count($by);
              $pk = 0;
              foreach($by as $dy){
                  $rg = explode("//", $dy);
                  $tb = substr($rg[3],0,1);
                  if($tb == "-"){
                    $pk = $pk+1;  
                  }
              }
              if($pk == $tot){
                 $passed = "passed"    ; 
              }
            }
            }
        }else{
            if($ver == 3 && $pd_s >= $sch_f){ 
             if($dat['outstandings'] == ""){
             $passed = "passed"    ;
            }else{
              $by = explode("{:||:}", $dat['outstandings']);
              $tot = count($by);
              $pk = 0;
              foreach($by as $dy){
                  $rg = explode("//", $dy);
                  $tb = substr($rg[3],0,1);
                  if($tb == "-"){
                    $pk = $pk+1;  
                  }
              }
              if($pk == $tot){
                 $passed = "passed"    ; 
              }
            }
            } 
        }
        }
        
        ?>
        
        <?php if($passed == "passed"){ ?>
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
        <center>
            <div style="text-transform: uppercase; font-weight: bolder; font-size: 200%; width: 100%;border-radius: 20px; color: #1c94c4;">EXAMINATION PERMIT FOR <?php echo $dat['present_session']." SESSION "; if($dat['semester'] == "1"){ echo "FIRST SEMESTER"; }else{ echo "SECOND SEMESTER"; } ?></div>
        </center>
<br><br><br>
</td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="4" valign="top">
        <div style="width: 100%;">
            <center>  <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo "Name:%20".$dat['firstname']."%20".$dat['middlename']."%20".$dat['lastname']."%20Matric%20Number:%20".$dat['uid']."%20Image:%20 http://k-dev.org/eksu/".$dat['photo']."%20On:%20".date("H:i:s D d-M-Y",time()); ?>&chs=500x500&chld=L|0" class="qr-code img-thumbnail img-responsive"></center>
        </div>
    </td>
</tr>
        </table>
            
            <?php } ?>
        
    </div>
    
     <div class="col-sm-12" style="">
         <div id="permit1" <?php if($passed == "passed"){ ?>onclick="permit('1')"<?php } ?> class="btn btn-success<?php if($passed != "passed"){ ?> disabled<?php } ?>" style="float: right; "><i class="glyphicon glyphicon-print"></i> Print Exam Permit</div> 
        <br><br>
    </div>
   
    <div class="col-sm-12 stripe-separator" style="padding: 0px;">  </div>
    <div class="col-sm-10" style="padding: 0px;">
        <form action="#">
							
								<fieldset>
                                                                    <div class="col-lg-12" style="padding: 0px;">
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="a">Firstname</label>
                                                                                <input type="text" id="a" style="text-transform: capitalize;" value="<?php echo $dat['firstname']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="b">Middlename</label>
                                                                                <input type="text" id="b" style="text-transform: capitalize;" value="<?php echo $dat['middlename']; ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                             <p>
										<label for="c">Lastname</label>
                                                                                <input type="text" id="c" style="text-transform: capitalize;" value="<?php echo $dat['lastname']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-1" style="padding: 0px;">
                                                                             <p>
										<label for="cc">Gender</label>
                                                                                <input type="text" id="cc" style="text-transform: capitalize;" value="<?php echo $dat['gender']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                             <p>
										<label for="cc1">ID</label>
                                                                                <input type="text" id="cc1" style="text-transform: capitalize;" value="<?php echo $dat['uid']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                            <p>
										<label for="d1">Programme</label>
                                                                                <input type="text" id="d1" style="text-transform: capitalize;" value="<?php echo $dat['programme']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                            <p>
										<label for="d2">Duration</label>
                                                                                <input type="text" id="d2" value="<?php echo $dat['duration']." Years"; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="d">Falculty</label>
                                                                                <input type="text" id="d" style="text-transform: capitalize;" value="<?php echo $dat['faculty']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="e">Department</label>
                                                                                <input type="text" id="e" style="text-transform: capitalize;" value="<?php echo $dat['department']; ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                             <p>
										<label for="f">Level</label>
                                                                                <input type="text" id="f" value="<?php echo $dat['level']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                            <p>
										<label for="g">Session</label>
                                                                                <input type="text" id="g" value="<?php echo $dat['present_session']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                            <p>
										<label for="h">Semester</label>
                                                                                <input type="text" id="h" value="<?php  $sem = $dat['semester']; if($sem == 1){ echo "First";}elseif($sem == "2"){ echo "Second"; } ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                        <div class="col-sm-2" style="padding: 0px;">
                                                                             <p>
										<label for="j">cgpa</label>
                                                                                <input type="text" id="j" value="<?php echo number_format((float)$dat['cgpa'], 2, '.', ''); ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-6" style="padding: 0px;">
                                                                            <center>
                                                                             <p>
										<label for="i">Registered Courses</label>
                                                                                <input type="text" id="i" value="<?php if($dat['results'] != ""){ $c = []; $hy = explode("{:||:}", $dat['results']); foreach($hy as $kp){ $rt = explode("//", $kp); if($rt[2] == $dat['semester'] && $rt[3] == $dat['level']){ array_push($c, $rt[0]); }  } if(empty($c)){ echo "YET TO REGISTER"; }else{ foreach ($c as $cc){ $ccc = $db->query('select * from courses where id = "'.$cc.'" ')->fetchAll(PDO::FETCH_ASSOC)[0]; echo "| ".$ccc['code']." (".$ccc['units'].")"." |"; } }}else{ echo "YET TO REGISTER"; } ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                            </center>
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                    </div>
									
									
	
									
								</fieldset>
							
							</form>
    </div>
    <div class="col-sm-2" style="padding: 0px;">
        <center>
            <img id="dash_p" src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" style="width: 180px; height: 180px; border-radius: 50%;" />
          
        </center>
    </div>
    <div class="col-sm-12" style="padding: 0px;">
        
    </div>
</div>


<?php
                  }
                  elseif($_SESSION['status'] == "staff"){
                   //do staff things....
                      ?>
<div class="col-lg-12" style="padding: 0px;">
 <div class="col-sm-10" style="padding: 0px;">
        <form action="#">
							
								<fieldset>
                                                                    <div class="col-lg-12" style="padding: 0px;">
                                                                        <div class="col-sm-4" style="padding: 0px;">
                                                                            <p>
										<label for="a">Firstname</label>
                                                                                <input type="text" id="a" value="<?php echo $dat['firstname']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-4" style="padding: 0px;">
                                                                            <p>
										<label for="b">Middlename</label>
                                                                                <input type="text" id="b" value="<?php echo $dat['middlename']; ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                        <div class="col-sm-4" style="padding: 0px;">
                                                                             <p>
										<label for="c">Lastname</label>
                                                                                <input type="text" id="c" value="<?php echo $dat['lastname']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="d">Falculty</label>
                                                                                <input type="text" id="d" value="<?php echo $dat['faculty']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="e">Department</label>
                                                                                <input type="text" id="e" value="<?php echo $dat['department']; ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                       <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="g">Session</label>
                                                                                <input type="text" id="g" value="<?php echo $dat['present_session']; ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                        </div>
                                                                        <div class="col-sm-3" style="padding: 0px;">
                                                                            <p>
										<label for="h">Semester</label>
                                                                                <input type="text" id="h" value="<?php $sem = $dat['semester']; if($sem == 1){ echo "First";}elseif($sem == "2"){ echo "Second"; } ?>" readonly class="round full-width-input disabled"/>
									</p> 
                                                                        </div>
                                                                       
                                                                        <div class="col-sm-12" style="padding: 0px;">
                                                                            <center>
                                                                             <p>
										<label for="i">Allocated courses</label>
                                                                                <input type="text" id="i" value="<?php $ft = $db->query('select * from courses where lecturers like "%'.$dat['uniqid'].'%"'); $c = $ft->rowCount(); if($c == "0"){ echo "YOU ARE YET TO BE ALLOCATED A COURSE"; }else{ $cc = $ft->fetchAll(PDO::FETCH_ASSOC); foreach ($cc as $ccc){ echo "| ".$ccc['code']." |"; } } ?>" readonly class="round full-width-input disabled"/>
									</p>
                                                                            </center>
                                                                        </div>
                                                                        
                                                                        
                                                                        
                                                                    </div>
									
									
	
									
								</fieldset>
							
							</form>
    </div>
    <div class="col-sm-2" style="padding: 0px;">
        <center>
            <img id="dash_p" src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" style="width: 200px; height: 200px; border-radius: 50%;" />
          
            <span class="btn btn-default" style="width: 100%;"><?php echo $dat['uid']; ?></span>
        </center>
    </div>
    <div class="col-sm-12" style="padding: 0px;">
        
    </div>
</div>
                 <?php 
                 
            }elseif($_SESSION['status'] == "bursary"){
                $resp = TRUE;
                if($resp != TRUE){
                 //generate a login token and send to bursars email address
                $r1 = mt_rand(10, 99);
                                    $r2 = time();
                                    $r3 = mt_rand(0, 25);
                                    $r4 = mt_rand(0, 9);
                                    $r5 = mt_rand(0, 25);
                                    $r6 = mt_rand(0, 25);
                                    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
                                    $code = $r1 . $arr[$r6] . $r2 . $arr[$r3] . $r4 . $arr[$r5];
                                    $db->query('update users set token = "'.sha1($code).'" where uniqid = "'.$_SESSION['uniqid'].'"');
                                     $headers = 'From: K-DEV<noreply@k-dev.org>' . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion();
                                        $to = $dat['email'];
                                      $subj = "Login Token";
                                      
                                        $mailbody = "Dear ".$dat['firstname'].",\r\nKindly use the token below to complete your login process\r\n".$code;                                      
if(mail($to, $subj, $mailbody, $headers)){
                                          
                                         ?>
<div class="col-lg-12">
    <div class="col-sm-4"></div>
    <div class="col-sm-4" style="padding: 0px; padding-top: 10%;">
<form>
    <fieldset>
        <p>
        <center><label for="bus-token">Enter Security Token</label></center>
        <input type="password" value="" class="round full-width-input" id="bus-token" />
        </p>
    </fieldset>
</form>
</div>
    <div class="col-sm-4"></div>
</div>
             <?php     
                                            
                                       }else{
                                           echo "Oops! Error occurred while sending message";                                           $resp = FALSE;                                         
                                          
                                       }
                
                  }else{ ?>
<div id="put-bus">
    
</div> 
<script>
    $.post('bus/', {}, 
    function(data){
      $("#put-bus").html(data)  ;
    });
</script>  
                      
               <?php   }
            }elseif($_SESSION['status'] == "vc" || $_SESSION['status'] == "registrar"){
                
                ?>
                <div id="put-vc">
    
</div> 
<script>
    $.post('vc/', {}, 
    function(data){
      $("#put-vc").html(data)  ;
    });
</script>
                
       <?php
            }elseif($_SESSION['status'] == "exams and records"){
                
                ?>
                <div id="put-exam-rec">
    
</div> 
<script>
    $.post('exam-rec/', {}, 
    function(data){
      $("#put-exam-rec").html(data)  ;
    });
</script>
                
        <?php    }elseif($_SESSION['status'] == "ict"){
                
                ?>
                <div id="put-ict">
    
</div> 
<script>
    $.post('ict/', {}, 
    function(data){
      $("#put-ict").html(data);
    });
</script>
                
        <?php   }elseif($_SESSION['status'] == "super admin"){
                
                ?>
                <div id="put-minda">
    
</div> 
<script>
    $.post('minda/', {}, 
    function(data){
      $("#put-minda").html(data);
    });
</script>
                
        <?php    }
            }else{
              header("location: ../");  
            }
            }else{
              header("location: ../");  
            }
                
            }else{
              header("location: ../");  
            }
            


        }else{
            header("location: ../");
        }
        
       