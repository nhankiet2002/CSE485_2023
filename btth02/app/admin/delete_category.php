<?php
include '../conn.php';
include '../controllers/CategoryController.php';

$categoryController = new CategoryController($conn);

$id = $_GET['ma_tloai']; 
$categoryController->delete($id);

header('Location: ../views/category_list.php');
exit();
?>
