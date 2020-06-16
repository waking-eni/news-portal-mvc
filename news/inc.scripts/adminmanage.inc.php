<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/newsController.php';

if(isset($_POST['deletear'])) {
    $id = str_replace(array(':', '-', '/', '*', '<', '>'), '',  $_POST['arId']);
    $newsController = new NewsController();

    if(empty($id)) {
        header("Location: ../view/adminManageArticles.php?error=emptyid");
        exit();
    } else {
        $newsController->deleteNews($id);
        header("Location: ../view/adminManageArticles.php?deletearticle=success");
		exit();
    }
} else {
    header("Location: ../view/adminManageArticles.php");
	exit();
}