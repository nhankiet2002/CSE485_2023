<?php
include "../db.php"; // Kết nối cơ sở dữ liệu

if (isset($_GET['id'])) {
    $aut_id = mysqli_real_escape_string($conn, $_GET['id']); // Lấy mã thể loại từ URL

    // Xóa thể loại
    $delete_sql = "DELETE FROM tacgia WHERE ma_tgia = '$aut_id'";

    if (mysqli_query($conn, $delete_sql)) {
        // Xóa thành công
        echo "<script>alert('Xóa tác giả thành công!'); window.location.href='author.php';</script>";
    } else {
        // Lỗi khi xóa
        echo "<script>alert('Xóa thất bại!'); window.location.href='author.php';</script>";
    }
} else {
    echo "<script>alert('Không có mã tác giả để xóa!'); window.location.href='author.php';</script>";
}
?>
