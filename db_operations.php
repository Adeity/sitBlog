<?php
include('constants.php');
include('print_article.php');

$read_json = file_get_contents(__DIR__ . '/data.json');
$data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

function getData($name){
    global $data;
    foreach ($data[$name] as $article){
        $article_header = htmlspecialchars($article["header"]);
        $article_content = htmlspecialchars($article["article_content"]);
        $article_anchor = DOCUMENTROOT.'article.php?name='.$name.'&id='.$article["id"];
        printArticle($article_header, $article_content, $article_anchor);
    }
}

function getDataByID($name, $id){
    global $data;
    foreach ($data[$name] as $article){
        if ($article["id"] == $id){
            $article_header = htmlspecialchars($article["header"]);
            $article_content = htmlspecialchars($article["article_content"]);
            $author = htmlspecialchars($article["author"]);
            printArticleByID($article_header, $article_content, $name, $id, $author);
            break;
            }
    }
}

function deleteData($name, $id){
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    foreach ($data[$name] as $key => $article){
        if ($article["id"] == $id){
            unset($data[$name][$key]);
            break;
        }
    }
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data.json', $json_db);
}


function getBlogData(){
    getData("blog_data");
}

function getBugData(){
    getData("bug_data");
}
