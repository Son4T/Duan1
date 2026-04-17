<?php
class Comment
{
    public $pdo; // Biến lưu đối tượng PDO để làm việc với cơ sở dữ liệu

    // Hàm khởi tạo: Kết nối cơ sở dữ liệu thông qua lớp Database
    public function __construct()
    {
        $db = new Database(); // Tạo một đối tượng Database
        $this->pdo = $db->getConnection(); // Lấy kết nối PDO từ lớp Database
    }

    public function getCommentsByProductId($productId)
    {
        $sql = "SELECT c.comment, c.created_at, u.fullname AS user_name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.product_id = :product_id ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($productId, $userId, $comment)
    {
        $sql = "INSERT INTO comments (product_id, user_id, comment, created_at) VALUES (:product_id, :user_id, :comment, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $productId, 'user_id' => $userId, 'comment' => $comment]);
        return $this->pdo->lastInsertId();
    }

    public function getCommentsByUserId($userId)
    {
        $sql = "SELECT c.comment, c.created_at, p.name AS product_name FROM comments c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllComments()
    {
        $sql = "SELECT c.id, c.comment, c.created_at, u.fullname AS user_name FROM comments c JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteComment($id)
    {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
