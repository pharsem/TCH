<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Patient Information</title>

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
    <li class="active">Patient Details</li>
</ol>




<?php

$patient_id = escape($_GET['patient_id']);

$sql = "SELECT * FROM patient_details WHERE patient_id = '$patient_id'";

$result = query($sql);
$row = mysql_fetch_row($result);

?>

<h2 id="user_name"><?php if (userAccessLvl() == "1") {
        echo '<span class="edit_area" id="name">' . $row[1] . ' ' . $row[2] . '</span>';
    } else echo $row[1] . ' ' . $row[2]; ?></h2>

<div id="user_photo">
</div>


<ul id="user_information">
    <li>
        <h2>
            <small>Patient information:</small>
        </h2>
    </li>
    <li><b>Date of birth:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="dob">' . $row[3] . '</span>';
        } else echo $row[3]; ?>
    </li>
    <li><b>Gender:</b> <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="gender">' . $row[5] . '</span>';
        } else echo $row[5]; ?>
    </li>
    <li><b>Nationality:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="nationality">' . $row[4] . '</span>';
        } else echo $row[4]; ?>
    </li>
    <li><b>Address:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="address">' . $row[7] . '</span>';
        } else echo $row[7]; ?>
    </li>
    <br>

    <li><b>Contact number:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="contact_number">' . $row[6] . '</span>';
        } else echo $row[6]; ?>
    </li>
    <br>

    <li><b>Emergency contact:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="emergency_contact">' . $row[8] . '</span>';
        } else echo $row[8]; ?>
    </li>
    <li><b>Emergency contact number:</b>
        <?php if (userAccessLvl() == "1") {
            echo '<span class="edit_area" id="emergency_contact_number">' . $row[9] . '</span>';
        } else echo $row[9]; ?>
    </li>
</ul>

<?php

$sql2 = "SELECT * FROM patient_history WHERE patient_id = '$patient_id'";

$result2 = query($sql2);

echo '<ul id="user_information">
        		<li><h2><small>Patient history:</small></h2></li>';

while ($row2 = mysql_fetch_row($result2)) {
    echo '<li><b>Date admitted: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="date_admitted">' . $row2[3] . '</span>';
    } else echo $row2[3];

    echo '</li><li><b>Date discharged: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="date_discharged">' . $row2[4] . '</span>';
    } else echo $row2[4];

    echo '</li><li><b>Doctor: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="doctor">' . $row2[2] . '</span>';
    } else echo $row2[2];

    echo '</li><li><b>Condition: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="conditionn">' . $row2[5] . '</span>';
    } else echo $row2[5];

    echo '</li><li><b>Surgeries: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="surgeries">' . $row2[6] . '</span>';
    } else echo $row2[6];

    echo '</li><li><b>Doctor\'s notes: </b>';
    if (userAccessLvl() == "2") {
        echo '<span class="edit_area" id="doctors_notes">' . $row2[7] . '</span>';
    } else echo $row2[7];

    echo '</li><li><b>Nurse\'s notes: </b>';
    if (userAccessLvl() == "3") {
        echo '<span class="edit_area" id="nurses_notes">' . $row2[8] . '</span>';
    } else echo $row2[8];

    echo '</li><p><hr></p> ';
}

?>

<li>
    <h2>
        <small>Tests:</small>
    </h2>
</li>
<li>None</li>

<li>
    <h2>
        <small>Requested tests:</small>
    </h2>
</li>
<?php
$sql = "SELECT * FROM testing_request WHERE patient_id = $patient_id";

$result = query($sql);

while ($row = mysql_fetch_array($result)) {
    echo "<li>Date: " . $row['test_date'] . "</li>";
    echo "<li>Start time: " . $row['start_time'] . "</li>";
    echo "<li>End time: " . $row['end_time'] . "</li>";
    echo "<li>Type: " . $row['test_type'] . "</li>";
    echo "<li>Assigned to: " . $row['assign_to'] . "</li>";
    echo "<li>Notes: " . $row['doctors_notes'] . "</li>";
    echo "<br><br>";
}

?>
<li>
    <h2>
        <small>Completed tests:</small>
    </h2>
</li>
<?php
$sql = "SELECT * FROM completed_testing_request WHERE patient_id = $patient_id";

$result = query($sql);

while ($row = mysql_fetch_array($result)) {
    echo "<li>Date: " . $row['test_date'] . "</li>";
    echo "<li>Start time: " . $row['start_time'] . "</li>";
    echo "<li>End time: " . $row['end_time'] . "</li>";
    echo "<li>Type: " . $row['test_type'] . "</li>";
    echo "<li>Assigned to: " . $row['assign_to'] . "</li>";
    echo "<li>Notes: " . $row['doctors_notes'] . "</li>";

    $sql1 = "SELECT * FROM test_result WHERE test_id = $row[0]";
    $result1 = query($sql1);
    $row1 = mysql_fetch_array($result1);
    $file = "upload/" . $row['test_id'] . ".jpg";
    echo "<li>End Date: " . $row1[1] . "</li>";
    echo "<li>End time: " . $row1[2] . "</li>";
    echo "<li>File: <a href=$file>File</a></li>";
    echo "<li>Test Notes: " . $row1[4] . "</li>";
    echo "<br><br>";

}

?>


<li>
    <h2>
        <small>Scheduled surgeries:</small>
    </h2>
</li>
<?php
$sql = "SELECT * FROM surgery WHERE patient_id = $patient_id";

$result = query($sql);

while ($row = mysql_fetch_array($result)) {
    echo "<li>Date: " . $row['surgery_date'] . "</li>";
    echo "<li>Start time: " . $row['surgery_start'] . "</li>";
    echo "<li>End time: " . $row['surgery_end'] . "</li>";
    echo "<li>Type: " . $row['type_of_surgery'] . "</li>";
    echo "<li>Doctor: " . $row['doctor_id'] . "</li>";
    echo "<li>Equipment: " . $row['equipment'] . "</li>";
    echo "<li>Department: " . $row['department'] . "</li>";
    echo "<li>Room: " . $row['room'] . "</li>";
    echo "<li>Notes: " . $row['doctors_notes'] . "</li>";
    echo "<br><br>";
}
?>
<li><br></li>


<?php
echo '
        	<li><h2><small>Insurance info:</small></h2></li>';


$health_cover_details_sql = "SELECT * FROM health_cover_details WHERE patient_id = '$patient_id'";
$result3 = query($health_cover_details_sql);
$row3 = mysql_fetch_array($result3);

//if the insurance is private
if ($row3[3]) {
    $healthcovertype = "Private";
    $healthcoverProvider = $row3[5];
    $healthcoverNumber = $row3[3];
} //if the patient is covered by Medicare
elseif ($row3[1]) {
    $healthcovertype = "Medicare";
    $healthcoverProvider = "Medicare";
    $healthcoverNumber = $row3[3];

} //if the patient has no cover.
else {
    $healthcovertype = "None";
    $healthcoverProvider = "None";
    $healthcoverNumber = "None";
}

echo '<li><b>Health cover: </b>';

echo $healthcovertype;


echo '</li><li><b>Health cover provider: </b>';

echo $healthcoverProvider;


echo '</li><li><b>Cover number: </b>';

echo $healthcoverNumber;


echo '</li>';

echo '<li><h2><small>Charge procedure to patient:</small></h2></li>';

?>
<form name="AddToBill" action="addProcedureToBill.php" method="POST">
    <input type="hidden" name="Patient_ID" value="<?php echo $patient_id; ?>">
    Bill number: <input type="text" name="billNumber">
    Procedure:<select name="Procedure">
        <option value="1">Stitches</option>
        <option value="2">Surgery</option>
        <option value="3">Chemotherapy</option>
        <option value="4">Injection</option>
        <option value="5">CT-Scan</option>

        <input class="btn btn-default" type="submit" value="Submit">
    </select>
</form>
<?php
$invoice_sql = "SELECT * FROM patient_details WHERE patient_id = $patient_id";
$invoice_result = query($invoice_sql);
$invoice_row = mysql_fetch_array($invoice_result);
echo '<li><h2><small>Invoice info:</small></h2></li>';
echo "Amount owing: $" . $invoice_row[10] . "";
?>
<form name="SeeAllProcedures" action="bill.php" method="POST">
    <input type="hidden" name="Patient_ID" value="<?php echo $patient_id; ?>">
    <input class="btn btn-default" type="submit" value="All">
</form>
<form name="Pay" action="pay.php" method="POST">
    <input type="hidden" name="Patient_ID" value="<?php echo $patient_id ?>">
    <input type="hidden" name="AmountOwing" value="<?php echo $invoice_row[10] ?>">
    Payment amount: <input type="text" name="payAmount">
    <input class="btn btn-default" type="submit" value="Pay">
</form>
</ul>


<hr>
<?php if (userAccessLvl() == 2 || userAccessLvl() == 3 || userAccessLvl() == 4) { ?>
    <button class="btn btn-default">
        <a href="addHistory.php?patient_id=<?php echo $patient_id; ?>">New history entry</a>
    </button>
<?php } ?>

<?php if (userAccessLvl() == 2) { ?>
    <button class="btn btn-default">
        <a href="requestTest.php?patient_id=<?php echo $patient_id; ?>">Request test</a>
    </button>

    <button class="btn btn-default">
        <a href="scheduleSurgery.php?patient_id=<?php echo $patient_id; ?>">Schedule surgery</a>
    </button><br><br>
<?php } ?>

<form id="PDF" action="dynamicPDF.php" method="post">
    <input type="hidden" name="Patient_ID" value="<?php echo $patient_id ?>">

    <div id="PDF"><input class="btn btn-default" type="submit" value="Print to PDF"/>
</form>
</div>


</div>


</div>

</div>

<script>
    $(document).ready(function () {
        $('.edit_area').editable('updatepatientdata.php', {
            type: 'textarea',
            cancel: 'Cancel',
            submit: 'Update',
            width: ($('.edit_area').width() + 100) + "px", // THIS DOES THE TRICK
            height: ($('.edit_area').height() + 100) + "%", //THIS DOES THE TRICK
            indicator: 'Saving...',
            tooltip: 'Click to edit',
            submitdata: {patient_id: <?php echo $patient_id; ?>}
        });
    });
</script>

</body>
</html>