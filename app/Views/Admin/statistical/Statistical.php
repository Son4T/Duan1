<?php include_once VIEW . "Admin/base/header.php" ?>
<link rel="stylesheet" href="Assets/Admin/Css/statistics.css">
<main>
    <div class="stats-grid">
        <div class="stat-card">
            <h2>Tổng Đơn Hàng</h2>
            <p class="stat-value"><?= htmlspecialchars($totalOrders) ?></p>
        </div>
        <div class="stat-card">
            <h2>Doanh Thu</h2>
            <p class="stat-value"><?= number_format($totalRevenue, 0, ',', '.') ?> VNĐ</p>
        </div>
        <div class="stat-card">
            <h2>Số Lượng Người Dùng</h2>
            <p class="stat-value"><?= htmlspecialchars($totalUsers) ?></p>
        </div>
        <div class="stat-card">
            <h2>Số Lượng Sản Phẩm</h2>
            <p class="stat-value"><?= htmlspecialchars($totalProducts) ?></p>
        </div>
    </div>
</main>
<?php include_once VIEW . "Admin/base/footer.php" ?>
