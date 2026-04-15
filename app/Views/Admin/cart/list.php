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
        <div style="color: green;margin: 40px 50px 0px 50px;font-weight: 25;height: 50px;border-radius: 20px;">
            <?php if(isset($message) && $message != "") : ?><?= $message ?><?php endif; ?>
        </div>
        <div class="show_list" style="width: 97%; margin: 20px 0; border-collapse: collapse; margin-left: 2%;">
            <table style="width: 100%; border: 1px solid gray;">
                <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Đơn Hàng</h3>
                </div>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">User ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Status</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Payment Method</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Total Price</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Created At</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $order['id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $order['user_id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $order['status'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $order['payment_method'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= number_format($order['total_price']) ?> VNĐ</td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $order['created_at'] ?></td>
                            <td style="width: 200px; background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;">
                                <a href="index.php?role=admin&act=OrderDetail&id=<?= $order['id'] ?>"><input style="margin-left: 5px; width: 50px; height: 25px;" type="button" value="chi tiết"></a>
                                <a href="index.php?role=admin&act=OrderStatus&id=<?= $order['id'] ?>"><input style="margin-left: 5px; width: 100px; height: 25px;" type="button" value="Trạng thái"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
