        <?php include '../../configs.php';
                                           define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}
        
        if(isset($_SESSION['status'], $_SESSION['uniqid'])){
            
            
 
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "'.'staff'.'" and status = "'.$_SESSION['status'].'" ');
               $row_count = $stmt->rowCount();
               if($row_count > 0){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
        //check if user is an HOD of his/her department
        $stmt1 = $db->query('select * from hod where uniqid = "'.$_SESSION['uniqid'].'" and department = "'.$dat['department'].'" and faculty = "'.$dat['faculty'].'" ');
               $row_count1 = $stmt1->rowCount();
        if($row_count1 > 0){
            if(isset ($_POST['to_allocate'], $_POST['alocate'], $_POST['action'])){
                if(!empty($_POST['to_allocate'] && $_POST['alocate'] && $_POST['action'])){
                    $cid = $_POST['to_allocate'];
                    $lecs = $_POST['alocate'];
                    $cond = $_POST['action'];
                    $st = $db->query('select * from courses where id = "'.$cid.'" ');
                        $ct = $st->rowCount();
                        if($ct == 1){
                    if($cond == "Y"){
                        //add to existing lectures
                        
                            $rw = $st->fetchAll(PDO::FETCH_ASSOC);
                            $dt = $rw[0];
                            $rt = explode("//", $dt['lecturers']);
                        foreach ($rt as $f){
                            if($f != ""){
                                array_push($lecs, $f);
                            }
                        }
                          $don = implode("//", $lecs);
                         $dd = $db->query('update courses set lecturers = "'.$don.'" where id = "'.$cid.'" ');
                          if($dd){
                               echo "Lecturer(s) successfully allocated ".$dt['code'];
                              
                          }
                        
                    }elseif($cond == "N"){
                        //remove from existing
                      
                        $narr = [];
                        $rw = $st->fetchAll(PDO::FETCH_ASSOC);
                            $dt = $rw[0];
                            $rt = explode("//", $dt['lecturers']);
                             foreach ($rt as $f){
                            if($f != "" && !in_array($f, $lecs)){
                                array_push($narr, $f);
                            }
                        }
                        $don = implode("//", $narr);
                        $dd = $db->query('update courses set lecturers = "'.$don.'" where id = "'.$cid.'" ');
                          if($dd){
                              echo "Lecturer(s) successfully withdrawn from taking ".$dt['code'];
                             
                          }
                    }
                    
                        }
                }else{
                  echo "Oops! Some Fields are required! Did you select the course and the lecturer to be acted upon?";
                }
//                    if(isset($_SESSION['resp_error'], $_SESSION['resp_allo'])){
//                        header('location: ../');
//                    }
                }elseif(isset($_POST['stat'], $_POST['uid'])){
                    if(!empty($_POST['stat'] && $_POST['uid'])){
                    

            $rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $dat1 = $rows1[0];
            //eligible
            ?>
<div class="col-lg-12" style="padding: 0px;">
    <div class="col-sm-6" style="padding: 0px;">
        <div class="half-size-column fl" style="width: 100%;">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">Allocate Courses and Manage Staffs</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" >
                                                    <div id="allocate-mes"></div>
                                                    <form id="allocate" action="hod/" method="post" enctype="multipart-formdata">
							
								<fieldset>
							
									
									<p>
										<label for="allocated_course">Select Course</label>
                                                                                <select name="to_allocate" id="to_allocate" class="round full-width-input">
                                                                                    <option value="" onclick="">--Select Course---</option>
                                                                                   <?php 
                                                                                   $c = $db->query('select * from courses where department = "'.$dat1['department'].'"');
                                                                                   $rw = $c->fetchAll(PDO::FETCH_ASSOC);
                                                                                   
                                                                                   foreach ($rw as $cc){
                                                                                       $rt = explode("//", $cc['lecturers']);
                                                                                       
                                                                                       $lecs = "";
                                                                                       foreach ($rt as $gt){
                                                                                           if($gt != ""){
                                                                                   $l = $db->query('select * from users where uniqid = "'.$gt.'"');
                                                                                   $ll = $l->fetchAll(PDO::FETCH_ASSOC);
                                                                                   $lec = $ll[0];
                                                                                   $j = $lec['firstname']." ".$lec['lastname'];
                                                                                  if($lecs == ""){
                                                                                     $lecs = $j; 
                                                                                  }else{
                                                                                   $lecs = $lecs." & ".$j ;   
                                                                                  }
                                                                                           }
                                                                                       }
                                                                                       
                                                                                   ?>
                                                                                    <option value="<?php echo $cc['id']; ?>"><?php echo $cc['code']." || ".$cc['title']." || ".$cc['units']." units || ".$lecs; ?></option>
                                                                                   <?php } ?>
                                                                                </select>
										<em>Who is in charge?</em>								
									</p>
                                                                        <p>
                                                                            <label for="allocated_course">Select the lecturer(s) to be acted upon</label>
                                                                           </p>
                                                                        <table>
						
							<thead>
						
								<tr>
                                                                    <th><input type="checkbox" /></th>
									<th>Name</th>
									<th>First Semester</th>
									<th>Second Semester</th>
									<th>Settings</th>
								</tr>
							
							</thead>
	
							
							
							<tbody>
                                                            
                                                             <?php 
                                                                             $ls = $db->query('select * from users where department = "'.$dat1['department'].'" and status = "staff" ');
                                                                                   $lls = $ls->fetchAll(PDO::FETCH_ASSOC) ;
                                                                                   foreach ($lls as $lk){
                                                                                    $bt = $db->query('select * from courses where department = "'.$dat1['department'].'" and lecturers like "%'.$lk['uniqid'].'%" ');
                                                                                   $bts = $bt->fetchAll(PDO::FETCH_ASSOC) ;
                                                                                   $crs = [];
                                                                                   $crz = [];
                                                                                   foreach ($bts as $bb){
                                                                                       if($bb['semester'] == "1"){
                                                                                       array_push($crs, $bb['code']);
                                                                                       }else{
                                                                                         array_push($crz, $bb['code']);  
                                                                                       }
                                                                                   }
                                                                                   $cks = implode(" || ", $crs);
                                                                                   $ckz = implode(" || ", $crz);
                                                                                                    
                                                                            ?>
                                                            <tr>
                                                                <td><input id="allocate_array" value="<?php echo $lk['uniqid']; ?>" type="checkbox" name="alocate[]" /></td>
                                                                        <td><?php echo $lk['firstname']." ".$lk['middlename']." ".$lk['lastname']; ?></td>
									<td><?php echo $cks; ?></td>
									<td><?php echo $ckz; ?></td>
									<td>
										 <div class="dropdown">
 <a href="#" class="glyphicon glyphicon-wrench btn btn-default dropdown-toggle" data-toggle="dropdown"></a>
  <ul class="dropdown-menu">
    <li><a href="#">EXTRACT STAFF ID</a></li>
 </ul>
</div> 
									</td>
								</tr>  
                                                                                   
                                                                            <?php } ?>
	
							</tbody>
							
						</table>
                                                                           <input name="action" id="allocate_action" value="" type="hidden" />
                                                      </fieldset>
							
							</form>
							
                                                    <div class="col-lg-12" style="padding: 0px;">                
                                                                          <div id="put-allocate_bt_N" class="col-sm-6" style="margin-top: 7%; padding: 0px;">
                                                                              <a href="#"  onclick="allocate('N')" class="button round btn-danger image-left ic-left-arrow" style="float: left;">WITHDRAW</a>
                                </div>
                                                        
                                                        <div id="put-allocate_bt_Y" class="col-sm-6" style="margin-top: 7%; padding: 0px;">
                                                            <a href="#"  onclick="allocate('Y')" class="button round blue image-right ic-right-arrow" style="float: right;">ALLOCATE</a>
                                </div>
                                     
                                                    </div>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
    <div class="col-sm-6" style="padding: 0px;">
        <div class="half-size-column fl" style="width: 100%; min-height: 271px;">
	
					<div class="content-module" >
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE STUDENTS</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main"  >
                                                    <div style="width: 100%;">
                                                    <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_student()" type="text" id="search-student"  class="round button dark ic-search image-right" style="width: 100%; color: #fff !important; font-size: 120%;" placeholder="Enter Student's Matric Number"  />
					
				</fieldset>
                                    </form> </div>
                                                    <div id="put-student" style="width: 100%; margin-top: 4%;">
                                                        
                                                    </div>	
					
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
    
</div>            



                <?php 
                }else{
             header("location: ../");     
            }
        }
                
                                                                                         }else{
          echo "You are not an HOD!!!!"  ;
        }
               }
            
            
            
            
        }else{
          header("location: ../");    
        }