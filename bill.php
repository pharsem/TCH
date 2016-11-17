<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Billing System</title>

</head>
<body>


<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}
$patient_id = $_POST['Patient_ID'];


$health_cover_details_sql = "SELECT * FROM health_cover_details WHERE patient_id = $patient_id";
$result3 = query($health_cover_details_sql);
$row3 = mysql_fetch_array($result3);

$result = query("SELECT * FROM patient_billing WHERE patient_id = $patient_id");


echo "<table border='1'>
<tr>
<th>Bill Number</th>
<th>Procedure</th>
<th>Cost</th>
<th>Charged Cost</th>
</tr>";

while ($row = mysql_fetch_array($result)) {

    echo "<tr>";
    echo "<td> " . $row['bill_number'] . " </td>";
    echo "<td> " . $row['med_procedure'] . " </td>";
    echo "<td> " . $row['cost'] . " </td>";
    //if the insurance is private
    if ($row3[3]) {
        echo "<td> " . $row['cost'] * 0.05 . " </td>";
    } //if the patient is covered by Medicare
    elseif ($row3[1]) {
        echo "<td> " . $row['cost'] * 0.075 . " </td>";
    } //if the patient has no cover.
    else {
        echo "<td> " . $row['cost'] . " </td>";
    }


    echo "</tr>";
}

echo "</table>";


?>

</div>

</body>

</html>