
<?php
include '../db.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $ma_tloai = $_POST['ma_tloai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $ma_tgia = $_POST['ma_tgia'];
    $ngayviet = $_POST['ngayviet'];
    
    // Xử lý upload hình ảnh
    $hinhanh = null;
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == UPLOAD_ERR_OK) {
        $hinhanh = 'uploads/' . basename($_FILES['hinhanh']['name']);
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $hinhanh);
    }

    // Câu truy vấn thêm bài viết
    $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $tieude, $ten_bhat, $ma_tloai, $tomtat, $noidung, $ma_tgia, $ngayviet, $hinhanh);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm bài viết thành công!'); window.location.href='article.php';</script>";
    } else {
        echo "<script>alert('Thêm bài viết thất bại!'); window.location.href='add_article.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
