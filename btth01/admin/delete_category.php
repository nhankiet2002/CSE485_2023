<?php
include '..\conn.php'; // Kết nối CSDL

// Kiểm tra xem mã thể loại có được truyền qua URL hay không
if (isset($_GET['ma_tloai'])) {
    $ma_tloai = $_GET['ma_tloai'];

    // Chuẩn bị truy vấn xóa
    $sql = "DELETE FROM theloai WHERE ma_tloai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_tloai);

    // Thực hiện truy vấn xóa
    if ($stmt->execute()) {
        echo "<script>alert('Xóa thể loại thành công!'); window.location.href='category.php';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa thể loại!'); window.location.href='category.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Không có mã thể loại để xóa!'); window.location.href='category.php';</script>";
}

$conn->close();
?>
