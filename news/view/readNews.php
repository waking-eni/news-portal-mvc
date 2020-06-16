<?php
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    require_once __DIR__.'/../controller/newsController.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <!-- STYLE -->
    <link href="../css/style.css" rel="stylesheet" />
    <title>News Portal</title>
</head>

<body>

<!-- HEADER -->
<?php
    include 'includes/header.php';
?>
<!-- HEADER END -->

<!-- WRAPPER -->
<div class="container-fluid wrapper-container">
    <div class="row row-wrapper mt-5">

        <!-- SIDEBAR -->
        <?php
            include 'includes/sidebar.php';
        ?>
        <!-- SIDEBAR END -->


        <!-- MAIN -->
        <main class="col-9 main">
            <div class="main-card row">

            <?php

            try {
                $newsController = new NewsController();
            } catch(Exception $e) {
                echo 'Caught exception: '.$e->getMessage();
            }

            $idNews = $_GET['id'];
            $news = $newsController->selectNews($idNews);

            //show the book
            if(!empty($news)) {

                foreach($news as $key => $value) {

                    echo '<div class="jumbotron jumbotron-fluid mt-3">';
                        echo '<div class="container">';
                            echo '<h1 class=display-4">'.stripslashes($value["title"]).'</h1>';
                            echo '<p class="lead">'.stripslashes($value["short_description"]).'</p>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="image-read-news">';
                        echo '<img src="data:image/jpeg;base64,'.base64_encode( $value['picture'] ).'"/>';
                        echo '<a class="d-block green-link" href="'.$value["picture_source"].'" target="_blank">'.'Image source</a>';
                    echo '</div>';

                    echo '<hr>';

                    echo '<div class="article-content">';
                    echo stripslashes($value['content']);
                        echo '<hr>';
                        echo '<p class="font-weight-bold text-right">Written by '.$value["author"].'</p>';
                        echo '<p class="font-weight-bold text-right">Published on '.$value["date_added"].', category: '.$value["category"].'</p>';
                    echo '</div>';

                    $_SESSION['newsId'] = stripslashes($value['id']);
                }
            }

            ?>

            </div>

            <!--comments-->
            <?php
                include 'includes/comments.php';
            ?>
            <!--end of comments-->

        </main>
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

</body>

</html>