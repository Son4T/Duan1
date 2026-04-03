<?php include_once VIEW . "Admin/base/header.php" ?>
<link rel="stylesheet" href="Assets/Admin/Css/bestselling.css">
<main>
<h1>Sản Phẩm Bán Chạy</h1>
    <div class="container">
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng Đã Bán</th>
                    <th>Hình Ảnh</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= htmlspecialchars($product['total_sold']) ?></td>
                        <td><img src="<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include_once VIEW . "Admin/base/footer.php" ?>
