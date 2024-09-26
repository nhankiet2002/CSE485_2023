<?php
include '../conn.php';
include '../controllers/ArticleController.php';

$articleController = new ArticleController($conn);

$id = $_GET['ma_bviet']; 
$articleController->delete($id);


header('Location: ../views/article_list.php');
exit();
?>
