<?php include_once VIEW . "Client/base/header.php" ?>
<link rel="stylesheet" href="Assets/Client/Css/checkOut.css">
<div class="container">
        <div class="recipient-info">
            <h2>Thông tin người nhận</h2>
            <form action="index.php?act=CheckOut" method="post" id="checkout-form">
                <label for="fullname">Họ và tên:</label>
                <input type="text" id="fullname" value="<?= $user['fullname'] ?>" name="fullname" required>
                
                <label for="phone">Số điện thoại:</label>
                <input type="tel" id="phone" value="<?= $user['phone'] ?>" name="phone" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" value="<?= $user['email'] ?>" name="email" required>
                
                <label for="address">Địa chỉ giao hàng:</label>
                <textarea id="address" name="address" required><?= $user['address'] ?></textarea>

                <input type="hidden" name="id" value="<?= $user['id'] ?>" id="">

                <label for="payment-method">Chọn phương thức thanh toán:</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="cash">Thanh toán khi nhận hàng</option>
                    <option value="bank">Chuyển khoản ngân hàng</option>
                </select>
            </form>
        </div>
        <div class="cart-info">
            <h2>Thông tin giỏ hàng</h2>
            <br>
            <div class="cart-details">
                <ul>
                    <?php foreach($carts as $cart) : ?>
                    <li><?= $cart['name'] ?> : <?= number_format($cart['price'] * $cart['quantity']) ?> VND</li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="checkout-action">
                <p>Tổng tiền: <?= number_format($sumPrice) ?></p>
                <br>
                <button type="submit" form="checkout-form" class="checkout-btn">Thanh toán</button>
            </div>
        </div>
    </div>
<?php include_once VIEW . "Client/base/foot.php" ?>
