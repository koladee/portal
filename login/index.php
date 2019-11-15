<?php
include '../configs.php';

if(isset($_POST['uid'], $_POST['pass'])){
    if(!empty($_POST['uid'] && $_POST['pass'])){
        
        $_SESSION['error'] = "";
        $_SESSION['status'] = "";
        $_SESSION['uniqid'] = "";
        $uid = $_POST['uid'];
        $pass = $_POST['pass'];
        //WHERE uid=:uid AND password=:pass 
$stmt = $db->query('SELECT * FROM users where uid = "'.$uid.'" && password = "'.sha1($pass).'" ');
//$stmt->execute(array(':uid' =>$uid, ':pass' =>sha1($pass)));
$row_count = $stmt->rowCount();

if($row_count == 1){
    //user exist
    //check if user is a student or staff
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   foreach($rows as $user){
       //seperate student from staff
        
       if($user['status'] == "student"){
           //student
           $_SESSION['status'] = $user['status'];
        $_SESSION['uniqid'] = $user['uniqid'];
      
         
       }else{
           //staff
              $_SESSION['status'] = $user['status'];
        $_SESSION['uniqid'] = $user['uniqid'];
     
       }
   
   }
}else{
    //invalid uid or pass, return error
    $mes = "Oops!! Invalid Username or Password.//nill";
    
}
    }else{
     $mes = "Oops!! All Fields are Required!!!//nill";   
    }
}

if(isset ($_SESSION['status'], $_SESSION['uniqid'])){
    session_start();
   header('location: ../dashboard/'); 
}elseif(isset($mes)){
   $_SESSION['error'] = $mes ; 
   header('location: ../');
}
//var_dump($_SESSION);