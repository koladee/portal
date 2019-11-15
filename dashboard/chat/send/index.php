<?php
//dash-chat
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
    if(isset($_POST['mid'], $_POST['rcvr'], $_POST['mes'])){
    if(!empty($_POST['mid'] && $_POST['rcvr'] && $_POST['mes'])){
     $mid = htmlentities($_POST['mid']);
     $mes = htmlentities($_POST['mes']);
     $rcvr = htmlentities($_POST['rcvr']);
     
  $st = $db->prepare("INSERT INTO messages(id, mes_id, sender, receiver, mes, status, date) VALUES(:id, :mes_id, :sender, :receiver, :mes, :status, :date)");
$do = $st->execute(array(':id' => "", ':mes_id'=> $mid, ':sender' => $_SESSION['uniqid'], ':receiver' => $rcvr, ':mes' => $mes, ':status' => "", ':date' => time()));

    }
    }
}