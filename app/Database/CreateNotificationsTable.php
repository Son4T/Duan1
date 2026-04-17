<?php
// Script to create notifications table
require_once __DIR__ . '/Database.php';

try {
    $db = new Database();
    $pdo = $db->getConnection();
    
    // Check if table already exists
    $checkTableSql = "SHOW TABLES LIKE 'notifications'";
    $stmt = $pdo->prepare($checkTableSql);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "✓ Bảng 'notifications' đã tồn tại.";
        exit;
    }
    
    // Create notifications table
    $createTableSql = "CREATE TABLE `notifications` (
        `id` int NOT NULL AUTO_INCREMENT,
        `order_id` int NOT NULL,
        `user_id` int NOT NULL,
        `message` varchar(255) NOT NULL,
        `is_read` tinyint(1) DEFAULT 0,
        `is_confirmed` tinyint(1) DEFAULT 0,
        `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`),
        KEY `order_id` (`order_id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
        CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    
    $pdo->exec($createTableSql);
    
    echo "✓ Bảng 'notifications' đã được tạo thành công!";
    
} catch (PDOException $e) {
    echo "✗ Lỗi: " . $e->getMessage();
    exit(1);
}
?>
