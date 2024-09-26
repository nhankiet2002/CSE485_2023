<?php
include '../conn.php';
include '../controllers/CategoryController.php';

$categoryController = new CategoryController($conn);

$id = $_GET['ma_tloai'];

if (!isset($id)) {
    header('Location: ../views/category_list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $categoryController->update($id, $name);
    header('Location: ../views/category_list.php');
    exit();
}

$category = $categoryController->getCategoryById($id);

if (!$category) {
    echo "Không tìm thấy thể loại!";
    exit();
}

?>
<?php include '../views/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Sửa Thể Loại</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Thể Loại</label>
                <input type="text" class="form-control" name="name" value="<?php echo $category['ten_tloai']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Cập Nhật</button>
        </form>
    </div>
</div>

<?php include '../views/footer.php'; ?>
