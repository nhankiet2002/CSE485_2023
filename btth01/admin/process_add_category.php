<?php
include '..\conn.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten_tloai = $_POST['ten_tloai'];

    // Chuẩn bị truy vấn để thêm thể loại
    $sql = "INSERT INTO theloai (ten_tloai) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ten_tloai);

    if ($stmt->execute()) {
        echo "<script>alert('Thêm thể loại thành công!'); window.location.href='category.php';</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra!'); window.history.back();</script>";
    }

    $stmt->close();
}

$conn->close();
?>
