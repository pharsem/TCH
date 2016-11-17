<head>

    <?php include 'headImports.php'; ?>

    <title>Townsville Children's Hospital - View Patients</title>


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
            xmlhttp.open("GET", "getPatients.php?q=" + str, true);
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

        <div id="right_container" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Patients</a></li>
                <li class="active">Search</li>
            </ol>

            <h2>Patient Search</h2>

            <form class="navbar-form">

                <input type="text" size="30" onkeyup="showResult(this.value)"
                       placeholder="Start typing a Name to search..." class="form-control">

                <div id="livesearch"></div>


                <button class="btn btn-default"><a href="addPatient.php">Add Patient</a></button>

            </form>

        </div>


    </div>


</div>

</body>

	

