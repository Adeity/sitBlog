<?php
include('constants.php');
include('print_article.php');



function renderArticleById($id){
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    foreach ($data as $article){
        if ($article["id"] == $id){
            $article_header = $article["header"];
            $article_content = $article["article_content"];
            $article_author = $article["author"];
            $article_id = $article["id"];
            printArticleByID($article_header, $article_content, $article_author, $article_id);
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

function add_user_to_database($email, $username, $password){
    global $data;
    $user = array(
        "email" => htmlspecialchars($email),
        "username" => htmlspecialchars($username),
        "password" => $password
    );
    $data = array_merge($data, array($user));
    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data_users.json', $json_db);
}

function is_in_database($identificator, $db_identificator){
    global $data;
    foreach ($data as $user){
        if ($user[$db_identificator] == $identificator){
            return true;
        }
    }
    return false;
}

function get_user_by_email($email) {
    $read_json = file_get_contents(__DIR__ . '/data_users.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    foreach ($data as $user){
        if ($user["email"] == $email){
            return $user;
        }
    }
    return false;
}

function get_user_by_username($username) {
    $read_json = file_get_contents(__DIR__ . '/data_users.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    foreach ($data as $user){
        if ($user["username"] == $username){
            return $user;
        }
    }
    return false;
}


function getArticles(
    $type=null,
    $page=null,
    $page_size=null
) {
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $db = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    if($page === null) {
        $page = 1;
    }
    if($page_size === null) {
        $page_size = 10;
    }

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
    $filtered_db = getArticles(
        $type,
        $page,
        $page_size
    );
    foreach ($filtered_db as $article){
        $article_id = $article["id"];
        $article_header = htmlspecialchars($article["header"]);
        $article_content = htmlspecialchars($article["article_content"]);
        $article_type = $article["type"];
        printArticle($article_id, $article_header, $article_content, $article_type);
    }
}

function createArticle(
    $article_heading,
    $article_content,
    $article_author,
    $article_type
){
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $data = json_decode($read_json, JSON_OBJECT_AS_ARRAY);

    $new_article = array(
        "id" => uniqid(),
        "header" => $article_heading,
        "article_content" => $article_content,
        "author" => $article_author,
        "type" => $article_type
    );
    array_push($data, $new_article);

    $json_db = json_encode(
        $data,
        JSON_PRETTY_PRINT
    );
    file_put_contents('data.json', $json_db);
}