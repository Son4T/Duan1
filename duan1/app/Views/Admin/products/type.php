<style>
    select, button {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        margin-bottom: 20px;
    }
    button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
        width: auto;
        margin: 0 auto;
        display: block;
    }
    button:hover {
        background-color: #0056b3;
    }

    .main {
        display: flex;
        justify-content: center;  /* Center horizontally */
        align-items: center;
        height: 800px;      /* Center vertically */     /* Full viewport height */
        padding: 20px;
        margin-top: -170px;      /* Add padding for spacing */
    }

    form {
        width: 100%;               /* The form takes up full width */
        max-width: 600px;          /* Limit the maximum width of the form */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Optional: adds shadow for better visibility */
    }
</style>

<?php include_once VIEW . "Admin/base/header.php" ?>

<div class="main">
    <form action="index.php" method="GET">
        <input type="hidden" name="role" value="admin">
        <input type="hidden" name="act" value="AddProduct">
        <select id="product-type" name="product_type" required>
            <option value="" disabled selected>-- Chọn một loại sản phẩm --</option>
            <option value="Áo">Áo</option>
            <option value="Quần">Quần</option>
            <option value="Phụ Kiện">Phụ kiện</option>
        </select>
        <button type="submit">Xác Nhận</button>
        <h4 style="color: red; margin-top: 20px; text-align: center;">
            <?= isset($message) ? htmlspecialchars($message) : '' ?>
        </h4>
    </form>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>