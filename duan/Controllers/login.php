<?php
require_once __DIR__ . '/../models/config.php';
require_once __DIR__ . '/../models/connectDB.php';
require_once __DIR__ . '/../models/User.php';

$db = new ConnectDB();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        $loggedInUser = $user->login($username, $password);

        if ($loggedInUser) {
            header('Location: ../views/home.html');  // Chuyển hướng đến trang chủ sau khi đăng nhập thành công
            exit();
        } else {
            echo "Đăng nhập thất bại.Vui lòng kiểm tra lại tên đăng nhập và mật khẩu";
        }
    } else {
        echo "Both username and password are required.";
    }
}
?>
