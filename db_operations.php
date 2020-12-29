<?php
include('constants.php');
include('print_article.php');



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


function getData(
    $type=null,
    $page=null,
    $page_size=null
) {
    $read_json = file_get_contents(__DIR__ . '/data.json');
    $db = json_decode($read_json, JSON_OBJECT_AS_ARRAY);
    $filtered_db = array_filter($db, function($article, $k) use ($type) {
        if ($type) {
            if(!$article["type"] == $type) {
                return false;
            }
        }
        return true;
    }, ARRAY_FILTER_USE_BOTH);

    // Skip
    $skip = $page * $page_size;
    $filtered_skipped_db = array();
    for ($i=0; $i < $page_size; $i++){
        if($filtered_db[$i+$skip]){
            $filtered_skipped_db[$i] = $filtered_db[$i+$skip];
        }
        else{
            break;
        }
    }


    // Limit

    return $filtered_limited_data;
}

function renderArticles(
    $type=null,
    $page=null,
    $page_size=null
)
{
    $data = getData($type, $page, $page_size);
    foreach ($data as $article){

        $article_header = htmlspecialchars($article["header"]);
        $article_content = htmlspecialchars($article["article_content"]);
        $article_anchor = DOCUMENTROOT.'article.php?name='.$type.'&id='.$article["id"];
        printArticle($article_header, $article_content, $article_anchor);
    }
}
