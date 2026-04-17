<?php
class OrdersController
{
    public function index(){
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            // Nếu chưa đăng nhập thì chuyển về trang login
            header('Location: index.php?act=LoginForm');
            exit;
        }

        $userId = $_SESSION['user']['id']; // Lấy ID người dùng từ session

        $categories = (new Category)->all();
        
        // Chỉ lấy đơn hàng của chính người dùng này
        $orders = (new Order)->getOrdersByUserId($userId);

        // Lấy chi tiết từng đơn hàng và thêm vào mảng orders
        foreach ($orders as &$order) {
            $order['details'] = (new Order)->allOrderDetailClient($order['id']);
        }
        return view('Client.Orders', compact('categories', 'orders'));
    }

    public function cancel($orderId) {
        // Kiểm tra quyền truy cập
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=LoginForm');
            exit;
        }

        // Kiểm tra xem đơn hàng có tồn tại không và người dùng có quyền hủy đơn hàng không
        $orderModel = new Order();
        $order = $orderModel->find($orderId);

        if ($order) {
            if ($order['user_id'] == $_SESSION['user']['id']) {
                $orderModel->updateStatus($orderId, 'canceled');
                $_SESSION['message'] = 'Đơn hàng đã được hủy thành công.';
            } else {
                $_SESSION['message'] = 'Bạn không có quyền hủy đơn hàng này.';
            }
        } else {
            $_SESSION['message'] = 'Đơn hàng không tồn tại.';
        }

        header('Location: index.php?act=Order');
        exit;
    }
}
?>
