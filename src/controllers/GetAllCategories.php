<?php
require_once "../libs/Startup.php";
Startup::_init(true);

use models\Category;
use models\User;

if(!isset($_SESSION['current_user_id'])) {
    http_response_code(401);
} else {
    $categories = Category::getAllCategories();
}
?>