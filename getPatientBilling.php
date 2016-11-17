<?php

require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

$patient_id = $_POST['Patient_ID'];
$patient_billing_sql = "SELECT * FROM patient_billing WHERE patient_id = '$patient_id'";
$result = query($patient_billing_sql);
$patient_billing_row = mysql_fetch_array($result);

$health_cover_details_sql = "SELECT * FROM health_cover_details WHERE patient_id = '$patient_id'";
$result2 = query($health_cover_details_sql);
$row2 = mysql_fetch_array($result2);
$cost = 0;
//if the insurance is private
if ($row2[3] = 1) {
    //billed cost is 5% of actual procedure;
    $cost = $patient_billing_row[2] * 0.05;
} //if the patient is covered by Medicare
elseif ($row2[1] = 1) {
    //Billed cost is 7.5% of actual procedure;
    $cost = $patient_billing_row[2] * 0.075;
} //if the patient has no cover.
else {
    // if no cover the patient is charged the full amount for the procedure.
    $cost = $patient_billing_row[2];
}
echo "$$cost";

?>