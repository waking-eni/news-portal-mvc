<?php
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    require_once __DIR__.'/../controller/commentsController.php';
?>

<!--form for adding comments-->
<form action="../includes/comments.inc.php" method="post" name="commentForm" onsubmit="emptyComment()">
    <div class="form-group">
        <span>Add a comment</span>
            <button class="btn btn-dark" type="submit" name="comment">
                Comment
            </button>
        <textarea class="form-control" rows="3" name="comment" id="commentArea" placeholder="..."></textarea>
    </div>
</form>

<div id="comment-div"></div>

<button id="showmore" class="btn btn-dark">Show more comments</button>

<!--show existing comments from the database-->
<div class="comment-div" id="comments-div">
    <?php

    $comm = new CommentsController();
    $idArticle = $_SESSION['idArticle'];
    $comments = $comm->selectComment($idArticle);

    if($comments && !empty($comments)) {
        foreach($comments as $key => $comment) {
            echo '<div class="card">';
                echo '<div class="card-body">';
                    echo '<h6 class="card-header">'.stripslashes($comment['username']).'</h6>';
                    echo '<p class="card-text">'.stripslashes($comment['content']).'</p>';

                    //button for deleting comments
                    if(isset($_SESSION['administratorUsername']) || 
                            (isset($_SESSION['userUsername']) && ($_SESSION['userUsername'] == $comment['username']))) {
                                echo '<form action="../inc.scripts/comments.inc.php" method="post">';
                                echo '<button type="submit" name="deletecom" class="btn btn-dark">Delete</button>';
                                echo '<input type="hidden" name="comId" value="'.$comment['id'].'">';
                                echo '</form>';
                    }

                echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>

<script>
    function emptyComment() {
        document.getElementById("commentArea").innerText = "";
    }

    //ajax
    $(document).ready(function() {
        var commentCount = 2;
        $("#showmore").click(function() {
            commentCount += 2;
            $("#comments-div").load("../inc.scripts/loadcomments.inc.php", {
                commentNewCount: commentCount
            })
        });
    });
</script>