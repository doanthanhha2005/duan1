<?php
require_once __DIR__ . '/../models/config.php';
require_once __DIR__ . '/../models/connectDB.php';
require_once __DIR__ . '/../models/Products.php';

$db = new ConnectDB();
$productModel = new Product($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'search') {
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $products = $productModel->searchProducts($keyword);
} else {
    $products = $productModel->getAllProducts();
}

require_once __DIR__ . '/../views/productList.php';
?>
