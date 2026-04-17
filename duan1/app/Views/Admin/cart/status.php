<?php include_once VIEW . "Admin/base/header.php" ?>
<link rel="stylesheet" href="Assets/Admin/Css/detail.css">
<div class="main">
    <h2>Chỉnh sửa trạng thái đơn hàng</h2>
    <div class="form">
    <form action="index.php?role=admin&act=UpdateOrderStatus" method="post">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" value="<?= $order['id'] ?>" readonly>

        <label for="status">Trạng thái:</label>
        <select id="status" name="status" required>
            <option value="pending" <?= $order['status'] == 'pending' ? 'selected' : '' ?>>Chờ</option>
            <option value="in transit" <?= $order['status'] == 'in transit' ? 'selected' : '' ?>>Đang giao hàng</option>
            <option value="completed" <?= $order['status'] == 'completed' ? 'selected' : '' ?>>Thành công</option>
            <option value="canceled" <?= $order['status'] == 'canceled' ? 'selected' : '' ?>>Đã Hủy</option>
        </select>

        <button type="submit">Cập nhật</button>
    </form>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
