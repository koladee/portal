<?php
//dash-courses-reg
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
    if(isset($_POST['id'], $_POST['stat'])){
     
        if($_POST['stat'] == "Y"){
        $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"');
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $row[0];
        $cs = explode("{:||:}", $dat['results']);
        $lim = count($cs);
        for($i = 0; $i < $lim; $i++){
            $cks = explode("//",$cs[$i]);
            //check if the course is outstanding or not
            if($cks[0] == $_POST['id'] && $cks[4] == "" && $cks[5] == ""){
                //outstanding
                $cks[3] = $dat['level'];
                $cs[$i] = $cks;
                break;
            }else{
                //carry over or new course
               $cs[$lim] = $_POST['id']."//".$dat['present_session']."//".$dat['semester']."//".$dat['level']."//////".$lim;
               break;
                
            }
        }
        $cs_new = implode("{:||:}", $cs);
        $do = $db->query('update users set results = "'.$cs_new.'" where uniqid = "'.$_SESSION['uniqid'].'"');
        if($do){
            echo "Course successfully registered!";
        }else{
            echo "Oops! An error occured while registering this course for you!!!";
        }
        
        }elseif($_POST['stat'] == "N"){
          $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"');
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $row[0];
        $cs = explode("{:||:}", $dat['results']);
        $lim = count($cs);
        for($i = 0; $i < $lim; $i++){
            $cks = explode("//",$cs[$i]);
            if($cks[0] == $_POST['id'] && $cks[3] == $dat['level'] && $cks[2] == $dat['semester']){
                unset($cs[$i]);
            }
            
        }
        $cs_new = implode("{:||:}", $cs);
        $do = $db->query('update users set results = "'.$cs_new.'" where uniqid = "'.$_SESSION['uniqid'].'"');
         if($do){
            echo "Course successfully deleted!";
        }else{
            echo "Oops! An error occured while deleting this course for you!!!";
        }
       }
        
        
    }

}