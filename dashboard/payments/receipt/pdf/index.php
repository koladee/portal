        <?php include '../../../../configs.php';
        define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
if (!IS_AJAX) {
    die('Restricted access');
}
$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) {
    die('Restricted access');
}
        if(isset($_SESSION['status'], $_SESSION['uniqid'])){
            
        if(isset($_FILES['file'])){
            if (isset($_FILES['file']) && $_FILES['file']['name'] !== "" && $_FILES['file']['size'] !== 0 && $_FILES['file']['size'] <= 2000000) {
            if (!preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $_FILES['file']['name'])) {
                if (in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)), array("jpeg", "jpg", "png"))) {
                    $rn = mt_rand(1, 100);
                    $stmt = $db->query('select * from users where uniqid = "'.$_SESSION['uniqid'].'" and status = "'.$_SESSION['status'].'"');
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
//        $dir = "../id080cards/".$dat['faculty']."/".$dat['department']."/".$dat['level']."/";
//        $ck = fopen($dir, "r");
//        if($ck == TRUE){
//           //directory exist 
//        }else{
//            //directory dose not exist, create it
//          $wr = fopen($dir, "w");  
//        }
        
        
        
                    $uploadir = "png/" ;
                    $_FILES['file']['name'] = $dat['uid']. "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    $filename = $_FILES['file']['name'];//."png";
                    $filePath = $uploadir . $filename;
                    unlink($filePath);
                   $km = move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
                    //update database here
             if($km){echo $filePath;}
                    
                }else {
            echo "Error! File format not supported.";
        }
            }else {
            echo "Error! THe name of your file contains disallowed characters.";
        }
        } else {
            echo "Error! File is invalid or it's size is larger than 2MB.";
        }
        

            }
        }else{
            $_SESSION['error'] = "You are not signed in!";
            header('location: ../');
        }