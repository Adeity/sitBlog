<?php
$title = "sitBlog"; include("head.php");
include 'db_operations.php';


$id = $_POST["id"];
//TODO: is logged in? if not, return.
if(!isset($_SESSION["logged_user"])){
    $_SESSION["delete_error_message"] = "User isnt logged";
//    header("Location: ".base_path);
    exit;
}



//TODO: fetch article with id $id from DB
$article = get_author_by_article_id($id, false);
if($article === false){
    $_SESSION["delete_error_message"] = "Article doesnt exist";
//    header("Location: ".base_path);
    exit;
}

//TODO: compare username from session with usernam from article. If no match, return.
if($article["author"] != $_SESSION["logged_user"]){
    $_SESSION["delete_error_message"] = "Logged user didnt post this";
//    header("Location: ".base_path);
    exit;
}

//TODO: refactor deleteData($name, $id) to deleteArticle($id)

deleteArticle($id);
include("topbar.php");
?>

    <main class="container">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex pb-2">
                        <i class="fas fa-bug fs-1 d-flex fa-align-start"></i>
                    </div>
                    <?php
                    if(isset($_SESSION["delete_error_message"])){
                        echo '<p>'.$_SESSION["delete_error_message"].'</p>';
                    }
                    else{
                        echo '<p>You deleted an articicle</p>';
                    }
                    echo '<a class="btn btn-primary" href="'.base_path.'" role="button">Go back</a>';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php
include("footer.php");
$_SESSION["delete_error_message"] = "";
?>

