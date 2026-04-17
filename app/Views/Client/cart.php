<?php include_once VIEW . "Client/base/header.php" ?>
<link rel="stylesheet" href="Assets/Client/Css/cart.css">

<div class="container">
    <div class="product-list">
        <h2>Sản phẩm trong giỏ hàng</h2>
        <form action="index.php?act=Cart" method="post">
            <?php if (!empty($carts)): ?>
                <?php foreach($carts as $key => $cart) : ?>
                <div class="product">
                    <img src="<?= $cart['image'] ?>" alt="<?= $cart['name'] ?>">
                    
                    <div class="product-info">
                        <h3><?= $cart['name'] ?></h3>
                        <p>Giá: <?= number_format($cart['price']) ?> VNĐ</p>
                        Số lượng: 
                        <input type="number" style="width: 60px;" 
                               value="<?= $cart['quantity'] ?>" 
                               name="quantities[<?= $key ?>]" min="1">
                        <br>
                        Thành tiền: <?= number_format($cart['price'] * $cart['quantity']) ?> VNĐ
                    </div>

                    <!-- nút xóa nằm riêng sang phải -->
                    <a href="index.php?act=DeleteInCart&id=<?= $key ?>" class="remove-btn">Xóa</a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Giỏ hàng của bạn đang trống.</p>
            <?php endif; ?>
    </div>

    <div class="cart-details">
        <h2>Thông tin giỏ hàng</h2>
        <br>
        <div class="cart-summary">
            <div class="upper-section">
                <?php if (!empty($carts)): ?>
                    <ul>
                    <?php foreach($carts as $cart) : ?>
                        <li><?= $cart['name'] ?>: <?= number_format($cart['price'] * $cart['quantity']) ?> ₫</li>
                    <?php endforeach; ?>
                    </ul>
                    <br>
                    <p>Tổng sản phẩm: <?= count($carts) ?></p>
                    <p class="total-price">Tổng tiền: <?= number_format($sumPrice, 0, ',', '.') ?> VNĐ</p>
                    <button type="submit" formaction="index.php?act=CheckOutForm" class="checkout-btn">Thanh toán</button>
                    <button type="submit" formaction="index.php?act=UpdateCart" class="update-btn">Cập nhật</button>
                <?php else: ?>
                    <p>Không có sản phẩm nào trong giỏ hàng.</p>
                <?php endif; ?>
            </div>
            <div class="lower-section"></div>
        </div>
    </div>
        </form>
</div>

<?php include_once VIEW . "Client/base/foot.php" ?>
