<?php


header('Content-type: application/json');

$DB_user = array(
    array(
        "email" => "testuser@gmail.com",
        "username" => "admin",
        "password" => "$2y$10\$CXlVxDIs./qOlElHHdQywOycch6RYsCwtJRjQvj51g4yeFfNmE2I6"
    ),
);


$user_data = $DB_user;

$json_db = json_encode(
    $user_data,
    JSON_PRETTY_PRINT
);
file_put_contents('data_users.json', $json_db);
echo $json_db;