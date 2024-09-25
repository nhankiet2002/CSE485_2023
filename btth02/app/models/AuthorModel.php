<?php
class AuthorModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function list() {
        $sql = "SELECT * FROM tacgia";
        return $this->conn->query($sql);
    }

    public function add($name, $image) {
        $stmt = $this->conn->prepare("INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $image);
        return $stmt->execute();
    }

    public function update($id, $name, $image) {
        $stmt = $this->conn->prepare("UPDATE tacgia SET ten_tgia = ?, hinh_tgia = ? WHERE ma_tgia = ?");
        $stmt->bind_param("ssi", $name, $image, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM tacgia WHERE ma_tgia = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
