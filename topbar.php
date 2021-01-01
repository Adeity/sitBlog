<?php
$title = "sitBlog"; include("head.php");
//  Topbar. If user is logged, echo username and link to create article page.
?>
<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_path ?>">
                <i class="fas fa-bug"></i>
                sitBlog
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                if (isset($_SESSION['logged_user'])){
                    echo '
                    <div class="d-flex flex-row"> 
                        <span class=""><span class="pe-3"> User: '.$_SESSION['logged_user'].'</span><a href="create_article_page.php" class="text-decoration-none">Create article</a><a href="logout.php" class="text-decoration-none ms-4">Log out</a></span>
                    </div>
                    
                    ';
                }
                else{
                    echo '<a href="login_page.php" class="text-decoration-none">Log in</a>';
                }
            ?>
        </div>
    </nav>
</header>


