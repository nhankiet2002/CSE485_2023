<?php
include '../conn.php';
include '../views/header.php';
include '../controllers/ArticleController.php';

$articleController = new ArticleController($conn);
$articles = $articleController->list();
?>

<h3 class="text-center mb-4">Danh sách Bài viết</h3>
<a href="../admin/add_article.php" class="btn btn-primary mb-3">Thêm Bài viết</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Tên bài hát</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $articles->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ma_bviet']; ?></td>
            <td><?php echo $row['tieude']; ?></td>
            <td><?php echo $row['ten_bhat']; ?></td>
            <td>
                <a href="../admin/edit_article.php?ma_bviet=<?php echo $row['ma_bviet']; ?>" class="btn btn-warning">Sửa</a>
                <a href="../admin/delete_article.php?ma_bviet=<?php echo $row['ma_bviet']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../views/footer.php'; ?>
