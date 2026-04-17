<?php
class AdminNotificationController
{
    public function confirmOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['message'] = "Phương thức yêu cầu không hợp lệ.";
            header("Location: index.php?role=admin");
            exit;
        }

        $notificationId = $_POST['notification_id'] ?? '';
        
        if (empty($notificationId)) {
            $_SESSION['message'] = "Không tìm thấy thông báo.";
            header("Location: index.php?role=admin");
            exit;
        }

        // Lấy thông báo
        $notification = (new Notification)->find($notificationId);
        if (!$notification) {
            $_SESSION['message'] = "Không tìm thấy thông báo.";
            header("Location: index.php?role=admin");
            exit;
        }

        // Cập nhật trạng thái đơn hàng thành 'in transit' (đang vận chuyển)
        (new Order)->updateStatus($notification['order_id'], 'in transit');

        // Xác nhận thông báo
        (new Notification)->confirm($notificationId);

        $_SESSION['message'] = "✓ Đã xác nhận đơn hàng #" . $notification['order_id'] . ". Khách hàng: " . $notification['fullname'];
        header("Location: index.php?role=admin");
        exit;
    }

    public function dismissNotification()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['message'] = "Phương thức yêu cầu không hợp lệ.";
            header("Location: index.php?role=admin");
            exit;
        }

        $notificationId = $_POST['notification_id'] ?? '';
        
        if (empty($notificationId)) {
            $_SESSION['message'] = "Không tìm thấy thông báo.";
            header("Location: index.php?role=admin");
            exit;
        }

        // Xóa thông báo
        (new Notification)->delete($notificationId);

        $_SESSION['message'] = "Đã xóa thông báo.";
        header("Location: index.php?role=admin");
        exit;
    }
}
