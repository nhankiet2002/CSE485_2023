<?php
include '../conn.php'; // Kết nối đến CSDL

// Xử lý thêm thể loại
if (isset($_POST['add'])) {
    $ten_tloai = $_POST['ten_tloai'];
    $sql_add = "INSERT INTO theloai (ten_tloai) VALUES ('$ten_tloai')";
    $conn->query($sql_add);
}

// Xử lý xóa thể loại
if (isset($_GET['delete'])) {
    $ma_tloai = $_GET['delete'];
    $sql_delete = "DELETE FROM theloai WHERE ma_tloai = '$ma_tloai'";
    $conn->query($sql_delete);
}

// Lấy danh sách thể loại
$sql_list = "SELECT * FROM theloai";
$result_list = $conn->query($sql_list);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Thể Loại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Quản Lý Thể Loại</a>
        </div>
    </nav>
</header>

<main class="container mt-5">
    <h3 class="text-center">Danh Sách Thể Loại</h3>

    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="ten_tloai" class="form-control" placeholder="Tên thể loại" required>
            <button class="btn btn-primary" type="submit" name="add">Thêm</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ma thể loại</th>
                <th>Tên thể loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_list->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['ma_tloai']; ?></td>
                    <td><?php echo $row['ten_tloai']; ?></td>
                    <td>
                        <a href="?delete=<?php echo $row['ma_tloai']; ?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
