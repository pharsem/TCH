<?php include 'headImports.php'; ?>

<head>

    <title>Townsville Children's Hospital - contact</title>

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


        <div id="right_container" class="panel panel-default" style="margin-left: 10px">

            <!--breadcrumbs-->

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Contact</li>
            </ol>

            <h2>Contact</h2>

            <!--contactform-->

            <form class="navbar-form">

                <br>

                <p>Feel free to contact us on, 0481-68215 or submit a form below.</p><br><br>

                <p>First Name:&nbsp;&nbsp;&nbsp;<input type="text" name="firstname" class="form-control"></p>

                <p>Last Name:&nbsp;&nbsp;&nbsp;<input type="text" name="lastname" class="form-control"></p><br>
                <textarea name="comments" cols="70" rows="7" class="form-control">Enter your comments
                    here..</textarea><br><br>
                <input class="btn btn-default" type="reset">
                <input class="btn btn-default" type="submit">

            </form>


        </div>

    </div>

    <!--footer-->

    <div id="footer_">
        <p>INB201 Scalable Systems Development Semester 1 2014, Workshop 4 Group 3.<br>
            Petter Harsem, Thomas Kirke, Isabella Hunt, Alex Bray, Lucas Preedy</p>
    </div>

</div>

</body>
