<?php
class CommentController
{
    // Thêm bình luận mới
    public function addComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $userName = $_POST['user_name'];
            $commentContent = $_POST['comment'];

            // Giả định bạn có hàm để lấy user_id từ tên người dùng
            $user = (new Account)->getUserByName($userName);
            $userId = $user['id'];

            // Thêm bình luận mới vào cơ sở dữ liệu
            (new Comment)->addComment($productId, $userId, $commentContent);

            // Chuyển hướng về trang chi tiết sản phẩm
            header("Location: index.php?act=Detail&id=$productId");
            exit();
        }
    }
}
?>
