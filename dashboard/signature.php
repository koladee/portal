        <?php include '../configs.php'; 
        if(isset($_FILES['file'])){
            if (isset($_FILES['file']) && $_FILES['file']['name'] !== "" && $_FILES['file']['size'] !== 0 && $_FILES['file']['size'] <= 2000000) {
            if (!preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $_FILES['file']['name'])) {
                if (in_array(strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION)), array("jpeg", "jpg", "png"))) {
                    $rn = mt_rand(1, 100);
                    $uploadir = "../im12sign784345/";
                    $_FILES['file']['name'] = $rn . time() . "." . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                    $filename = $_FILES['file']['name'];
                    $filePath = $uploadir . $filename;
                    $stmt = $db->query('select signature from users where uniqid="'.$_SESSION['uniqid'].'"');
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dat = $rows[0];
    $wr = $dat['signature'];
                    if($wr != "" ){
                        unlink("../".$wr);
                    }
                    $db->query('update users set signature="im12sign784345/'.$filename.'" where uniqid="'.$_SESSION['uniqid'].'"');
                    move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
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