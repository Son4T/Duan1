<?php include_once VIEW . "Admin/base/header.php" ?>
<main class="welcome-container">
    <div class="welcome-content">
        <h1>Chào Mừng Đến Với Trang Quản Trị</h1>
        <p>Chào mừng bạn đến với khu vực quản trị. Hãy sử dụng các chức năng trên menu để quản lý hệ thống của bạn hiệu quả.</p>
    </div>
</main>

<!-- Notifications Section -->
<?php 
try {
    $notifications = (new Notification)->getUnconfirmed();
    $notificationCount = count($notifications);
} catch (Exception $e) {
    $notifications = [];
    $notificationCount = 0;
}
?>

<?php if($notificationCount > 0) : ?>
<div class="notifications-container">
    <div class="notifications-header">
        <h2>📢 Thông Báo Đơn Hàng Mới (<?= $notificationCount ?>)</h2>
        <p>Có <?= $notificationCount ?> đơn hàng chưa được xác nhận</p>
    </div>
    
    <div class="notifications-list">
        <?php foreach($notifications as $notif) : ?>
        <div class="notification-item">
            <div class="notification-content">
                <div class="notification-header-item">
                    <span class="notification-title">📦 Đơn hàng #<?= $notif['order_id'] ?></span>
                    <span class="notification-time"><?= date('H:i d/m/Y', strtotime($notif['created_at'])) ?></span>
                </div>
                <div class="notification-details">
                    <p><strong>Khách hàng:</strong> <?= $notif['fullname'] ?></p>
                    <p><strong>Số điện thoại:</strong> <?= $notif['phone'] ?></p>
                    <p><strong>Email:</strong> <?= $notif['email'] ?></p>
                    <p><strong>Địa chỉ:</strong> <?= $notif['address'] ?></p>
                    <p><strong>Phương thức thanh toán:</strong> <span class="payment-method"><?= ucfirst($notif['payment_method']) ?></span></p>
                    <p><strong>Số tiền:</strong> <span class="total-amount"><?= number_format($notif['total_price']) ?> VND</span></p>
                </div>
                <p class="notification-message"><?= $notif['message'] ?></p>
            </div>
            <div class="notification-actions">
                <form method="POST" action="index.php?role=admin&act=ConfirmOrder" style="display: inline;">
                    <input type="hidden" name="notification_id" value="<?= $notif['id'] ?>">
                    <button type="submit" class="btn-confirm">✓ Xác Nhận</button>
                </form>
                <form method="POST" action="index.php?role=admin&act=DismissNotification" style="display: inline;">
                    <input type="hidden" name="notification_id" value="<?= $notif['id'] ?>">
                    <button type="submit" class="btn-dismiss">✕ Bỏ Qua</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<?php include_once VIEW . "Admin/base/footer.php" ?>

<style>
.welcome-container {
    width: 1280px;
    height: 700px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
}

.welcome-content {
    text-align: center;
}

h1 {
    font-size: 2.5em;
    color: #333333;
    margin-bottom: 20px;
}

p {
    font-size: 1.2em;
    color: #666666;
    margin-bottom: 30px;
}

button {
    padding: 15px 30px;
    font-size: 1.2em;
    color: #ffffff;
    background-color: #ff5722;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #e64a19;
}

/* Notifications Styles */
.notifications-container {
    width: 1280px;
    margin: 20px auto;
    background: #f8f9fa;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.notifications-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px 30px;
    border-bottom: 3px solid #ff6b6b;
}

.notifications-header h2 {
    margin: 0 0 10px 0;
    font-size: 1.8em;
}

.notifications-header p {
    margin: 0;
    font-size: 1em;
    opacity: 0.9;
}

.notifications-list {
    padding: 20px;
    max-height: 600px;
    overflow-y: auto;
}

.notification-item {
    background: white;
    border: 2px solid #667eea;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 20px;
    transition: all 0.3s ease;
}

.notification-item:hover {
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
    border-color: #764ba2;
}

.notification-content {
    flex: 1;
}

.notification-header-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.notification-title {
    font-size: 1.2em;
    font-weight: bold;
    color: #333;
}

.notification-time {
    font-size: 0.9em;
    color: #999;
    background: #f0f0f0;
    padding: 5px 10px;
    border-radius: 4px;
}

.notification-details {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin-bottom: 10px;
}

.notification-details p {
    margin: 8px 0;
    font-size: 0.95em;
    color: #555;
}

.notification-details strong {
    color: #333;
}

.payment-method {
    background: #e3f2fd;
    color: #1976d2;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 500;
}

.total-amount {
    color: #d32f2f;
    font-size: 1.1em;
    font-weight: bold;
}

.notification-message {
    color: #1976d2;
    font-size: 0.95em;
    padding: 10px;
    background: #e3f2fd;
    border-left: 4px solid #1976d2;
    border-radius: 4px;
    margin: 0;
}

.notification-actions {
    display: flex;
    gap: 10px;
    flex-direction: column;
    min-width: 150px;
}

.btn-confirm {
    background: #4caf50;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
    font-size: 0.9em;
}

.btn-confirm:hover {
    background: #45a049;
    box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
}

.btn-dismiss {
    background: #ff6b6b;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
    font-size: 0.9em;
}

.btn-dismiss:hover {
    background: #ff5252;
    box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
}

/* Scrollbar styling */
.notifications-list::-webkit-scrollbar {
    width: 8px;
}

.notifications-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.notifications-list::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 10px;
}

.notifications-list::-webkit-scrollbar-thumb:hover {
    background: #764ba2;
}
</style>