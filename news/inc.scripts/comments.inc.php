<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

if(isset($_POST['comment'])) {
    require_once __DIR__.'/../controller/commentsController.php';
    require_once __DIR__.'/../model/comments.php';

    $commentsController = new CommentsController();
    $commentsModel = new Comments();

    $commentsModel->newsId = $_POST['idArticle'];
    $commentsModel->content = mysqli_real_escape_string($conn, $_POST['comment']);

    //error handling and verifying
    if(empty($content)) {
        header("Location: ../view/readNews.php?error=emptycomment");
        exit();
    } else {
        //what is the username
        if(isset($_SESSION['userUsername'])) {
            $commentsModel->username = $_SESSION['userUsername'];
        } else if(isset($_SESSION['administratorUsername'])) {
            $commentsModel->username = $_SESSION['administratorUsername'];
        } else {
            $commentsModel->username = "Anonymous";
        }

        //inserting into database
        $commentsController->insertComment($commentsModel);
        header("Location: ../view/readNews.php?id=".$commentsModel->newsId."&comments=success");
		exit();
    }

} else {
    header("Location: ../view/readNews.php?id=".$commentsModel->newsId."&");
	exit();
}