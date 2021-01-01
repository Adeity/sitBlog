<?php
session_start();
include_once("reload_cookie.php");
include("db_operations.php");
include_once ("topbar.php");

//  you get redirected to this site with different success messages
?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <?php
                    if(isset($_SESSION["success_message"])){
                        echo '<p>'.$_SESSION["success_message"].'</p>';
                    }
                    echo '<a class="btn btn-primary" href="'.base_path.'" role="button">Go back</a>';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php include("footer.php");?>