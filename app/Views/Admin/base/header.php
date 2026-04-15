<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Assets/Admin/Css/admin.css">
</head>
<body>
<div class="container">
    <aside class="sidebar">
        <h2 style="color: red;">COOLMETA</h2>
        <ul>
            <li>
                <a href="#" class="menu-item">Dashboard</a>
            </li>
            <li>
                <a href="#" class="menu-item">Danh mục sản phẩm</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=AddCategory">Thêm danh mục</a></li>
                    <li><a href="index.php?role=admin&act=Category">Danh Sách danh mục</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">Sản phẩm</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=SelectType">Thêm sản phẩm</a></li>
                    <li><a href="index.php?role=admin&act=Product">Danh Sách sản phẩm</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">Tài khoản</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=User">Danh sách tài khoản</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">Bình luận</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=Comment">bình luận</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">Đơn hàng</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=Order">Xem đơn hàng</a></li>
                    <li><a href="#">Xác nhận đơn hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="menu-item">Thống kê</a>
                <ul class="submenu">
                    <li><a href="index.php?role=admin&act=Statistical">Tổng Quan</a></li>
                    <li><a href="index.php?role=admin&act=BestSelling">Sản phẩm bán chạy</a></li>
                </ul>
            </li>
            <li>
                <a href="index.php?act=" class="menu-item">Thoát</a>
            </li>
        </ul>
    </aside>
    <main class="main-content">
        <header class="header">
            <div class="user-info">
                <img src="Assets/images/category_logoo.png" alt="Avatar" class="avatar">
                <span class="user-name"><?php if(isset($_SESSION['user'])) : ?><?= $_SESSION['user']['fullname'] ?><?php endif; ?></span>
            </div>
            <div class="notifications">
                <a href="#" class="icon">🔔</a>
                <a href="#" class="icon">💌</a>
            </div>
        </header>
