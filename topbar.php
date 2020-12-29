
<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container">
            <a class="navbar-brand" href="http://zwa.local:8080/semestralka">
                <i class="fas fa-bug"></i>
                sit<span id="brand-name" class="op-1"><?php echo $brand_cookie_value; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                if ($brand_cookie_value == "Blog"){
                    echo '<div class="me-auto pl-4"><a class="ms-2 text-decoration-none" href="switch.php">Switch to sitBug</a></div> ';
                }
                else{
                    echo '<div class="me-auto pl-4"><a class="ms-2 text-decoration-none" href="switch.php">Switch to sitBlog</a></div>';
                }
            ?>
            <?php
                if (isset($_SESSION['logged_user'])){
                    echo '
                    <div class="d-flex flex-row"> 
                        <span class=""><a href="create_article_page.php" class="text-decoration-none"> User: '.$_SESSION['logged_user'].'</a><a href="logout.php" class="text-decoration-none ms-4">Log out</a></span>
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


