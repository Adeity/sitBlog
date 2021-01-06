<?php
include('constants.php');
include('print_functions.php');


//  renders article by id
function renderArticleById($id){
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  iterate over each article and print
    foreach ($data as $article){
        //  Does id match article id? if so, print
        if ($article["id"] == $id){
            $article_header = $article["header"];
            $article_content = $article["article_content"];
            $article_author = $article["author"];
            $article_id = $article["id"];

            //  print article
            printArticleByID($article_header, $article_content, $article_author, $article_id);
            break;
            }
    }
}

//  deletes article by id
function deleteArticle($id){
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  iterate over each article unsets it from array if id matches
    foreach ($data as $key => $article){
        if ($article["id"] == $id){
            unset($data[$key]);
            break;
        }
    }

    //  Rewrites JSON database
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data.json', $json_db);
}

//  adds user to databes with before validated parameters
function add_user_to_database($email, $username, $password){
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data_users.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  create array from input variables
    $user = array(
        "email" => $email,
        "username" => $username,
        "password" => $password
    );

    //  put at the end of database
    $data = array_merge($data, array($user));

    //  rewrite json database
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data_users.json', $json_db);
}

//  This returns article based on id. Th
function get_article_by_article_id(
    $id,
    $default = false
){
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    foreach ($data as $article){
        if($article["id"] == $id){
            return $article;
        }
    }
    return $default;
}

//  returns user by email or returns false
function get_user_by_email($email) {
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data_users.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  iterate over db, if email is found, return user
    foreach ($data as $user){
        if ($user["email"] == $email){
            return $user;
        }
    }
    return false;
}

function get_user_by_username($username) {
    //  read db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data_users.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  iterate over db, if username is found, return user
    foreach ($data as $user){
        if ($user["username"] == $username){
            return $user;
        }
    }
    return false;
}

//  gets articles
function getArticles(
    $type=null,
    $page=null,
    $page_size=null
) {
    //  Read JSON database
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $db = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  Set default values if needed
    if($page === null) {
        $page = 1;
    }
    if($page_size === null) {
        $page_size = 10;
    }

    //  Fitler articles based on type
    $filtered_db = array_filter($db, function($article, $k) use ($type) {
        if ($type) {
            if($article["type"] == $type) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }, ARRAY_FILTER_USE_BOTH);

    // Skip
    $skip = ($page - 1) * $page_size;
    $filtered_db = array_slice($filtered_db, $skip);

    // Limit
    $filtered_db = array_slice($filtered_db, 0, $page_size);

    return $filtered_db;
}

function renderArticles(
    $type=null,
    $page=null,
    $page_size=null
)
{
    //  First articles get fitlered based on parameters
    $filtered_db = getArticles(
        $type,
        $page,
        $page_size
    );
    //  Print each article
    foreach ($filtered_db as $article){
        $article_id = $article["id"];
        $article_header = $article["header"];
        $article_content = $article["article_content"];
        $article_type = $article["type"];
        printArticle($article_id, $article_header, $article_content, $article_type);
    }
}

function renderPagination(
    $type=null,
    $page=null,
    $page_size=null
){
    //  Set default values if needed
    if($page === null) {
        $page = 1;
    }
    if($page_size === null) {
        $page_size = 10;
    }

    //  Read JSON db
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $db = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  Filter articles
    $filtered_db = array_filter($db, function($article, $k) use ($type) {
        if ($type) {
            if($article["type"] == $type) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }, ARRAY_FILTER_USE_BOTH);

    //  Get number of filtered articles and calculate total_pages based on that and page_size
    $total_articles = count($filtered_db);
    $total_pages = ceil($total_articles / $page_size);
    print_pagination($type, $page, $total_pages);

}

function createArticle(
    $article_heading,
    $article_content,
    $article_author,
    $article_type
){
    //  read json db and put into variable
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    //  create new array from input parameters and push them at the end of database
    $new_article = array(
        "id" => uniqid(),
        "header" => $article_heading,
        "article_content" => $article_content,
        "author" => $article_author,
        "type" => $article_type
    );
    array_push($data, $new_article);

    //  rewrite database
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data.json', $json_db);
}