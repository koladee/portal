<?php
include '../../configs.php';
if(isset($_SESSION['uniqid'], $_SESSION['status'])){
if(isset($_POST['dt'])){
    if(!empty($_POST['dt'])){
                   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and uniqid = "'.$_POST['dt'].'" and status = "'.$_SESSION['status'].'"');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
    ?>
        
        <div class="col-lg-12">
                 
                 <div class="col-sm-12">
                   <div id="my_idcard" style="width: 100%; padding: 10px; height: 329px;">
                      <table class="table" style="width: 100%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                             <tr style="background: rgba(0,0,0,0);">
                                 <td colspan="2" style=" border: 0px solid #eee; width: 100%;">
                                     <div style="display: inline;"><img src="../images/logo.png" style="width: 60px; float: left;"  /></div>
                                     <div style="display: inline;">
                                         <center>
                                         <span style="font-weight: bold; font-size: 280%;">EKITI STATE UNIVERSITY</span> <br>
                                         <span style="font-weight: bold; font-size: 120%;">P.M.B 5363, ADO-EKITI, EKITI STATE, NIGERIA</span><br>
                                         <span style="font-weight: bold; font-size: 100%;">www.eksu.edu.ng</span><br>
                                         </center>
                             </div>
                                 </td>  
                                   
                             </tr>
                             <tr style="background: rgba(0,0,0,0);">
                                 <td weight="1" style="width: 40%; border: 0px solid #eee; background: red;">
                                     <div style="width: 100%;  color: yellow; font-weight: bold; text-transform: uppercase; font-size: 120%;">
                                         <span style="float: left;"><?php echo $_SESSION['status']; ?></span>
                                     </div>
                                 </td>  
                                 
                                 <td weight="2" style="width: 60%; border: 0px solid #eee; background: red;">
                                     <div style="width: 100%; color: yellow; font-weight: bold; font-size: 120%;">
                                   <?php if($_SESSION['status'] == "student"){
     echo 'MATRIC NO: '.$dat['uid'];
                                   }else{
                                       echo 'STAFF ID: '.$dat['uid'];
                                   }  ?>  
                                     </div>
                                 </td>  
                             </tr>
                             <tr style="background: rgba(0,0,0,0);">
                                 <td valign="top" style="width: 70%; border: 0px solid #eee; font-size: 120%; //background-image: url('../images/logo.png');  background-repeat: no-repeat; background-size: 150px 100%;; background-position: center center; ">
                                     <table>
                                       <tr style="background: rgba(0,0,0,0);">
                                           <td style="width: 20%; border: 0px solid #eee;">
                                               <span style="float: left; text-align: left; font-weight: bolder; font-size: 150%;">Name:</span>   
                                           </td>
                                           <td style="width: 80%; border: 0px solid #eee; padding-left: 20px;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;"><?php echo $dat['firstname']." ".$dat['middlename']." ".$dat['lastname']; ?></span>   
                                           </td>
                                       </tr>
                                       <tr style="background: rgba(0,0,0,0);">
                                           <td style="width: 20%; border: 0px solid #eee;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;">Department:</span>   
                                           </td>
                                           <td style="width: 80%; border: 0px solid #eee; padding-left: 20px;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;"><?php echo $dat['department']; ?></span>   
                                           </td>
                                       </tr>
                                       <tr style="background: rgba(0,0,0,0);">
                                           <td style="width: 20%; border: 0px solid #eee;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;">Faculty:</span>   
                                           </td>
                                           <td style="width: 80%; border: 0px solid #eee; padding-left: 20px;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;"><?php echo $dat['faculty']; ?></span>   
                                           </td>
                                       </tr>
                                       <?php if($_SESSION['status'] == "student"){ ?>
                                        <tr style="background: rgba(0,0,0,0);">
                                           <td style="width: 20%; border: 0px solid #eee;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;">Level:</span>   
                                           </td>
                                           <td style="width: 80%; border: 0px solid #eee; padding-left: 20px;">
                                               <span style="float: left; text-align: left; font-weight: bold; font-size: 150%;"><?php echo $dat['level']; ?></span>   
                                           </td>
                                       </tr >
    <?php } ?>
                                      
                                      
                             </table>  
                                 </td>
                                 <td valign="top" style="width: 30%; border: 0px solid #eee;">
                                     <center>
                                    <img id="passp" src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }else{ echo "../".$dat['photo']; } ?>" style="width: 100%; border-radius: 5px;" />
                                    <br>
                             
                                    <span style="float: left; text-align: left; font-weight: bold; font-size: 150%; margin-top: 5%;">
                                                   <img id="signature" src="../<?php echo $dat['signature']; ?>" style="height: 20px; border-radius: 0px;" alt="Signnature" /><br>
                                         
                                    </span></center>
                                 </td>
                                 
                               
                             </tr>
                         </table> 
                     
                     </div>
                     <br>
                     <br>
                     <div class="col-lg-12">
                         <div class="col-sm-6">
                             <span class="fileContainer" style="cursor: pointer;  margin-top: 25px; float: left;">
                                                    
                                                        <span style="width: 100%;">
                                                            <center> 
                                                                <center id="put-change_sign"> <a href="#"  onclick="" class="button round blue">UPLOAD SIGNATURE</a></center>    
                                                            </center>
                                                        </span>
                                 <input onchange="signature()" id="upload2" type='file' name="file">
                                                    
                                                </span> 
                            
                         </div>
                         <div class="col-sm-6">
                             <span class="fileContainer" style="cursor: pointer;  margin-top: 25px; float: right !important;">
                                                    
                                                        <span style="width: 100%;">
                                                            <center> 
                                                                <center id="put-change_passport"> <a href="#"  onclick="" class="button round blue">UPLOAD PASSPORT</a></center>     
                                                            </center>
                                                        </span>
                                 <input onchange="passp()" id="upload3" type='file' name="file">
                                                    
                                                </span>
                             
                            
                         </div>
                     </div>
                     <br>
                     <br>
                     <div id="my_idcard_back" style="width: 100%; padding: 10px; height: 329px;">
                         <table class="table" style="width: 100%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                             <tr style="background: rgba(0,0,0,0);">
                                 <td colspan="2" style="width: 100%; border: 0px solid #eee; text-align: left; font-weight: bold; font-size: 100%;">
                                     <span>
                                         This is to certify that the bearer whose name, signature & photograph appear overleaf is a <?php echo $dat['status']; ?> of
                                     </span><br>
                                     <div style="background: #000; font-size: 200%; text-align: center; font-weight: bold; color: #fff;">
                                        EKITI STATE UNIVERSITY, ADO EKITI 
                                     </div><br>
                                     <span>
                                         P.M.B 5363, Ado-Ekiti<br>
                                         Website: www.eksu.edu.ng
                                     </span>
                                     <br><br>
                                     <span>No person(s) unless authorized by the above institutional authority may hold or possess the card.</span>
                                     <br><br>
                                     <span>If found, please return to the Office of the Registrar, EKITI STATE UNIVERSITY or the nearest police station</span>
                                     
                                 </td>  
                             </tr>
                             <tr style="background: rgba(0,0,0,0); font-weight: bold; font-size: 100%;">
                                 <td style="width: 50%; border: 0px solid #eee;">
                                     <div style="background: #000; padding: 5px; color: #fff; width: 100%;">
                                         <span><?php echo "Expiry: ".(date("Y", time())+1); ?></span> 
                                     </div>
                                     
                                     <img src="../images/backcode.png" style="width: 100%;" alt="Backcode" />
                                 </td>
                                 <td style="width: 50%; border: 0px solid #eee;">
                                     <div style="width: 100%;">
                                         <img src="../images/registrar.png" style="height: 25px;" alt="Signature" /><br>
                                         <span>---------------------------------------------------------</span><br>
                                         <span>Registrar's Signature</span>
                                     </div> 
                                 </td>
                             </tr>
                         </table> 
                     </div>
                     <br><br>
                     <center id="put-idcard"> <a href="#"  onclick="capture()" class="button round blue image-right ic-right-arrow">SUBMIT ID CARD REQUEST</a></center>    
                     <BR><br>
                 </div>
              </div>
        
     <?php   }
    }
}


