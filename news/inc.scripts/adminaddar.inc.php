<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/newsController.php';
require_once __DIR__.'/../model/news.php';

if(isset($_POST['add-article'])) {
    $newsController = new NewsController();
    $news = new News();

    $news->title = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['title']);
    $news->author = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['author']);
    $news->category = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['category']);
    $news->content = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['content']);
    $news->shortDesc = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['shortDesc']);

    $news->dateAdded = date('Y-m-d H:i:s');

    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['chooseimg']['tmp_name'])) {
            $news->picture = addslashes(file_get_contents($_FILES['chooseimg']['tmp_name']));
            $news->pictureSrc = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['imgsource']);
        }
    } else {
        $news->picture = null;
        $news->pictureSrc = null;
    }

    if(empty($news->title) || empty($news->author) || empty($news->category)  || empty($news->content)  || empty($news->shortDesc)) {
        header("Location: ../view/adminAddArticles.php?error=emptyfields");
        exit();
    } else {
        $newsController->insertNews($news);
        header("Location: ../view/adminAddArticles.php?add=success");
        exit();
    }

} else {
    header("Location: ../view/adminAddArticles.php");
    exit();
}