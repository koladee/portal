<?php
//dash-vc||registrar
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and (status = "'.'vc'.'" || status = "'.'registrar'.'")');
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
       <div class="col-lg-6" style="padding: 0px;">
        <div class="half-size-column fl" style="width: 100%;">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE REVENUE</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" >
                                                    
                                                    <center><h3>SUMMARY OF PRESENT SESSION'S REVENUE</h3></center>
                                                    <div class="btn btn-block btn-default" style="margin-bottom: 20px; font-size: 100%;">
                                                    <b style='color:red; margin-right: 30px;'>PAYMENT NAME</b><b style='color:blue; margin-right: 30px;'>PROGRAMME</b><b style='color:green; margin-right: 30px;'>FACULTY</b><span style='margin-right: 30px;'>TOTAL AMOUNT</span>
                                                    </div>
                                                    <div style="height: 250px; overflow: auto;">
                                                        <?php
                                                    $op = $db->query('select * from payments order by name asc');
                                                    $lp = $op->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($lp as $rt){
                                                        $gh = $db->query('select sum(amount) from transactions where purpose = "'.$rt['id'].'" and present_session = "'.$row['present_session'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
                                                       ?>
                                                    <div class="btn btn-block btn-default" style="margin-bottom: 20px; font-size: 80%;">
                                                        <span style="float: left; text-transform: uppercase;"><?php echo "<b style='color:red;'>".$rt['name']."</b> <b style='color:blue;'>".$rt['programme']."</b> <b style='color:green;'>".$rt['faculty']."</b>" ?> </span>
                                                        <span style=""> <?php echo "#".$gh['sum(amount)']; if($gh['sum(amount)'] == NULL){echo 0;} ?></span>
                                                    </div>   
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    				</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
    <div class="col-lg-6" style="padding: 0px;">
        <div class="half-size-column fr" style="width: 100%;">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">QUERY REVENUE</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" style="min-height: 400px; overflow: auto;" >
                                                  
                                                    <div id="rev-mes"></div>
                                                    <form>
                                                        <fieldset>
                                                            <p>
                                                                <label>{PAYMENT NAME} [PROGRAMME] (FACULTY)</label>
                                                                <select id="qu-p-type" class="full-width-input" style="text-transform: uppercase;">
                                                                    <option value="">---Select Payment Type---</option>
                                                                    <option value="all"><?php echo "<b style='color:red;'>{".'all'."}</b> <b style='color:blue;'>[".'all'."]</b> <b style='color:green;'>(".'all'.")</b>" ?></option>
                                                                    <?php
                                                                    foreach($lp as $rt){
                                                                    ?>
                                                                    <option value="<?php echo $rt['id']; ?>"><?php echo "<b style='color:red;'>{".$rt['name']."}</b> <b style='color:blue;'>[".$rt['programme']."]</b> <b style='color:green;'>(".$rt['faculty'].")</b>" ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </p>
                                                            
                                                            <p class="col-lg-6" style="padding-left: 0px;">
                                                            
                                                                <label>FROM</label>
                                                                <input id="qu-from" type="text" class="full-width-input" placeholder="YYYY-MM-DD" >
                                                            </p>
                                                            <p class="col-lg-6">
                                                           
                                                                <label>TO</label>
                                                                <input id="qu-to" type="text" class="full-width-input" placeholder="YYYY-MM-DD" >
                                                           
                                                            </p>
                                                            <p class="col-lg-6" style="padding-left: 0px;">
                                                            
                                                                <label>SESSION</label>
                                                                <input id="qu-session" type="text" class="full-width-input" placeholder="yyyy/YYYY" >
                                                            </p>
                                                            <p class="col-lg-6">
                                                           
                                                                <label>SEMESTER</label>
                                                                <select id="qu-semester" class="full-width-input" >
                                                                    <option value="">---Select Semester---</option>
                                                                    <option value="1">First Semester</option>
                                                                    <option value="2">Second Semester</option>
                                                                    <option value="all">First & Second Semesters</option>
                                                                
                                                                
                                                                </select>
                                                           
                                                            </p>
                                                        </fieldset>
                                                    </form>
                                                    <div id="qu-cont"></div>
                                                    <center>
                                                        <div id="put-qu-bt" style="padding: 30px;">
                                                            <b onclick="revenue_query()"  class="btn btn-primary">QUERY <i class="glyphicon glyphicon-search"></i></b> 
                                                    </div>
                                                    </center>
                                                    
                                                    
                                                    
                                                    				</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
  <?php }
}
