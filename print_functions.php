<?php
include ("utils.php");
function printArticle($article_id, $article_heading, $article_content, $article_type){
    ?>
    <div class="card my-2 shadow">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($article_heading) ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($article_content) ?></p>
            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="single_article.php?id=<?php echo $article_id ?>" role="button">Visit article</a>
            </div>
        </div>
        <div class="card-footer">
            <?php echo $article_type ?>
        </div>
    </div>
<?php
}

function printArticleByID($article_heading, $article_content, $article_author, $article_id){
    ?>
    <div class="card my-2 shadow"><div class="card-body">
    <h5 class="card-title"><?php echo htmlspecialchars($article_heading) ?></h5>
    <p class="card-text"><?php echo htmlspecialchars($article_content) ?></p>
            <div class="d-flex align-items-center">
                <div class="text-muted">Posted by user <?php echo htmlspecialchars($article_author) ?></div>
                <a class="btn btn-primary ms-auto" href="/semestralka" role="button">Go back</a>
    <?php
    if(session_get("logged_user", false) == $article_author){
        ?>
        <form method="post" class="d-inline ms-2" action="delete_article.php" onsubmit="return confirm("Are you sure you want to delete article?")">
            <label for="delete" class="btn btn-danger">Delete</label>
            <input class="btn btn-danger d-none" type="submit" id="delete" name="id" value="<?php echo $article_id ?>">
        </form>

        <?php
    }
    ?>
    </div>
        </div>
        </div>
    <?php
}

function print_pagination($type, $page, $total_pages){
    ?>
    <nav class="d-flex justify-content-center" aria-label="pagination">
        <ul class="pagination pagination-sm">
            <?php
            for($i = 0; $i < $total_pages; $i++){
                if ($page == ($i+1)){
                    $is_active = 'active';
                }
                else{
                    $is_active = '';
                }
                echo '<li class="page-item '.$is_active.'">
                        <a
                           class="page-link"
                           href="'.base_path.'?type='.$type.'&page='.($i+1).'"
                           data-page="'.($i+1).'"
                           data-type="'.$type.'"
                           data-query="type='.$type.'&page='.($i+1).'"
                           >'.($i+1).'
                        </a>
                      </li>';
                }
            ?>
        </ul>
    </nav>
<?php
}
?>