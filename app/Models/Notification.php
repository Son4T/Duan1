<?php
class Notification
{
    public $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Tạo thông báo mới
    public function create($data)
    {
        $sql = "INSERT INTO notifications(order_id, user_id, message, is_read, is_confirmed)
                VALUES(:order_id, :user_id, :message, :is_read, :is_confirmed)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindParam(':order_id', $data['order_id'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);
        $stmt->bindParam(':is_read', $data['is_read'] ?? 0, PDO::PARAM_INT);
        $stmt->bindParam(':is_confirmed', $data['is_confirmed'] ?? 0, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    // Lấy tất cả thông báo chưa xác nhận
    public function getUnconfirmed()
    {
        $sql = "SELECT n.*, o.id as order_id, o.total_price, u.fullname, u.phone, u.email, u.address, o.payment_method
                FROM notifications n
                JOIN orders o ON n.order_id = o.id
                JOIN users u ON n.user_id = u.id
                WHERE n.is_confirmed = 0
                ORDER BY n.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông báo theo ID
    public function find($id)
    {
        $sql = "SELECT n.*, o.id as order_id, o.total_price, u.fullname, u.phone, u.email, u.address, o.payment_method
                FROM notifications n
                JOIN orders o ON n.order_id = o.id
                JOIN users u ON n.user_id = u.id
                WHERE n.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Xác nhận thông báo
    public function confirm($id)
    {
        $sql = "UPDATE notifications SET is_confirmed = 1, is_read = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Đánh dấu đã đọc
    public function markAsRead($id)
    {
        $sql = "UPDATE notifications SET is_read = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Đếm thông báo chưa xác nhận
    public function countUnconfirmed()
    {
        $sql = "SELECT COUNT(*) as count FROM notifications WHERE is_confirmed = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    // Xóa thông báo
    public function delete($id)
    {
        $sql = "DELETE FROM notifications WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
