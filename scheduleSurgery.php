<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Scheduled Surgeries</title>

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
    <li><a href="#">Surgery</a></li>
    <li class="active">New Surgery</li>
</ol>

<h2>New Surgery</h2><br>


<?php
$sql = "SELECT username FROM staff WHERE role = 'Doctor'";

$result = query($sql);

$doctors = [];

while ($row = mysql_fetch_array($result)) {

    array_push($doctors, $row['username']);

}

$patient_id = escape($_GET['patient_id']);

$sql = "SELECT * FROM patient_details WHERE patient_id = '$patient_id'";

$result = query($sql);
$row = mysql_fetch_row($result);



?>

<h4 id="user_name"><?php if (userAccessLvl() == "1") {
        echo '<span id="name">' . $row[1] . ' ' . $row[2] . '</span>';
    } else echo $row[1] . ' ' . $row[2]; ?></h4>


<form class="navbar-form float-left" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

    <div id="surgery_form">


        <p>Date: <input id="add_form" type="date" name="date" class="form-control"></p>

        <p>Start Time<input id="add_form" type="time" name="start" class="form-control"></p>

        <p>End Time<input id="add_form" type="time" name="end" class="form-control"></p>


        <p>Doctor: <select id="add_form" name="doctor" class="form-control">
                <?php foreach ($doctors as $doctor) {
                    echo '<option value="' . $doctor . '">' . $doctor . '</option>';
                }?>

            </select>


        <p>Type of surgery: <select id="add_form" name="type" class="form-control">
                <option value="Heart">Heart</option>
                <option value="Brain">Brain</option>
                <option value="Cosmetic">Cosmetic</option>
                <option value="Amputation">Amputation</option>
                <option value="Cardiovascular">Cardiovascular</option>
                <option value="Neurosurgery">Neurosurgery</option>
                <option value="Pediatric">Pediatric</option>
                <option value="Orthopaedic">Orthopaedic</option>
            </select>

        <p>Equipment: <select id="add_form" name="equipment" class="form-control">
                <option value="Diagnostic">Diagnostic</option>
                <option value="Monitors">Monitors</option>
                <option value="Scanner">Scanner</option>

            </select>


        <p>Department: <select id="add_form" name="department" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="H">H</option>
                <option value="Z">Z</option>
                <option value="N">N</option>
                <option value="O">O</option>
                <option value="P">P</option>
            </select>


        <p>Room: <select id="add_form" name="room" class="form-control">
                <option value="110">110</option>
                <option value="112">112</option>
                <option value="114">114</option>
                <option value="115">115</option>
                <option value="201">201</option>
                <option value="202">202</option>
                <option value="203">203</option>
                <option value="320">320</option>
                <option value="321">321</option>
                <option value="408">408</option>
                <option value="410">410</option>
            </select>
        </p>


        </p>

        <p>Notes: <input id="add_form" type="text" name="notes" class="form-control"></p>


    </div>

    <input class="btn btn-default" type="submit" name="submit">

</form>

<?php

if (isset($_POST['submit'])) {
    $patient_id = $_GET['patient_id'];
    $date = $_POST['date'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $doctor = $_POST['doctor'];
    $type = $_POST['type'];
    $equipment = $_POST['equipment'];
    $department = $_POST['department'];
    $room = $_POST['room'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO surgery (patient_id, surgery_date, surgery_start, surgery_end, doctor_id, type_of_surgery, equipment, department, room, doctors_notes)
                    VALUES ('$patient_id', '$date', '$start', '$end', '$doctor', '$type', '$equipment', '$department', '$room', '$notes')";

    $query = query($sql);

    if ($query) {
        echo "<script type='text/javascript'>alert('History registered successfully');</script>";
    } else {
        echo "<script type='text/javascript'>alert('WARNING: History registration error');</script>";
    }
}


?>

<div id="room-availability">
    <h2>Rooms booked</h2>
    <?php

    $sql = "SELECT * FROM surgery";

    $result = query($sql); ?>

    <table class="table">
        <tr>
            <th>Department</th>
            <th>Room</th>
            <th>Date</th>
            <th>Start time</th>
            <th>End time</th>
        </tr>

        <?php
        while ($row = mysql_fetch_array($result)) {
            echo '<tr><td>' . $row['department'] . '</td>';
            echo '<td>' . $row['room'] . '</td>';
            echo '<td>' . $row['surgery_date'] . '</td>';
            echo '<td>' . $row['surgery_start'] . '</td>';
            echo '<td>' . $row['surgery_end'] . '</td></tr>';
        }

        ?>
    </table>
    <br>

    <h2>Equipment booked</h2>

    <table class="table">
        <tr>
            <th>Equipment</th>
            <th>Date</th>
            <th>Start time</th>
            <th>End time</th>
        </tr>

        <?php

        $sql = "SELECT * FROM surgery";

        $result = query($sql);

        while ($row = mysql_fetch_array($result)) {
            echo '<tr><td>' . $row['equipment'] . '</td>';
            echo '<td>' . $row['surgery_date'] . '</td>';
            echo '<td>' . $row['surgery_start'] . '</td>';
            echo '<td>' . $row['surgery_end'] . '</td></tr>';
        }

        ?>

    </table>


</div>

</div>


</div>

</div>

</body>
</html>
