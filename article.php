<?php

$title = "Article"; include("head.php");
include("topbar.php");
include("db_operations.php");

if(isset($_GET["name"]) && isset($_GET["id"])){
    $name = $_GET["name"];
    $id = $_GET["id"];
}

?>

    <main class="container">
        <div class="row">
            <div class="col" id="main_content">

                <?php getDataByID($name, $id); ?>
            </div>
        </div>
    </main>

<?php
include("footer.php");
?>