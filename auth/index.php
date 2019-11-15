<?php
include '../configs.php';
if(isset($_GET['auth'])){
   if($_GET['auth'] != ""){
    $auth = explode("{::}", $_GET['auth']);
    //confirm if the student with uniqid is a student or staff
    $stmt = $db->query('select * from users where uniqid = "'.$auth[1].'" and status ="'.$auth[0].'"');
    $row_count = $stmt->rowCount();
    if($row_count == 1){
        //valid
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['status'] = $auth[0]['status'];
        $_SESSION['uniqid'] = $rows[0]['uniqid'];
        //var_dump($_SESSION);
        header('location: dashboard/');
    }else{
       //invalid
        $_SESSION['error'] = "Unautorised Login Attempt!!!";
    }
       
   }else{
    header('location: ../');
} 
}else{
    header('location: ../');
}