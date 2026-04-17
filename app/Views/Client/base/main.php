<link rel="stylesheet" href="Assets/Client/Css/category.css">
<?php include_once VIEW . "Client/base/header.php" ?>
<?php if(isset($message) && $message != "") : ?>
    <script>alert("<?= $message ?>")</script>
       <?php endif; ?>
<div class="main">
    <div class="baner">
        <img class="baner-img" src="Assets/images/baner/baner2.png" alt="">
    </div>
    <div class="about-texts">
        <div class="texts">
            <div class="about-text-1">Châu Bùi</div>
            <div class="about-text-2">Là một trong những fashionista hàng đầu Việt Nam, Có gu thời trang cá tính, hiện đại, biến hóa đa phong cách</div>
        </div>
    </div>
    <div class="containers">
        <div class="sidebar">
            <div class="filter-section">
                <form action="index.php" method="GET">
                    <input type="hidden" name="act" value="">
                    <!-- Quan trọng: Giữ lại từ khóa tìm kiếm khi lọc giá/size -->
                    <input type="hidden" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    
                    <h4>Khoảng giá</h4>
                    <input type="number" name="min_price" placeholder="Từ" value="<?= htmlspecialchars($filters['min_price'] ?? '') ?>">
                    <input type="number" name="max_price" placeholder="Đến" value="<?= htmlspecialchars($filters['max_price'] ?? '') ?>">

                    <h4>Kích thước</h4>
                    <select name="size">
                        <option value="">-- Chọn Size --</option>
                        <option value="S" <?= ($filters['size'] ?? '') == 'S' ? 'selected' : '' ?>>Size S</option>
                        <option value="M" <?= ($filters['size'] ?? '') == 'M' ? 'selected' : '' ?>>Size M</option>
                        <option value="L" <?= ($filters['size'] ?? '') == 'L' ? 'selected' : '' ?>>Size L</option>
                    </select>

                    <button type="submit" class="filter-submit-btn">LỌC SẢN PHẨM</button>
                    <a href="index.php" class="filter-reset-link">Xóa lọc</a>
                </form>
            </div>
            <hr>
            <h4>Danh mục</h4>
            <?php 
            $displayedTypes = [];
            foreach ($categories as $category): 
                if (!in_array($category['type'], $displayedTypes)):
                    $displayedTypes[] = $category['type'];
            ?>
                <button class="accordion"><?= htmlspecialchars($category['type']) ?></button>
                <div class="panel">
                    <ul>
                        <?php foreach ($categories as $sub): if ($sub['type'] == $category['type']): ?>
                            <li><a href="index.php?act=Category&id=<?= $sub['id'] ?>"><?= $sub['cate_name'] ?></a></li>
                        <?php endif; endforeach; ?>
                    </ul>
                </div>
            <?php endif; endforeach; ?>
        </div>

        <div class="content">
            <div class="products">
                <?php if (!empty($products)): foreach($products as $values): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?= $values['image'] ?>" alt="">
                    </div>
                    <a class="detail-btn" href="index.php?act=Detail&id=<?= $values['id'] ?>"><button class="detail-product-btn">XEM NGAY</button></a>
                    <div class="product-name-price">
                        <h3><?= $values['name'] ?></h3>
                        <span><?= number_format($values['price'], 0, ',', '.') ?> vnđ</span>
                    </div>
                </div>
                <?php endforeach; else: echo "<p>Không có sản phẩm nào khớp bộ lọc.</p>"; endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="short-baner">
            <img src="images/short-baner/short-baner.png" alt="">
        </div>
        <div class="title-card"><span>BEST SELLER</span></div>
        <div class="products">
        <?php foreach($topseller as $values): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?= $values['image'] ?>" alt="">
                </div>
                <a class="detail-btn" href="index.php?act=Detail&id=<?= $values['id'] ?>"><button class="detail-product-btn">XEM NGAY</button></a>
                <div class="product-name-price">
                    <h3><?= $values['name'] ?></h3>
                    <span><?= number_format($values['price'], 0, ',', '.') ?> vnđ</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="show-more"><a href="index.php?act=Products"><button class="show-more-btn">< SEE MORE></button></a></div>
    </div>
</div>
<?php include_once VIEW . "Client/base/foot.php" ?>