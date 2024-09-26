<?php
include "../db.php"; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $cat_id = mysqli_real_escape_string($conn, $_GET['id']); // Lấy mã thể loại từ URL

    // Xóa thể loại
    $delete_sql = "DELETE FROM theloai WHERE ma_tloai = '$cat_id'";

    if (mysqli_query($conn, $delete_sql)) {
        // Xóa thành công
        echo "<script>alert('Xóa thể loại thành công!'); window.location.href='category.php';</script>";
    } else {
        // Lỗi khi xóa
        echo "<script>alert('Xóa thất bại!'); window.location.href='category.php';</script>";
    }
} else {
    echo "<script>alert('Không có mã thể loại để xóa!'); window.location.href='category.php';</script>";
}
?>
