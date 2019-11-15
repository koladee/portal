<?php 
include '../../configs.php';
unset($_SESSION['username'], $_SESSION['uniqid']);
@session_destroy();
header('location: ../../');