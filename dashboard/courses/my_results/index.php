<?php
//dash-courses-my_results
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
$stmt = $db->query('select * from courses where id = "'.$st.'"');
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dat = $row[0];
?>
<div class="col-lg-12">
    <div class="col-sm-12">
    <?php
if($dat['results'] != ""){
    ?>
    
<table class="table">
						
							<thead>
						
								<tr>
									
                                                                    <th style="width: 15%;">Matric Number</th>
									<th style="width: 60%;">Name</th>
                                                                        <th style="width: 15%;">CA</th>
									<th style="width: 10%;">Exam</th>
									<th style="width: 10%;">Total</th>
								</tr>
							
                                                        </thead>
                                                        <tbody>
        <?php
require_once '../../../reader/simplexlsx.class.php';

if ( $xlsx = SimpleXLSX::parse('../../../'.$dat['results'])) {
	 $lt = $xlsx->rows();
         $lm = count($lt);
         $dk = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'"')->fetchAll(PDO::FETCH_ASSOC)[0];
         for($i = 1; $i < $lm; $i++){
             $yt = $db->query('select * from users where uid = "'.$lt[$i][0].'" and status = "student" and results like "%'.$st.'//'.$dk['present_session'].'//'.$dat['semester'].'//%"');
             if($yt->rowCount() == 1){
                 $tr = $yt->fetchAll(PDO::FETCH_ASSOC)[0];
                 $br = explode("{:||:}", $tr['results']);
                 $lim = count($br);
                 for ($t = 0; $t < $lim; $t++){
                     $bv = explode("//", $br[$t]);
                     if($bv[0] == $st){
                         $bv[4]= $lt[$i][1];
                         $bv[5]= $lt[$i][2];
                         $jh =  implode("//", $bv);
                   $br[$t] = $jh;
                         break;
                     }else{
                        $jh =  implode("//", $bv);
                   $br[$t] = $jh; 
                     }
                   
                 }
                 $rf = implode("{:||:}", $br);
              $ok =   $db->query('update users set results = "'.$rf.'" where uniqid = "'.$tr['uniqid'].'" ');
                 if($ok){
         ?>
           <tr>
									
									<td style="width: 15%;"><?php echo $lt[$i][0]; ?></td>
									<td style="width: 60%; text-transform: capitalize;"><?php echo $tr['firstname']." ".$tr['middlename']." ".$tr['lastname']; ?></td>
                                                                        <td style="width: 15%;"><?php echo $lt[$i][1]; ?></td>
                                                                        <td style="width: 10%;"><?php echo $lt[$i][2]; ?></td>
                                                                        <td style="width: 10%;"><?php echo $lt[$i][1]+$lt[$i][2]; ?></td>
								</tr>  
             
                 <?php } } }
	
} else {
	echo SimpleXLSX::parse_error();
} ?>
                                                        </tbody>
</table>
<?php }
?>
        
    </div>
<form id="my_ress" class="col-sm-12" >
 <div class="form-group ">
     <input type="hidden" value="<?php echo $dat['id']; ?>" name="dd" />
                          <label for="image" style="color:rgba(19, 35, 47, 0.9); text-transform: uppercase;">UPLOAD RESULT FOR <?php echo $dat['code']; ?></label>
                          <input style="width: 100%;" id="input-5" type="file" data-show-upload="false" data-show-remove="false" class="file-loading" accept="file" name="result">
                      </div>
    <div style="margin-top: 10%;">
  <div id='up_result_bt' style='margin-top: 5%; display: inline;'><button type="submit" class='btn btn-primary glyphicon glyphicon-cloud-upload' > Upload</button></div>
    <a href="../test.xlsx" target="_blank" style="display: inline; float: right;" class='btn btn-primary glyphicon glyphicon-cloud-download'> Download Excel Format</a>
    </div>
</form>
</div>
<script>
      $("#input-5").fileinput({
            theme: "explorer",
            //uploadUrl: "#",
            allowedFileExtensions: ['xlsx', 'csv'],
            overwriteInitial: false,
            initialPreviewAsData: true

        }); 
        
        
         $("form#my_ress").submit(function(event){
 $("#up_result_bt").html("<div class='lds-roller'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>");
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
$.ajax({
    url: 'courses/my_results/',
    dataType: 'text',
    async: false,
    cache: false,
    processData: false,
    contentType: false,
    data: formData,
    type: 'POST',
    success: function (data){
        alert(data);
    
        setTimeout(function(){my_results('<?php echo $st; ?>');}, 2000);
    }
});
         });  
        
        
//        function show_bt(){
//     var pt = "";
//     $("#put-my_results").append(pt);
// }
       </script>
<?php    }
    
      }elseif(isset ($_POST['dd'], $_FILES['result'])){
          $stmt = $db->query('select results from courses where id="'.$_POST['dd'].'" and lecturers like "'.$_SESSION['uniqid'].'%"');
          if($stmt->rowCount() == 1){
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if( !empty($_POST['dd']) && $_FILES['result']['size'] > 0){
           if (isset($_FILES['result']) && $_FILES['result']['name'] !== "" && $_FILES['result']['size'] !== 0 && $_FILES['result']['size'] <= 2000000) {
            if (!preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $_FILES['result']['name'])) {
                if (in_array(strtolower(pathinfo($_FILES['result']['name'], PATHINFO_EXTENSION)), array("xlsx", "csv"))) {
                    $rn = mt_rand(1, 100);
                    $uploadir = "../../../re768ss/";
                    $_FILES['result']['name'] = $rn . time() . "." . pathinfo($_FILES['result']['name'], PATHINFO_EXTENSION);
                    $filename = $_FILES['result']['name'];
                    $filePath = $uploadir . $filename;
        $dat = $rows[0];
    $wr = $dat['results'];
                    if($wr != "" ){
                        unlink("../../../".$wr);
                    }
                    $db->query('update courses set results="re768ss/'.$filename.'" where id="'.$_POST['dd'].'"');
                 $do =  move_uploaded_file($_FILES['result']['tmp_name'], $filePath);
                 if($do){
                  echo "Result successfully uploaded."   ;
                 }else{
                     echo "Oops! An error occured while uploading this result!!!";
                 }
                }else {
            echo "Error! File format not supported.";
        }
            }else {
            echo "Error! THe name of your file contains disallowed characters.";
        }
           }else{
               echo "Error! File is invalid or it's size is larger than 2MB.";
            
           }
        } else {
            echo "No file was selected!!!";  
        }
          }else{
              echo "Oops! You are not authorised to upload the result for this course!!!";
          }
      }
      }