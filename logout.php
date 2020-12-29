<?php
$title = "sitBlog"; include("head.php");
include("topbar.php");
unset($_SESSION['logged_user']);
session_destroy();

include("db_operations.php");
?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <?php
                    echo '<p>You are logged out.</p>';
                    echo '<a class="btn btn-primary" href="'.DOCUMENTROOT.'" role="button">Go back</a>';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php include("footer.php");?>