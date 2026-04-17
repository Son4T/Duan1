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

    // Xóa bình luận
    public function deleteComment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?act=Products");
            exit();
        }

        // Validate: Kiểm tra comment_id
        if (empty($_POST['comment_id']) || !is_numeric($_POST['comment_id'])) {
            $_SESSION['message'] = "ID bình luận không hợp lệ.";
            header("Location: index.php?act=Products");
            exit();
        }

        // Validate: Kiểm tra product_id
        if (empty($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
            $_SESSION['message'] = "ID sản phẩm không hợp lệ.";
            header("Location: index.php?act=Products");
            exit();
        }

        $commentId = $_POST['comment_id'];
        $productId = $_POST['product_id'];

        // Validate: Kiểm tra user đã đăng nhập
        if (!isset($_SESSION['user'])) {
            $_SESSION['message'] = "Vui lòng đăng nhập để xóa bình luận.";
            header("Location: index.php?act=LoginForm");
            exit();
        }

        // Xóa bình luận
        try {
            (new Comment)->deleteComment($commentId);
            $_SESSION['message'] = "Xóa bình luận thành công.";
        } catch (Exception $e) {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa bình luận.";
            error_log("Delete comment error: " . $e->getMessage());
        }

        header("Location: index.php?act=Detail&id=$productId");
        exit();
    }
}
?>
