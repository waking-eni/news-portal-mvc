<?php

require_once __DIR__.'/modelController.php';
session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

$controller = new ModelController();

$idArticle = $_SESSION['idArticle'];
$commentNewCount = $_POST['commentNewCount'];

$sql = "SELECT id, username, content FROM comments WHERE news_id = ? LIMIT $commentNewCount ;";
$result = $controller->oneParamRecord($sql, $idArticle);

foreach($result as $key => $comment) {
    echo '<div class="card">';
        echo '<div class="card-body">';
            echo '<h6 class="card-header">'.stripslashes($comment['username']).'</h6>';
            echo '<p class="card-text">'.stripslashes($comment['content']).'</p>';

            //button for deleting comments
            if(isset($_SESSION['administratorUsername']) || 
                    (isset($_SESSION['userUsername']) && ($_SESSION['userUsername'] == $comment['username']))) {
                        echo '<form action="../includes/comments.inc.php" method="post">';
                        echo '<button type="submit" name="deletecom" class="btn btn-dark">Delete</button>';
                        echo '<input type="hidden" name="comId" value="'.$comment['id'].'">';
                        echo '</form>';
            }

        echo '</div>';
    echo '</div>';
}