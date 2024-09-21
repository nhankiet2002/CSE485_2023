<?php
include '../db.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_bviet = $_POST['ma_bviet'];
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $theloai = $_POST['theloai'];
    $tacgia = $_POST['tacgia'];
    $noidung = $_POST['noidung'];

    // Xử lý hình ảnh
    $hinhanh = $_POST['hinhanh_cu']; // Hình ảnh cũ
    if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
        $hinhanh = 'uploads/' . basename($_FILES['hinhanh']['name']);
        move_uploaded_file($_FILES['hinhanh']['tmp_name'], $hinhanh);
    }

    // Cập nhật bài viết trong cơ sở dữ liệu
    $sql = "UPDATE baiviet SET tieude = ?, ten_bhat = ?, ma_tloai = ?, ma_tgia = ?, noidung = ?, hinhanh = ? WHERE ma_bviet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $tieude, $ten_bhat, $theloai, $tacgia, $noidung, $hinhanh, $ma_bviet);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật bài viết thành công!'); window.location.href='article.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra khi cập nhật!'); window.location.href='article.php';</script>";
    }

    $stmt->close();
}
?>
