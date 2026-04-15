<?php include_once VIEW . "Admin/base/header.php" ?>
<link rel="stylesheet" href="Assets/Admin/Css/comment.css">
<main>
    <table class="comments-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Người Dùng</th>
                <th>Nội Dung</th>
                <th>Ngày Đăng</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= htmlspecialchars($comment['id']) ?></td>
                    <td><?= htmlspecialchars($comment['user_name']) ?></td>
                    <td><?= htmlspecialchars($comment['comment']) ?></td>
                    <td><?= date('Y-m-d', strtotime($comment['created_at'])) ?></td>
                    <td>
                        <a href="index.php?role=admin&act=DeleteComment&id=<?= $comment['id'] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include_once VIEW . "Admin/base/footer.php" ?>
