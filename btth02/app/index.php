<?php
include 'conn.php'; // Kết nối đến cơ sở dữ liệu

// Lấy danh sách bài viết từ cơ sở dữ liệu
$sql_baiviet = "SELECT ma_bviet, tieude, ten_bhat, tomtat, hinhanh FROM baiviet ORDER BY ngayviet DESC LIMIT 5"; // Lấy 5 bài viết mới nhất
$result_baiviet = $conn->query($sql_baiviet);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Music for Life</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Music for Life</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index.php">Quản lý</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin/login.php">Đăng nhập</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <h1 class="text-center">Chào Mừng Đến Với Music for Life</h1>
        <h2 class="mt-5">Bài Viết Mới Nhất</h2>
        <div class="row">
            <?php if ($result_baiviet->num_rows > 0): ?>
                <?php while ($row = $result_baiviet->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row['hinhanh'] ? $row['hinhanh'] : 'default.jpg'; ?>" class="card-img-top" alt="<?php echo $row['ten_bhat']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['tieude']; ?></h5>
                                <p class="card-text"><?php echo $row['tomtat']; ?></p>
                                <a href="article/article.php?ma_bviet=<?php echo $row['ma_bviet']; ?>" class="btn btn-primary">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">Không có bài viết nào.</p>
            <?php endif; ?>
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
