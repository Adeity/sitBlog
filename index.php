<?php

$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");
?>

<main class="container">

    <div class="row">
        <div class="col" id="main_content">

            <?php
                if ($brand_cookie_value == "Blog"){
                    getBlogData();
                }
                else if ($brand_cookie_value == "Bug"){
                    getBugData();
                }
                else{
                    getBlogData();
                }
            ?>
        </div>
    </div>
</main>
<?php include("footer.php");?>

<script type="application/javascript">

</script>
