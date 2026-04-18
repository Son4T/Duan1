<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/global.css">
    <link rel="stylesheet" href="Assets/Client/Css/main.css">
    <title>Coolmeta Stores</title>
</head>

<body>
    <div class="wraper">
        <header>
            <div class="red-line">
                <h7>MIỄN PHÍ GIAO HÀNG TỪ 300K</h7>
            </div>
        </header>
        <div class="all-menu">
            <div class="logo"><a href="index.php?role=admin&act="><img src="Assets/images/logoo.png" alt="company logo"></a></div>
            <div class="nav-main">
                <ul>
                    <li><a class="home-link" href="index.php?API=home">TRANG CHỦ</a></li>
                    <li><a class="menu-link" >QUẦN</a></li>
                    <li><a class="menu-link" >ÁO</a></li>
                    <li><a class="menu-link" >PHỤ KIỆN</a></li>
                </ul>
            </div>
            <div class="search">
                <form action="index.php" method="GET" style="display: flex; gap: 0; width: 100%; align-items: center;">
                    <input type="hidden" name="act" value="Products">
                    <input class="search-bar" type="search" placeholder="TÌM KIẾM..." name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" required>
                    <button type="submit" class="search-header-btn">
                        <img class="search-logo" src="Assets/images/search-icon.png" alt="Tìm kiếm">
                        <span>search</span>
                    </button>
                </form>
            </div>
            <div class="user-cart">
            <div class="cart-container"> 
              
                <a href="<?php if(isset($_SESSION['Cart']) && isset($_SESSION['user'])):?>index.php?act=Cart<?php endif; ?>"> 
                   <a href="index.php?act=Cart"><img src="Assets/images/cart-logo.png" alt="Giỏ hàng" style="cursor: pointer;"></a>
                   <div class="badge"><?= $_SESSION['totalQuantity'] ?? "0" ?></div></a></div>
                <?php if(empty($_SESSION['user'])) : ?> <img class="user" src="Assets/images/user.png" alt=""><?php endif; ?>
                <?php if(isset($_SESSION['user'])) : ?> <a href="index.php?act=Information"><img class="user-1" src="Assets/images/user.png" alt=""></a><?php endif; ?>
            </div>
            <div class="management-user">
                <?php if (!isset($_SESSION['user'])): ?>
                    <a class="user-select-link" href="index.php?act=LoginForm">
                        <div class="user-select">Đăng nhập</div>
                    </a>
                    <a class="user-select-link" href="index.php?act=RegisterForm">
                        <div class="user-select">Tạo tài khoản</div>
                    </a>
                    </a><?php endif; ?>
            </div>
            <div class="toggle-categories">
                <div class="content-categories">
                    <div class="category">
                        <div class="category-card">
                            <?php $count = 0; ?>
                            <h5>ÁO</h5>
                            <?php foreach ($categories as $value): ?>
                                <?php if ($value['type'] == "Áo"): ?>
                                    <p><a href="index.php?act=Category&id=<?= $value['id'] ?>"><?= $value['cate_name'] ?></a></p>
                                    <?php
                                    $count++;
                                    if ($count == 6):
                                        break;
                                    endif;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="category">
                        <div class="category-card">
                            <h5>QUẦN</h5>
                            <?php foreach ($categories as $value): ?>
                                <?php if ($value['type'] == "Quần"): ?>
                                    <p><a href="index.php?act=Category&id=<?= $value['id'] ?>"><?= $value['cate_name'] ?></a></p>
                                    <?php
                                    $count++;
                                    if ($count == 6):
                                        break;
                                    endif;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>    
                        </div>
                    </div>
                    <div class="category">
                        <div class="category-card">
                            <h5>PHỤ KIỆN</h5>
                            <?php foreach ($categories as $value): ?>
                                <?php if ($value['type'] == "Phụ Kiện"): ?>
                                    <p><a href="index.php?act=Category&id=<?= $value['id'] ?>"><?= $value['cate_name'] ?></a></p>
                                    <?php
                                    $count++;
                                    if ($count == 6):
                                        break;
                                    endif;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="logo-category">
                    <div><img class="category-logo" src="Assets/images/category_logoo.png" alt=""></div>
                    <div class="admin-page-link">
                    </div>
                </div>
            </div>
        </div>