<?php
include '..\conn.php'; // Kết nối CSDL

if (isset($_GET['ma_tgia'])) {
    $ma_tgia = $_GET['ma_tgia'];

    // Truy vấn xóa tác giả theo mã
    $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_tgia);

    if ($stmt->execute()) {
        // Nếu xóa thành công, chuyển hướng về trang danh sách tác giả
        echo "<script>alert('Xóa tác giả thành công!'); window.location.href='author.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa tác giả!'); window.location.href='author.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
