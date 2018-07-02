<?php
require_once "../libs/Startup.php";
Startup::_init(true);

use models\Quote;
use models\User;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    $message = 'Login to continue...';
 	header('Location: ../views/Login.php?message=' . $message . '&status_code=401');
} else {
    $current_user_id = $_SESSION['current_user_id'];
    $current_user_name = $_SESSION['current_user_username'];

    $quotes = Quote::getUserQuotes($current_user_id);
    $user = User::getUserByUsername($current_user_name);
    
	require_once('../views/Profile.php');
}
?>