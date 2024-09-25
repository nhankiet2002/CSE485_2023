<?php
include '../conn.php';
include '../controllers/CategoryController.php';

$categoryController = new CategoryController($conn);
$id = $_GET['id'];
$categoryController->delete($id);
header('Location: ../views/category_list.php');
exit();
?>
