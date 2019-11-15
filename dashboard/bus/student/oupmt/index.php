<?php
//dash-bus-student-oupmt
include '../../../../configs.php';
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
      if(isset($_POST['wh'], $_POST['pt'], $_POST['amt'], $_POST['sess'], $_POST['pop'])){
          $who = htmlentities($_POST['wh'], ENT_QUOTES);
          $pt = htmlentities($_POST['pt'], ENT_QUOTES);
          $amt = htmlentities($_POST['amt'], ENT_QUOTES);
          $sess = htmlentities($_POST['sess'], ENT_QUOTES);
          $pop = htmlentities($_POST['pop'], ENT_QUOTES);
          $nv = $db->query('select outstandings from users where uniqid = "'.$who.'"');
          if($nv->rowCount() == 1){
              $dat = $nv->fetchAll(PDO::FETCH_ASSOC)[0];
              if($dat['outstandings'] != ""){
                  $rt = explode("{:||:}", $dat['outstandings']);
                  $nd = [];
                  foreach($rt as $dl){
                      $lo = explode("//", $dl);
                      array_push($nd, $lo[0]);
                  }
                  $lim = count($rt);
                  if(in_array($pt, $nd)){
                  
                  for ($i=0;$i<$lim;$i++){
                      $bg = explode("//", $rt[$i]);
                      if($bg[0] == $pt){
                          $bl = $bg[3];
                          if($pop == "over"){
                          $dif = $bl-$amt;
                          }elseif($pop == "under"){
                            $dif = $bl+$amt;  
                          }
                          if($dif == 0){
                              unset($rt[$i]) ;
                          }else{
                              $bg[3] = $dif;
                              $rs = implode("//", $bg);
                              $rt[$i] = $rs;
                          }
                          break;
                      }
                  }
                  
                  }elseif(!in_array($pt, $nd)){
                        if($pop == "over"){
                          $rt[$lim] = $pt."//".$sess."////-".$amt    ;
                          }elseif($pop == "under"){
                            $rt[$lim] = $pt."//".$sess."////".$amt    ;
                          }
                      
                      }
                      $don = implode("{:||:}", $rt);
              }else{
                  if($pop == "over"){
                          $don = $pt."//".$sess."////-".$amt;    
                          }elseif($pop == "under"){
                            $don = $pt."//".$sess."////".$amt;    
                          }
              
              }
              $do = $db->query('update users set outstandings = "'.$don.'" where uniqid = "'.$who.'"');
                  if($do){
                      echo "<div style='width: 100%;' class='round confirmation-box'>".$pop."payment successfuly executed!</div>";
                  } 
          }
      }
       
   } 
   }


