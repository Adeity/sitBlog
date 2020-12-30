<?php
include 'db_operations.php';


$id = $_POST["id"];
//TODO: is logged in? if not, return.
//TODO: fetch article with id $id from DB
//TODO: compare username from session with usernam from article. If no match, return.
//TODO: refactor deleteData($name, $id) to deleteArticle($id)



echo $name . $id;

deleteData($name, $id);

header('Location: /semestralka');

