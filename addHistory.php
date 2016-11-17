<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Add History entry</title>

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

            </ol>

            <?php

            $sql = "SELECT username FROM staff WHERE role = 'Doctor'";

            $result = query($sql);

            $doctors = [];

            while ($row = mysql_fetch_array($result)) {

                array_push($doctors, $row['username']);

            }

            if (isset($_POST['submit'])) {
                $patient_id = $_GET['patient_id'];
                $date_admitted = escape($_POST['date_admitted']);
                $date_discharged = escape($_POST['date_discharged']);
                $doctor = escape($_POST['doctor']);
                $condition = escape($_POST['condition']);
                $surgeries = escape($_POST['surgeries']);
                $doctors_notes = escape($_POST['doctors_notes']);
                $nurses_notes = escape($_POST['nurses_notes']);


                $err = "";


                if ($err == "") {
                    $sql = "INSERT INTO patient_history (patient_id, doctor, date_admitted, date_discharged, conditionn, surgeries, doctors_notes, nurses_notes)
            values('$patient_id', '$doctor', '$date_admitted', '$date_discharged', '$condition', '$surgeries', '$doctors_notes', '$nurses_notes')";

                    $query = query($sql);

                    if ($query) {
                        echo "<script type='text/javascript'>alert('History registered successfully');</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('WARNING: History registration error');</script>";
                    }
                } else {
                    echo $err;
                }
            }

            ?>

            <form class="navbar-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                <div id="form_box">

                    <p>Date admitted:<input id="add_form" type="datetime-local" name="date_admitted"
                                            class="form-control"></p>

                    <p>Date discharged: <input id="add_form" type="datetime-local" name="date_discharged"
                                               class="form-control"></p>

                    <p>Doctor: <select id="add_form" name="doctor" class="form-control">
                            <option value="-">None assigned</option>
                            <?php foreach ($doctors as $doctor) {
                                echo '<option value="' . $doctor . '">' . $doctor . '</option>';
                            }?>
                        </select></p>
                    <?php
                    if (userAccessLvl() == "2") {
                        echo '<p>Condition: <input id="add_form" type="text" name="condition" class="form-control"></p>';
                        echo '<p>Surgeries: <input id="add_form" type="text" name="surgeries" class="form-control"></p>';
                        echo '<p>Doctor\'s notes: <input id="add_form" type="text" name="doctors_notes" class="form-control"></p>';
                        echo '<p>Nurse\'s notes: <input id="add_form" type="text" name="nurses_notes" class="form-control"></p>';
                    }
                    ?>



                    <input class="btn btn-default" type="submit" name="submit">

                </div>

            </form>


        </div>

    </div>

</div>

</body>
</html>
