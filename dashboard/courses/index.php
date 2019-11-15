<?php
//dash-courses
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
if($_SESSION['status'] == "student"){
    $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "student"');
    if($stmt->rowCount() == 1){
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];

   $lim = ((substr($dat['level'], 0,1))*2)+1;
   $l1 = []; $l2 = []; $l3 = []; $l4 = []; $l5 = []; $l6 = []; $l7 = []; $l8 = []; $l9 = [];
   $o11 = []; $o21 = []; $o31 = []; $o41 = []; $o51 = []; $o61 = []; $o71 = []; $o81 = []; $o91 = [];
   $o12 = []; $o22 = []; $o32 = []; $o42 = []; $o52 = []; $o162 = []; $o72 = []; $o82 = []; $o92 = [];
   $c11 = []; $c21 = []; $c31 = []; $c41 = []; $c51 = []; $c61 = []; $c71 = []; $c81 = []; $c91 = [];
   $c12 = []; $c22 = []; $c32 = []; $c42 = []; $c52 = []; $c62 = []; $c72 = []; $c82 = []; $c92 = [];
//            $sec = round($i/2);
   if($dat['results'] != ""){
         $rst = explode("{:||:}", $dat['results']);
   
   foreach ($rst as $ft){
       $up = explode("//", $ft);
       if($up[3] == "100"){
           array_push($l1, $ft) ;
         
          
       }elseif($up[3] == "200"){
           array_push($l2, $ft) ;
           
       }elseif($up[3] == "300"){
           array_push($l3, $ft) ;
            
       }elseif($up[3] == "400"){
           array_push($l4, $ft) ;
         
       }elseif($up[3] == "500"){
           array_push($l5, $ft) ;
        
       }elseif($up[3] == "600"){
           array_push($l6, $ft) ;
        
       }elseif($up[3] == "700"){
           array_push($l7, $ft) ;
        
       }elseif($up[3] == "800"){
           array_push($l8, $ft) ;
        
       }elseif($up[3] == "900"){
           array_push($l9, $ft) ;
        
       }
       
   }
   }else{}
     array_unique($l1);
    array_unique($l2);
    array_unique($l3);
    array_unique($l4);
    array_unique($l5);
    array_unique($l6);
    array_unique($l7);
    array_unique($l8);
    array_unique($l9);
    
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
   $ll61 = [];
    $ll62 = [];
    foreach ($l6 as $ll6){
        $x = explode("//", $ll6);
        if($x[2] == 1){
            array_push($ll61, $ll6);
        }elseif($x[2] == 2){
            array_push($ll62, $ll6);
        }
    }
   $ll71 = [];
    $ll72 = [];
    foreach ($l7 as $ll7){
        $x = explode("//", $ll7);
        if($x[2] == 1){
            array_push($ll71, $ll7);
        }elseif($x[2] == 2){
            array_push($ll72, $ll7);
        }
    }
   $ll81 = [];
    $ll82 = [];
    foreach ($l8 as $ll8){
        $x = explode("//", $ll8);
        if($x[2] == 1){
            array_push($ll81, $ll8);
        }elseif($x[2] == 2){
            array_push($ll82, $ll8);
        }
    }
   $ll91 = [];
    $ll92 = [];
    foreach ($l9 as $ll9){
        $x = explode("//", $ll9);
        if($x[2] == 1){
            array_push($ll91, $ll9);
        }elseif($x[2] == 2){
            array_push($ll92, $ll9);
        }
    }
    
    $p_cgpa = [];
//    $p_cgpa[0] = 0;
    ?>
<div class="col-lg-12">
   
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
                        
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo11">
					
                                            <h3 class="fl" style="font-size: 120%;">FIRST SEMESTER 100L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo11" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb11">
	<?php 
        $tu = 0;
        $id_arr = [];
        if(!empty($ll11)){
        foreach($ll11 as $do11){
            $dis = explode("//", $do11);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "100" && $dat['semester'] == 1 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                            <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "100" && $dat['semester'] == 1){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll11)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('11')" id="c_formbt11" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "100" && $dat['semester'] == 1){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('11')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "100" and semester = "1" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "100" && $dat['semester'] == 1){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        
                                        <div id="c_form11" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 100L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : First</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll11 as $do11){
            $dis = explode("//", $do11);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll11)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                        
                                        
                                        
                                </div>
                                    </div>
                </div>
       
        
        
    </div>
    <br><br><br><br>
    <?php 
   
    
    
    
     ?>
    
    <?php
    
    if(!empty($ll12)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo12">
					
                                            <h3 class="fl" style="font-size: 120%;">SECOND SEMESTER 100L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo12" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb12">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll12 as $do12){
            $dis = explode("//", $do12);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td><i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "100" && $dat['semester'] == 2 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "100" && $dat['semester'] == 2){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll12)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('12')" id="c_formbt12" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "100" && $dat['semester'] == 2){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('12')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "100" and semester = "2" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "100" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        
                                        <div id="c_form12" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 100L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll12 as $do12){
            $dis = explode("//", $do12);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll12)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
        
        
        
    </div>
    <br><br><br><br>
    <?php 
    
    
    }
    
     ?>
   
   <?php if(!empty($ll21)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo21">
					
                                            <h3 class="fl" style="font-size: 120%;">FIRST SEMESTER 200L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo21" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb21">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll21 as $do21){
            $dis = explode("//", $do21);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "200" && $dat['semester'] == 1 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "200" && $dat['semester'] == 1){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll21)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('21')" id="c_formbt21" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "200" && $dat['semester'] == 1){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('21')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "200" and semester = "1" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "200" && $dat['semester'] == 1){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form21" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 200L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : First</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll21 as $do21){
            $dis = explode("//", $do21);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll21)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
       
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll22)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo22" >
					
                                            <h3 class="fl" style="font-size: 120%;">SECOND SEMESTER 200L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo22" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb22">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll22 as $do22){
            $dis = explode("//", $do22);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "200" && $dat['semester'] == 2 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "200" && $dat['semester'] == 2){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll22)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('22')" id="c_formbt22" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "200" && $dat['semester'] == 2){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('22')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "200" and semester = "2" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "200" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form22" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 200L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll22 as $do22){
            $dis = explode("//", $do22);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll22)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
       
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
   
   <?php if(!empty($ll31)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo31">
					
                                            <h3 class="fl" style="font-size: 120%;">FIRST SEMESTER 300L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo31" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb31">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll31 as $do31){
            $dis = explode("//", $do31);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "300" && $dat['semester'] == 1 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "300" && $dat['semester'] == 1){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll31)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('31')" id="c_formbt31" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "300" && $dat['semester'] == 1){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('31')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "300" and semester = "1" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "300" && $dat['semester'] == 1){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form31" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 300L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : First</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll31 as $do31){
            $dis = explode("//", $do31);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll31)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
      
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll32)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo32">
					
                                            <h3 class="fl" style="font-size: 120%;">SECOND SEMESTER 300L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo32" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb32">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll32 as $do32){
            $dis = explode("//", $do32);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "300" && $dat['semester'] == 2 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "300" && $dat['semester'] == 2){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll32)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('32')" id="c_formbt32" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "300" && $dat['semester'] == 2){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('32')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "300" and semester = "2" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "300" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form32" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 300L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll32 as $do32){
            $dis = explode("//", $do32);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll32)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
        
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
    
   <?php if(!empty($ll41)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo41">
					
                                            <h3 class="fl" style="font-size: 120%;">FIRST SEMESTER 400L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo41" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb41">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll41 as $do41){
            $dis = explode("//", $do41);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "400" && $dat['semester'] == 2 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "400" && $dat['semester'] == 1){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll41)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('41')" id="c_formbt41" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "400" && $dat['semester'] == 1){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('41')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "400" and semester = "1" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "400" && $dat['semester'] == 1){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form41" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 400L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : First</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll41 as $do41){
            $dis = explode("//", $do41);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll41)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
      
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
   
    <?php
    
    if(!empty($ll42)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo42" >
					
                                            <h3 class="fl" style="font-size: 120%;">SECOND SEMESTER 400L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo42" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb42">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll42 as $do42){
            $dis = explode("//", $do42);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "400" && $dat['semester'] == 2 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "400" && $dat['semester'] == 2){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll42)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('42')" id="c_formbt42" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "400" && $dat['semester'] == 2){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('42')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "400" and semester = "2" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "400" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form42" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 400L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll42 as $do42){
            $dis = explode("//", $do42);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll42)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
       
        
        
    </div>
    <br><br><br><br>
    <?php
    
    }
    
     ?>
   
   <?php if(!empty($ll51)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf"data-toggle="collapse" data-target="#demo51" >
					
                                            <h3 class="fl" style="font-size: 120%;">FIRST SEMESTER 500L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo51" style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb51">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll51 as $do51){
            $dis = explode("//", $do51);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "500" && $dat['semester'] == 1 && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "500" && $dat['semester'] == 1){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll51)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('51')" id="c_formbt51" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "500" && $dat['semester'] == 1){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('51')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "500" and semester = "1" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "500" && $dat['semester'] == 1){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form51" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 500L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : First</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll51 as $do51){
            $dis = explode("//", $do51);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll51)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
       
       
        
    </div>
    <br><br><br><br>
    <?php
        }
    
     ?>
    
    
    <?php
    
    if(!empty($ll52)){
  ?>  
    <div class="col-sm-12" >
        <div style="background: rgba(0,0,0,0);">
                    <div class="content-module">
				
                        <div class="content-module-heading cf" data-toggle="collapse" data-target="#demo52" >
					
                                            <h3 class="fl" style="font-size: 120%;">SECOND SEMESTER 500L </h3><h3 class="glyphicon glyphicon-chevron-down fr"></h3>
					</div> 
                                    <!--end content-module-heading--> 
                                    <div class="content-module-main cf collapse" id="demo52"  style="min-height: 200px; overflow: auto;">
                              <table>
	<thead>
	<tr>
	<th style="width: 10%;">Course Code</th>
									<th style="width: 60%;">course title</th>
									<th style="width: 15%;">unit(s)</th>
									<th style="width: 15%;">Actions</th>
									
									
									
								</tr>
							
							</thead>
                                                        <tbody id="tb52">
	<?php 
        $tu = 0;
        $id_arr = [];
        foreach($ll52 as $do52){
            $dis = explode("//", $do52);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
            $tu = $tu+$css['units'];
        ?>
								<tr>
									
									<td><?php echo $css['code']; ?></td>
									<td><?php echo $css['title']; ?></td>
									<td><?php echo $css['units']; ?></td>
									<td>
                                                                            <i id="reg_c<?php echo $css['id']; ?>" onclick="reg_course('<?php echo $css['id']; ?>', 'N')" class="btn btn-default glyphicon  <?php if($dat['level'] == "500" && $dat['semester'] == 2  && $dis[4] == "" && $dis[5] == ""){ ?>glyphicon-trash<?php }else{ ?>disabled glyphicon-lock<?php } ?>"></i>
                                                                        <?php 
                                                                            $bv = explode("//", $css['lecturers'])[0];
                                                                            ?>
                                                                            <i onclick="chat('<?php echo $bv; ?>')" class="btn btn-default glyphicon  <?php if($dat['level'] == "500" && $dat['semester'] == 2){ ?> glyphicon-comment<?php }else{ ?>disabled glyphicon-comment<?php } ?>"></i>
                                                                        </td>
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr>
                                                                    <td><?php echo count($ll52)." Courses" ?></td>
                                                                    <td></td>
                                                                    <td><?php echo $tu." units"; ?></td>
                                                                    <td><i onclick="c_form('52')" id="c_formbt52" class="btn btn-primary glyphicon glyphicon-download-alt"> Download</i></td>
                                                                </tr>
                                                                <?php if($dat['level'] == "500" && $dat['semester'] == 2){ ?>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                        <b>SEARCH AND SELECT COURSES TO BE REGISTERED BELOW</b>
                                                                    </td></tr>
            <tr><td colspan="4" style="height: 50px; font-size: 120%;">
                                                                                   <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_course('52')" type="text" id="search-course"  class="round button dark ic-search image-right" style="width: 50%; color: #fff !important; font-size: 120%;" placeholder="Enter Course Code as in (ENG 123)"  />
					
				</fieldset>
                                    </form>
                                                                    </td></tr>
            <?php
        $stk = $db->query('select * from courses where department = "'.$dat['department'].'" and level = "500" and semester = "2" order by code asc ');
        $dtk = $stk->fetchAll(PDO::FETCH_ASSOC);
        foreach($dtk as $ro){
            if(($tu + $ro['units']) <= $dat['max_units'] && !in_array($ro['id'], $id_arr)){
        ?>
                                                               
            <tr class="loade">
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "500" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
        <?php 
        $tu = $tu + $ro['units'];
                                                                } } } ?> 
                                                                
                                                                 
								 
            
							</tbody>
							
						</table>
                                        <div id="c_form52" class="hidden">
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
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4 !important;" colspan="2" valign="top">
            <div style="display: inline; width: 60%;">
                <label style="color: #1c94c4 !important;">FIRSTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['firstname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MIDDLENAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['middlename']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LASTNAME : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['lastname']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">MATRIC NUMBER : <?php echo $dat['uid']; ?></label>
        <br>
        <label style="color: #1c94c4 !important;">FACULTY : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['faculty']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">DEPARTMENT : <span style="text-transform: capitalize; color: #1c94c4 !important;"><?php echo $dat['department']; ?></span></label>
        <br>
        <label style="color: #1c94c4 !important;">LEVEL : 500L</label>
        <br>
        <label style="color: #1c94c4 !important;">SEMESTER : Second</label>
        <br>
            </div>
            
    </td>
    <td style="border: 0px solid #eee; width: 100%; text-align: left;" colspan="2" valign="top">
      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>"  style="width: 250px; height: 250px; border-radius: 50%; float: right !important; " />  
    </td>
</tr>
<tr style="background-color: rgba(0,0,0,0);">
        <td style="border: 0px solid #eee; width: 100%; text-align: left; font-size: 200%; font-weight: bold; color: #1c94c4;" colspan="4" valign="top">
<center> COURSE REGISTRATION RECEIPT</center>
    </td>
</tr>
                                            </table>
                                            <table style="width: 100%; border: 1px solid #000;">
	<thead>
	<tr>
	<th style="width: 25%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">Course Code</th>
									<th style="width: 60%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">course title</th>
									<th style="width: 15%; font-weight: bold; font-size: 150%;background-color: #5d6677;color: white;text-transform: uppercase;padding: 1.25em 0 1.25em 1.25em; border-left: 1px solid #747c8a;">unit(s)</th>
									
									
									
									
								</tr>
							
							</thead>
                                                        <tbody>
	<?php 
   
        foreach($ll52 as $do52){
            $dis = explode("//", $do52);
            array_push($id_arr, $dis[0]);
            $c = $db->query('select * from courses where id = "'.$dis[0].'"');
            $cs = $c->fetchAll(PDO::FETCH_ASSOC);
            $css = $cs[0];
           
        ?>
                                                            <tr style="background-color: #f8f9fa;">
									
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['code']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['title']; ?></td>
									<td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $css['units']; ?></td>
									
									
								</tr>
                                                               
                                                                
	<?php
        }
        ?>
                                                                 <tr style="background-color: #f8f9fa;">
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo count($ll52)." Courses" ?></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"></td>
                                                                    <td style="padding: 0.833em 0 0.833em 1.25em; border-left: 1px solid white;border-bottom: 1px solid #f8f9fa; font-size: 120%;"><?php echo $tu." units"; ?></td>
                                                                   
                                                                </tr>
                                                        </tbody>

</table>
                                        </div>
                                </div>
                                    </div>
                </div>
        
        
        
    </div>
    <br><br><br><br>
       <?php
        
    }
    
     ?>
    
    
</div>
          

<?php
    }
}elseif($_SESSION['status'] == "staff"){
  ?>
    <table class="table">
						
							<thead>
						
								<tr>
									
                                                                    <th style="width: 10%;">Course Code</th>
									<th style="width: 50%;">Course Title</th>
									<th style="width: 10%;">Unit(s)</th>
									<th style="width: 30%;">Actionss</th>
								</tr>
							
							</thead>
	
							
							
							<tbody>
	<?php 
         $stp = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "staff"')->fetchAll(PDO::FETCH_ASSOC)[0];
        $stmt = $db->query('select * from courses where lecturers like "%'.$_SESSION['uniqid'].'%" and semester = "'.$stp['semester'].'" order by code asc ');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        foreach($rows as $tr){
        
        ?>
								<tr>
									
									<td style="width: 10%;"><?php echo $tr['code']; ?></td>
									<td style="width: 50%;"><?php echo $tr['title']; ?></td>
									<td style="width: 10%;"><?php echo $tr['units'] ?></td>
                                                                        <td style="width: 30%; text-align: left;">
                                                                            <a href="#" onclick="my_students('<?php echo $tr['id'] ?>')" class="btn btn-default "><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i><i class="glyphicon glyphicon-user"></i><small> Students</small></a>
                                                                            <a href="#" onclick="my_results('<?php echo $tr['id'] ?>')" class="btn btn-default "><i class="glyphicon glyphicon-briefcase"></i></i><small> Results</small></a>
                                                                            <a href="#" onclick="my_materials('<?php echo $tr['id'] ?>')" class="btn btn-default "><i class="glyphicon glyphicon-book"></i></i><small> Course Work</small></a>
                                                                        </td>
								</tr>
        <?php } ?>
								
							
							</tbody>
							
						</table>
<?php }
        } 
        } 
        
        