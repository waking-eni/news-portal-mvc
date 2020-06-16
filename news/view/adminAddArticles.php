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
        <?php
            try {
                $newsController = new NewsController();
            } catch(Exception $e) {
                echo 'Caught exception: '.$e->getMessage();
            }
            $categories = $news->getAllCategories();
        ?>

        <!--form for adding articles-->
        <h1 class="text-center mt-5">New Article</h1>    
        <form enctype="multipart/form-data" class="center-divv" name="adminaddForm" action="../includes/adminaddar.inc.php" method="post" onsubmit="return(validate());">
            <div class="form-group">
                <label for="title">Title</label>    
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                <p id="artitle"></p>
            </div>
            <div class="form-group">
                <label for="author">Author</label> 
                <input type="text" class="form-control" id="author" name="author" placeholder="Author">
                <p id="arauthor"></p>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <?php 
                        if($categories && !empty($categories)) {
                            foreach($categories as $key => $category) {
                                echo '<option>';
                                echo $category["category"];
                                echo '</option>';
                            }
                        }
                    ?>
                </select>
                <p id="arcategory"></p>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="20" cols="30"></textarea>
                    <p id="arcontent"></p>
                </div>
                <div class="form-group">
                    <label for="shortDesc">Short description</label>
                    <textarea name="shortDesc" id="shortDesc" class="form-control" rows="5" cols="30"></textarea>
                    <p id="arshortdesc"></p>
                </div>
                <div class="form-group">
                    <label for="chooseimg">Choose a picture</label>    
                    <input type="file" name="chooseimg" id="chooseimg" class="form-control">
                </div>
                <div class="form-group">
                    <label for="imgsource">Image source</label>
                    <input type="text" class="form-control" id="imgsource" name="imgsource" placeholder="Image Source">
                    <p id="arimgsource"></p>
                </div>
                <div class="form-group">
                    <button class="d-block my-3 btn btn-dark float-right" type="submit" name="add-article">Add</button>
                </div>
        </form>
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

<script>
//client side validation

function validate() {
    
    if(document.forms["adminaddForm"]["title"].value == "") {
        document.getElementById("artitle").innerHTML = "Please provide a Title";
        document.forms["adminaddForm"]["title"].focus();
        return false;
    }
    if(document.forms["adminaddForm"]["author"].value == "") {
        document.getElementById("arauthor").innerHTML = "Please provide an Author";
        document.forms["adminaddForm"]["author"].focus();
        return false;
    }
    if(document.forms["adminaddForm"]["content"].value == "") {
        document.getElementById("arcontent").innerHTML = "Please provide the Content";
        document.forms["adminaddForm"]["content"].focus();
        return false;
    }
    if(document.forms["adminaddForm"]["shortDesc"].value == "") {
        document.getElementById("arshortdesc").innerHTML = "Please provide a Short Description";
        document.forms["adminaddForm"]["shortDesc"].focus();
        return false;
    }
}

</script>

</body>

</html>