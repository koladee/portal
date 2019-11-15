<?php
//dash-chat-notiz
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
    $stmt = $db->query('select id from messages where receiver = "'.$_SESSION['uniqid'].'" and status = "'.''.'" and mes != ""');
    $m = $stmt->rowCount();
    echo $m;
    
}

