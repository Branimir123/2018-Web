<?php
require_once "../libs/Startup.php";

Startup::_init(true);

use helpers\Validator;
use models\Quote;

$quote_text = htmlspecialchars($_POST['quote_text']);
$title = htmlspecialchars($_POST['title']);
$category_id = $_POST['category_id'];
$real_author = htmlspecialchars($_POST['real_author']);

$is_text_valid = Validator::exists($quote_text);
$is_title_valid = Validator::exists($title);
$is_author_valid = Validator::exists($real_author);
$is_category_id_valid = Validator::exists($category_id);

session_start();

if (!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can create quotes.", 401);
    echo json_encode($error);
}

if (!$is_text_valid || !$is_title_valid || !$is_author_valid || !$is_category_id_valid) {
    header('Location: ../views/CreateQuote.php?title=' . json_encode($is_title_valid) . '&text=' . json_encode($is_text_valid) . '&author=' . json_encode($is_author_valid));
} else {
    $user_id = $_SESSION['current_user_id'];
    $quote = Quote::create($title, $quote_text, $user_id, $real_author, $category_id);

    try {
        $id = $quote->insert();
        header('Location: ./GetQuote.php?id=' . $id);
    } catch (Exception $ex) {
        echo $ex;
    }
}