<?php 
// Đảm bảo hằng VIEW đã được định nghĩa, nếu chưa thì tự set tạm
if (!defined('VIEW')) {
    define('VIEW', __DIR__ . '/../../Views/');
}

include_once VIEW . "Client/base/header.php"; 

// Đảm bảo $searchData có giá trị mặc định
$searchData = isset($searchData) ? $searchData : '';
?>
<link rel="stylesheet" href="Assets/Client/Css/category.css">
<div class="main">
    <div class="gray-line">COOLMETA STORES</div>
    <div class="back-main">
        <a href="index.php?act=">Trang chủ</a> | ALL Product
    </div>
    <div class="containers">
        <div class="sidebar">
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
                $found = false; // Đánh dấu xem có sản phẩm nào trùng không
                foreach ($products as $product): 
                    if (empty($searchData) || strpos(strtolower($product['name']), strtolower($searchData)) !== false): 
                        $found = true;
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
                    endif; 
                endforeach; 

                if (!$found) {
                    echo "<p>Không tìm thấy sản phẩm nào.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="Assets/Js/scripts.js"></script>
<?php include_once VIEW . "Client/base/foot.php"; ?>
