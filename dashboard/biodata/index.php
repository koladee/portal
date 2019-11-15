<?php
//biodata
include '../../configs.php';

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}

if(isset($_SESSION['uniqid'], $_SESSION['status'])){
    if(isset($_POST['id'] , $_POST['stat'])){
        //fetch form
        $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "'.$_SESSION['status'].'"');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
        ?>
<div class="col-lg-12" style="width: 100%; padding: 0px;">
    <div class="col-sm-12" style="padding: 0px;">
        
       <form action="#" method="POST" id="login-form" style="padding-top: 20px; padding-bottom: 20px; width: 100%;">
           <h3 style="font-size: 120%;">BASIC INFORMATION</h3>
       <hr>
                <div class="information-box round">Upload a clear scanned copy of your passport and fill the form as required.</div>
                <div id="put-mess"></div>
                    
                <fieldset style="margin: 0px;">
                    <div class="col-lg-12" style="margin-bottom: 30px;">
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="firstname">Firstname</label>
                                        <input type="text" id="firstname" name="firstname" class="round full-width-input" />
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="middlename">Middlename</label>
                                        <input type="text" id="middlename" name="middlename" class="round full-width-input"/>
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="lastname">Lastname</label>
                                        <input type="text" id="lastname" name="lastname" class="round full-width-input"/>
				</p>
    </div>
    <div class="col-sm-8" style="padding: 0px;">
        <p>
        <label>Gender</label>
        <table style="width: 100%; border: 0px solid #eee;" class="table">
                                                   
            <tr style="background: none;">
                                                        <td style="width: 50%; border: 0px solid #eee;">
                                                    <center>
                                                        <div onclick="sex('male')"  style="width: 100%;">
                                                            <img id="male" class="card" src="../male.png" style="width: 100px; height: 100px;"> <br>
                                                            
                                                            <span style="font-size: 100%; color: rgba(0, 5, 47, 0.8); font-weight: bold;">Male</span>
                                                            </div>
                                                            </center>
                                                        </td>
                                                        <td style="width: 50%; border: 0px solid #eee;">
                                                    <center>
                                                        <div onclick="sex('female')"  style="width: 100%;">
                                                            <img id="female" class="card" src="../female.png" style="width: 100px; height: 100px;"> <br>
                                                           <span style="font-size: 100%; color: rgba(0, 5, 47, 0.8); font-weight: bold;">Female</span>
                                                            </div>
                                                    </center>
                                                        </td>
                                                        
                                                    </tr>
                                                </table>
    </p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
        <p>
            <label>Passport</label>
           <center>
                                     <img id="blah1"   src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" alt="DP" style="cursor: pointer; width: 150px; height: 150px; border-radius: 5px;" >
                                     <br><br>
                                                <span class="fileContainer" style="cursor: pointer;  margin-top: 25px;">
                                                    
                                                        <span style="width: 100%;">
                                                            <center> 
                                                                <span class="glyphicon glyphicon-camera" style="cursor: pointer;font-size: 150%; font-weight: bolder; color: rgba(0, 5, 47, 0.8);" ></span>
                                                            </center>
                                                        </span>
                                                        <input onchange="load()" id="upload1" type='file' name="filez">
                                                   
                                                </span>  

                                            </center>  
        </p>
    </div>
     <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="year">Year of Birth</label>
                                        <select id="year" name="year" class="round full-width-input">
                                        <option value=''>--Select Year--</option>
                                        <?php
                                        $present = date("Y", time());
                                        $end = $present - 13;
                                        $start = $present - 60;
                                        for($y = $start; $y < $end; $y++){ ?>
                                          <option value="<?php echo $y; ?>"><?php echo $y; ?></option>  
                                      <?php  }
                                        
                                        ?>
                                        
                                        
                                        </select>
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="month">Month of Birth</label>
                                        <select id="month" name="month" class="round full-width-input">
                                            <option value=''>--Select Month--</option>
                                            <option value='01'>January</option>
                                            <option value='02'>February</option>
                                            <option value='03'>March</option>
                                            <option value='04'>April</option>
                                            <option value='05'>May</option>
                                            <option value='06'>June</option>
                                            <option value='07'>July</option>
                                            <option value='08'>August</option>
                                            <option value='09'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                        </select>
                                        
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="day">Day of Birth</label>
                                        <select id="day" name="day" class="round full-width-input">
                                        <option value=''>--Select Day--</option>
                                        <?php
                                        for($i=1; $i<31; $i++){
                                          ?>
                                        <option value="<?php echo $i; ?>"><?php $ln = strlen($i); if($ln == 1){echo "0".$i;}else{ echo $i;} ?></option>   
                                        <?php  
                                        }
                                        ?>
                                        </select>
                                        
				</p>
    </div>
     <div class="col-sm-3" style="padding: 0px;">
				<p>
					<label for="country">Nationality</label>
                                        <input type="text" id="country" name="country" class="round full-width-input" />
				</p>
    </div>
    <div class="col-sm-3" style="padding: 0px;">
				<p>
					<label for="state">State of Origin</label>
                                        <input type="text" id="state" name="state" class="round full-width-input"/>
				</p>
    </div>
    <div class="col-sm-3" style="padding: 0px;">
				<p>
					<label for="lga">Local Government</label>
                                        <input type="text" id="lga" name="lga" class="round full-width-input"/>
				</p>
    </div>
    <div class="col-sm-3" style="padding: 0px;">
				<p>
					<label for="religion">Religion</label>
                                        <select id="religion" name="religion" class="round full-width-input">
                                            <option value="">--Select Religion</option>
                                            <option value="christianity">Christianity</option>
                                            <option value="islamic">Islamic</option>
                                            <option value="traditional">Traditional</option>
                                        </select>
				</p>
    </div>
       <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="marital_status">Marital Status</label>
                                        <input type="text" id="marital_status" name="marital_status" class="round full-width-input" />
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="email">Email</label>
                                        <input type="email" id="email" name="email" class="round full-width-input"/>
				</p>
    </div>
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="mobile">Mobile</label>
                                        <input type="text" id="mobile" name="mobile" class="round full-width-input"/>
				</p>
    </div>
    
    <div class="col-sm-5" style="padding: 0px;">
				<p>
					<label for="mailing_address">Mailing Address</label>
                                        <input type="text" id="mailing_address" name="mailing_address" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-5" style="padding: 0px;">
				<p>
					<label for="address">Residential Address</label>
                                        <input type="text" id="address" name="address" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-2" style="padding: 0px;">
				<p>
					<label for="residential_state">Residential State</label>
                                        <input type="text" id="residential_state" name="residential_state" class="round full-width-input" />
				</p>
				
    </div> 
   <?php if($_SESSION['status'] == "student"){ ?>                     
    <div class="col-sm-8" style="padding: 0px;">
				<p>
					<label for="course">Course of Study</label>
                                        <input type="text" id="course" name="course" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="confirmation">Confirmation Number</label>
                                        <input type="text" id="confirmation" name="confirmation" class="round full-width-input" />
				</p>
				
    </div>   
   <?php } ?>                     			
                                 </div>
                  <?php if($_SESSION['status'] == "student"){ ?>                      
              <h3 style="font-size: 120%;">EDUCATIONAL BACKGROUND INFORMATION</h3>
       <hr>      
       <div class="col-lg-12" style="margin-bottom: 30px; padding: 0px;">
           <div class="col-sm-12" style="padding: 0px;">
               <p>
                   <label style="font-size: 120%; color: #4682b4;">First Sitting</label>
                   <br>
               </p>
           </div>
             <div class="col-sm-8" style="padding: 0px;">
				<p>
					<label for="institution1">Name of Institution</label>
                                        <input type="text" id="institution1" name="institution1" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="qualification1">Qualification Obtained</label>
                                        <select id="qualification1" name="qualification1" class="round full-width-input">
                                            <option value="">--Select Qualification</option>
                                            <option value="S.S.C.E (WASSCE)">S.S.C.E (WASSCE)</option>
                                            <option value="S.S.C.E (NECO)">S.S.C.E (WASSCE)</option>
                                            <option value="G.C.E (WASSCE)">G.C.E (WASSCE)</option>
                                            <option value="G.C.E (NECO)">G.C.E (NECO)</option>
                                            <option value="NABTEB">NABTEB</option>
                                            <option value="D.E (POLYTECHNIC)">D.E (POLYTECHNIC)</option>
                                        </select>
				</p>
				
    </div>
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="start1">Year Started</label>
                                        <input type="text" id="start1" name="start1" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="ended1">Year Ended</label>
                                        <input type="text" id="ended1" name="ended1" class="round full-width-input" />
				</p>
				
    </div>    
    <div class="col-sm-12" style="padding: 0px;">
				<p>
					<label for="result1">Results/Grades</label>
                                        <input type="text" id="result1" name="result1" class="round full-width-input" />
				</p>
				
    </div>    
        
           <br><br>
           
           <div class="col-sm-12" style="padding: 0px;">
               <p>
                   <label style="font-size: 120%; color: #4682b4;">Second Sitting</label>
                   <br>
               </p>
           </div>
             <div class="col-sm-8" style="padding: 0px;">
				<p>
					<label for="institution2">Name of Institution</label>
                                        <input type="text" id="institution2" name="institution2" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="qualification2">Qualification Obtained</label>
                                        <select id="qualification2" name="qualification2" class="round full-width-input">
                                            <option value="">--Select Qualification</option>
                                            <option value="S.S.C.E (WASSCE)">S.S.C.E (WASSCE)</option>
                                            <option value="S.S.C.E (NECO)">S.S.C.E (WASSCE)</option>
                                            <option value="G.C.E (WASSCE)">G.C.E (WASSCE)</option>
                                            <option value="G.C.E (NECO)">G.C.E (NECO)</option>
                                            <option value="NABTEB">NABTEB</option>
                                            <option value="D.E (POLYTECHNIC)">D.E (POLYTECHNIC)</option>
                                        </select>
				</p>
				
    </div>
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="start2">Year Started</label>
                                        <input type="text" id="start2" name="start2" class="round full-width-input" />
				</p>
				
    </div>   
    <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="ended2">Year Ended</label>
                                        <input type="text" id="ended2" name="ended2" class="round full-width-input" />
				</p>
				
    </div>    
    <div class="col-sm-12" style="padding: 0px;">
				<p>
					<label for="result2">Results/Grades</label>
                                        <input type="text" id="result2" name="result2" class="round full-width-input" />
				</p>
				
    </div>    
       </div>
       
           <h3 style="font-size: 120%;">PARENT/GUARDIAN/NEXT OF KIN INFORMATION</h3>
       <hr>
       
       <div class="col-lg-12" style="margin-bottom: 30px; padding: 0px;">
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="parent_name">NAME</label>
                                        <input type="text" id="parent_name" name="parent_name" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="parent_address">ADDRESS</label>
                                        <input type="text" id="parent_address" name="parent_address" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="parent_mobile">MOBILE</label>
                                        <input type="text" id="parent_mobile" name="parent_mobile" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="parent_email">EMAIL</label>
                                        <input type="email" id="parent_email" name="parent_email" class="round full-width-input" />
				</p>
				
    </div>   
       </div>
       
           <h3 style="font-size: 120%;">EMERGENCY CONTACT INFORMATION</h3>
       <hr>
       
       <div class="col-lg-12" style="margin-bottom: 30px; padding: 0px;">
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="emergency_name">NAME</label>
                                        <input type="text" id="emergency_name" name="emergency_name" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="emergency_address">ADDRESS</label>
                                        <input type="text" id="emergency_address" name="emergency_address" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="emergency_mobile">MOBILE</label>
                                        <input type="text" id="emergency_mobile" name="emergency_mobile" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="emergency_email">EMAIL</label>
                                        <input type="email" id="emergency_email" name="emergency_email" class="round full-width-input" />
				</p>
				
    </div>   
       </div>
       
       
       <h3 style="font-size: 120%;">REFEREES INFORMATION</h3>
       <hr>
       
       <div class="col-lg-12" style="margin-bottom: 30px; padding: 0px;">
          <div class="col-sm-12" style="padding: 0px;">
              <p>
                  <label style="font-size: 120%; color: #4682b4;">FIRST REFEREE</label>
              </p>
          </div>
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="referee1_name">NAME</label>
                                        <input type="text" id="referee1_name" name="referee1_name" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="referee1_address">ADDRESS</label>
                                        <input type="text" id="referee1_address" name="referee1_address" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee1_occpation">OCCUPATION</label>
                                        <input type="text" id="referee1_occupation" name="referee1_occupation" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee1_mobile">MOBILE</label>
                                        <input type="text" id="referee1_mobile" name="referee1_mobile" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee1_email">EMAIL</label>
                                        <input type="email" id="referee1_email" name="referee1_email" class="round full-width-input" />
				</p>
				
    </div>   
       </div>
       
        
       <div class="col-lg-12" style="padding: 0px;" >
           <div class="col-sm-12" style="padding: 0px;">
              <p>
                  <label style="font-size: 120%; color: #4682b4;">SECOND REFEREE</label>
              </p>
          </div>
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="referee2_name">NAME</label>
                                        <input type="text" id="referee2_name" name="referee2_name" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-6" style="padding: 0px;">
				<p>
					<label for="referee2_address">ADDRESS</label>
                                        <input type="text" id="referee2_address" name="referee2_address" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee2_occupation">OCCUPATION</label>
                                        <input type="text" id="referee2_occupation" name="referee2_occupation" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee2_mobile">MOBILE</label>
                                        <input type="text" id="referee2_mobile" name="referee2_mobile" class="round full-width-input" />
				</p>
				
    </div>   
          <div class="col-sm-4" style="padding: 0px;">
				<p>
					<label for="referee2_email">EMAIL</label>
                                        <input type="email" id="referee2_email" name="referee2_email" class="round full-width-input" />
				</p>
				
    </div>   
       </div>
       
    <?php } ?>
       
       <div class="col-lg-12" style="padding: 0px;">
           
           <div class="col-sm-12" style="padding: 0px; margin-top: 30px;">
               <center>                
               <div id="put-sub_bio">
                                <a href="#"  onclick="" class="button round blue image-right ic-right-arrow">SUBMIT FORM</a>
                                </div>
               </center>
                                </div>
       </div>
			</fieldset>

			

		</form>
       
           
      
    </div>
    
    
    </div>
    <?php }else{
     $_SESSION['error'] = "Unauthurised User, Keep Off!!!";
     header('location: ../../');
    }
    
    
}else{
    header('location: ../../');
}


