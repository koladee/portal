<?php
//dash-chat-notif
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
   $stmt = $db->query('select * from messages where (sender = "'.$_SESSION['uniqid'].'" || receiver = "'.$_SESSION['uniqid'].'") and mes = "" ');
   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   foreach($rows as $dat){
       $who = "";
   if($dat['sender'] == $_SESSION['uniqid']){
       $who = $dat['receiver'];
   }else{
       $who = $dat['sender'];
   }
   $sp = $db->query('select * from users where uniqid = "'.$who.'"'); 
   $rt = $sp->fetchAll(PDO::FETCH_ASSOC)[0];
       ?>
<div onclick="chat('<?php echo $who; ?>')"  class="card" style=" background: rgba(0,0,0,0); width: 100%; padding: 5px;">
    <table style="width: 100%;">
        <tr style="background: rgba(0,0,0,0);">
            <td style="width: 10%; border: 0px solid #eee;">
                <img src="../<?php echo $rt['photo']; ?>" style="width: 40px; height: 40%;" class="img-circle" /><br>
                <small style="font-weight: bolder;"><?php echo $rt['firstname']." ".$rt['lastname']; ?></small>
            </td>  
            <td style="width: 65%; border: 0px solid #eee;">
              <?php 
              $st = $db->query('select * from messages where mes_id = "'.$dat['mes_id'].'" and mes != "" order by id desc limit 1');
              $stt = $db->query('select * from messages where mes_id = "'.$dat['mes_id'].'" and mes != "" and status = "" and receiver = "'.$_SESSION['uniqid'].'"');
              $rw = $st->fetchAll(PDO::FETCH_ASSOC)[0];
              $num = $stt->rowCount();
              ?>  
                <span style="font-weight: bold; font-size: 110%;"><?php echo substr($rw['mes'], 0, 200); if(strlen($rw['mes']) > 200){ echo "...";} ?></span>
            </td>  
            <td  style="width: 25%; border: 0px solid #eee;">
        <center>
              <?php  if($num > 0){?><span style="padding: 5px; color: #eee; font-weight: bolder; font-size: 120%; width: 30px; height: 30px; border-radius: 50%; float: right;" class="btn btn-danger" ><?php echo $num; ?></span> <?php } ?>
              <br><br><small style="float: right; font-weight: bold;"><?php echo date("h:i:s d/m/Y", $rw['date']);  ?></small>
        </center>
            </td>  
        </tr>
    </table>
</div>
       
 <?php  }
    
    
}

