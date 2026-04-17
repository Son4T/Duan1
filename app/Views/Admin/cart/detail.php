<?php include_once VIEW . "Admin/base/header.php" ?>
<style>
        .main {
    height: 800px;
    overflow-y: auto;
}
</style>
<div class="main">
    <div class="option">
    </div>
    <div class="product-main">
        <div style="color: green; margin: 40px 50px 0px 50px; font-weight: 25; height: 50px; border-radius: 20px;">
            <?php if(isset($message) && $message != "") : ?><?= $message ?><?php endif; ?>
        </div>
        <div class="show_list" style="width: 97%; margin: 20px 0; border-collapse: collapse; margin-left: 2%;">
            <!-- Bảng chi tiết đơn hàng -->
            <table style="width: 100%; border: 1px solid gray;">
                <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Chi Tiết Đơn Hàng</h3>
                </div>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Order ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Product ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Price</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetail as $detail) : ?>
                        <tr>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $detail['id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $detail['order_id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $detail['product_id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= number_format($detail['price']) ?> VNĐ</td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $detail['quantity'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
