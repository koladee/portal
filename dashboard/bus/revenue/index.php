<?php
//dash-bus-revenue
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
   $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and (status = "'.'bursary'.'" || status = "'.'vc'.'" || status = "'.'registrar'.'" || status = "super admin")');
   if($stmt->rowCount() == 1){
       if(isset($_POST['pt'], $_POST['from'], $_POST['to'], $_POST['sess'], $_POST['seme'])){
       $p_type = htmlentities($_POST['pt'], ENT_QUOTES);
       $date_from = htmlentities($_POST['from'], ENT_QUOTES);
       $date_to = htmlentities($_POST['to'], ENT_QUOTES);
       $sess = htmlentities($_POST['sess'], ENT_QUOTES);
       $seme = htmlentities($_POST['seme'], ENT_QUOTES);
       $from = strtotime($date_from);
       $to = strtotime($date_to);
       if($seme == "all"){
           $semester = " ";
       }else{
           $semester = ' && semester = "'.$seme.'"';
       }
       $query = 'select * from transactions where (purpose = "'.$p_type.'"'.$semester.' && present_session = "'.$sess.'" && date >= "'.$from.'" && date <= "'.$to.'") order by date asc';
       $kq = $db->query($query);
               $qu = $kq->fetchAll(PDO::FETCH_ASSOC);
               
       if($kq->rowCount() > 0){
            $quer = 'select sum(amount) from transactions where (purpose = "'.$p_type.'"'.$semester.' && present_session = "'.$sess.'" && date >= "'.$from.'" && date <= "'.$to.'") order by date asc';
           $tot = $db->query($quer)->fetchAll(PDO::FETCH_ASSOC)[0]['sum(amount)'];
           $ppl = count($qu);
           $lk = $db->query('select * from payments where id = "'.$p_type.'"')->fetchAll(PDO::FETCH_ASSOC)[0];
//       foreach ($qu as $qq){
//           
//       }
          ?>
<div class="card" style="padding: 10px; font-weight: bold; text-transform: uppercase;">
    <span onclick="timez('qu-cont')" style="float: right; font-size: 200%; cursor: pointer;">&times;</span>
    <center><h5 style=" font-weight: bold;"><?php echo $lk['name']; ?></h5></center> 
    <span>PROGRAMME: <?php echo $lk['programme']; ?></span><br><br>
    <span>FACULTY: <?php echo $lk['faculty']; ?></span><br><br>
    <span>DEPARTMENT(S): <?php echo $lk['department']; ?></span><br><br>
    <span>TOTAL AMOUNT GENERATED: <?php echo "#".$tot; ?></span><br><br>
    <span>TOTAL NUMBER OF STUDENT(S): <?php echo $ppl; ?></span>
    
</div>
<?php
       
       }else{
           echo "<center style='margin-top: 40px;'><span class='round confirmation-box'>No transaction record was found for this payment type within the supplied time constraint!</span></center>";
       } 
       }
   }
   }
