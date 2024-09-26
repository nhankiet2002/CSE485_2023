<?php
class CategoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function list() {
        $sql = "SELECT * FROM theloai";
        return $this->conn->query($sql);
    }

    public function add($name) {
        $stmt = $this->conn->prepare("INSERT INTO theloai (ten_tloai) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    public function update($id, $name) {
        $stmt = $this->conn->prepare("UPDATE theloai SET ten_tloai = ? WHERE ma_tloai = ?");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM theloai WHERE ma_tloai = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function getCategoryById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM theloai WHERE ma_tloai = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
}
?>
