<?php
require_once "../libs/Startup.php";

Startup::_init(true);

use helpers\Validator;
use models\Quote;

$quote_text = $_POST['quote_text'];
$title = $_POST['title'];

$is_text_valid = Validator::exists($quote_text);
$is_title_valid = Validator::exists($title);

session_start();
if (!isset($_SESSION['current_user_id'])) {
    $error = new Error("Only authorized users can create quotes.", 401);
    echo json_encode($error);
}
if (!$is_text_valid || !$is_title_valid) {
    header('Location: ../views/CreateQuote.php?address=' . json_encode($is_address_valid) . '&city=' . json_encode($is_city_valid) . '&date=' . json_encode($is_date_valid) . '&title=' . json_encode($is_title_valid));
} else {
    $user_id = $_SESSION['current_user_id'];
    $quote = Quote::create($title, $quote_text, $user_id);

    try {
        $quote->insert();
        header('Location: ./GetAllQuotes.php');
    } catch (Exception $ex) {
        http_response_code(500);
        header('Location: ../views/Error.php?message=Server error.&status_code=500');
    }
}