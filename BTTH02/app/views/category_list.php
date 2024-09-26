<?php
include '../conn.php';
include '../controllers/CategoryController.php';

$categoryController = new CategoryController($conn);
$categories = $categoryController->list();
?>
<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">Danh sách thể loại</h3>
        <a href="../admin/add_category.php" class="btn btn-success mb-3">Thêm Thể Loại</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Thể Loại</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($categories->num_rows > 0): ?>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ma_tloai']; ?></td>
                            <td><?php echo $row['ten_tloai']; ?></td>
                            <td>
                                <a href="../admin/edit_category.php?ma_tloai=<?php echo $row['ma_tloai']; ?>" class="btn btn-warning">Sửa</a>
                                <a href="../admin/delete_category.php?ma_tloai=<?php echo $row['ma_tloai']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Chưa có thể loại nào!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
