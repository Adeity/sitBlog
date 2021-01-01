<?php

$title = "sitBlog"; include("head.php");
include("topbar.php");
include("db_operations.php");

$type = null;
if(isset($_GET["type"])) {
    $type = $_GET["type"];
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
    // TODO: validate $page
}


$page_size= null;
if(isset($_GET["page_size"])) {
    $page_size = $_GET["page_size"];

    //  page_size validation
    if ($page_size > 1000000){
        $page_size = 1;
    }
}

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
                    <form id="formFilters" name="formFilters" action="" method="GET">
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
        <div class="col <?php if ($cookie_value == "light"){echo 'order-first';} else{echo 'order-last';}?>">
            <div id="main_content">
                <?php
                renderArticles(
                    $type,
                    $page,
                    $page_size
                );
                ?>
            </div>
            <div id="pagination">
                <?php
                renderPagination(
                    $type,
                    $page,
                    $page_size
                );
                ?>
            </div>

        </div>

    </div>
    <a href="" onclick="getSummary(event, 2)">asdasd</a>
</main>
<?php include("footer.php");?>

<script type="application/javascript">
    function toggleOrder(){
        filtersCol = document.querySelector("#filters");
        maincontentCol = document.querySelector("#main_content");
        if(filtersCol.classList.contains("order-first") && maincontentCol.classList.contains("order-last")){
            //  Change order of filters column
            filtersCol.classList.remove("order-first");
            filtersCol.classList.add("order-last");

            //  Change order or main_content column
            maincontentCol.classList.remove("order-last");
            maincontentCol.classList.add("order-first");
        }
        else{
            //  Change order of filters column
            filtersCol.classList.remove("order-last");
            filtersCol.classList.add("order-first");

            //  Change order or main_content column
            maincontentCol.classList.remove("order-first");
            maincontentCol.classList.add("order-last");
        }
    }
    document.querySelector("#colorSwitchCheck").addEventListener('click', toggleOrder);

</script>
<script type="application/javascript">
    function clearForm(){
        $('#radioBlog2').prop('checked', false)
        $('#radioBug2').prop('checked', false)
    }

    function removeActive(){
        $('li.page-item.active').each(function (){
            $(this).removeClass("active");
        })
    }

    $('a.page-link').each(function () {
        var $this = $(this);
        console.log($this);
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
                // data is ur summary
                $('#main_content').html(data);
                history.pushState({page: $this.data('page'), type: $this.data('type')}, "", '?page='+$this.data('page')+'&type='+$this.data('type'));
                $('html, body').animate({scrollTop: 0}, 100);
            });
        });
    });



    // $("form#formFilters").on('submit', function (event){event.preventDefault();});
    // $("#deleteFilterButton").on('click', function (event){event.preventDefault();});
</script>
