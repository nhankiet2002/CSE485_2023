<?php
include '../conn.php';
include '../controllers/AuthorController.php';

$authorController = new AuthorController($conn);


$id = $_GET['ma_tgia']; 
$authorController->delete($id);


header('Location: ../views/author_list.php');
exit();
?>
