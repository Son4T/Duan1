<?php

class Statistical
{
    public $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Lấy tổng số đơn hàng
    public function getTotalOrders() {
        $sql = "SELECT COUNT(*) AS total_orders FROM orders";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];
    }

    // Lấy tổng doanh thu
    public function getTotalRevenue() {
        $sql = "SELECT SUM(total_price) AS total_revenue FROM orders";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
    }

    // Lấy tổng số người dùng
    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) AS total_users FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];
    }

    // Lấy tổng số sản phẩm
    public function getTotalProducts() {
        $sql = "SELECT COUNT(*) AS total_products FROM products";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];
    }
}
?>
