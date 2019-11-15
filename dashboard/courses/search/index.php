<?php
//dash-courses-search
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
          $dat = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
          $st = strtoupper(htmlentities($_POST['st'], ENT_QUOTES));
          $ex = explode("{:||:}", $dat['results']);
          $dc = [];
          if($dat['results'] != ""){
          foreach($ex as $rt){
              $gt = explode("//", $rt);
              if(($gt[2] == $dat['semester'] && $gt[3] == $dat['level']) || ($gt[4]+ $gt[5] > 40)){
                  array_push($dc, $gt[0]);
              }
          }
          }
          $stmt = $db->query('select * from courses where semester = "'.$dat['semester'].'" and code like "'.$st.'%"');
          $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($rows as $ro){
              if(!in_array($ro['id'], $dc)){
             ?>
<tr class='loade'>
                                                                    <td><?php echo $ro['code']; ?></td>
                                                                    <td><?php echo $ro['title']; ?></td>
                                                                    <td><?php echo $ro['units']; ?></td>
                                                                    <td><i id="reg_c<?php echo $ro['id']; ?>" onclick="reg_course('<?php echo $ro['id']; ?>', 'Y')" class="btn btn-default glyphicon glyphicon-ok <?php if($dat['level'] == "500" && $dat['semester'] == 2){ }else{ ?>disabled<?php } ?>"></i></td>
                                                                </tr>
<?php
          }
          }
      }  
    }

}