<?php
include 'db_operations.php';
session_start();
include_once("reload_cookie.php");

$id = $_POST["id"];
//  Is logged in? if not, exit.
if(!isset($_SESSION["logged_user"])){
    $_SESSION["delete_error_message"] = "User isnt logged";
    exit;
}

//  fetch article with id $id from DB
$article = get_article_by_article_id($id, false);
if($article === false){
    $_SESSION["delete_error_message"] = "Article doesnt exist";
    exit;
}

// compare username from session with usernam from article. If no match, exit.
if($article["author"] != $_SESSION["logged_user"]){
    $_SESSION["delete_error_message"] = "Logged user didnt post this";
    exit;
}

//  delete article!
deleteArticle($id);
include_once("topbar.php");
?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <?php
                    //  If error message is set; echo
                    if(isset($_SESSION["delete_error_message"])){
                        echo '<p>'.$_SESSION["delete_error_message"].'</p>';
                    }
                    //  Success!
                    else{
                        echo '<p>You deleted an article</p>';
                    }
                    echo '<a class="btn btn-primary" href="'.base_path.'" role="button">Go back</a>';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php
include("footer.php");
//  Delete error message. Dont show on reload.
$_SESSION["delete_error_message"] = "";
?>

