<?php
require_once 'models/connectDB.php';
require_once 'models/User.php';

// Kết nối cơ sở dữ liệu
$db = new ConnectDB();

$user = new User($db);

// Kiểm tra kết nối thành công và chuyển hướng đến trang đăng ký
if ($db->PDO) {
    header('Location: views/login.html');   
    exit();
}

// Điều hướng yêu cầu đến các controller tương ứng
$page = isset($_GET['page']) ? $_GET['page'] : '';

switch($page) {
    case 'register':
        require 'views/register.html';
        break;
    case 'login':
        require 'views/login.html';
        break;
    default:
        echo 'Welcome to Billiard Accessories Store! <br>';
        echo '<a href="?page=register">Register</a> | <a href="?page=login">Login</a>';
}
?>
