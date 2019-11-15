<?php
//dash-find-student
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
    if(isset($_POST['std'], $_POST['wh'])){
         $st = $db->query('select * from hod where uniqid = "'.$_SESSION['uniqid'].'"');
        $count = $st->rowCount();
        
        if($count == 1 || $_SESSION['status'] == "vc" || $_SESSION['status'] == "registrar" || $_SESSION['status'] == "exams and records" || $_SESSION['status'] == "super admin"){
            if($count == 1){
            $r = $st->fetchAll(PDO::FETCH_ASSOC);
            $rr = $r[0];
            $stmt = $db->query('select * from users where department = "'.$rr['department'].'" and uid = "'.$_POST['std'].'" and status = "'.'student'.'"');
            
            }else{
              $stmt = $db->query('select * from users where uid = "'.$_POST['std'].'" and status = "'.'student'.'"');  
            }
            $row_count = $stmt->rowCount();
            if($row_count == 1){
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $dat = $rows[0];
                ?>
<div class="col-lg-12" style="padding: 0px;">
    <div class="col-sm-3">
        <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/female.png<?php }else{ echo "../".$dat['photo']; } ?>" style="width: 100px; height: 100px; border-radius: 50%;">
    </div>
    <div class="col-sm-9">
        <h5><?php echo $dat['firstname'].' '.$dat['middlename'].' '.$dat['lastname']; ?></h5>
        <h5><?php echo $dat['faculty']; ?></h5>
        <h5><?php echo $dat['department']; ?></h5>
        <?php 

        $cgpa = $dat['cgpa'];
        
        ?>
        
        
        <h5><?php echo "CGPA: ".number_format((float)$cgpa, 2, '.', ''); ?></h5>
        
    </div>
    
    
    
    
    
   <?php 
   $lim = ((substr($dat['level'], 0,1))*2)+1;
   $l1 = []; $l2 = []; $l3 = []; $l4 = []; $l5 = [];
   $o11 = []; $o21 = []; $o31 = []; $o41 = []; $o51 = [];
   $o12 = []; $o22 = []; $o32 = []; $o42 = []; $o52 = [];
   $c11 = []; $c21 = []; $c31 = []; $c41 = []; $c51 = [];
   $c12 = []; $c22 = []; $c32 = []; $c42 = []; $c52 = [];
//            $sec = round($i/2);
         $rst = explode("{:||:}", $dat['results']);
             
   foreach ($rst as $ft){
       $up = explode("//", $ft);
       if($up[3] == "100"){
           if($up[4] != "" && $up[5] != ""){
          array_push($l1, $ft) ;
          $t = $up[4]+$up[5];
          if($t < 40){
              $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
            if($fk['semester'] == "1"){
           array_push($c11, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;
           }else{
            array_push($c12, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;   
           }
           
          }
       }else{
           $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
           if($fk['semester'] == "1"){
           array_push($o11, $fk['code']."(".$fk['units']." units)") ;
           }else{
            array_push($o12, $fk['code']."(".$fk['units']." units)") ;   
           }
       }
          
       }elseif($up[3] == "200"){
              if($up[4] != "" && $up[5] != ""){
          array_push($l2, $ft) ;
          $t = $up[4]+$up[5];
          if($t < 40){
              $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
            if($fk['semester'] == "1"){
           array_push($c21, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;
           }else{
            array_push($c22, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;   
           }
           
          }
       }else{
           $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
          if($fk['semester'] == "1"){
           array_push($o21, $fk['code']."(".$fk['units']." units)") ;
           }else{
            array_push($o22, $fk['code']."(".$fk['units']." units)") ;   
           }
       }
       }elseif($up[3] == "300"){
              if($up[4] != "" && $up[5] != ""){
          array_push($l3, $ft) ;
          $t = $up[4]+$up[5];
          if($t < 40){
              $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
            if($fk['semester'] == "1"){
           array_push($c31, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;
           }else{
            array_push($c32, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;   
           }
           
          }
       }else{
            $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
            $fk = $fkk[0];
          if($fk['semester'] == "1"){
           array_push($o31, $fk['code']."(".$fk['units']." units)") ;
           }else{
            array_push($o32, $fk['code']."(".$fk['units']." units)") ;   
           }
       }
       }elseif($up[3] == "400"){
              if($up[4] != "" && $up[5] != ""){
          array_push($l4, $ft) ;
          $t = $up[4]+$up[5];
          if($t < 40){
              $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
            if($fk['semester'] == "1"){
           array_push($c41, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;
           }else{
            array_push($c42, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;   
           }
           
          }
       }else{
            $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
            $fk = $fkk[0];
          if($fk['semester'] == "1"){
           array_push($o41, $fk['code']."(".$fk['units']." units)") ;
           }else{
            array_push($o42, $fk['code']."(".$fk['units']." units)") ;   
           }
       }
       }elseif($up[3] == "500"){
              if($up[4] != "" && $up[5] != ""){
          array_push($l5, $ft) ;
          $t = $up[4]+$up[5];
          if($t < 40){
              $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
            if($fk['semester'] == "1"){
           array_push($c51, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;
           }else{
            array_push($c52, $fk['code']."(".$fk['units']." units)//".$up[0]."//".$up[6]) ;   
           }
           
          }
       }else{
           $fkk = $db->query('select * from courses where id = "'.$up[0].'"')->fetchAll(PDO::FETCH_ASSOC);
           $fk = $fkk[0];
           if($fk['semester'] == "1"){
           array_push($o51, $fk['code']."(".$fk['units']." units)") ;
           }else{
            array_push($o52, $fk['code']."(".$fk['units']." units)") ;   
           }
       }
       }
       
   }
   
     array_unique($l1);
    array_unique($l2);
    array_unique($l3);
    array_unique($l4);
    array_unique($l5);
   $ll11 = [];
    $ll12 = [];
    foreach ($l1 as $ll1){
        $x = explode("//", $ll1);
        if($x[2] == 1){
            array_push($ll11, $ll1);
        }elseif($x[2] == 2){
            array_push($ll12, $ll1);
        }
    }
   $ll21 = [];
    $ll22 = [];
    foreach ($l2 as $ll2){
        $x = explode("//", $ll2);
        if($x[2] == 1){
            array_push($ll21, $ll2);
        }elseif($x[2] == 2){
            array_push($ll22, $ll2);
        }
    }
   $ll31 = [];
    $ll32 = [];
    foreach ($l3 as $ll3){
        $x = explode("//", $ll3);
        if($x[2] == 1){
            array_push($ll31, $ll3);
        }elseif($x[2] == 2){
            array_push($ll32, $ll3);
        }
    }
   $ll41 = [];
    $ll42 = [];
    foreach ($l4 as $ll4){
        $x = explode("//", $ll4);
        if($x[2] == 1){
            array_push($ll41, $ll4);
        }elseif($x[2] == 2){
            array_push($ll42, $ll4);
        }
    }
   $ll51 = [];
    $ll52 = [];
    foreach ($l5 as $ll5){
        $x = explode("//", $ll5);
        if($x[2] == 1){
            array_push($ll51, $ll5);
        }elseif($x[2] == 2){
            array_push($ll52, $ll5);
        }
    }
    
    $p_cgpa = [];
//    $p_cgpa[0] = 0;
    ?>

   <?php if(!empty($ll11)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>FIRST SEMESTER 100L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
                                                                <?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll11 as $do11){
            $dis = explode("//", $do11);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
                                                                        <td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
                                                                        <td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
                                                                        <td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
                                                                            <i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll11 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        //$q = count($p_cgpa);
        array_push($p_cgpa, $gpa);
        $db->query('update users set cgpa = "'.$gpa.'" where uid = "'.$_POST['std'].'"');
    ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
									<th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o11)){ foreach($o11 as $oo11){  echo "| ".$oo11." |"; } } ?></td>
                                                                        <td><?php if(!empty($c11)){ foreach($c11 as $cc11){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc11); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; }}} ?></td>
                                                                        <td>0.00</td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
    
    <?php
    
    if(!empty($ll12)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>SECOND SEMESTER 100L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll12 as $do12){
            $dis = explode("//", $do12);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);"readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll12 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
        if($bk >= 0){
        $tc = ($p_cgpa[$bk])*$q;
        $n_tc = $tc + $gpa;
        $n_cgpa = ($n_tc)/($q + 1);
        array_push($p_cgpa, $n_cgpa);
        }else{
           $n_cgpa = $gpa;
            array_push($p_cgpa, $gpa);
        }
        $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
    ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o12)){ foreach($o12 as $oo12){ echo "| ".$oo12." |"; } } ?></td>
                                                                        <td><?php if(!empty($c12)){ foreach($c12 as $cc12){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc12); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; }} } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
   <?php if(!empty($ll21)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>FIRST SEMESTER 200L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll21 as $do21){
            $dis = explode("//", $do21);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll21 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
           $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
    ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o21)){ foreach($o21 as $oo21){ echo "| ".$oo21." |"; } } ?></td>
                                                                        <td><?php if(!empty($c21)){ foreach($c21 as $cc21){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc21); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll22)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>SECOND SEMESTER 200L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll22 as $do22){
            $dis = explode("//", $do22);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll22 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o212)){ foreach($o22 as $oo22){ echo "| ".$oo22." |"; } } ?></td>
                                                                        <td><?php if(!empty($c22)){ foreach($c22 as $cc22){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc22); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
   <?php if(!empty($ll31)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>FIRST SEMESTER 300L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll31 as $do31){
            $dis = explode("//", $do31);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll31 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
   $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o31)){ foreach($o31 as $oo31){ echo "| ".$oo31." |"; } } ?></td>
                                                                        <td><?php if(!empty($c31)){ foreach($c31 as $cc31){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc31); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll32)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>SECOND SEMESTER 300L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll32 as $do32){
            $dis = explode("//", $do32);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll32 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o32)){ foreach($o32 as $oo32){ echo "| ".$oo32." |"; } } ?></td>
                                                                        <td><?php if(!empty($c32)){ foreach($c32 as $cc32){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc32); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }  ?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
    
   <?php if(!empty($ll41)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>FIRST SEMESTER 400L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll41 as $do41){
            $dis = explode("//", $do41);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll41 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o41)){ foreach($o41 as $oo41){ echo "| ".$oo41." |"; } } ?></td>
                                                                        <td><?php if(!empty($c41)){ foreach($c41 as $cc41){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc41); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', '');?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll42)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>SECOND SEMESTER 400L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll42 as $do42){
            $dis = explode("//", $do42);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
          $totz = 0 ;
        $totu = 0 ;
        foreach ($ll42 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o42)){ foreach($o42 as $oo42){ echo "| ".$oo42." |"; } } ?></td>
                                                                        <td><?php if(!empty($c42)){ foreach($c42 as $cc42){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc42); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
    
    }
    
     ?>
   
   <?php if(!empty($ll51)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>FIRST SEMESTER 500L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll51 as $do51){
            $dis = explode("//", $do51);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
                                                                        <td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
                                                                            <i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
    <?php 
    
      
        $totz = 0 ;
        $totu = 0 ;
        foreach ($ll51 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o51)){ foreach($o51 as $oo51){ echo "| ".$oo51." |"; } } ?></td>
                                                                        <td><?php if(!empty($c51)){ foreach($c51 as $cc51){  $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc51); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; }} } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
									<td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
        }
    
     ?>
    
    
    <?php
    
    if(!empty($ll52)){
  ?>  
    <div class="col-sm-12" style="padding: 0px;" >
       
        <h3>SECOND SEMESTER 500L</h3>
        <table>
	<thead>
	<tr>
	<th>Course</th>
									<th>title</th>
									<th>unit(s)</th>
									<th>CA</th>
									<th>Exam</th>
									<th>Total</th>
									<?php if($count == 1){ ?><th>Edit</th><?php } ?>
								</tr>
							
							</thead>
	<tbody>
	<?php 
        foreach($ll52 as $do52){
            $dis = explode("//", $do52);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><input id="ca<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[4]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td><input id="exam<?php echo $dis[6]; ?>" type="text" value="<?php echo $dis[5]; ?>" readonly="readonly" style="border: 0px solid #eee; width: 25px; text-align: center; outline: none; background: rgba(0,0,0,0);" /></td>
									<td id="total<?php echo $dis[6]; ?>"><?php echo ($dis[4]+ $dis[5]); ?></td>
									<?php if($count == 1){ ?>
                                                                        <td>
										<i id="edit_bt<?php echo $dis[6]; ?>" onclick="edit_result('<?php echo $dis[6]; ?>', 'edit')" class="btn btn-default glyphicon glyphicon-pencil"></i>
										
									</td>
                                                                        <?php } ?>
								</tr>
	<?php
        }
        ?>
								
							</tbody>
							
						</table>
        
    </div>
    <br><br>
        <?php 
              $totz = 0 ;
        $totu = 0 ;
        foreach ($ll52 as $x){
            $c = explode("//", $x);
            $v = $c[4]+$c[5];
            $b = $db->query('select * from courses where id = "'.$c['0'].'"')->fetchAll(PDO::FETCH_ASSOC)[0]['units'];
            $pt = 0;
            if($v >= 70){
                $pt = 5;
            }elseif($v >= 60 && $v < 70){
                $pt = 4 ;
            }elseif($v >=50 && $v < 60){
             $pt = 3;   
            }elseif($v >= 45 && $v < 50){
                $pt = 2;
            }elseif($v >= 40 && $v < 45){
                $pt = 1;
            }elseif($v < 40){
                $pt = 0;
            }
            $totz = $totz + ($pt*$b);
            $totu = $totu + ($b);
        }
        $gpa = ($totz/$totu);
        $q = count($p_cgpa);
        $bk = $q - 1;
           if($bk >= 0){        $tc = ($p_cgpa[$bk])*$q;        $n_tc = $tc + $gpa;        $n_cgpa = ($n_tc)/($q + 1);        array_push($p_cgpa, $n_cgpa);        }else{           $n_cgpa = $gpa;            array_push($p_cgpa, $gpa);        }
    $db->query('update users set cgpa = "'.$n_cgpa.'" where uid = "'.$_POST['std'].'"');
    
           
           ?>
    <div class="col-sm-12" style="padding: 0px; margin-top: 2%;">
        <table>
						
							<thead>
						
								<tr>
									<th>TCP</th>
									<th>TU</th>
                                                                        <th>OUTSTANDING</th>
                                                                        <th>CARRY OVER</th>
                                                                        <th>PREVIOUS CGPA</th>
									<th>PRESENT GPA</th>
									<th>CGPA</th>
								</tr>
							
							</thead>
	
							
							<tbody>
	<tr>
                                                                        <td><?php echo $totz; ?></td>
									<td><?php echo $totu; ?></td>
                                                                        <td><?php if(!empty($o52)){ foreach($o52 as $oo52){ echo "| ".$oo52." |"; } } ?></td>
                                                                        <td><?php if(!empty($c52)){ foreach($c52 as $cc52){ $sc = []; foreach($rst as $pk){ $pkk = explode("//", $pk);$pkp = explode("//", $cc52); if($pkk[0] == $pkp[1]){ array_push($sc, ($pkk[4]+$pkk[5])); }}if(max($sc) < 45){ echo "| ".$pkp[0]." |"; } } } ?></td>
                                                                        <td><?php if($bk >=0){ echo  number_format((float)$p_cgpa[$bk], 2, '.', ''); }else{ echo "0.00"; }?></td>
									<td><?php echo number_format((float)$gpa, 2, '.', ''); ?></td>
                                                                        <td><?php echo number_format((float)$n_cgpa, 2, '.', ''); ?></td>
								</tr>
	
							
							</tbody>
							
						</table>
    </div>
    <?php
        
    }
    
     ?>
    
    
</div>
           <?php }else{
                $mes = "Oops! No student is associated with <b>".$_POST['std']."</b> on this system!";
            }
            
        }else{
          $mes = "Unauthorised access!!!";  
        }
        
    }else{
      $mes = "Unauthorised access!!!";  
    }
    
    
}else{
 $mes = "Unauthorised access!!!";  
}
if(isset($mes)){
    echo $mes;
}