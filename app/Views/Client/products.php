<?php 
// Đảm bảo hằng VIEW đã được định nghĩa, nếu chưa thì tự set tạm
if (!defined('VIEW')) {
    define('VIEW', __DIR__ . '/../../Views/');
}

include_once VIEW . "Client/base/header.php"; 

// Đảm bảo $searchData có giá trị mặc định
$filters = $filters ?? [];
?>
<link rel="stylesheet" href="Assets/Client/Css/category.css">
<div class="main">
    <div class="gray-line">COOLMETA STORES</div>
    <div class="back-main">
        <a href="index.php?act=">Trang chủ</a> | 
        <?php if (!empty($filters['min_price']) || !empty($filters['max_price'])): ?>
            Kết quả lọc giá: 
            <strong>
                <?= !empty($filters['min_price']) ? number_format($filters['min_price']) . 'đ' : '0đ' ?> 
                - 
                <?= !empty($filters['max_price']) ? number_format($filters['max_price']) . 'đ' : 'Tối đa' ?>
            </strong>
        <?php else: ?>
            Tất cả sản phẩm
        <?php endif; ?>
    </div>
    <div class="containers">
        <div class="sidebar">
            <div class="filter-section">
                <form action="index.php" method="GET">
                    <input type="hidden" name="act" value="Products">
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
                        <option value="XL" <?= ($filters['size'] ?? '') == 'XL' ? 'selected' : '' ?>>Size XL</option>
                    </select>

                    <h4>Màu sắc</h4>
                    <select name="color">
                        <option value="">-- Chọn màu --</option>
                        <option value="Black" <?= ($filters['color'] ?? '') == 'Black' ? 'selected' : '' ?>>Đen</option>
                        <option value="White" <?= ($filters['color'] ?? '') == 'White' ? 'selected' : '' ?>>Trắng</option>
                        <option value="Blue" <?= ($filters['color'] ?? '') == 'Blue' ? 'selected' : '' ?>>Xanh dương</option>
                    </select>

                    <button type="submit" class="filter-submit-btn">ÁP DỤNG</button>
                    <a href="index.php?act=Products" class="filter-reset-link">Xóa bộ lọc</a>
                </form>
            </div>

            <hr>
            <h4>Danh mục</h4>
            <?php 
            $displayedTypes = []; // Mảng tạm lưu các kiểu đã hiển thị
            foreach ($categories as $category): 
                if (!in_array($category['type'], $displayedTypes)):
                    $displayedTypes[] = $category['type']; // Thêm kiểu mới vào mảng tạm
            ?>
                <button class="accordion"><?= htmlspecialchars($category['type']) ?></button>
                <div class="panel">
                    <ul>
                        <?php 
                        foreach ($categories as $subCategory):
                            if ($subCategory['type'] == $category['type']):
                        ?>
                            <li>
                                <a href="index.php?act=Category&id=<?= $subCategory['id'] ?>">
                                    <?= htmlspecialchars($subCategory['cate_name']) ?>
                                </a>
                            </li>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </ul>
                </div>
            <?php 
                endif; 
            endforeach; 
            ?>
        </div>
        
        <div class="content">
            <div class="products">
                <?php 
                if (!empty($products)):
                    foreach ($products as $product): 
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="">
                        </div>
                        <a class="detail-btn" href="index.php?act=Detail&id=<?= $product['id'] ?>">
                            <button class="detail-product-btn">XEM NGAY</button>
                        </a>
                        <div class="product-name-price">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <span><?= number_format($product['price'], 0, ',', '.') ?> vnđ</span>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                else:
                    echo "<p>Không tìm thấy sản phẩm nào khớp với bộ lọc.</p>";
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<script src="Assets/Js/scripts.js"></script>
<?php include_once VIEW . "Client/base/foot.php"; ?>
