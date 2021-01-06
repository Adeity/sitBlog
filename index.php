<?php
/**
 * Index page
 *
 * Get parameters get somewhat validated here and render functions get called based on these parameters
 *
 */

//  Include important files and start session
session_start();
include_once("reload_cookie.php");
include("db_operations.php");

//  GET parameters get sent to this site. This handles them or sets a defaul value
$type = null;
if(isset($_GET["type"])) {
    $type = $_GET["type"];
    //  Whitelisting
    if (!$type == "blog" && !$type == "bug"){
        $type = null;
    }
}

$page= null;
if(isset($_GET["page"])) {
    $page = $_GET["page"];

    //  page validation
    if ($page > 1000000){
        $page = 1;
    }
}


$page_size= null;
if(isset($_GET["page_size"])) {
    $page_size = $_GET["page_size"];

    //  page_size validation
    if ($page_size > 1000000){
        $page_size = 1;
    }
}
include_once("topbar.php");
?>

<main class="container">
    <div class="row">
        <div class="col-3 <?php if ($cookie_value == "light"){echo 'order-last';} else{echo 'order-first';} ?>" id="filters">
            <div class="card mt-2">
                <div class="card-header">
                    Filtry
                </div>
                <div class="card-body">
                    <p>
                        Podle typu
                    </p>
                    <form id="formFilters" name="formFilters" action="?" method="GET">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="radioBlog2" value="blog" <?php if($type==="blog") {echo "checked";}  ?>>
                            <label class="form-check-label" for="radioBlog2">
                                Blog článek
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="radioBug2" value="bug" <?php if($type==="bug") {echo "checked";}  ?>>
                            <label class="form-check-label" for="radioBug2">
                                Bug článek
                            </label>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Aplikovat filtr</button>
                        <a href="?type="
                           class="btn btn-warning mt-2"
                           data-type=""
                           data-page="1"
                           id="deleteFilterButton">Smazat filtr</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col <?php if ($cookie_value == "light"){echo 'order-first';} else{echo 'order-last';}?>" id="col-containing-main-content">
            <div id="main_content">
                <?php
                //  Renders and echoes articles
                renderArticles(
                    $type,
                    $page,
                    $page_size
                );
                ?>
            </div>
            <div id="pagination">
                <?php
                //  Renders and echoes pagination
                renderPagination(
                    $type,
                    $page,
                    $page_size
                );
                ?>
            </div>
        </div>
    </div>
</main>
<script>
    //  This removes active class from pagination.active list item
    function removeActive(){
        $('li.page-item.active').each(function (){
            $(this).removeClass("active");
        })
    }

    //  Each pagination leaf has a function to create a GET request. Request is sent article_results.php, where only article results are generated. Only #main_content on current page gets updated.
    $('a.page-link').each(function () {
        var $this = $(this);
        $this.on("click", function (event)
        {
            removeActive();
            $(this).parent().addClass("active");
            console.log($this.data('query'));
            event.preventDefault();
            $.ajax({

                type: "GET",
                url: 'article_results.php',
                data: $this.data('query'), // appears as $_GET @ your backend side
            }).done(function(data) {
                // data is the summary
                $('#main_content').html(data);
                history.pushState({page: $this.data('page'), type: $this.data('type')}, "", '?page='+$this.data('page')+'&type='+$this.data('type'));
                $('html, body').animate({scrollTop: 0}, 100);
            });
        });
    });
</script>
<?php include("footer.php");?>
