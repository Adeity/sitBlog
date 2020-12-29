<?php
include 'db_operations.php';

$name_plus_id = $_POST["delete"];
$input_info = explode("+", $name_plus_id);

$name = $input_info[0];
$id = $input_info[1];

echo $name . $id;

deleteData($name, $id);

header('Location: /semestralka');

