<?php include_once VIEW . 'Admin/base/header.php'; ?>
<style>
    .main{
        height: 700px;
    }
</style>
<div class="main">
    <div class="option">
    </div>
    <div class="product-main">  
        <div class="add_category">
            <div style="width: 90%; margin: 50px auto; background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <h3 style="text-align: center; color: #333;">Thêm Danh Mục</h3>
                <form method="POST" action="index.php?role=admin&act=Storage" style="display: flex; flex-direction: column;">
                    <label for="name" style="margin-bottom: 10px; color: #555;">Tên danh mục:</label>
                    <input type="text" id="name" name="add_category" placeholder="Enter data here..." style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                    <label for="type" style="margin-bottom: 10px; color: #555;">Loại danh mục:</label>
                    <select id="category_type" name="category_type" style="padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Chọn loại danh mục</option>
                        <option value="Áo">Áo</option>
                        <option value="Quần">Quần</option>
                        <option value="Phụ Kiện">Phụ kiện</option>
                    </select>
                    
                    <div style="width: 100%; text-align: center;">
                        <input type="submit" name="sbm_add_cate" value="Thêm" style="height: 40px;width: 49%;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;">
                        <a class="sbm_slist_cate" style="height: 40px;text-decoration: none;text-align: center;display: inline-block;width: 49%;padding: 10px; color: #fff; background-color: #5cb85c; border: none; border-radius: 4px; cursor: pointer;" href="index.php?act=listdm">Xem danh mục</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once VIEW . 'Admin/base/footer.php'; ?>
