<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Request Tests</title>

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


        <div id="right_container" style="width: 100%;" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Tests</a></li>
                <li class="active">Request Test</li>
            </ol>


            <h2>Request Test</h2><br>


            <?php

            $patient_id = escape($_GET['patient_id']);

            $sql = "SELECT * FROM patient_details WHERE patient_id = '$patient_id'";

            $result = query($sql);
            $row = mysql_fetch_row($result);

            ?>

            <h4 id="user_name"><?php if (userAccessLvl() == "1") {
                    echo '<span id="name">' . $row[1] . ' ' . $row[2] . '</span>';
                } else echo $row[1] . ' ' . $row[2]; ?></h4>


            <form class="navbar-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                <div id="surgery_form">

                    <p>Date: <input id="add_form" type="date" name="date" class="form-control"></p>

                    <p>Start Time<input id="add_form" type="time" name="starttime" class="form-control"></p>

                    <p>End Time<input id="add_form" type="time" name="endtime" class="form-control"></p>

                    <p>Type of test: <select id="add_form" name="testtype" class="form-control">
                            <option value="Blood">Blood</option>
                            <option value="X-ray">X-ray</option>
                            <option value="MRI">MRI</option>
                            <option value="CT">CT</option>
                            <option value="Urine">Urine</option>
                            <option value="Allergy">Allergy</option>
                            <option value="Tomography">Tomography</option>
                            <option value="Angioscopy">Angioscopy</option>
                        </select>
                    </p>
                    <p>Assign to: <select id="add_form" name="assignto" class="form-control">
                            <option value="Nurse">Nurse</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Medical technician">Medical technician</option>
                        </select>
                    </p>
                    <p>Doctor's notes: <input id="add_form" type="text" name="notes" class="form-control"></p>

                </div>

                <input class="btn btn-default" type="submit" name="submit">

            </form>

            <?php

            if (isset($_POST['submit'])) {

                $patient_id = $_GET['patient_id'];
                $date = date('Ymd', strtotime(escape($_POST['date'])));
                $starttime = escape($_POST['starttime']);
                $endtime = escape($_POST['endtime']);
                $testtype = escape($_POST['testtype']);
                $assignto = escape($_POST['assignto']);
                $notes = escape($_POST['notes']);

                $sql = "INSERT INTO testing_request (patient_ID, test_date, start_time, end_time, test_type, assign_to, doctors_notes)
                        VALUES ('$patient_id', '$date', '$starttime', '$endtime', '$testtype', '$assignto', '$notes')";

                $query = query($sql);

                if ($query) {
                    echo "<script type='text/javascript'>alert('Request registered successfully');
							window.location.href ='singlePatient.php?patient_id=$patient_id';
						</script>";
                } else {
                    echo "<script type='text/javascript'>alert('WARNING: Request registration error');</script>";
                }

            }
            ?>

        </div>

    </div>

</div>

</body>
</html>
