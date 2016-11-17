<?php
require_once 'include.php';
$procedure_id = $_POST['Procedure'];
$billNumber = $_POST['billNumber'];
$patient_id = $_POST['Patient_ID'];
$procedure = "SELECT * FROM procedure_details WHERE procedure_id = $procedure_id";
$result = query($procedure);
$patient_billing_row = mysql_fetch_array($result);
$cost = $patient_billing_row[2];

$health_cover_details_sql = "SELECT * FROM health_cover_details WHERE patient_id = '$patient_id'";
$result3 = query($health_cover_details_sql);
$row3 = mysql_fetch_array($result3);

if ($row3[3]) {
    $cost = $cost * 0.05;
} elseif ($row3[1]) {
    $cost = $cost * 0.075;
}


$patient_billing_sql = "INSERT INTO patient_billing (patient_id, bill_number, med_procedure, cost, paid)
                        VALUES ('$patient_id','$billNumber','$patient_billing_row[1]','$cost','0')";
query($patient_billing_sql);
$patient_invoice_sql = "UPDATE `patient_details` SET `invoice_owing`=`invoice_owing`+$cost WHERE `patient_id`= $patient_id";
query($patient_invoice_sql);
header("Location: singlePatient.php?patient_id=$patient_id");
die();
?>
