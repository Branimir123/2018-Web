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

	if($quote->getAuthorId() == $current_user) {
		$quote->delete($quote->getId());
		header('Location: ../controllers/GetAllQuotes.php');
	} else {
        header('Location: ../controllers/GetAllQuotes.php');
    }
}
?>