<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Requested Tests</title>

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

            <h2>Requested tests</h2>

            <h2>
                <small>Welcome, <?php echo($_SESSION['username']); ?>!</small>
            </h2>


            <div class='panel panel-default'>

                <div class="panel-body">
                    <p>Scheduled tests</p>
                </div>

                <!-- Table -->

                <?php

                $sql = "SELECT * FROM testing_request";

                $result = query($sql);

                ?>

                <table class="table">
                    <tr>
                        <th>Test ID</th>
                        <th> Patient ID</th>
                        <th>Type of test</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Assigned to</th>
                        <th>Doctor's notes</th>
                        <th>Test results</th>
                    </tr>

                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        echo '<tr><td>' . $row['test_id'] . '</td>';
                        echo '<td>' . $row[1] . '</td>';
                        echo '<td>' . $row['test_type'] . '</td>';
                        echo '<td>' . $row['test_date'] . '</td>';
                        echo '<td>' . $row['start_time'] . '</td>';
                        echo '<td>' . $row['end_time'] . '</td>';
                        echo '<td>' . $row['assign_to'] . '</td>';
                        echo '<td>' . $row['doctors_notes'] . '</td>';
                        echo '<td><a href="submitTestResults.php?test_id=' . $row['test_id'] . '&patient_id=' . $row[1] . '">Submit test results</a>
								 
								  </td></tr>';


                    }

                    ?>

                </table>

            </div>


        </div>

    </div>

</div>

</body>
</html>
