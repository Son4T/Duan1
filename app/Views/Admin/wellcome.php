<?php include_once VIEW . "Admin/base/header.php" ?>
<main class="welcome-container">
    <div class="welcome-content">
        <h1>Chào Mừng Đến Với Trang Quản Trị</h1>
        <p>Chào mừng bạn đến với khu vực quản trị. Hãy sử dụng các chức năng trên menu để quản lý hệ thống của bạn hiệu quả.</p>
    </div>
</main>
<?php include_once VIEW . "Admin/base/footer.php" ?>
<style>

.welcome-container {
    width: 1280px;
    height: 700px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.welcome-content {
    text-align: center;
}

h1 {
    font-size: 2.5em;
    color: #333333;
    margin-bottom: 20px;
}

p {
    font-size: 1.2em;
    color: #666666;
    margin-bottom: 30px;
}

button {
    padding: 15px 30px;
    font-size: 1.2em;
    color: #ffffff;
    background-color: #ff5722;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #e64a19;
}

</style>