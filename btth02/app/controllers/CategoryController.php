<?php
include '../models/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct($conn) {
        $this->categoryModel = new CategoryModel($conn);
    }

    public function list() {
        return $this->categoryModel->list();
    }

    public function add($name) {
        return $this->categoryModel->add($name);
    }

    public function update($id, $name) {
        return $this->categoryModel->update($id, $name);
    }

    public function delete($id) {
        return $this->categoryModel->delete($id);
    }
    public function getCategoryById($id) {
        return $this->categoryModel->getCategoryById($id);
    }
    
}
?>
