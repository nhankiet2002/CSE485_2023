<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tác Giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include '..\conn.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_tgia = $_POST['ten_tgia'];
    
    // Kiểm tra xem người dùng có tải lên hình ảnh hay không
    if (isset($_FILES['hinh_tgia']) && $_FILES['hinh_tgia']['error'] == 0) {
        $hinh_tgia = $_FILES['hinh_tgia']['name']; // Lấy tên file ảnh
        $target_dir = "images/"; // Folder để lưu ảnh
        $target_file = $target_dir . basename($_FILES['hinh_tgia']['name']);

        // Kiểm tra định dạng file ảnh
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        
        if (in_array($imageFileType, $allowed_types)) {
            // Lưu file ảnh vào thư mục "images"
            if (move_uploaded_file($_FILES["hinh_tgia"]["tmp_name"], $target_file)) {
                // File ảnh đã được upload thành công
            } else {
                echo "<script>alert('Lỗi khi tải lên hình ảnh!');</script>";
                $hinh_tgia = ""; // Để trống nếu không tải được ảnh
            }
        } else {
            echo "<script>alert('Định dạng hình ảnh không hợp lệ!');</script>";
            $hinh_tgia = ""; // Để trống nếu định dạng ảnh không hợp lệ
        }
    } else {
        // Nếu không có ảnh, có thể để giá trị mặc định hoặc để trống
        $hinh_tgia = ""; // Hoặc bạn có thể thiết lập ảnh mặc định tại đây
    }

    // Thực hiện truy vấn thêm tác giả vào CSDL
    $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $ten_tgia, $hinh_tgia);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm tác giả thành công!'); window.location.href='author.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi thêm tác giả!');</script>";
    }

    $stmt->close();
}

$conn->close();
?>

    <div class="container mt-5">
        <h3 class="text-center text-uppercase">Thêm tác giả mới</h3>
        <form action="add_author.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ten_tgia" class="form-label">Tên tác giả</label>
                <input type="text" class="form-control" id="ten_tgia" name="ten_tgia" required>
            </div>
            <div class="mb-3">
                <label for="hinh_tgia" class="form-label">Hình ảnh tác giả</label>
                <input type="file" class="form-control" id="hinh_tgia" name="hinh_tgia" >
            </div>
            <button type="submit" class="btn btn-primary">Thêm Tác Giả</button>
        </form>
    </div>
</body>
</html>
