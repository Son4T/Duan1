<?php include_once VIEW . "Admin/base/header.php"; ?>
<style>
    .main {
        overflow: auto;
    }
    .product-info {
        width: 90%;
        margin: 50px auto;
        background: #fff;
        padding: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .product-info img {
        max-width: 250px;
        max-height: 300px;
        border: 3px solid gray;
        border-radius: 3px;
        padding: 2px;
    }
</style>

<div class="main">
    <div class="product-main">
        <div class="add_product">
            <div class="product-info">
                <h3 style="text-align: center; color: red;">Xóa Sản Phẩm</h3>
                <p style="text-align: center; color: #555;">Bạn có chắc chắn muốn xóa sản phẩm này không?</p>

                <form action="index.php?role=admin&act=DeleteProductAction&id=<?= $product['id'] ?>" method="POST" style="margin-top: 30px; text-align: center;">
                    <button type="submit" style="height: 40px; width: 49%; padding: 10px; color: #fff; background-color: red; border: none; border-radius: 4px; cursor: pointer;">
                        Xác nhận xóa
                    </button>
                    <a href="index.php?role=admin&act=Product" style="height: 40px; width: 49%; text-decoration: none; text-align: center; display: inline-block; padding: 10px; color: #fff; background-color: gray; border-radius: 4px;">
                        Hủy
                    </a>
                </form>

                <h4 style="color: red; margin-top: 20px; text-align: center;">
                    <?= isset($message) ? htmlspecialchars($message) : '' ?>
                </h4>
            </div>
        </div>
    </div>
</div>

<?php include_once VIEW . "Admin/base/footer.php"; ?>
