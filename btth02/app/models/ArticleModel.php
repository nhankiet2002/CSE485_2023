<?php
class ArticleModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function list() {
        $sql = "SELECT * FROM baiviet";
        return $this->conn->query($sql);
    }

    public function add($title, $songName, $categoryId, $summary, $content, $authorId, $date, $image) {
        $stmt = $this->conn->prepare("INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssississ", $title, $songName, $categoryId, $summary, $content, $authorId, $date, $image);
        return $stmt->execute();
    }

    public function update($id, $title, $songName, $categoryId, $summary, $content, $authorId, $date, $image) {
        $stmt = $this->conn->prepare("UPDATE baiviet SET tieude = ?, ten_bhat = ?, ma_tloai = ?, tomtat = ?, noidung = ?, ma_tgia = ?, ngayviet = ?, hinhanh = ? WHERE ma_bviet = ?");
        $stmt->bind_param("ssississi", $title, $songName, $categoryId, $summary, $content, $authorId, $date, $image, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM baiviet WHERE ma_bviet = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
