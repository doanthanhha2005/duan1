<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <form action="productController.php" method="get">
        <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
        <button type="submit" name="action" value="search">Tìm kiếm</button>
    </form>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Giá: <?php echo htmlspecialchars($product['price']); ?> VND</p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
