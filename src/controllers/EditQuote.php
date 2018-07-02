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

    $quote_id = htmlspecialchars($_POST['id']);
    $quote_text = htmlspecialchars($_POST['quote_text']);
    $title = htmlspecialchars($_POST['title']);
    $category_id = $_POST['category_id'];
    $real_author = $_POST['real_author'];

    $quote = Quote::getById($quote_id);
	if($quote->getAuthorId() == $current_user) {
        $quote->edit($quote_id, $quote_text, $title, $real_author, $category_id);

		header('Location: ../controllers/GetQuote.php?id=' . $quote_id);
	} else {
        header('Location: ../controllers/GetQuote.php?id=' . $quote->getId());
    }
}
?>