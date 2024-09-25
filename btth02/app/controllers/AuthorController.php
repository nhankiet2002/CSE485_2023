<?php
include '../models/AuthorModel.php';

class AuthorController {
    private $authorModel;

    public function __construct($conn) {
        $this->authorModel = new AuthorModel($conn);
    }

    public function list() {
        return $this->authorModel->list();
    }

    public function add($name, $image) {
        return $this->authorModel->add($name, $image);
    }

    public function update($id, $name, $image) {
        return $this->authorModel->update($id, $name, $image);
    }

    public function delete($id) {
        return $this->authorModel->delete($id);
    }
}
?>
