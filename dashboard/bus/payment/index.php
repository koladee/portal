<?php
//dash-bus-payments
include '../../../configs.php';
 define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}

if(isset($_SESSION['status'], $_SESSION['uniqid'])){
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and (status = "'.'bursary'.'" || status = "super admin")');
   if($stmt->rowCount() == 1){
       if(isset($_POST['n'], $_POST['name'], $_POST['amou'], $_POST['dura'], $_POST['prog'], $_POST['facu'], $_POST['dept'], $_POST['leve'], $_POST['bank'], $_POST['acna'], $_POST['acnu'])){
        if(!empty($_POST['n'] && $_POST['name'] && $_POST['amou'] && $_POST['dura'] && $_POST['prog'] && $_POST['facu'] && $_POST['dept'] && $_POST['bank'] && $_POST['acna'] && $_POST['acnu'])  && $_POST['leve'] != ""){
        $id = $_POST['n'];
        $name =  $_POST['name'];
        $amount = $_POST['amou'];
        $duration = $_POST['dura'];
        $programme = $_POST['prog'];
        $faculty = $_POST['facu'];
        $department = $_POST['dept'];
        $level = $_POST['leve'];
        $bank = $_POST['bank'];
        $accl_name = $_POST['acna'];
        $accl_number = $_POST['acnu'];
        $ck = $db->query('select id from payments where id = "'.$id.'"');
        if($ck->rowCount() == 1){
            $pl = $db->query('update payments set name = "'.$name.'", amount = "'.$amount.'", duration = "'.$duration.'", programme = "'.$programme.'", faculty = "'.$faculty.'", '
                    . 'department = "'.$department.'", level = "'.$level.'", bank = "'.$bank.'", accl_name = "'.$accl_name.'", accl_number = "'.$accl_number.'" where id ="'.$id.'" ');
            if($pl){
                echo "Account successfully modified!";
            }
        }
            
            
       } 
           
           
       }elseif(isset($_POST['name'], $_POST['amou'], $_POST['dura'], $_POST['prog'], $_POST['facu'], $_POST['dept'], $_POST['leve'], $_POST['bank'], $_POST['acna'], $_POST['acnu'])){
        if(!empty($_POST['name'] && $_POST['amou'] && $_POST['dura'] && $_POST['prog'] && $_POST['facu'] && $_POST['dept'] && $_POST['leve'] && $_POST['bank'] && $_POST['acna'] && $_POST['acnu'])){
        $name =  $_POST['name'];
        $amount = $_POST['amou'];
        $duration = $_POST['dura'];
        $programme = $_POST['prog'];
        $faculty = $_POST['facu'];
        $department = $_POST['dept'];
        $level = $_POST['leve'];
        $bank = $_POST['bank'];
        $accl_name = $_POST['acna'];
        $accl_number = $_POST['acnu'];
  $st = $db->prepare("INSERT INTO payments (id, name, amount, duration, programme, faculty, department, level, bank, accl_name, accl_number, dell) "
                . "VALUES(:id, :name, :amount, :duration, :programme, :faculty, :department, :level, :bank, :accl_name, :accl_number, :dell)");
$do = $st->execute(array(':id' => "", ':name' => $name, ':amount' => $amount, ':duration' => $duration, ':programme' => $programme, ':faculty' => $faculty, ':department' => $department, ':level' => $level, ':bank' => $bank, ':accl_name' => $accl_name, ':accl_number' => $accl_number, ':dell' => ""));
if($do){
                echo "New account successfully added!";
            }
       
            
            
       } 
           
           
       }elseif(isset($_POST['n'], $_POST['fc'])){
           if(!empty($_POST['n'] && $_POST['fc'])){
               $id = htmlentities($_POST['n'], ENT_QUOTES);
               $ck = $db->query('select id from payments where id = "'.$id.'"');
        if($ck->rowCount() == 1){
            $sd = $db->query('update payments set dell = "'.'Y'.'" where id = "'.$id.'"');
            if($sd){
                echo "Payment profile successfully deleted";
            }
        }
           }
       }
       
       
   }
}
