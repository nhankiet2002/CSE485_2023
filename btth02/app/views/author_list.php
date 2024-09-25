<?php
include '../conn.php';
include '../views/header.php';
include '../controllers/AuthorController.php';

$authorController = new AuthorController($conn);
$authors = $authorController->list();
?>

<h3 class="text-center mb-4">Danh sách Tác giả</h3>
<a href="../admin/add_author.php" class="btn btn-primary mb-3">Thêm Tác giả</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên Tác giả</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $authors->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ma_tgia']; ?></td>
            <td><?php echo $row['ten_tgia']; ?></td>
            <td><img src="<?php echo $row['hinh_tgia']; ?>" alt="<?php echo $row['ten_tgia']; ?>" style="width: 50px; height: 50px;"></td>
            <td>
                <a href="../admin/edit_author.php?id=<?php echo $row['ma_tgia']; ?>" class="btn btn-warning">Sửa</a>
                <a href="../admin/delete_author.php?id=<?php echo $row['ma_tgia']; ?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include '../views/footer.php'; ?>
