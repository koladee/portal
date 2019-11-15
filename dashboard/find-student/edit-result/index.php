<?php
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
    if(isset($_POST['std'], $_POST['ca'], $_POST['exam'], $_POST['ind'])){
         $st = $db->query('select * from hod where uniqid = "'.$_SESSION['uniqid'].'"');
        $count = $st->rowCount();
        if($count == 1){
            $sk = $db->query('select * from users where uid = "'.$_POST['std'].'" and status = "'.'student'.'"'); 
            $cn = $sk->rowCount();
            if($cn === 1){
                $row = $sk->fetchAll(PDO::FETCH_ASSOC);
                $dat = $row[0];
                $r = explode("{:||:}", $dat['results']);
                $ind = $_POST['ind'];
               $g =  $r[$ind] ;
               $gg = explode("//", $g);
               $gg[4] = $_POST['ca'];
               $gg[5] = $_POST['exam'];
               $h = implode("//", $gg);
               $r[$ind] = $h;
               $f = implode("{:||:}", $r);
             $do = $db->query('update users set results = "'.$f.'" where uniqid = "'.$dat['uniqid'].'"');
             if($do){
                 echo "done";
             }else{
                 echo "An error occured while updating result";
             }
            }else{
                echo "Student with matric number <b>".$_POST['std']."</b> does not exist on this system";
            }
            
            
        }else{
         echo "You are not eligible to edit this result";   
        }
    }else{
     echo "Unautorised user! Access denied!!!"   ;
    }
}