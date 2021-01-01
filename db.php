<?php

header('Content-type: application/json');

// TODO: use MySQL instead
$DB = array(
    array(
        "id" => uniqid(),
        "header" => "Blog 1",
        "article_content" => "Blogs rule",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 2",
        "article_content" => "Blogs rule lots",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 3",
        "article_content" => "Blogs rule",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 4",
        "article_content" => "Blogs rule lots",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 1",
        "article_content" => "Bugs suck",
        "author" => "admin",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 2",
        "article_content" => "Bugs suck lots",
        "author" => "admin",
        "type" => "bug",
    ),
);

$DB_page_info = array(
    "page" => "1",
    "page_size" => "10",
    "total_pages" => "10",
    "total_articles" => "6"
);


$json_db = json_encode(
    $DB,
    JSON_PRETTY_PRINT
);
file_put_contents('data.json', $json_db);

$json_db_page_info = json_encode(
    $DB_page_info,
    JSON_PRETTY_PRINT
);
file_put_contents('data_page_info.json', $json_db_page_info);

echo $json_db;