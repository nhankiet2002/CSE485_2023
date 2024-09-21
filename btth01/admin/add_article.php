<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Bài Viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Thêm Bài Viết</h3>
        <form method="POST" action="process_add_article.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tieude" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control" id="tieude" name="tieude" required>
            </div>
            <div class="mb-3">
                <label for="ten_bhat" class="form-label">Tên Bài Hát</label>
                <input type="text" class="form-control" id="ten_bhat" name="ten_bhat" required>
            </div>
            <div class="mb-3">
                <label for="ma_tloai" class="form-label">Thể Loại</label>
                <select class="form-select" id="ma_tloai" name="ma_tloai" required>
                    <!-- Duyệt danh sách thể loại từ cơ sở dữ liệu -->
                    <?php
                    include '..\conn.php'; // Kết nối CSDL
                    $sql = "SELECT ma_tloai, ten_tloai FROM theloai";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ma_tloai'] . "'>" . $row['ten_tloai'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tomtat" class="form-label">Tóm Tắt</label>
                <textarea class="form-control" id="tomtat" name="tomtat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="noidung" class="form-label">Nội Dung</label>
                <textarea class="form-control" id="noidung" name="noidung" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ma_tgia" class="form-label">Tác Giả</label>
                <select class="form-select" id="ma_tgia" name="ma_tgia" required>
                    <!-- Duyệt danh sách tác giả từ cơ sở dữ liệu -->
                    <?php
                    $sql_authors = "SELECT ma_tgia, ten_tgia FROM tacgia";
                    $result_authors = $conn->query($sql_authors);
                    while ($row = $result_authors->fetch_assoc()) {
                        echo "<option value='" . $row['ma_tgia'] . "'>" . $row['ten_tgia'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="ngayviet" class="form-label">Ngày Viết</label>
                <input type="date" class="form-control" id="ngayviet" name="ngayviet" required>
            </div>
            <div class="mb-3">
                <label for="hinhanh" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" id="hinhanh" name="hinhanh">
            </div>
            <button type="submit" class="btn btn-primary">Thêm Bài Viết</button>
            <a href="article.php" class="btn btn-secondary">Quay Lại</a>
        </form>
    </div>
</body>
</html>
