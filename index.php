<?php include 'headImports.php'; ?>

<head>

    <title>Townsville Children's Hospital - Home</title>

</head>
<body>

<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}
?>


<!--main content wrapper-->

<div id="wrapper">

    <?php include 'header.php'; ?>
    <!--main container-->

    <div id="main_container">

        <!--side nav-->
        <div id="left_nav">
            <div id="" class="panel panel-default">
                <ul class="nav nav-pills nav-stacked">

                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="map.php">Locations</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php if (userAccessLvl() == "0") {
                        echo "<li><a href='adminReports.php'>Hospital Reports</a></li>";
                    }?>
                </ul>
            </div>
        </div>

        <!--main content-->

        <div id="right_container" style="width: 85%;" class="panel panel-default">

            <!--homepage main image-->

            <div id="topimage"></div>

            <!--top buttons-->

            <div id="top_buttons_wrapper" style="margin-top: 10px;">
                <div id="top_buttons" class="btn-group btn-group-lg">

                    <button class="btn btn-default"><a href="ViewPatients.php">Patient Search</a></button>
                    <button class="btn btn-default"><a href="staff.php">Staff</a></button>

                </div>
            </div>

            <!--welcome content-->

            <?php include 'welcome.php'; ?>

            <!--news content-->

            <?php include 'news.php'; ?>

        </div>
        <!--footer-->
        <div id="footer_">
            <p>INB201 Scalable Systems Development Semester 1 2014, Workshop 4 Group 3.<br>Petter Harsem, Thomas Kirke,
                Isabella Hunt, Alex Bray, Lucas Preedy</p>
        </div>

    </div>


</div>

</body>

