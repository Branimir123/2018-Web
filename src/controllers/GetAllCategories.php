<?php
require_once "../libs/Startup.php";
Startup::_init(true);

use models\Category;
use models\User;

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
    $message = 'You have to be logged in to download quotes...';
    header('Location: ../views/Login.php?message=' . $message . '&status_code=401');
} else {
    $categories = Category::getAllCategories();
}
?>