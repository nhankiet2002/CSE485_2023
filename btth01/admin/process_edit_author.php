<?php
include '..\conn.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tgia = $_POST['ma_tgia'];
    $ten_tgia = $_POST['ten_tgia'];

    // Cập nhật tên tác giả trong CSDL
    $sql = "UPDATE theloai SET ten_tgia = ? WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $ten_tgia, $ma_tgia);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='author.php';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại!'); window.location.href='author.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Yêu cầu không hợp lệ!'); window.location.href='author.php';</script>";
}
?>
