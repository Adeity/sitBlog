<?php
session_start();
include_once("reload_cookie.php");
include("db_operations.php");
include_once ("topbar.php");
//  you get redirected here when you successfuly create and article
?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <p>You created an article.</p>
                    <a class="btn btn-primary" href="<?php echo base_path; ?>" role="button">Go back</a>
                </div>
            </div>
        </div>
    </main>
<?php include("footer.php");?>