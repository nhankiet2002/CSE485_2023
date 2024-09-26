<?php
    include "../db.php"; // Kết nối cơ sở dữ liệu

    // Lấy mã thể loại từ URL
    if (isset($_GET['id'])) {
        $cat_id = $_GET['id'];

        // Truy vấn thông tin thể loại từ cơ sở dữ liệu
        $sql = "SELECT * FROM tacgia WHERE ma_tgia = '$cat_id'";
        $result = mysqli_query($conn, $sql);

        // Kiểm tra xem thể loại có tồn tại hay không
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $cat_name = $row['ten_tgia']; // Lấy tên thể loại
        } else {
            echo "<script>alert('Không tìm thấy thể loại!'); window.location.href='category.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Không có mã thể loại được cung cấp!'); window.location.href='category.php';</script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tác giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Chỉnh sửa thông tin tác giả</h3>
        <form method="POST" action="process_edit_author.php">
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" id="lblCatId">Mã tác giả</span>
                <p class="form-control"><?php echo $row['ma_tgia']; ?></p>
                <input type="hidden" name="ma_tgia" value="<?php echo $row['ma_tgia']; ?>">                    
            </div>
            <div class="mb-3">
                <label for="ten_tgia" class="form-label">Tên tác giả</label>
                <input type="text" class="form-control" id="ten_tgia" name="ten_tgia" value="<?php echo isset($row['ten_tgia']) ? $row['ten_tgia'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="author.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
