<?php include_once VIEW . "Admin/base/header.php"; ?>
<style>
    .main {
        overflow: auto;
    }
    .product-info {
        width: 90%;
        margin: 50px auto;
        background: #fff;
        padding: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .product-info img {
        max-width: 250px;
        max-height: 300px;
        border: 3px solid gray;
        border-radius: 3px;
        padding: 2px;
    }
</style>

<div class="main">
    <div class="product-main">
        <div class="add_product">
            <div class="product-info">
                <h3 style="text-align: center; color: red;">Xóa Sản Phẩm</h3>
                
                <?php if ($hasActiveOrders): ?>
                    <div style="padding: 15px; margin-bottom: 15px; background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; border-radius: 4px; text-align: center;">
                        <strong>⚠️ CẢNH BÁO:</strong> Sản phẩm này có <strong><?= $totalOrders ?></strong> đơn hàng<br>
                        Hiện tại có <strong>đơn hàng đang hoạt động</strong> (chờ xử lý/đang giao/đã xác nhận)
                        <br><br>
                        Vui lòng <strong>hủy hoặc hoàn thành</strong> các đơn hàng trước khi xóa sản phẩm
                    </div>
                <?php else: ?>
                    <p style="text-align: center; color: #555;">Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
                    <?php if ($totalOrders > 0): ?>
                        <div style="padding: 10px; margin-bottom: 15px; background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; border-radius: 4px; text-align: center;">
                            ℹ️ Sản phẩm này có <strong><?= $totalOrders ?></strong> đơn hàng đã hoàn thành/hủy. Dữ liệu đơn hàng sẽ được giữ lại.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <!-- Hiển thị thông tin sản phẩm -->
                <div style="background: #f9f9f9; padding: 15px; border-radius: 4px; margin: 20px 0;">
                    <div style="display: flex; gap: 20px;">
                        <div>
                            <?php if (!empty($product['image']) && file_exists($product['image'])): ?>
                                <img src="<?= htmlspecialchars($product['image']) ?>" alt="Sản phẩm">
                            <?php else: ?>
                                <p style="color: #999;">Không có ảnh</p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p><strong>Tên:</strong> <?= htmlspecialchars($product['name']) ?></p>
                            <p><strong>Giá:</strong> <?= number_format($product['price']) ?> VNĐ</p>
                            <p><strong>Danh mục:</strong> <?= htmlspecialchars($product['cate_name']) ?></p>
                            <p><strong>ID:</strong> <?= htmlspecialchars($product['id']) ?></p>
                        </div>
                    </div>
                </div>

                <form action="index.php?role=admin&act=DeleteProductAction&id=<?= $product['id'] ?>" method="POST" style="margin-top: 30px; text-align: center;">
                    <?php if (!$hasActiveOrders): ?>
                        <button type="submit" style="height: 40px; width: 49%; padding: 10px; color: #fff; background-color: red; border: none; border-radius: 4px; cursor: pointer;">
                            Xác nhận xóa
                        </button>
                    <?php else: ?>
                        <button type="submit" style="height: 40px; width: 49%; padding: 10px; color: #fff; background-color: #ccc; border: none; border-radius: 4px; cursor: not-allowed;" disabled>
                            Không thể xóa
                        </button>
                    <?php endif; ?>
                    <a href="index.php?role=admin&act=Product" style="height: 40px; width: 49%; text-decoration: none; text-align: center; display: inline-block; padding: 10px; color: #fff; background-color: gray; border-radius: 4px;">
                        Hủy
                    </a>
                </form>

                <?php if (isset($message) && !empty($message)): ?>
                    <div style="padding: 10px; margin-top: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; text-align: center;">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW . "Admin/base/footer.php"; ?>
