<?php
include '../db.php'; // Kết nối CSDL

if (isset($_GET['id'])) {
    $ma_bviet = $_GET['id'];

    // Truy vấn lấy thông tin bài viết từ cơ sở dữ liệu
    $sql = "SELECT * FROM baiviet WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_bviet);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Bài viết không tồn tại!'); window.location.href='article.php';</script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>alert('Không có mã bài viết!'); window.location.href='article.php';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Chỉnh sửa bài viết</h3>
        <form method="POST" action="process_edit_article.php" enctype="multipart/form-data">
            <input type="hidden" name="ma_bviet" value="<?php echo $row['ma_bviet']; ?>">

            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="tieude" name="tieude" value="<?php echo $row['tieude']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên bài hát</label>
                <input type="text" class="form-control" id="ten_bhat" name="ten_bhat" value="<?php echo $row['ten_bhat']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="theloai" class="form-label">Thể loại</label>
                <select class="form-select" id="theloai" name="theloai" required>
                    <?php
                    // Lấy danh sách thể loại từ cơ sở dữ liệu
                    $sql_theloai = "SELECT * FROM theloai";
                    $result_theloai = $conn->query($sql_theloai);
                    while ($row_theloai = $result_theloai->fetch_assoc()) {
                        $selected = ($row_theloai['ma_tloai'] == $row['ma_tloai']) ? 'selected' : '';
                        echo "<option value='{$row_theloai['ma_tloai']}' $selected>{$row_theloai['ten_tloai']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tacgia" class="form-label">Tác giả</label>
                <select class="form-select" id="tacgia" name="tacgia" required>
                    <?php
                    // Lấy danh sách tác giả từ cơ sở dữ liệu
                    $sql_tacgia = "SELECT * FROM tacgia";
                    $result_tacgia = $conn->query($sql_tacgia);
                    while ($row_tacgia = $result_tacgia->fetch_assoc()) {
                        $selected = ($row_tacgia['ma_tgia'] == $row['ma_tgia']) ? 'selected' : '';
                        echo "<option value='{$row_tacgia['ma_tgia']}' $selected>{$row_tacgia['ten_tgia']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="hinhanh" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="hinhanh" name="hinhanh">
                <img src="<?php echo $row['hinhanh']; ?>" alt="Bài viết hình ảnh" width="100">
                <input type="hidden" name="hinhanh_cu" value="<?php echo $row['hinhanh']; ?>">
            </div>

            <div class="mb-3">
                <label for="noidung" class="form-label">Nội dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" ><?php echo $row['noidung']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="article.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
