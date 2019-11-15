<?php
//dash-exam&rec
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "'.'exams and records'.'"');
   if($stmt->rowCount() == 1){
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
       ?>
       <div class="col-lg-6" style="padding: 0px;">
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

  <?php }
}