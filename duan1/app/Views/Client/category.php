<?php include_once VIEW . "Client/base/header.php"; ?>
<link rel="stylesheet" href="Assets/Client/Css/category.css">

<div class="main">
    <div class="gray-line">COOLMETA STORES</div>
    <div class="back-main">
        <a href="index.php?act=">Trang chủ</a> |
        <?php if (!empty($category) && is_array($category)): ?>
            <span><?= htmlspecialchars($category['type']) ?></span> |
            <span><?= htmlspecialchars($category['cate_name']) ?></span>
        <?php else: ?>
            <span>Danh mục không xác định</span>
        <?php endif; ?>
    </div>
    <div class="containers">
        <div class="sidebar">
            <?php 
            if (!empty($categories) && is_array($categories)):
                $displayedTypes = []; // Mảng tạm lưu các kiểu đã hiển thị
                foreach ($categories as $value): 
                    if (
                        (!empty($category) && is_array($category) && $value['type'] != $category['type']) 
                        && !in_array($value['type'], $displayedTypes)
                    ): 
                        $displayedTypes[] = $value['type']; // Thêm kiểu mới vào mảng tạm
            ?>
                        <button class="accordion"><?= htmlspecialchars($value['type']) ?></button>
                        <div class="panel">
                            <ul>
                                <?php 
                                foreach ($categories as $subCategory):
                                    if ($subCategory['type'] == $value['type']):
                                ?>
                                        <li><a href="index.php?act=Category&id=<?= $subCategory['id'] ?>"><?= htmlspecialchars($subCategory['cate_name']) ?></a></li>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </ul>
                        </div>
            <?php 
                    endif;
                endforeach;
            else:
                echo "<p>Không có danh mục nào để hiển thị.</p>";
            endif;
            ?>
        </div>
        
        <div class="content">
            <div class="products">
                <?php 
                if (!empty($products) && is_array($products)):
                    $hasProduct = false;
                    foreach ($products as $values): 
                        if (
                            (!empty($category) && is_array($category) && $values['category_id'] == $category['id']) ||
                            (empty($category) || !is_array($category)) // Nếu không có category, hiển thị tất cả
                        ): 
                            $hasProduct = true;
                ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="<?= htmlspecialchars($values['image']) ?>" alt="">
                                </div>
                                <a class="detail-btn" href="index.php?act=Detail&id=<?= $values['id'] ?>">
                                    <button class="detail-product-btn">XEM NGAY</button>
                                </a>
                                <div class="product-name-price">
                                    <h3><?= htmlspecialchars($values['name']) ?></h3>
                                    <span><?= number_format($values['price'], 0, ',', '.') ?> vnđ</span>
                                </div>
                            </div>
                <?php 
                        endif;
                    endforeach;
                    if (!$hasProduct):
                        echo "<p>Không có sản phẩm nào trong danh mục này.</p>";
                    endif;
                else:
                    echo "<p>Dữ liệu sản phẩm không hợp lệ.</p>";
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<script src="Assets/Js/scripts.js"></script>
<?php include_once VIEW . "Client/base/foot.php"; ?>
