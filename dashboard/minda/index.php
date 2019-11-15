<?php
//dash-ict
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and (status = "'.'super admin'.'")');
   if($stmt->rowCount() == 1){
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
       ?>


      
                                                <div class="content-module col-lg-12" >
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE PAYMENT TYPES</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" >
                                                    <div id="-mes"></div>
                                                    <table>
						
							<thead>
						
								<tr>
                                                                        <th style="width:10%;">Name</th>
									<th style="width:22%;">Amount</th>
									<th style="width:5%;">duration</th>
									<th style="width:8%;">Programme</th>
                                                                        <th style="width:8%;">Faculty</th>
                                                                        <th style="width:8%;">Department</th>
                                                                        <th style="width:14%;">level</th>
                                                                        <th style="width:5%;">bank</th>
                                                                        <th style="width:5%;">Account Name</th>
                                                                        <th style="width:5%;">Account Number</th>
                                                                        <th style="width:10%;">Actions</th>
								</tr>
							
							</thead>
	
							
							
							<tbody>
                                                         <?php
                                                         $ft = $db->query('select * from payments where dell = ""');
                                                         $rows = $ft->fetchAll(PDO::FETCH_ASSOC);
                                                         foreach($rows as $py){
                                                          
                                                         
                                                         ?>
                                                            <tr>
                                                                <td style="width:10%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="name<?php echo $py['id']; ?>" value="<?php echo $py['name']; ?>" /></td>
                                                                <td style="width:22%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="amou<?php echo $py['id']; ?>" value="<?php echo $py['amount']; ?>" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="dura<?php echo $py['id']; ?>" value="<?php echo $py['duration']; ?>" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="prog<?php echo $py['id']; ?>" value="<?php echo $py['programme'] ?>" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="facu<?php echo $py['id']; ?>" value="<?php echo $py['faculty'] ?>" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="dept<?php echo $py['id']; ?>" value="<?php echo $py['department'] ?>" /></td>
                                                                <td style="width:14%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="leve<?php echo $py['id']; ?>" value="<?php echo $py['level'] ?>" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="bank<?php echo $py['id']; ?>" value="<?php echo $py['bank'] ?>" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="acna<?php echo $py['id']; ?>" value="<?php echo $py['accl_name'] ?>" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 0px solid #eee; background: rgba(0,0,0,0);" readonly id="acnu<?php echo $py['id']; ?>" value="<?php echo $py['accl_number'] ?>" /></td>
                                                                <td style="width:10%;">
                                                                    <b onclick="bus_pmt('<?php echo $py['id']; ?>', 'edit')" class="btn btn-default" id="edit<?php echo $py['id']; ?>"><i class="glyphicon glyphicon-pencil"></i></b>
                                                                    <b onclick="bus_pmt('<?php echo $py['id']; ?>', 'trash')" class="btn btn-default" id="trash<?php echo $py['id']; ?>"><i class="glyphicon glyphicon-trash"></i></b>
                                                                </td>
                                                            </tr>
                                                            
                                                         <?php
                                                         }
                                                         ?>
                                                            <tr>
                                                                <td colspan="11" style="width: 100%;">
                                                        <center>  <h3>ADD A NEW PAYMENT TYPE</h3>  </center>
                                                                </td>
                                                            </tr>
	<tr>
                                                                <td style="width:10%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="name-add" /></td>
                                                                <td style="width:22%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="amou-add" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="dura-add" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="prog-add" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="facu-add" /></td>
                                                                <td style="width:8%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="dept-add" /></td>
                                                                <td style="width:14%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="leve-add" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="bank-add" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="acna-add" /></td>
                                                                <td style="width:5%;"><input style="width:100%; border: 2px solid #eee; background: rgba(0,0,0,0);" id="acnu-add" /></td>
                                                                <td style="width:10%;">
                                                                    <b id="bus-add" onclick="bus_pmt('', 'add')" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> Add</b>
                                                                
                                                                </td>
                                                            </tr>
							</tbody>
							
						</table>
                                                    
                                                    
                                                    
                                                    				</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				 
   
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
    <div class="col-lg-6" style="padding: 0px;">
        <div class="half-size-column fr" style="width: 100%;">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE TRANSACTIONS</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" style="min-height: 400px; overflow: auto;" >
                                                    
                                                        <div style="width: 100%;">
                                                    <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="find_tranz()" type="text" id="search-tranz"  class="round button dark ic-search image-right" style="width: 100%; color: #fff !important; font-size: 120%;" placeholder="Enter Payment Transaction ID"  />
					
				</fieldset>
                                    </form> </div>
                                                    <div id="put-tranz" style="width: 100%; margin-top: 4%;">
                                                        
                                                    </div>		</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
    <div class="col-lg-6" style="padding: 0px;">
        <div class="half-size-column fr" style="width: 100%;">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE STUDENTS PAYMENT PROFILE</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main" style="min-height: 400px; overflow: auto;">
                                                   
                                                        <div style="width: 100%;">
                                                    <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="bus_student()" type="text" id="bus-student"  class="round button dark ic-search image-right" style="width: 100%; color: #fff !important; font-size: 120%;" placeholder="Enter Student Matric Number"  />
					
				</fieldset>
                                    </form> </div>
                                                    <div id="put-bus-student" style="width: 100%; margin-top: 4%;">
                                                        
                                                    </div>
                                                    
                                                    
                                                    				</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>
                                   
     <div class="col-lg-6" style="padding: 0px;">
        <div class="half-size-column fl" style="width: 100%; min-height: 271px;">
	
					<div class="content-module" >
					
						<div class="content-module-heading cf">
						
                                                    <h3 class="fl" style="font-size: 100%;">MANAGE STUDENTS/STAFF BIODATA</h3>
							
						</div> <!-- end content-module-heading -->
                                                <div class="content-module-main"  >
                                                    <div style="width: 100%;">
                                                    <form style="width: 100%;">
				<fieldset>
                                    <input onkeyup="ict_biodata()" type="text" id="edit_biodata"  class="round button dark ic-search image-right" style="width: 100%; color: #fff !important; font-size: 120%;" placeholder="Enter Student/Staff ID"  />
					
				</fieldset>
                                    </form> </div>
                                                    <div id="put-edit_biodata" style="width: 100%; margin-top: 4%;">
                                                        
                                                    </div>	
					
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
	
				</div>  
    </div>  
     
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
 <?php  }
}
