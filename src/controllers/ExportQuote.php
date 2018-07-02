<?php
    header('Content-Type: application/text');
    header('Content-Disposition: attachment; filename="'.$_GET['title'].'_'.$_GET['author'].'.txt"');
    echo 'Title: ' . $_GET['title'] . PHP_EOL .
        'Quote: ' . $_GET['quote_text'] . PHP_EOL . 
        'Author: ' . $_GET['author'] . PHP_EOL
?>