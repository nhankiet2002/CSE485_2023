<?php
include "../db.php"; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $bv_id = mysqli_real_escape_string($conn, $_GET['id']); // Lấy mã thể loại từ URL

    // Xóa thể loại
    $delete_sql = "DELETE FROM baiviet WHERE ma_bviet = '$bv_id'";

    if (mysqli_query($conn, $delete_sql)) {
        // Xóa thành công
        echo "<script>alert('Xóa bài viết thành công!'); window.location.href='article.php';</script>";
    } else {
        // Lỗi khi xóa
        echo "<script>alert('Xóa thất bại!'); window.location.href='article.php';</script>";
    }
} else {
    echo "<script>alert('Không có mã bài viết để xóa!'); window.location.href='article.php';</script>";
}
?>
