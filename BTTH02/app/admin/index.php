<?php
include '../conn.php';

// Đếm số lượng thể loại
$sql_theloai = "SELECT COUNT(ma_tloai) AS count_theloai FROM theloai";
$result_theloai = $conn->query($sql_theloai);
$count_theloai = $result_theloai->fetch_assoc()['count_theloai'];

// Đếm số lượng tác giả
$sql_tacgia = "SELECT COUNT(ma_tgia) AS count_tacgia FROM tacgia";
$result_tacgia = $conn->query($sql_tacgia);
$count_tacgia = $result_tacgia->fetch_assoc()['count_tacgia'];

// Đếm số lượng bài viết
$sql_baiviet = "SELECT COUNT(ma_bviet) AS count_baiviet FROM baiviet";
$result_baiviet = $conn->query($sql_baiviet);
$count_baiviet = $result_baiviet->fetch_assoc()['count_baiviet'];

// Đếm số lượng người dùng
$sql_users = "SELECT COUNT(idus) AS count_users FROM user";
$result_users = $conn->query($sql_users);
$count_users = $result_users->fetch_assoc()['count_users'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Lý</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Administration</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="..\views\category_list.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="..\views\author_list.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="..\views\article_list.php">Bài viết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <h1 class="text-center">Tổng Quan Quản Lý</h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Người dùng</a>
                        </h5>
                        <h5 class="h1 text-center"><?php echo $count_users; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../views/category_list.php" class="text-decoration-none">Thể loại</a>
                        </h5>
                        <h5 class="h1 text-center"><?php echo $count_theloai; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../views/author_list.php" class="text-decoration-none">Tác giả</a>
                        </h5>
                        <h5 class="h1 text-center"><?php echo $count_tacgia; ?></h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="../views/article_list.php" class="text-decoration-none">Bài viết</a>
                        </h5>
                        <h5 class="h1 text-center"><?php echo $count_baiviet; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            <h5 class="text-uppercase">TLU's Music Garden</h5>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
