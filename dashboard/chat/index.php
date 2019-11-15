<?php
//dash-chat
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
    if(isset($_POST['dd'])){
     $dd = htmlentities($_POST['dd']);
     $stmt = $db->query('select * from messages where (sender = "'.$dd.'" and receiver = "'.$_SESSION['uniqid'].'") || (sender = "'.$_SESSION['uniqid'].'" and receiver = "'.$dd.'")');
    ?>
<div style="width: 100%;">
    
    <div id="chat-box" style="width: 100%;  height: 400px; overflow: auto; background-image: url('../images/chat.png'); background-repeat: no-repeat; background-size: 100% 100%;">
        <?php 
        
         if($stmt->rowCount() > 0){
         $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $id = $rows[0]['mes_id'];
             $who = "";
   if($rows[0]['sender'] == $_SESSION['uniqid']){
       $who = $rows[0]['receiver'];
   }else{
       $who = $rows[0]['sender'];
   }
   $dat = $db->query('select * from users where uniqid = "'.$who.'"')->fetchAll(PDO::FETCH_ASSOC)[0];
   ?>
        <div style="width: 95%; padding: 10px; margin: 2%; border: 2px solid #eee; border-radius: 10px;">
            <table style="width: 100%;">
                <tr style="background: rgba(0,0,0,0);">
                    <td style="width: 10%; border: 0px solid #eee;">
                      <img src="<?php if($dat['gender'] == "male" && $dat['photo'] == ""){ ?>../im12ages784345/male.png<?php }elseif($dat['gender'] == "female" && $dat['photo'] == ""){ ?>../im12ages784345/female.png<?php }else{ echo "../".$dat['photo']; } ?>" style="width: 80px; height: 80px; border-radius: 50%;" />  
                    </td>
                    <td style="width: 90%; border: 0px solid #eee;">
                <div style="float: left; text-align: left; margin-left: 10%;"> 
                <span style="font-size: 150%; font-weight: bolder; text-transform: capitalize;"><?php echo $dat['firstname']." ".$dat['lastname']; ?></span><br>
                <span style="font-size: 80%; font-weight: bolder; text-transform: capitalize;"><?php echo "Faculty of ".$dat['faculty']; ?></span><br>
                <span style="font-size: 80%; font-weight: bolder; text-transform: capitalize;"><?php echo $dat['department']." department"; ?></span>
                </div>  
                    </td>
                </tr>
            </table>
            
            
    </div>
        <table style="width: 100%;">
        <?php
         //var_dump($rows);
         foreach($rows as $dat){
             if($dat['mes'] != ""){
             ?>
            <tr style="background: rgba(0,0,0,0);">
                <?php if($dat['sender'] == $_SESSION['uniqid']){ ?>
                    
                 <td style="width: 50%; border: 0px solid #eee;">
                    
                </td>
                <td style="width: 50%; border: 0px solid #eee; font-size: 120%; text-align: left;">
                     <div  style=" width: 100%; background: #fff; border-radius: 20px; padding: 10px; color: #000; ">
            <?php echo $dat['mes']; ?>
           <br><div style="float: right; font-size: 60%; font-weight: bolder; padding-right: 2%;"><?php echo date("h:i:s d/m/y", $dat['date']);  ?></div> 
        </div>
        <br>
                </td>
                    
                    <?php }else{ ?>
                          <td style="width: 50%; border: 0px solid #eee; font-size: 120%; text-align: left;">
                     <div  style=" width: 100%; background: #fff; border-radius: 20px; padding: 10px; color: #000; ">
            <?php echo $dat['mes']; ?>
           <br><div style="float: right; font-size: 60%; font-weight: bolder; padding-right: 2%;"><?php echo date("h:i:s d/m/y", $dat['date']);  ?></div> 
        </div>
        <br>
                </td>
                <td style="width: 50%; border: 0px solid #eee;">
                    
                </td>
                        
                        <?php } ?>
              
       
        </tr>
             <?php  
             
             
        } }
        $db->query('update messages set status = "R" where mes_id = "'.$id.'" and receiver = "'.$_SESSION['uniqid'].'"');
        ?>
        </table>
    </div>
    <div style="width: 100%;">
        <form  style="width: 100%;">
							
								<fieldset style="width: 100%;">
								
									<p>
                                                                        <table style="width: 100%; background: rgba(0,0,0,0);" >
                                                                            <tr style="background: rgba(0,0,0,0);">
                                                                                <td style="width: 90%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                                                                                    <textarea id="chat-area"  type="text" id="full-width-input" class="round default-width-input" style="width: 100% !important; display: inline; resize: none;" ></textarea>
                                                                                </td>
                                                                                <td style="width: 10%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                                                                                    <i onclick="send('<?php echo $dd; ?>', '<?php echo $id;  ?>')" class="btn btn-default glyphicon glyphicon-send" style="display: inline; float: top; width: 100%;"></i>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        </p>
                                                                </fieldset>
        </form>
    </div>
    
</div>
     
   <?php 
     }else{
       //initiate new chat
                                    $r1 = mt_rand(10, 99);
                                    $r2 = time();
                                    $r3 = mt_rand(0, 25);
                                    $r4 = mt_rand(0, 9);
                                    $r5 = mt_rand(0, 25);
                                    $r6 = mt_rand(0, 25);
                                    $arr = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
                                    $code = $r1 . $arr[$r6] . $r2 . $arr[$r3] . $r4 . $arr[$r5];
                                    
                                    $st = $db->prepare("INSERT INTO messages(id, mes_id, sender, receiver, mes, status, date) VALUES(:id, :mes_id, :sender, :receiver, :mes, :status, :date)");
$do = $st->execute(array(':id' => "", ':mes_id'=> $code, ':sender' => $_SESSION['uniqid'], ':receiver' => $dd, ':mes' => "", ':status' => "", ':date' => time()));
if($do){
    ?>
<div style="width: 100%;">
    <div style="width: 100%;">
        
    </div>
    <div id="chat-box" style="width: 100%;  height: 400px; overflow: auto;">
   
    </div>
    <div style="width: 100%;">
        <form  style="width: 100%;">
							
								<fieldset style="width: 100%;">
								
									<p>
                                                                        <table style="width: 100%; background: rgba(0,0,0,0);" >
                                                                            <tr style="background: rgba(0,0,0,0);">
                                                                                <td style="width: 90%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                                                                                    <textarea id="chat-area"  type="text" id="full-width-input" class="round default-width-input" style="width: 100% !important; display: inline; resize: none;" ></textarea>
                                                                                </td>
                                                                                <td style="width: 10%; background: rgba(0,0,0,0); border: 0px solid #eee;">
                                                                                    <i onclick="send('<?php echo $dd; ?>', '<?php echo $code;  ?>')" class="btn btn-default glyphicon glyphicon-send" style="display: inline; float: top; width: 100%;"></i>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        </p>
                                                                </fieldset>
        </form>
    </div>
    
</div>
    
<?php }
                                    
     }
        
    }

}
