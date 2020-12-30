<?php

$title = "Article"; include("head.php");
include("topbar.php");
include("db_operations.php");

if(isset($_GET["id"])){
    $id = $_GET["id"];
}

?>

    <main class="container">
        <div class="row">
            <div class="col" id="main_content">

                <?php renderArticleById($id); ?>
            </div>
        </div>
    </main>

<?php
include("footer.php");
?>