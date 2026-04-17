<?php include_once VIEW . "Client/base/header.php" ?>
<link rel="stylesheet" href="Assets/Client/Css/Orders.css">
<main>
    <div class="orders-container">
        <h1>Đơn Hàng Của Tôi</h1>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Ngày Đặt Hàng</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Chi Tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php foreach ($orders as $order): ?>
                        <?php if ($_SESSION['user']['id'] == $order['user_id'] && $order['status'] !== "canceled" ): ?>
                            <tr>
                                <td>#<?= $order['id'] ?></td>
                                <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                <td><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= $order['status'] ?></td>
                                <td>
                                    <button class="detail-order-btn" onclick="toggleDetails(<?= $order['id'] ?>, this)">Xem</button>
                                    <?php if($order['status'] == "pending" ) : ?>
                                    <a style="text-decoration: none;" href="index.php?act=CancelOrder&id=<?= $order['id'] ?>" class="detail-order-btn" onclick="return confirmCancel()">Hủy đặt hàng</a>
                                    <?php endif ?>
                                    <div class="order-details" id="details-<?= $order['id'] ?>" style="display:none;">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>ID Sản Phẩm</th>
                                                    <th>Tên Sản Phẩm</th>
                                                    <th>Số Lượng</th>
                                                    <th>Giá</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($order['details'] as $detail): ?>
                                                    <tr>
                                                        <td><?= $detail['product_id'] ?></td>
                                                        <td><?= $detail['name'] ?></td>
                                                        <td><?= $detail['quantity'] ?></td>
                                                        <td><?= number_format($detail['price'], 0, ',', '.') ?> VNĐ</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center; color:red;">Vui lòng đăng nhập để xem đơn hàng của bạn</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        function toggleDetails(id, btn) {
            var details = document.getElementById("details-" + id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
                btn.textContent = "Đóng";
            } else {
                details.style.display = "none";
                btn.textContent = "Xem";
            }
        }
        function confirmCancel() {
            return confirm("Bạn chắc chắn muốn hủy đơn hàng này?");
        }
    </script>
</main>
<?php include_once VIEW . "Client/base/foot.php" ?>
