<?php
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
    if(isset($_POST['pass'], $_POST['new_pass'], $_POST['con_pass'])){
    if(!empty($_POST['pass']) && !empty($_POST['new_pass']) && !empty($_POST['con_pass'])){
        $stmt = $db->query('select password from users where uniqid = "'.$_SESSION['uniqid'].'"'); 
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
        $p = $dat['password'];
        if(sha1($_POST['pass']) == $p){
            if($_POST['new_pass'] == $_POST['con_pass']){
                $pass = sha1($_POST['new_pass']);
                $do = $db->prepare  ('update users set password =? where uniqid =?');
              $dd =  $do->execute(array($pass, $_SESSION['uniqid']));
                if($dd){
               $mes = "Password successfully changed!" ;
                }else{
                    $mes = "Oops! An error occured while attempting to change your password!!!";
                }
            }else{
                $mes = "Password dose not match!!!";
            }
            
        }else{
            $mes = "Incorrect Password.!!!";
        }
    }else{
        $mes = "All fields are required!!!";
    }
    }else{
        $mes = "Undefined!";
    }
}else{
 $mes = "Access Denied"   ;
}

if(isset($mes)){
    echo $mes;
}