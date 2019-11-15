<?php ob_start(); ?>
<!DOCTYPE HTML>
<html>
<head>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  $( function() {
    $( "input[type=radio]" ).checkboxradio();
  } );
  </script>
<meta charset=utf-8 />
<link rel="stylesheet" href="introjs.css">
  <title>E-Test | EKSU</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.theme.default.css" rel="stylesheet"/>
  <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/reset.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/style.css">

	   
        <link rel="stylesheet" type="text/css" href="css1/demo.css" />
        <link rel="stylesheet" type="text/css" href="css1/style2.css" />
		<link rel="stylesheet" type="text/css" href="css1/animate-custom.css" />
  
  <link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/sidebar-collapse.css">

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

	<meta name="viewport" content="width=device-width,  initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        
  
<link href="icon.png" rel="shortcut icon"> 

<meta name="theme-color" content="#4682B4">
<meta name="msapplication-navbutton-color" content="#4682B4">
<meta name="apple-mobile-web-app-status-bar-style" content="#4682B4">
<link rel="stylesheet" type="text/css" href="jquery.jscrollpane.css" />
<script type="text/javascript" src="jquery.jscrollpane.min.js"></script>
 <link href="images/logo.png" rel="shortcut icon"> 
 <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.css">
<script src="jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>

</head>

 <body>
	

    <?php include 'conf.php'; 
     $_POST['username'] = "fghjk";
    $_POST['eid'] = "40c1506622636f7i";
    if(isset($_POST['username'], $_POST['eid'])){ 
        if(!empty($_POST['username'] && $_POST['eid'])){
           //validate if user has written exam or not and if student is eligible to write the exam
            $quo = mysql_query('select * from applications where uniqid = "' .'40c1506622636f7i'. '" and exam_score = "'.''.'" ');
            if(mysql_num_rows($quo) == 1){
                //student is eligible
                
                $ar = mysql_fetch_array($quo);
                $status = $ar['exam_score'];
                if($status == ""){ 
                    $q = mysql_query('select * from questions order by rand() limit 50');
                    $ques = [];
                    
                    while($qs = mysql_fetch_array($q)){
                        array_push($ques, $qs['id']);
                       
                    }
                
                    
        ?>
     
     <!-- TOP BAR -->
     <div id="top-bar" style="height: 70px;">
		
		<div class="page-full-width">
                    <a href="#" id="company-branding" class="fl" style="margin-right: 20px; outline: none;  "><img src="images/logo.png" alt="EKSU" /></a>
                    <a href="#" class="round" style="font-size: 200%; font-weight: bold; color: #eee; outline: none;">CBT EXAMINATION <?php echo date("Y", time()); ?></a>

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
     <!-- HEADER -->
	<div id="header">
		
		<div class="page-full-width cf">
	
			<div id="login-intro" class="fl">
			
                            <h4 style="text-transform: uppercase;"><span><b>TIME LEFT : </b><span id="time"></span></span></h4>
				
			
			</div> <!-- login-intro -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 39px height. -->
                        <b class="fr" style="text-transform: capitalize;"><span><?php echo "NAME: ".$ar['firstname']." ". $ar['lastname']; ?></span><br> <?php echo "EXAM ID: ".$_POST['eid']; ?>
                            <br><button onclick="confirmSubmit();" name="score" type="submit" class="btn btn-primary">SUBMIT EXAMINATION</button>
                        </b>
			
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
     <!-- MAIN CONTENT -->
        <div id="content" style="padding: 0px; margin: 0px;">
     
<div class="content" >
    
    <table border="0px" style="color: #4682B4; width: 100%; ">






<tr>
<td colspan="2" valign="top" style="padding-top: 5px;">
    <div style="width: 100%;  text-align: center; font-weight: bold;">
        <center>
        
            <form class="form-horizontal" role="form" id="quests" method="post" action="round_result.php">
					<?php 
                                        $gfd = 1;
                                        $uniq = mysql_real_escape_string($_POST['eid']);
                                       $st = $ques;
                                        shuffle($st);
                                        $i = 1;
                                        foreach($st as $gj){
                                            $sy = mysql_fetch_array(mysql_query('select * from questions where id="'.$gj.'"'));
                                            $sl = explode("{:,:,;]}",$sy['wrongs']);
                                            array_push($sl, $sy['correct']);
                                            shuffle($sl);
                                            ?>
                <div id='<?php echo $i; ?>' class='cont' style="margin-bottom: 10%;">
                                                <?php
                                                if($sy['image'] != NULL){
                                                    ?>
                                                <div style="max-width:450px; max-height:450px; margin-top: 5%; margin-bottom: 10%;;">
                                                    <img src="<?php echo $sy['image']; ?>" style="width: 100%; height: 100%;" alt="Question Image" >
                                                </div>
                                                <?php } ?>
                    <p  style="font-weight: bold; font-size: 20px; color: #000;" class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $sy['question_name'];?></p>
                    <center><div class="row" style="width: 60%"><div align="left">
                    <?php foreach($sl as $lo){ ?>
                            
                                <div class="col-lg-6 rad"><label style="text-align: left!important" for="qds<?php echo $gfd; ?>"><input id="qds<?php echo  $gfd; ?>" type="radio" value="<?php echo $lo; ?>" name="q<?php echo $gj;?>xyz"> <?php echo $lo;?></label></div>
                            
                    <?php $gfd++; }
                    ?></div></div></center>
                    <input style="size: 40px; font-weight: bold; font-size: 20px;" type="hidden" name="qd[]" value="<?php echo $gj; ?>">
                    <span> <?php echo " " ?></span>
                    </div>  
                                        <?php  $i++; }
                ?>
            <input style="font-weight: bold; font-size: 20px;" type="hidden" name="eid" value="<?php echo $_POST['eid'] ?>">
                    <input style="font-weight: bold; font-size: 20px;" id="usem" type="hidden" name="usem" value="">
                    <input style="font-weight: bold; font-size: 20px;" id="use" type="hidden" name="use" value="">
				</form>
        </center>
</div>

<script>
		$('.cont').addClass('hide');
		$('#'+1).removeClass('hide');
                 $('#'+1).addClass('tmt');
                
    $(document).on('click','#next',function(){
                     var element = document.getElementsByClassName("tmt")[0].id;
                     var last = parseInt(element.substr(element.length - 1));
                     if(last !== 0){
		     var nex = last + 1;
		     $('#question'+last).addClass('hide');
                     $('#question'+last).removeClass('tmt');
		     $('#question'+nex).removeClass('hide');
                     $('#question'+nex).addClass('tmt');
                 }
                 });
                  $(document).on('change','.rad input',function(){
                     var element = document.getElementsByClassName("tmt")[0].id;
                     var last = parseInt(element);
                     if(last !== 0){
		     var nex = last + 1;
		     $('#'+last).addClass('hide');
                     $('#'+last).removeClass('tmt');
		     $('#'+nex).removeClass('hide');
                     $('#'+nex).addClass('tmt');
                 }
                 });
$(document).on('click','#prev',function(){
             var element = document.getElementsByClassName("tmt")[0].id;
             var last = parseInt(element.substr(element.length - 1));
             if(last !== 1){
             var pre;             $('#question'+last).removeClass('tmt');

             if(last == 0){pre = 9; last = 10;}else{pre = last - 1;}
             $('#question'+last).addClass('hide');
             $('#question'+pre).removeClass('hide');
             $('#question'+pre).addClass('tmt');
                 }
             });
             function confirmSubmit(){
                 document.getElementById('quests').submit();
             }
</script>

</td>
</tr>

</table>

    
    
    
    </div>
        </div>
   
<script>
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    inter = setInterval(function () {
        minute = minutes = parseInt(timer / 60, 10);
        second = seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        document.getElementById("usem").value = minute;
        document.getElementById("use").value = second;

        if (--timer < 0) {
            confirmSubmit();
            window.clearInterval(inter);
        }
    }, 1000);
}

window.onload = function () {
    var fiveMinutes = 120,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>    

<?php
                    }else{
    //ole...you don play b4
//    $exp = explode(",", $ar['points']);
//    if($exp[$ind] == ""){
//        $exp[$ind] = $ar['amount']/2;
//        $sb = implode(",", $exp);
//        mysql_query('update rooms set points="'.mysql_real_escape_string($sb).'" where uniqid="'.mysql_real_escape_string($_GET['gid']).'"');
//    }
//    if($ad_b4[$ind] == ""){
//    $ad_b4[$ind] = 'Y';
//    $xu = implode(',', $ad_b4);
//    $ad = mysql_fetch_array(mysql_query('select weekly_points,lifetime_points,'.$ar['category'].' from users where uniqid="'.mysql_real_escape_string($_SESSION['uniqid']).'"'));
//    $new_week_point = $ad['weekly_points'] + $ar['amount'];
//    $new_life_point = $ad['lifetime_points'] + $ar['amount'];
//    $new_cat_point = $ad[$ar['category']] + $ar['amount'];
//    mysql_query('update users set weekly_points="'.$new_week_point.'", lifetime_points="'.$new_life_point.'", '.$ar['category'].'="'.$new_cat_point.'" where uniqid="'.mysql_real_escape_string($_SESSION['uniqid']).'"');
//    mysql_query('update  rooms set added_before="'.mysql_real_escape_string($xu).'" where uniqid="'.mysql_real_escape_string($ar['uniqid']).'"');
//}
//    header('location: ../');
}
?>
<div id="footer">

		<p>&copy; Copyright 2018 <a href="https://eksu.edu.ng">Ekiti State University, Ado-Ekiti</a>. All rights reserved.</p>
		<!--<p><strong>Powered</strong> by <a href="http://www.k-dev.org">K-DEVELOPERS TECHNOLOGIES</a></p>-->
	
	</div> <!-- end footer -->
</body>
<?php 


 } else {
     $_SESSION['mes_fals'] = "You've Attemted This Examination Before!!!";
    header('location: ../eksu');
}
        }
        
            
            


                    
        
        ?>
                   

</html>
    <?php 
   // header('refresh:125,url=js_tamper.php?gid='.$_GET['gid']);
    }else{
        header('location: ../');
    }
    ob_end_flush(); 
    