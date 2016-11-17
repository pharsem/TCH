<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Edit profile</title>

</head>
<body>


<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

?>

<div id="wrapper">

    <?php include 'header.php'; ?>


    <div id="main_container">


        <div id="right_container" class="panel panel-default">

            <ol class="breadcrumb">

            </ol>


        </div>

    </div>

</div>

</body>
</html>
