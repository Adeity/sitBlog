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
    try{
        $page = intval($_GET["page"]);
    } catch (TypeError $e) {
        $page = 1;
    }

    //  page validation
    if ($page > 200){
        $page = 1;
    }
    // TODO: validate $page
}

$page_size= null;
if(isset($_GET["page_size"])) {
    $page_size = intval($_GET["page_size"]);
    try{
        $page_size = intval($_GET["page_size"]);
    } catch (TypeError $e) {
        $page_size = 10;
    }

    //  page_size validation
    if ($page_size > 200){
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
                        <a href="?type=" class="btn btn-warning mt-2" id="deleteFilterButton" >Smazat filtr</a>
                    </form>

                </div>
            </div>

        </div>
        <div class="col <?php if ($cookie_value == "light"){echo 'order-first';} else{echo 'order-last';} ?>" id="main_content">
            <?php
                renderArticles(
                    $type,
                    $page,
                    $page_size
                );
            ?>
        </div>
    </div>

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

    $("form#formFilters").on('submit', function (event){event.preventDefault();});
    $("#deleteFilterButton").on('click', function (event){event.preventDefault();});
</script>
