<?php include_once VIEW . "Admin/base/header.php" ?>
<style>
    .main {
    height: 800px;
    overflow-y: auto;
    margin-left: 1%;
}
</style>
<div class="main">
    <div class="option">
    </div>
    <div class="product-main">
    <div style="color: green;margin: 40px 50px 0px 50px;font-weight: 25;height: 10px;border-radius: 20px;"><?php if(isset($message) && $message != "") :?><?= $message ?><?php endif; ?></div>
        <div class="show_list" style="width: 97%; margin: 20px 0; border-collapse: collapse; margin-left: 2%;">
            <table style="width: 100%; border: 1px solid gray;">
            <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Bảng sản phẩm</h3>
                </div>
                <br>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Tên sản phẩm</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Ảnh</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Giá</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Mô tả ngắn</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Lượt xem</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Ngày tạo</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Trạng thái</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $value): ?>
                        <tr>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 50px;"><?= $value['id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 250px;"><?= $value['name'] ?></td>
                            <td style="background-color: #f8f8f8; text-align: left; border: 1px solid #ccc;width: 75px;"><img width="75px" src="<?= $value['image'] ?>" alt=""></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 200px;"><?= number_format($value['price'], 0, ',', '.') ?> VND</td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc; max-width: 290px; overflow: hidden;text-overflow: ellipsis;"><?= $value['description'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc; width: 100px;"><?= $value['view'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc; width: 150px;"><?= date('d/m/Y', strtotime($value['created_at'])) ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc; width: 150px;">
                                <?= ($value['status'] == 'active') ? 'Active' : 'Inactive' ?>
                            </td>
                            <td style="width: 130px; background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;">
                                <a href="index.php?role=admin&act=UpdateProductForm&id=<?= $value['id'] ?>"><input style="margin-left: 5px; width: 35px; height: 25px;" type="button" value="Sửa"></a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" 
   href="index.php?role=admin&act=DeleteProduct&id=<?= $value['id'] ?>">
   <input style="margin-left: 5px; width: 35px; height: 25px;" type="button" value="Xóa">
</a>

                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
