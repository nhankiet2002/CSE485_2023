<?php
include '../models/ArticleModel.php';

class ArticleController {
    private $articleModel;

    public function __construct($conn) {
        $this->articleModel = new ArticleModel($conn);
    }

    public function list() {
        return $this->articleModel->list();
    }

    public function add($title, $songName, $categoryId, $summary, $content, $authorId, $date, $image) {
        return $this->articleModel->add($title, $songName, $categoryId, $summary, $content, $authorId, $date, $image);
    }

    public function update($id, $title, $songName, $categoryId, $summary, $content, $authorId, $date, $image) {
        return $this->articleModel->update($id, $title, $songName, $categoryId, $summary, $content, $authorId, $date, $image);
    }

    public function delete($id) {
        return $this->articleModel->delete($id);
    }
}
?>
