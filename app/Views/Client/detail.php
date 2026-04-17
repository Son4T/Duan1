<?php include_once VIEW . "Client/base/header.php" ?>
<link rel="stylesheet" href="Assets/Client/Css/detail.css">
<div class="main">
    <div class="gray-line">COOLMETA STORES</div>
    <div class="back-main"><a href="index.php?API=home">Trang chủ</a> | <span><?= htmlspecialchars($detail['type']) ?></span> | <span><?= htmlspecialchars($detail['name']) ?></span></div>
    <div class="container">
        <div class="image-gallery">
            <img src="<?= $detail['image'] ?>" alt="Sản phẩm chính">
        </div>
        <div class="product-details">
            <h2><?= htmlspecialchars($detail['name']) ?></h2>
            <div class="product-code">Mã SP: <span><?= htmlspecialchars($detail['id']) ?></span></div>
            <div class="price">Giá: <span><?= number_format($detail['price'], 0, ',', '.') ?> VNĐ</span></div>
                <div class="size-options">
                    <label for="sizes">Kích cỡ:</label>
                    <div class="size" onclick="selectSize(this, 'M')">M</div>
                    <div class="size" onclick="selectSize(this, 'L')">L</div>
                    <div class="size" onclick="selectSize(this, '2XL')">2XL</div>
                    <?php 
                    if(!empty($detail['size'])):
                        $sizes = explode(',', $detail['size']);
                        foreach($sizes as $s): ?>
                            <div class="size" onclick="selectSize(this, '<?= trim($s) ?>')"><?= trim($s) ?></div>
                    <?php endforeach; else: echo "<span>Liên hệ</span>"; endif; ?>
                </div>
                
                <div class="color-options" style="margin-top: 10px;">
                    <label>Màu sắc:</label>
                    <?php 
                    if(!empty($detail['color'])):
                        $colors = explode(',', $detail['color']);
                        foreach($colors as $c): ?>
                            <span class="color-tag" style="padding: 5px 10px; border: 1px solid #ccc; margin-right: 5px;"><?= trim($c) ?></span>
                    <?php endforeach; else: echo "<span>Mặc định</span>"; endif; ?>
                </div>
                <br>
                <a href="index.php?act=AddToCart&id=<?= $detail['id'] ?>"><button type="submit"  class="add-to-cart">THÊM VÀO GIỎ HÀNG</button></a>
            <div class="description">
                <h3>MÔ TẢ</h3>
                <p><?= htmlspecialchars($detail['description']) ?></p>
            </div>
        </div>
    </div>
    <div class="comments-section">
        <h3>Bình luận</h3>
        <?php if (empty($comments)): ?>
            <p>Chưa có bình luận nào.</p>
        <?php else: ?>
            <ul class="comments-list">
                <?php foreach ($comments as $comment): ?>
                    <li class="comment-item" style="padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <p><strong><?= htmlspecialchars($comment['user_name']) ?>:</strong> <?= htmlspecialchars($comment['comment']) ?></p>
                            <p class="comment-date" style="font-size: 12px; color: #999;"><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></p>
                        </div>
                        <?php if(isset($_SESSION['user']) && ($_SESSION['user']['id'] == $comment['user_id'] || $_SESSION['user']['role'] == 'admin')): ?>
                            <form action="index.php?act=DeleteComment" method="POST" style="display: inline;">
                                <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment['id']) ?>">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($detail['id']) ?>">
                                <button type="submit" style="padding: 5px 10px; background-color: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 12px;" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">Xóa</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <!-- Form gửi bình luận -->
        <div class="comment-form">
            <form action="index.php?act=AddComment" method="POST">
                <input type="hidden" name="product_id" value="<?= $detail['id'] ?>">
                <?php if(isset($_SESSION['user'])): ?>
                    <input type="hidden" name="user_name" value="<?= $_SESSION['user']['fullname'] ?>">
                <?php else: ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['user'])) : ?>
                <div class="form-group">
                    <label for="comment">Bình luận:</label>
                    <textarea id="comment" name="comment" rows="4" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Gửi</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="similar-products">
        <h3>Sản phẩm tương tự</h3>
        <div class="products-container">
            <div class="products">
                <?php foreach($products as $product) : ?>
                <?php if($product['category_id'] == $detail['category_id'] && $product['id'] !== $detail['id'] ) : ?>
                <a href="index.php?act=Detail&id=<?= $product['id'] ?>">
                <div class="product">
                    <img src="<?= $product['image'] ?>" alt="Sản phẩm tương tự 1">
                    <div class="product-details">
                        <div class="product-name"><?= $product['name'] ?></div>
                        <div class="product-price"><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</div>
                    </div>
                </div>
                </a>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<script src="Assets/Js/detail.js"></script>
<?php include_once VIEW . "Client/base/foot.php" ?>
