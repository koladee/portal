<?php
//dash-payments-ref_gen
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
    if(isset($_POST['mnt'], $_POST['tp'])){
       $id = htmlentities($_POST['mnt'], ENT_QUOTES);
       $tp = htmlentities($_POST['tp'], ENT_QUOTES);
       
       $stmt = $db->query('select * from payments where id = "'.$id.'"');
       $row = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
       $dat = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
       $amount = "";
       if($row['faculty'] == "all"){
           $amount = $row['amount'];
       }elseif($row['faculty'] == $dat['faculty']){
           if($row['department'] == "all"){
               if($row['level'] == "all"){
               $amount = $row['amount'];
               }else{
                 $t = (substr($dat['level'], 0 ,1) - 1);
                 $kp = explode("//", $row['amount']);
                 $amount = $kp[$t];
               }
           }elseif($row['department'] == $dat['department']){
               if($row['level'] == "all"){
               $amount = $row['amount'];
               }else{
                 $t = (substr($dat['level'], 0 ,1) - 1);
                 $kp = explode("//", $row['amount']);
                 $amount = $kp[$t];
               }  
           }
       }
       if($tp == "h" && $row['name'] == "School Fees"){
         $ramt = ($amount/2);
       }elseif($tp == ""){
           $ramt = $amount;
       }else{
           $ramt = $tp;
       }
       
       
           //generate ref
               $r1 = mt_rand(10, 99);
                                    $r2 = time();
                                    $r3 = mt_rand(0, 25);
                                    $r4 = mt_rand(0, 9);
                                    $r5 = mt_rand(0, 25);
                                    $r6 = mt_rand(0, 25);
                                    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
                                    $code = $r1 . $arr[$r6] . $r2 . $arr[$r3] . $r4 . $arr[$r5];
       //create a new row in transaction table
        $st = $db->prepare("INSERT INTO transactions (id, tranz_id, payer, purpose, present_session, semester, amount, criteria, date) VALUES(:id, :tranz_id, :payer, :purpose, :present_session, :semester, :amount, :criteria, :date)");
$do = $st->execute(array(':id' => "", ':tranz_id'=> $code, ':payer' => $_SESSION['uniqid'], ':purpose' => $id, ':present_session' => $dat['present_session'], ':semester' => $dat['semester'], ':amount' => "", ':criteria' => "", ':date' => time()));
       if($do){
         $m = (($ramt+600)*100)."//".$code;  
       }

       
       
       if(isset($m)){
          echo $m; 
       }
       
       }elseif(isset ($_POST['abt'])){
           if(!empty($_POST['abt'])){
                $k = htmlentities($_POST['abt'], ENT_QUOTES);
            $fr = $db->query('select id from transactions where tranz_id =  "'.$k.'" and payer = "'.$_SESSION['uniqid'].'"');   
            if($fr->rowCount() == 1){
             $do =  $db->query('delete from transactions where tranz_id = "'.$k.'" and payer = "'.$_SESSION['uniqid'].'"'); 
               if($do){
                  echo "done" ;
               }
            }
           }
       }
    }


