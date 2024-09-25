<?php
include '../conn.php';
include '../controllers/AuthorController.php';

$authorController = new AuthorController($conn);
$id = $_GET['id'];
$authorController->delete($id);
header('Location: ../views/author_list.php');
exit();
?>
