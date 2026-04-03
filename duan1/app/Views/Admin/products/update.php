<?php include_once VIEW . "Admin/base/header.php" ?>
<style>
    .main{
        overflow: auto;
    }
</style>
<div class="main">
    <div class="option">
    </div>
    <div class="product-main">
        <div class="add_product">
            <div style="width: 90%; margin-top: 50px;margin-left: 40px; background: #fff; padding: 25px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h3 style="text-align: center; color: #333;">Sửa Sản Phẩm</h3>
                <form action="index.php?role=admin&act=UpdateProduct&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                    <!-- Dropdown Category -->
                    <select name="category_id" id="id_cate" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                        <option value="" disabled selected>Chọn danh mục sản phẩm</option>
                        <?php foreach ($categories as $values): ?>
                            <option value="<?= htmlspecialchars($values['id']) ?>"
                                <?= isset($product['category_id']) && $product['category_id'] == $values['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($values['cate_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Hidden Fields -->
                    <input type="hidden" name="type" value="<?= $product['type'] ?>">
                    <input type="hidden" name="old_img" value="<?= $product['image'] ?>">

                    <!-- Product Name -->
                    <label for="name" style="margin-bottom: 10px; color: #555;">Tên Sản Phẩm:</label>
                    <input type="text" id="name" value="<?= $product['name'] ?>" name="name" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">

                    <!-- Product Price -->
                    <label for="price" style="margin-bottom: 10px; color: #555;">Giá Sản Phẩm:</label>
                    <input type="number" id="price" value="<?= $product['price'] ?>" name="price" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">

                    <!-- Product Image -->
                    <label for="image" style="margin-bottom: 10px; color: #555;">Chọn ảnh sản phẩm:</label>
                    <input type="file" id="image" name="Uimg_src_product" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                    <div style="border: 3px solid gray;width: 250px;height: 300px;border-radius: 3px;">
                        <img style="height: 100%;width: 100%;padding: 2px;" src="<?= $product['image'] ?>" alt="">
                    </div>

                    <!-- Product Short Description -->
                    <label for="content" style="margin-bottom: 10px; color: #555;">Mô tả ngắn:</label>
                    <textarea id="content" name="content" style="height: 100px;padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;"><?= $product['content'] ?></textarea>

                    <!-- Product Full Description -->
                    <label for="description" style="margin-bottom: 10px; color: #555;">Mô tả chi tiết sản phẩm:</label>
                    <textarea id="description" name="description" style="height: 100px;padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;"><?= $product['description'] ?></textarea>

                    <!-- Product Status -->
                    <label for="status" style="margin-bottom: 10px; color: #555;">Trạng thái:</label>
                    <select name="status" id="status" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;" required>
                        <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                        <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Không kích hoạt</option>
                    </select>

                    <!-- Submit and Cancel Buttons -->
                    <div style="width: 100%; text-align: center;">
                        <input type="submit" name="sbm_update_product" value="Lưu" style="height: 40px;width: 49%;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;">
                        <a class="sbm_slist_product" href="index.php?role=admin&act=Product" style="height: 40px;width: 49%;text-decoration: none;text-align: center;display: inline-block;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;">Xem sản phẩm</a>
                    </div>
                    <h4 style="color: red;margin-top: 20px;text-align: center;">
                        <?= isset($message) ? htmlspecialchars($message) : '' ?>
                    </h4>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
