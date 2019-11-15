<!DOCTYPE html>
<?php  
include 'configs.php';
?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>EKSU | PORTAL</title>
	  <link href="images/logo.png" rel="shortcut icon"> 
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 

        <script>
              function support(){
            $("#support").modal("show");
        }
        
        function cloz(dp){
     $("#"+dp).modal('hide');        
             
         }
         function f_pass(){
             $("#f_pass").modal("show");
         }
         function log(){
             $("#log").modal("show");
         }
         function trans(){
             $("#trans").modal("show");
         }
         function cert(){
             $("#cert").modal("show");
         }
            
            function login(){
                $("#put-log").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                var uid = $("#login-username").val();
                var pass = $("#login-password").val();
                if(uid !== "" && pass !== ""){
                    $("#put-mes").html('');
                 $('#login-form').submit();
                    //alert(uid+'\r\n'+pass);
                }else{
                    $("#put-mes").html("<div class='error-box round'>Oops! Username and Password are required!!!</div>");
                 $("#put-log").html('<a href="#" id="log-but" onclick="login()" class="button round blue image-right ic-right-arrow">LOG IN</a>');  
                }
            }
            function reset(){
                $("#put-reset").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                var uid = $("#reset-id").val();
                var mail = $("#reset-email").val();
                var mobile = $("#reset-mobile").html();
                if(uid !== "" && mail !== "" && mobile !== ""){
                    $("#reset-mes").html('');
                    alert(uid+'\r\n'+mail);
                }else{
                    $("#reset-mes").html("<div class='error-box round'>Oops! All fields are required!!!</div>");
                 $("#put-reset").html('<a href="#" onclick="reset()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }
            }
            function do_support(){
                $("#put-support").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                var uid = $("#sup_user").val();
                var mail = $("#sup_email").val();
                var mes = $("#sup_mes").val();
                if(uid !== "" && mail !== "" && mes !== ""){
                  $("#sup_user").val('');
                  $("#sup_email").val('');
                  $("#sup_mes").val('');
                    $("#support-mes").html("<div class='confirmation-box round'>Dear <span style='text-transfrom: capitallize; font-weight: bold;'>"+uid+"</span>,<br>your message was sent successfully</div>");
                   $("#put-support").html('<a href="#" onclick="do-support()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }else{
                    $("#support-mes").html("<div class='error-box round'>Oops! All fields are required!!!</div>");
                 $("#put-support").html('<a href="#" onclick="do-support()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }
            }
            function do_trans(){
                $("#put-trans").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                var uid = $("#mat").val();
                var mail = $("#trans_email").val();
                var mobile = $("#trans_mobile").val();
                var name = $("#trans_name").val();
                if(uid !== "" && mail !== "" && mobile !== "" && name !== ""){
                   $("#mat").val('');
                   $("#trans_email").val('');
                   $("#trans_mobile").val('');
                   $("#trans_name").val('');
            $("#trans-mes").html("<div class='confirmation-box round'>Dear <span style='text-transfrom: capitallize; font-weight: bold;'>"+name+"</span>,<br> your request has been submitted to the appropriate department, kindly check your mail from time to time, as we will be communicating with you via the email submitted.</div>");
                  $("#put-trans").html('<a href="#" onclick="do-trans()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }else{
                    $("#trans-mes").html("<div class='error-box round'>Oops! All fields are required!!!</div>");
                 $("#put-trans").html('<a href="#" onclick="do-trans()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }
            }
            
            function do_cert(){
                $("#put-cert").html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                var uid = $("#cert_mat").val();
                var mail = $("#cert_email").val();
                var mobile = $("#cert_mobile").val();
                var name = $("#cert_name").val();
                if(uid !== "" && mail !== "" && mobile !== "" && name !== ""){
                   $("#cert_mat").val('');
                   $("#cert_email").val('');
                   $("#cert_mobile").val('');
                   $("#cert_name").val('');
            $("#cert-mes").html("<div class='confirmation-box round'>Dear <span style='text-transfrom: capitallize; font-weight: bold;'>"+name+"</span>,<br> your request has been submitted to the appropriate department, kindly check your mail from time to time, as we will be communicating with you via the email submitted.</div>");
                  $("#put-cert").html('<a href="#" onclick="do-trans()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }else{
                    $("#cert-mes").html("<div class='error-box round'>Oops! All fields are required!!!</div>");
                 $("#put-cert").html('<a href="#" onclick="do-cert()" class="button round blue image-right ic-right-arrow">SUBMIT</a>');  
                }
            }
            
           function show_pass(a){
           if(a === "show"){
           $("#login-password").attr("type", "text");
           $("#login-eye").attr("onclick", "show_pass('hide')");
           $("#login-eye").removeClass("glyphicon-eye-open");
           $("#login-eye").addClass("glyphicon-lock");
       }else{
         $("#login-password").attr("type", "password");
         $("#login-eye").attr("onclick", "show_pass('show')");
         $("#login-eye").removeClass("glyphicon-lock");
         $("#login-eye").addClass("glyphicon-eye-open");  
       }
       
           } 
            
        </script>
</head>
<body>

	<!-- TOP BAR -->
        <div id="top-bar" style="">
		
		<div class="page-full-width">
                    <a href="#" id="company-branding" class="fl" style="margin-right: 20px;"><img src="images/logo.png" alt="EKSU" /></a>
			<!--<a href="http://eksu.edu.ng" class="round button dark ic-left-arrow image-left ">Return to EKSU website</a>-->
                        <a href="#" onclick="trans()" class="round button dark "><b>APPLY FOR TRANSCRIPT</b></a>
                        <a href="#" onclick="cert()" class="round button dark "><b>APPLY FOR CERTIFICATE</b></a>
                        <a href="exam.php" class="round button dark"><b>CBT</b></a>
                        <a href="#"  class="round button dark fr" onclick="support()"><span>Contact Us</span></a>
			<!--<a href="#" class="round button dark ic-right-arrow image-left ">Smart School</a>-->

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<!--<div id="header">-->
		
		<!--<div class="page-full-width cf">-->
	
			 <!-- login-intro -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 39px height. -->
                        
			
			
		<!--</div>  end full-width -->	

	<!--</div>  end header -->
	
	
	
	<!-- MAIN CONTENT -->
        <div id="content" class="col-lg-12" style="padding: 0px; margin: 0px; min-height: 550px;">
<!--            <div class="col-sm-4">
                <style>
                    .qr-code {
  max-width: 200px;
  margin: 10px;
}
                </style>  
                <script>
                function htmlEncode (value){
  return $('<div/>').text(value).html();
}

$(function() {
  $("#generate").click(function() {
    $(".qr-code").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + htmlEncode($("#content").val()) + "&chs=160x160&chld=L|0");
  });
});
                </script>
<div class="container-fluid">
  <div class="text-center">
    <img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive">
  </div>

  <div class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-2" for="content">Content:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="content" placeholder="Enter content">
      </div>
    </div>
    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-default" id="generate">Generate</button>
      </div>
    </div>
  </div>
</div>


            </div>-->
            <div class="col-sm-12">
                
                <form action="login/" method="POST" id="login-form" style="padding-top: 20px; padding-bottom: 20px;">
                <div class="information-box round">Freshers should use their <b>UTME registration number</b> as username and <b>mypassword</b> as password to login.<br>Endeavour to change your password at first login.</div>
                <div id="put-mes"></div>
                    
                <fieldset style="padding: 0px;">
                            <p style="padding: 0px;">
                                <center>
                <div id="login-intro" class="fl">
			
                            <h4 style="text-transform: uppercase;">Login to portal</h4>
				<h6>Enter your credentials below</h6>
			
			</div>
                </center>
                            </p>
				<p style="padding: 0px;">
					<label for="login-username">username</label>
                                        <input type="text" id="login-username" name="uid" class="round full-width-input" autofocus style="width: 100%;" />
				</p>

				<p style="padding: 0px;">
					<label for="login-password">password</label>
                                        <input type="password" id="login-password" name="pass" class="round full-width-input" style="width: 100%;" /><i id="login-eye" onclick="show_pass('show')" class="glyphicon glyphicon-eye-open" style="margin-top: 10px; width: 20%; display: inline; font-size: 150%;"></i>
				</p>
				
                                <p>I've <a href="#" onclick="f_pass()">forgotten my password</a>.</p>
				
                                <div id="put-log">
                                <a href="#"  onclick="login()" class="button round blue image-right ic-right-arrow">LOG IN</a>
                                </div>
			</fieldset>

			

		</form>
            </div>
           
            
            
          
		
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">

		<p>&copy; Copyright 2018 <a href="https://eksu.edu.ng">Ekiti State University, Ado-Ekiti</a>. All rights reserved.</p>
		<!--<p><strong>Powered</strong> by <a href="http://www.k-dev.org">K-DEVELOPERS TECHNOLOGIES</a></p>-->
	
	</div> <!-- end footer -->
<div id="log" class="modal">
        <div class="col-lg-12">
            <div class="col-sm-4" style="height: 100%;" onclick="cloz('log')"></div>
            <div class="col-sm-4 card" style="background: #c1bdba; margin-top: 15%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('log')">&times;</span>
                <center><h3 style="text-transform: uppercase; ">Login</h3></center> 
                <div class="col-lg-12">
                 
                 <div class="col-sm-12">
                     <label >Username</label>
                   <input id="user"  type="text" class="form-control" required autocomplete="off" style=" border-radius:4px; border:1px solid rgba(0, 5, 47, 0.8); ">
                </div>
                 <div class="col-sm-12">
                     <label  >Password</label>
                     <input id="password" required autocomplete="off" type="password" class="round full-width-input">
                </div>
                    <center> <span >    <input type="submit" onclick="login()" class="btn btn-default form-control card" value="SUBMIT" style=" font-weight:bold; padding: 5px; margin-top: 10px; width: 100px; height: 40px;  border: 2px solid rgba(0, 5, 47, 0.8);  border-radius: 12px;">  </span></center>   
                </div>
            </div>
            <div class="col-sm-4" style="height: 100%;"  onclick="cloz('log')"></div>
        </div>
    </div>
    <div id="f_pass" class="modal">
        <div class="col-lg-12">
            <div class="col-sm-4" style="height: 100%;" onclick="cloz('f_pass')"></div>
            <div class="col-sm-4 card" style="padding-left: 3.5%; background: #c1bdba; margin-top: 15%;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('f_pass')">&times;</span>
                <center><h4 style="text-transform: uppercase; ">RESET PASSWORD</h4>
                <div id="reset-mes"></div>
                </center> 
                <form>
                <fieldset>
                
                
                    <p>
                        <label for="reset-id">Student/Staff ID</label>
                     <input id="reset-id" type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="reset-email">Email Address</label>
                     <input id="reset-email" type="email" class="round full-width-input">
                </p>
                 <p>
                     <label for="reset-mobile">Mobile Number</label>
                     <input id="reset-mobile" type="text" class="round full-width-input">
                </p>
                    <center id="put-reset"> <a href="#"  onclick="reset()" class="button round blue image-right ic-right-arrow">SUBMIT</a></center>  
                    <br>
                
                    </fieldset>
                </form>
            </div>
            <div class="col-sm-4" style="height: 100%;"  onclick="cloz('f_pass')"></div>
        </div>
    </div>
    <div id="support" class="modal">
        <div class="col-lg-12">
            <div class="col-sm-4" style="height: 100%;" onclick="cloz('support')"></div>
            <div class="col-sm-4 card" style="padding-left: 3.5%; background: #c1bdba; margin-top: 15%; padding-top: 10px;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('support')">&times;</span>
                <center><h4 style="text-transform: uppercase; ">SUPPORT</h4></center> 
                <div id="support-mes"></div>
                <form>
                <fieldset>
                 
                 <p>
                     <label for="sup_user" >Student/Staff ID</label>
                   <input id="sup_user"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="sup_email" >Email</label>
                   <input id="sup_email"  type="email" class="round full-width-input">
                </p>
                 <p>
                     <label for="sup_mes">Message</label>
                     <textarea id="sup_mes" class="round full-width-textarea"></textarea>
                </p>
                 
                    <center id="put-support"> <a href="#"  onclick="do_support()" class="button round blue image-right ic-right-arrow">SUBMIT</a></center>
                    <br>
                </fieldset>
            </form>
            </div>
            <div class="col-sm-4" style="height: 100%;"  onclick="cloz('support')"></div>
        </div>
    </div>
    <div id="trans" class="modal">
        <div class="col-lg-12">
            <div class="col-sm-4" style="height: 100%;" onclick="cloz('trans')"></div>
            <div class="col-sm-4 card" style="padding-left: 3.5%; background: #c1bdba; margin-top: 15%; padding-top: 10px;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('trans')">&times;</span>
                <center><h4 style="text-transform: uppercase; ">TRANSCRIPT APPLICATION</h4></center> 
                <div id="trans-mes"></div>
                <form>
                <fieldset>
                 
                 <p>
                     <label for="mat" >MATRICULATION NUMBER</label>
                   <input id="mat"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="trans_name" >Name</label>
                   <input id="trans_name"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="trans_mobile" >Mobile</label>
                   <input id="trans_mobile"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="trans_email" >Email</label>
                   <input id="trans_email"  type="email" class="round full-width-input">
                </p>
                
                 
                    <center id="put-trans"> <a href="#"  onclick="do_trans()" class="button round blue image-right ic-right-arrow">SUBMIT</a></center>
                    <br>
                </fieldset>
            </form>
            </div>
            <div class="col-sm-4" style="height: 100%;"  onclick="cloz('trans')"></div>
        </div>
    </div>
    <div id="cert" class="modal">
        <div class="col-lg-12">
            <div class="col-sm-4" style="height: 100%;" onclick="cloz('cert')"></div>
            <div class="col-sm-4 card" style="padding-left: 3.5%; background: #c1bdba; margin-top: 15%; padding-top: 10px;">
                <span style="float: right; font-size: 200%; font-weight: bold; cursor: pointer; " onclick="cloz('cert')">&times;</span>
                <center><h4 style="text-transform: uppercase; ">CERTIFICATE APPLICATION</h4></center> 
                <div id="cert-mes"></div>
                <form>
                <fieldset>
                 
                 <p>
                     <label for="cert_mat" >MATRICULATION NUMBER</label>
                   <input id="mat"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="cert_name" >Name</label>
                   <input id="trans_name"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="cert_mobile" >Mobile</label>
                   <input id="trans_mobile"  type="text" class="round full-width-input">
                </p>
                 <p>
                     <label for="cert_email" >Email</label>
                   <input id="trans_email"  type="email" class="round full-width-input">
                </p>
                <center id="put-cert"> <a href="#"  onclick="do_cert()" class="button round blue image-right ic-right-arrow">SUBMIT</a></center>
                    <br>
                </fieldset>
            </form>
            </div>
            <div class="col-sm-4" style="height: 100%;"  onclick="cloz('cert')"></div>
        </div>
    </div>
        <?php
if(isset($_SESSION['error'])){
    ?>
        
<script>
    //alert('<?php //echo $_SESSION['error']; ?>');
    $("#put-mes").html("<div class='error-box round'><?php echo $_SESSION['error']; ?></div>");</script>
<?php

    unset($_SESSION['error']);
}
?>
    <?php
if(isset($_SESSION['mes_false'])){
    ?>
        
<script>
    //alert('<?php //echo $_SESSION['error']; ?>');
    $("#put-mes").html("<div class='confirmation-box round'><?php echo $_SESSION['mes_false']; ?></div>");</script>
<?php

    unset($_SESSION['mes_false']);
}
?>
    <?php
if(isset($_SESSION['mes_fals'])){
    ?>
        
<script>
    //alert('<?php //echo $_SESSION['error']; ?>');
    $("#put-mes").html("<div class='error-box round'><?php echo $_SESSION['mes_fals']; ?></div>");</script>
<?php

    unset($_SESSION['mes_fals']);
}
?>
</body>

<!-- Mirrored from webdesigntutsplus.s3.amazonaws.com/tuts/297_simpleAdmin/demo/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Aug 2018 18:29:14 GMT -->
</html>