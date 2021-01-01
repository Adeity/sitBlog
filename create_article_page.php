<?php
session_start();
include_once("reload_cookie.php");
include_once("db_operations.php");
include_once("utils.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //  Article header and content can only contain character a-b, A-B, 0-9 and space.
    $re_article = "^[a-zA-Z0-9\s]*$";

    //  Article variables
    $article_heading = $_POST["article_heading"];
    $article_content = $_POST["article_content"];
    $article_author = $_SESSION["logged_user"];
    if(isset($_POST["radioType"])){
        $article_type = $_POST["radioType"];
    }
    else{
        $article_type = "blog";
    }

    //  Validate if isnt empty
    $is_empty = false;
    if(!$article_heading){
        $_SESSION["create_article_heading_error"] = "Empty article heading";
        $is_empty = true;
    }
    if(!$article_content){
        $_SESSION["create_article_content_error"] = "Empty article content";
        $is_empty = true;
    }
    if($is_empty){
        header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }

    createArticle(
        $article_heading,
        $article_content,
        $article_author,
        $article_type
    );
    header("Location: ".base_path."/success_create_article.php");
}
include_once("topbar.php");
?>

    <main class="container">
        <div class="row">
            <div class="col" id="main_content">
                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["logged_user"])) {
                            ?>

                    <h4 class="pb-3">Create article</h4>
                            <p>Forms tagged with * sign are required</p>
                    <form method="post" action="create_article_page.php" id="createArticleForm" name="createArticleForm">
<!--                        Protoze uzivatel si muze psat jake clanky chce, neni zde pattern. Akorat article heading a article content nesmi byt prazdne-->
                        <div class="form-group">
                            <span>* </span><label for="article_heading">Article heading</label>
                            <textarea
                                    class="form-control <?php if(session_get("create_article_heading_error", false)){echo ' is-invalid';}?>"
                                      id="article_heading"
                                      name="article_heading"
                                      rows="1"
                                      required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <span>* </span><label for="article_content">Article</label>
                            <textarea
                                    class="form-control <?php if(session_get("create_article_content_error", false)){echo ' is-invalid';}?>"
                                    id="article_content"
                                    name="article_content"
                                    rows="5"
                                    required></textarea>
                        </div>
                        <label>What type of article?</label>
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioType" id="radioBlog" value="blog">
                                <label class="form-check-label" for="radioBlog">
                                    Blog article
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radioType" id="radioBug" value="bug">
                                <label class="form-check-label" for="radioBug">
                                    Bug article
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block mt-2" type="submit">Create article</button>
                    </form>
                    <?php
                        }
                        else{
                            echo 'You must be logged in to create an article.';
                        }
                        ?>
                    </div>
                    </div>
                </div>
        </div>
    </main>

<script>
    //  Client side validation. User can post whatever he wants, just not empty heading or content.
    $("form[name=createArticleForm]").submit(function(event){
        //  Set variable and remove class is-invalid if there is one
        articleHeading = $("textarea[name=article_heading]");
        articleHeadingValue = articleHeading.val();
        articleHeading.removeClass("is-invalid");

        //  Set variable and remove class is-invalid if there is one
        articleContent = $("textarea[name=article_content]");
        articleContentValue = articleContent.val();
        articleContent.removeClass("is-invalid");

        //  Is value empty? If so, !isValid
        var isValid = true;
        if (!articleHeadingValue){
            articleHeading.addClass("is-invalid");
            isValid = false;
        }
        if (!articleContentValue){
            articleContent.addClass("is-invalid");
            isValid = false
        }
        if(!isValid){
            event.preventDefault();
        }
    });
</script>
<?php include("footer.php");?>

