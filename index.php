<?php

$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");
?>

<main class="container">
    <div class="row">
        <div class="col" id="main_content">
            <?php
            renderArticles();
            ?>
        </div>
    </div>
</main>
<?php include("footer.php");?>

<script type="application/javascript">

</script>
