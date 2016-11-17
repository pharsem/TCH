<?php include 'headImports.php'; ?>

<head>

    <title>Townsville Children's Hospital - Map</title>

</head>
<body>


<?php

require 'include.php';

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

                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="map.php">Locations</a></li>

                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>

        <!--main content-->

        <div id="right_container" style="width: 85%;" class="panel panel-default">

            <!--breadcrumbs-->

            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">location</li>
            </ol>

            <h2>Welcome to Townsville's Childrens Hospital's Staff System</h2>

            <div id="mapscontainer">

                <!--googlemap-->

                <div id="detailmap">
                    <script>detailLocation()</script>
                </div>


                <div id="map_info">

                    <h2>
                        <small>Townsville Childrens Hospital location</small>
                    </h2>

                </div>

            </div>


        </div>

        <!--footer-->

        <div id="footer_">
            <p>INB201 Scalable Systems Development Semester 1 2014, Workshop 4 Group 3.<br>Petter Harsem, Thomas Kirke,
                Isabella Hunt, Alex Bray, Lucas Preedy</p>
        </div>


    </div>

</div>

</body>