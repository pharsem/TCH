<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Internal Map</title>

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

        <div id="left_nav">
            <div id="" class="panel panel-default">

                <ul class="nav nav-pills nav-stacked">

                    <li><a href="staff.php">Staff Home</a></li>
                    <li class="active"><a href="inmap.php">Internal Map</a></li>


                </ul>

            </div>
        </div>

        <div id="right_container" style="width: 85%;" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Staff</a></li>
                <li class="active">Internal Map</li>
            </ol>


            <h2>Internal Map &amp; Directory</h2>


            <div id="intermap" class="panel panel-default"></div>


            <p>Departmant List.</p>


        </div>

    </div>

</div>

