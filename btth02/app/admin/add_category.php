<?php
include '../conn.php';
include '../controllers/CategoryController.php';

$categoryController = new CategoryController($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $categoryController->add($name);
    header('Location: ../views/category_list.php');
    exit();
}
?>
<?php include '../views/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Thêm Thể Loại</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Thể Loại</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>

<?php include '../views/footer.php'; ?>
