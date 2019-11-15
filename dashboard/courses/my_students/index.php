<?php
//dash-courses-my_students
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
    if(isset($_POST['st'])){
      if(!empty($_POST['st'])){
$st = htmlentities($_POST['st'], ENT_QUOTES);
$dat = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
$stm = $db->query('select * from courses where id = "'.$st.'"')->fetchAll(PDO::FETCH_ASSOC)[0];
$stmt = $db->query('select * from users where results like "%'.$st.'//'.$dat['present_session'].'//'.$stm['semester'].'//%"  order by uid asc');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div>
    <center>
    <h3><?php echo $stm['code']." [ ".$stm['title']." ]"; ?> <?php echo "( ".$stm['units']." unit(s) )"; ?></h3>
    
    <h5 >Lecturer: <?php echo $dat['firstname']." ".$dat['lastname']; ?></h5>
    </center>
</div>
<?php
?>
    
<table class="table">
						
							<thead>
						
								<tr>
									
                                                                    <th style="width: 15%;">Matric Number</th>
									<th style="width: 60%;">Name</th>
                                                                        <th style="width: 15%;"><center>Image</center></th>
									<th style="width: 10%;">Actions</th>
								</tr>
							
                                                        </thead>
                                                         <tbody>
                                                     <?php   foreach($rows as $tr){ ?>
                                                       
                                                            
                                                            <tr>
									
									<td style="width: 15%;"><?php echo $tr['uid']; ?></td>
									<td style="width: 60%; text-transform: capitalize;"><?php echo $tr['firstname']." ".$tr['middlename']." ".$tr['lastname']; ?></td>
                                                                        <td style="width: 15%;"><center><img class="img-circle" src="../<?php echo $tr['photo']; ?>" style="width: 55px; height: 55px; border-radius: 50%;" /></center></td>
                                                                        <td style="width: 10%; text-align: left;">
                                                                            <a href="#" onclick="chat('<?php echo $tr['uniqid'] ?>')" class="btn btn-default "><i class="glyphicon glyphicon-comment"></i><small> Message</small></a>
                                                                            
                                                                        </td>
								</tr>
                                                         
                                                        <?php } ?>
                                                        
                                             </tbody>             

</table>

<?php 
      }
    }
}