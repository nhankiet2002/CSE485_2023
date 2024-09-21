<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tác giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include '..\conn.php'; // Kết nối CSDL

if (isset($_GET['ma_tgia'])) {
    $ma_tgia = $_GET['ma_tgia'];

    // Truy vấn lấy thông tin thể loại từ cơ sở dữ liệu
    $sql = "SELECT * FROM tacgia WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_tgia);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Tác giả không tồn tại!'); window.location.href='author.php';</script>";
        exit;
    }

    $stmt->close();
} else {
    echo "<script>alert('Không có mã tác giả!'); window.location.href='author.php';</script>";
    exit;
}

?>
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
