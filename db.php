<?php

header('Content-type: application/json');

// TODO: use MySQL instead
$DB = array(
    array(
        "id" => uniqid(),
        "header" => "Blog 1",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 1",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 2",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 2",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 3",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 3",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 4",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 4",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 5",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 5",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 6",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 6",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 7",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 7",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 8",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 8",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 9",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 9",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 10",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 10",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 11",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 11",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 12",
        "article_content" => "Blogs rule.",
        "author" => "admin",
        "type" => "blog",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 12",
        "article_content" => "Bugs are bad.",
        "author" => "Carl",
        "type" => "bug",
    ),

);

//  Create DB of articles in JSON format
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