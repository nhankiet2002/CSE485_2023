<?php
include '../conn.php';
include '../controllers/AuthorController.php';

$authorController = new AuthorController($conn);

$id = $_GET['id'];

if (!isset($id)) {
    header('Location: ../views/author_list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        $imagePath = 'uploads/' . $image;
    } else {
        $imagePath = $_POST['old_image'];
    }

    $authorController->update($id, $name, $imagePath);
    header('Location: ../views/author_list.php');
    exit();
}

$author = $authorController->getAuthorById($id);

if (!$author) {
    echo "Không tìm thấy tác giả!";
    exit();
}
?>
<?php include '../views/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Sửa Tác Giả</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên Tác Giả</label>
                <input type="text" class="form-control" name="name" value="<?php echo $author['ten_tgia']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" name="image">
                <img src="<?php echo $author['hinh_tgia']; ?>" alt="" style="width: 50px; height: 50px;">
                <input type="hidden" name="old_image" value="<?php echo $author['hinh_tgia']; ?>">
            </div>
            <button type="submit" class="btn btn-warning">Cập Nhật</button>
        </form>
    </div>
</div>

<?php include '../views/footer.php'; ?>
