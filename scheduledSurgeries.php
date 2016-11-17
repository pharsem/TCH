<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Scheduled surgeries</title>

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

            <h2>Scheduled surgeries</h2>

            <h2>
                <small>Welcome, <?php echo($_SESSION['username']); ?>!</small>
            </h2>


            <div class='panel panel-default'>

                <div class="panel-body">
                </div>

                <!-- Table -->


                <table class="table">
                    <tr>
                        <th>Surgery ID</th>
                        <th>Condition</th>
                        <th>Type of surgery</th>
                        <th>Scheduled by</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Doctor's notes</th>
                        <th>Complete</th>
                    </tr>


                    <tr>

                        <?php
                        $surgery_sql = "SELECT * FROM surgery";
                        $surgery_result = query($surgery_sql);


                        while ($surgeryRow = mysql_fetch_array($surgery_result)) {
                            $surgery_id = $surgeryRow['surgery_id'];
                            echo "<td>" . $surgeryRow[0] . "</td>";
                            echo "<td>" . $surgeryRow[2] . "</td>";
                            echo "<td>" . $surgeryRow[7] . "</td>";
                            echo "<td>" . $surgeryRow[6] . "</td>";
                            echo "<td>" . $surgeryRow[3] . "</td>";
                            echo "<td>" . $surgeryRow[4] . "</td>";
                            echo "<td>" . $surgeryRow[10] . "</td>";
                            echo "<td>" . $surgeryRow[12] . "</td>";
                            echo "<td><form name='AddToBill' action='completeSurgery.php' method='POST'>
				<input type='hidden' name='Surgery_ID' value='<?php echo $surgery_id;?>'>
				<input class='btn btn-default' type='submit' value='Complete Surgery'>
				</select>
			</form></td>";
                        }
                        ?>
                    </tr>

                </table>

            </div>


        </div>

    </div>

</div>

</body>
</html>
