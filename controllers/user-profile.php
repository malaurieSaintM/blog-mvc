<?php
if(!isset($_SESSION['user']) OR $_SESSION['user']['is_admin'] == 1){
    header('location: index.php');
    exit;
}
if (isset($_SESSION['user']['message'])){
    unset($_SESSION['user']['message']);
}
require_once('../models/user-profile.php');
if (isset($_POST['updtProfile'])){
    $arrayMsg = profileUpdt();
    $success = $arrayMsg[0];
    $message = $arrayMsg[1];
}
$updtUser = profileRecup();
require_once('../views/user-profile.php');