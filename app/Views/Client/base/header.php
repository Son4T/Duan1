<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="Assets/global.css">
    <link rel="stylesheet" href="Assets/Client/Css/main.css">
    
    <title>Coolmeta Stores</title>
    <style>
        /* Tùy chỉnh thêm một chút cho đẹp */
        .search-bar { border-radius: 20px 0 0 20px !important; }
        .btn-search { border-radius: 0 20px 20px 0 !important; }
        .nav-link { font-weight: 600; color: #333; transition: 0.3s; }
        .nav-link:hover { color: #dc3545; }
        .badge-cart { font-size: 0.7rem; padding: 3px 6px; }
    </style>
</head>

<body>
    <div class="wrapper">
        <header class="bg-danger text-white text-center py-2 shadow-sm">
            <small class="fw-bold" style="letter-spacing: 1px;">MIỄN PHÍ GIAO HÀNG TỪ 300K</small>
        </header>

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="index.php?role=admin&act=">
                    <img src="Assets/images/logoo.png" alt="logo" height="40">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" href="index.php?API=home">TRANG CHỦ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">QUẦN</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">ÁO</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">PHỤ KIỆN</a></li>
                    </ul>

                    <form action="index.php" method="GET" class="d-flex me-3" style="min-width: 250px;">
                        <input type="hidden" name="act" value="Products">
                        <div class="input-group border border-dark rounded-pill overflow-hidden">
                            <input class="form-control border-0 px-3" type="search" placeholder="TÌM KIẾM..." name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" required>
                            <button class="btn btn-dark border-0 px-3" type="submit">Tìm</button>
                        </div>
                    </form>

                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <a href="index.php?act=Cart">
                                <img src="Assets/images/cart-logo.png" alt="Cart" height="28">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger badge-cart">
                                    <?= $_SESSION['totalQuantity'] ?? "0" ?>
                                </span>
                            </a>
                        </div>

                        <?php if(isset($_SESSION['user'])) : ?>
                            <a href="index.php?act=Information">
                                <img src="Assets/images/user.png" alt="User" height="30" class="rounded-circle border border-2 border-dark">
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!isset($_SESSION['user'])): ?>
                        <div class="ms-lg-3 mt-2 mt-lg-0 d-flex gap-2">
                            <a href="index.php?act=LoginForm" class="btn btn-sm btn-outline-dark rounded-pill px-3">Đăng nhập</a>
                            <a href="index.php?act=RegisterForm" class="btn btn-sm btn-dark rounded-pill px-3">Đăng ký</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>