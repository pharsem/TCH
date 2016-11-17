<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Staff</title>


    <script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementById("livesearch").innerHTML = "";
                document.getElementById("livesearch").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
                    document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "getStaff.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

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

                    <li class="active"><a href="staff.php">Staff Home</a></li>

                    <li><a href="inmap.php">Internal Map</a></li>


                </ul>

            </div>

        </div>

        <div id="right_container" style="width: 85%;" class="panel panel-default">

            <h2>Welcome to Townsville's Childrens Hospital's Staff System</h2>

            <h2>
                <small>Welcome, <?php echo($_SESSION['username']); ?>!</small>
            </h2>


            <h2>Staff Search</h2>

            <form class="navbar-form">

                <input type="text" size="30" onkeyup="showResult(this.value)"
                       placeholder=" Start typing a Name to search..." class="form-control">

                <div id="livesearch"></div>
            </form>

            <div id="results"
            <?php if (userAccessLvl() == "1") {
                echo "<button class='btn btn-default'><a href='addStaff.php'>Add new staff member</a></button>";
            }?>


        </div>

    </div>

</div>

</div>

</body>
</html>
