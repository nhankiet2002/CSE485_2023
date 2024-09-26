<?php
include '../conn.php';
include '../controllers/ArticleController.php';

$articleController = new ArticleController($conn);
$id = $_GET['id'];

if (!isset($id)) {
    header('Location: ../views/article_list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $song_name = $_POST['song_name'];
    $category_id = $_POST['category_id'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
        $imagePath = 'uploads/' . $image;
    } else {
        $imagePath = $_POST['old_image'];
    }

    $articleController->update($id, $title, $song_name, $category_id, $summary, $content, $author_id, $date, $imagePath);
    header('Location: ../views/article_list.php');
    exit();
}

$article = $articleController->getArticleById($id);

if (!$article) {
    echo "Không tìm thấy bài viết!";
    exit();
}

$authors = $conn->query("SELECT * FROM tacgia");
$categories = $conn->query("SELECT * FROM theloai");
?>
<?php include '../views/header.php'; ?>

<div class="row">
    <div class="col-md-6 offset-md-3">
        <h3 class="text-center">Sửa Bài Viết</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" name="title" value="<?php echo $article['tieude']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="song_name" class="form-label">Tên Bài Hát</label>
                <input type="text" class="form-control" name="song_name" value="<?php echo $article['ten_bhat']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Thể Loại</label>
                <select name="category_id" class="form-control" required>
                    <?php while ($row = $categories->fetch_assoc()): ?>
                        <option value="<?php echo $row['ma_tloai']; ?>" <?php echo ($row['ma_tloai'] == $article['ma_tloai']) ? 'selected' : ''; ?>><?php echo $row['ten_tloai']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Tác Giả</label>
                <select name="author_id" class="form-control" required>
                    <?php while ($row = $authors->fetch_assoc()): ?>
                        <option value="<?php echo $row['ma_tgia']; ?>" <?php echo ($row['ma_tgia'] == $article['ma_tgia']) ? 'selected' : ''; ?>><?php echo $row['ten_tgia']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Tóm Tắt</label>
                <textarea class="form-control" name="summary" required><?php echo $article['tomtat']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội Dung</label>
                <textarea class="form-control" name="content" required><?php echo $article['noidung']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Ngày Viết</label>
                <input type="date" class="form-control" name="date" value="<?php echo $article['ngayviet']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" name="image">
                <img src="<?php echo $article['hinhanh']; ?>" alt="" style="width: 50px; height: 50px;">
                <input type="hidden" name="old_image" value="<?php echo $article['hinhanh']; ?>">
            </div>
            <button type="submit" class="btn btn-warning">Cập Nhật</button>
        </form>
    </div>
</div>

<?php include '../views/footer.php'; ?>
