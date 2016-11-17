<?php
session_start();

require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

$id = $_POST['id'];
$value = escape($_POST['value']);
$patient_id = $_POST['patient_id'];

if ($id == 'name') {
    $name_split = preg_split("/\s+(?=\S*+$)/", $value);
    $first_name = $name_split[0];
    $surname = $name_split[1];

    $sql = "UPDATE patient_details SET first_name = '$first_name', surname = '$surname' WHERE patient_id = '$patient_id'";
} else {
    $sql = "UPDATE patient_details SET $id = '$value' WHERE patient_id = '$patient_id'";
}

query($sql);

echo $value;


?>