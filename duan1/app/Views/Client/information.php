<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: auto;
        background: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .navigation {
        width: 30%;
    }

    .navigation ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .navigation ul li {
        margin: 10px 0;
    }

    .navigation ul li a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
        display: block;
        padding: 10px;
        background: #f4f4f4;
        border-radius: 4px;
        transition: background 0.3s, color 0.3s;
    }

    .navigation ul li a:hover {
        background: #007bff;
        color: #fff;
    }

    .account-info {
        width: 70%;
    }

    .account-info h2 {
        margin-top: 0;
        color: #333;
    }

    .info-item {
        margin: 10px 0;
        color: #555;
    }

    .info-item label {
        display: block;
        margin-bottom: 5px;
    }

    .info-item input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<?php include_once VIEW . "Client/base/header.php" ?>

<div class="container">
    <div class="navigation">
        <ul>
            <li><a href="index.php?act=Order">Đơn Hàng Của tôi</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="index.php?act=ChangeInforForm&id=<?= $_SESSION['user']['id'] ?>">Sửa Thông Tin</a></li>
                <?php if ($_SESSION['user']['role'] == "admin") : ?>
                    <li><a href="<?= ADMIN_URL ?>">Trang Quản trị</a></li>
                <?php endif; ?>
                <li><a href="index.php?act=Logout">Đăng xuất</a></li>
            <?php else: ?>
                <li><a href="index.php?act=Login">Đăng nhập</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="account-info">
        <h2>Thông tin tài khoản</h2>
        <?php if (isset($_SESSION['user'])): ?>
            <div class="info-item">
                <label for="fullname">Họ tên:</label>
                <input type="text" id="fullname" value="<?= htmlspecialchars($_SESSION['user']['fullname']) ?>" readonly>
            </div>
            <div class="info-item">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" value="<?= htmlspecialchars($_SESSION['user']['phone']) ?>" readonly>
            </div>
            <div class="info-item">
                <label for="email">Email:</label>
                <input type="text" id="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly>
            </div>
            <div class="info-item">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" value="<?= htmlspecialchars($_SESSION['user']['address']) ?>" readonly>
            </div>
            <div class="info-item">
                <label for="created_at">Ngày Tạo:</label>
                <input type="text" id="created_at" value="<?= date('d/m/Y', strtotime($_SESSION['user']['created_at'])) ?>" readonly>
            </div>
        <?php else: ?>
            <p>Bạn chưa đăng nhập. Vui lòng <a href="index.php?act=Login">đăng nhập</a>.</p>
        <?php endif; ?>
    </div>
</div>

<?php include_once VIEW . "Client/base/foot.php" ?>
