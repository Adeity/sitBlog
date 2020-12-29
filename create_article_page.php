<?php

$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");
?>

    <main class="container">

        <div class="row">
            <div class="col" id="main_content">

                <?php
                if (isset($_SESSION["logged_user"])) {
                    echo
                    '
                    <h4 class="pb-3">Create article</h4>
                    <form method="post" action="create_article.php">
                        <div class="form-group pb-3">
                            <label for="exampleFormControlSelect1">Where do you want to post to?</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option>sitBlog</option>
                              <option>sitBug</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Article heading</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Article</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>
                        <button class="btn btn-primary btn-block mt-2" type="submit">Create article</button>
                    </form>
                    ';
                }
                else{
                    echo 'You must be logged in to create an article.';
                }
                ?>
            </div>
        </div>
    </main>
<?php include("footer.php");?>