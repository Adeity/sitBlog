<?php

header('Content-type: application/json');

// TODO: use MySQL instead
$DB_blog = array(
    array(
        "id" => uniqid(),
        "header" => "Blog 1",
        "article_content" => "Blogs rule",
        "author" => "admin",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 2",
        "article_content" => "Blogs rule lots",
        "author" => "admin",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 1",
        "article_content" => "Blogs rule",
        "author" => "admin",
    ),
    array(
        "id" => uniqid(),
        "header" => "Blog 2",
        "article_content" => "Blogs rule lots",
        "author" => "admin",
    ),
);

$DB_bug = array(
    array(
        "id" => uniqid(),
        "header" => "Bug 1",
        "article_content" => "Bugs suck",
        "author" => "admin",
    ),
    array(
        "id" => uniqid(),
        "header" => "Bug 2",
        "article_content" => "Bugs suck lots",
        "author" => "admin",
    ),
);




$blog_data = $DB_blog;
$bug_data = $DB_bug;

$json_db = json_encode(
    array(
        "blog_data" => $blog_data,
        "bug_data" => $bug_data,
    ),
    JSON_PRETTY_PRINT
);
file_put_contents('data.json', $json_db);
echo $json_db;