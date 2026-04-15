<?php include_once VIEW . "Admin/base/header.php" ?>
<style>
    .main {
    height: 800px;
    overflow-y: auto;
    margin-left: 75px;
}
</style>
<div class="main">
    <div class="product-main">
        <div style="color: green;margin: 40px 50px 0px 50px;font-weight: 25;height: 10px;border-radius: 20px;"><?php if(isset($message) && $message != "") :?><?= $message ?><?php endif; ?></div>

        <div class="show_list" style="width: 90%; margin: 20px 0; border-collapse: collapse;margin-left: 2%;">
            <table style="width: 100%; border: 1px solid gray;">
            <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Bảng Danh Mục</h3>
                </div>
                <br>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Tên danh mục</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Loại danh mục</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $value) : ?>
                        <tr>
                            <td style="background-color: #f8f8f8;padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['id'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['cate_name'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['type'] ?></td>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 130px;">
                                <a href="index.php?role=admin&act=Edit&id=<?= $value['id'] ?>"><input style="width: 50px;height: 25px;" type="button" value="Sửa"></a>
                                <a href="index.php?role=admin&act=DeleteCategory&id=<?= $value['id'] ?>" onclick="return confirm('bạn có muốn xóa?')"><input style="width: 50px;height: 25px;" type="button" value="Xóa"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>