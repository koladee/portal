<?php ob_start(); 
include 'conf.php';

//if(isset($_SESSION['username'],$_SESSION['uniqid'])){
if(isset( $_POST['qd']) && (isset($_POST['gid']) || isset( $_POST['eid']))){
  $uy =  mysql_query('select * from rounds where (game_id = "'.  mysql_real_escape_string($_POST['gid']).'" and player = "'.  mysql_real_escape_string($_SESSION['uniqid']).'" and time_played = "'.''.'") ');
  $reo = mysql_query('select * from applications where uniqid = "'.  mysql_real_escape_string($_POST['eid']).'" and exam_score = "'.''.'" ')  ;
  if(mysql_num_rows($uy) == 1 ){
       $qd = $_POST['qd'];
       unset($_POST['qd']);
       $sp = 0;
foreach ($qd as $ft){
    $sf = mysql_fetch_array(mysql_query('select `correct` from questions where id="'.mysql_real_escape_string($ft).'"'))['correct'];
    if(isset($_POST["q".$ft."xyz"])){
    if($sf == $_POST["q".$ft."xyz"]){
        $sp++;
    }
    
    }
}

$point = $sp * 20  ;
//$score = mysql_query('update rounds set score = "'.$point.'", time_played = "'.time().'" where (game_id = "'.  mysql_real_escape_string($_POST['gid']).'" and player = "'.  mysql_real_escape_string($_SESSION['uniqid']).'") ');
if($score){
unset($_POST['gid']);
$mes = "You scored ".$point." POINTS";
}
    }elseif(mysql_num_rows($reo) == 1){
        $qd = $_POST['qd'];
       unset($_POST['qd']);
       $sp = 0;
foreach ($qd as $ft){
    $sf = mysql_fetch_array(mysql_query('select `correct` from questions where id="'.mysql_real_escape_string($ft).'"'))['correct'];
    if(isset($_POST["q".$ft."xyz"])){
    if($sf == $_POST["q".$ft."xyz"]){
        $sp++;
    }
    
    }
}

$point = $sp * 2  ;
//$score = mysql_query('update applications set exam_score = "'.$point.'" where (uniqid = "'.  mysql_real_escape_string($_POST['eid']).'" ) ')or die(mysql_error());
//if($score){
unset($_POST['eid']);
$mes = "You scored ".$point."%, endeavor to always check your MAIL INBOX or SPAM so as to know if your are shortlisted for the interview.";
//}


    }else{
        $mes = "Invalid Game Entry!!!" ;
    }
}
if(isset($mes)){
    $_SESSION['mes_false'] = $mes;
    header('location: ../eksu/');
}
//}else{
//    header('location: ../eksu/');
//}