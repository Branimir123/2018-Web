<?php
require_once "../libs/Startup.php";
Startup::_init(true);

use models\Quote;
use models\User;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    $message = 'Login to view the quotes. Login or register to continue...';
 	header('Location: ../views/Login.php?message=' . $message . '&status_code=401');
} else {
    $quotes = Quote::getMostLiked();
	
	require_once('../views/QuotesList.php');
}
?>