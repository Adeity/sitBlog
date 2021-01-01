<?php
include_once("db_operations.php");

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

renderArticles(
    $type,
    $page,
    $page_size
);