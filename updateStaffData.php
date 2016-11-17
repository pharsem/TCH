<?php
session_start();

require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

$id = $_POST['id'];
$value = escape($_POST['value']);
$username = $_POST['username'];

if ($id == 'name') {
    $name_split = preg_split("/\s+(?=\S*+$)/", $value);
    $first_name = $name_split[0];
    $surname = $name_split[1];

    $sql = "UPDATE staff SET first_name = '$first_name', surname = '$surname' WHERE username = '$username'";
} else {
    $sql = "UPDATE staff SET $id = '$value' WHERE username = '$username'";
}

query($sql);

echo $value;


?>