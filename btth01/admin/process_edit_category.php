<?php
include '..\conn.php'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_tloai = $_POST['ma_tloai'];
    $ten_tloai = $_POST['ten_tloai'];

    // Cập nhật tên thể loại trong CSDL
    $sql = "UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $ten_tloai, $ma_tloai);

    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href='category.php';</script>";
    } else {
        echo "<script>alert('Cập nhật thất bại!'); window.location.href='category.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Yêu cầu không hợp lệ!'); window.location.href='category.php';</script>";
}
?>
