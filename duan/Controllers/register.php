<?php
require_once __DIR__ . '/../models/config.php';
require_once __DIR__ . '/../models/connectDB.php';
require_once __DIR__ . '/../models/User.php';

$db = new ConnectDB();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  // Kiểm tra email hợp lệ
            if ($user->register($username, $email, $password)) {
                header('Location: ../views/login.html');  // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
                exit();
            } else {
                echo "Registration failed. Please try again.";
            }
        } else {
            echo "Invalid email format.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
