<?php
    if(!isset($_SESSION['current_user_id'])) {
        http_response_code(401);
        $message = 'You have to be logged in to download quotes...';
        header('Location: ../views/Login.php?message=' . $message . '&status_code=401');
    }

    header('Content-Type: application/text');
    header('Content-Disposition: attachment; filename="'.$_GET['title'].'_'.$_GET['author'].'.txt"');
    echo 'Title: ' . $_GET['quote_text'] . PHP_EOL .
        'Quote: ' . $_GET['title'] . PHP_EOL . 
        'Author: ' . $_GET['author'] . PHP_EOL
?>