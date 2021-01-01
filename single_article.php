<?php
session_start();
include_once("reload_cookie.php");
include("db_operations.php");

//  is GET is set, render article with id
if(isset($_GET["id"])){
    $id = $_GET["id"];
}
include_once ("topbar.php");
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