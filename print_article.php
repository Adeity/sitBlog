<?php
function printArticle($heading, $content, $article_anchor){
    echo '<div class="card my-2 shadow"><div class="card-body">';
    echo '<h5 class="card-title">' . $heading . '</h5>';
    echo '<p class="card-text">' . $content . '</p>';
    echo '<div class="d-flex justify-content-end">';
    echo '<a class="btn btn-primary" href="'.$article_anchor.'" role="button">Visit article</a>';
    echo '</div>';
    echo '</div></div>';
}

function printArticleByID($heading, $content, $name, $id, $author){
    echo '<div class="card my-2 shadow"><div class="card-body">';
    echo '<h5 class="card-title">' . $heading . '</h5>';
    echo '<p class="card-text">' . $content . '</p>';
    echo '<div class="d-flex align-items-center">';
    echo '<div class="text-muted">Posted by user '.$author.'</div>';
    echo '<a class="btn btn-primary ms-auto" href="'.DOCUMENTROOT.'" role="button">Go back</a>';
    if (isset($_SESSION["logged_user"]) && $_SESSION["logged_user"] == $author){
        echo ' 
        <form method="post" class="d-inline ms-2" action="delete_article.php" onsubmit="return confirm(&#39;Are you sure you want to delete article?&#39;)">
            <label for="delete" class="btn btn-danger">Delete</label>
            <input class="btn btn-danger d-none" type="submit" id="delete" name="delete" value="'.$name.'+'.$id.'">
        </form>
        ';
    }
    echo '</div>';
    echo '</div></div>';
}