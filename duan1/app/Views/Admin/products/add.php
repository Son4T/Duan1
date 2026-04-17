<?php include_once VIEW . "Admin/base/header.php" ?>
<style>
    .main {
    height: 800px;
    overflow-y: auto;
    margin-left: 75px;
}
</style>
<div class="main">
    <div class="option">

    </div>
    <div class="product-main">
        <div class="add_product">
            <div style="width: 90%; margin-top: 50px;margin-left: 40px; background: #fff; padding: 25px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h3 style="text-align: center; color: #333;">Thêm Sản Phẩm</h3>
                <form method="POST" action="index.php?role=admin&act=StorageProduct" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                    <label for="name" style="margin-bottom: 10px; color: #555;">Danh mục Sản Phẩm:</label>
                    <select name="id_cate" id="id_cate" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                        <option value="0">Chọn danh mục</option>
                        <?php 
                        $key_type = $_GET['product_type'];
                        foreach ($categories as $values): 
                            if($values['type'] == $key_type):?>
                            <option value="<?= $values['id'] ?>"><?=$values['cate_name'] ?></option>
                        <?php endif;
                    endforeach; ?>
                    </select>
                    <input type="hidden" value="<?= $key_type ?>" name="type" id="">
                    <label for="name" style="margin-bottom: 10px; color: #555;">Tên Sản Phẩm:</label>
                    <input type="text" id="name" name="name" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <label for="price_product" style="margin-bottom: 10px; color: #555;">Giá Sản Phẩm:</label>
                    <input type="number" id="price_product" name="price" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <label for="img_src_product" style="margin-bottom: 10px; color: #555;">Chọn ảnh sản phẩm:</label>
                    <input type="file" id="img_src_product" name="image" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <label for="descrip_product" style="margin-bottom: 10px; color: #555;">mô tả ngắn::</label>
                    <textarea id="descrip_product" name="content" style="height: 100px;padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required></textarea>
                    <label for="descrip_product" style="margin-bottom: 10px; color: #555;">Mô tả sản phẩm:</label>
                    <textarea id="descrip_product" name="description" style="height: 100px;padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required></textarea>
                    <div style="width: 100%; text-align: center;">
                        <input type="submit" name="sbm_add_product" value="Thêm" style="height: 40px;width: 49%;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;">
                        <a class="sbm_slist_product" style="height: 40px;text-decoration: none;text-align: center;display: inline-block;width: 49%;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;" href="index.php?act=listsp">Xem sản phẩm</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
