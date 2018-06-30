<?php
require_once "../libs/Startup.php";
Startup::_init(true);

use models\Quote;
use models\User;

session_start();

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
} else {
	$current_user = $_SESSION['current_user_id'];
	
	$quote_id = $_GET['id'];
	$quote = Quote::getById($quote_id);

	if($quote->getTitle() && $quote->getQuoteText()) {
		$quote->like();
		header('Location: ../controllers/GetAllQuotes.php');
	} else {
		http_response_code(500);
	}
}
?>