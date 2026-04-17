<?php
class Order
{
    public $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function all()
    {
        $sql = "SELECT o.*, u.fullname, u.address, u.email, u.phone 
                FROM orders o
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT o.*, u.fullname, u.email, u.address, u.phone
                FROM orders o
                JOIN users u ON o.user_id = u.id 
                WHERE o.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($order) {
            $order['details'] = $this->allOrderDetailClient($id);
        }

        return $order;
    }

    public function create($data)
    {
        // Danh sách phương thức thanh toán hợp lệ
        $allowedMethods = ['cash', 'momo', 'vnpay', 'banking'];

        // Nếu không hợp lệ hoặc rỗng thì gán mặc định là 'cash'
        if (empty($data['payment_method']) || !in_array($data['payment_method'], $allowedMethods)) {
            $data['payment_method'] = 'cash';
        }

        $sql = "INSERT INTO orders(user_id, status, payment_method, total_price)
                VALUES(:user_id, :status, :payment_method, :total_price)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
        $stmt->bindParam(':payment_method', $data['payment_method'], PDO::PARAM_STR);
        $stmt->bindParam(':total_price', $data['total_price'], PDO::PARAM_INT);

        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'status' => $status]);
    }

    public function createOrderDetail($data)
    {
        $sql = "INSERT INTO order_details(order_id, product_id, product_name, price, quantity) 
                VALUES(:order_id, :product_id, :product_name, :price, :quantity)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function allOrderDetail($orderId)
    {
        $sql = "SELECT od.id, od.order_id, od.product_id, p.name AS product_name, od.price, od.quantity 
                FROM order_details od
                JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = :order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function allOrderDetailClient($orderId)
    {
        $sql = "SELECT od.product_id, p.name, od.price, od.quantity 
                FROM order_details od
                JOIN products p ON p.id = od.product_id
                WHERE od.order_id = :order_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function updateOrderStatus($orderId, $status)
    {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getOrdersByUserId($userId) {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function cancelOrder($orderId)
    {
        $sql = "UPDATE orders SET status = :status WHERE id = :order_id";
        $stmt = $this->pdo->prepare($sql);
        $status = 'canceled';
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
