<?php
require_once 'include.php';

$amountOwing = $_POST['AmountOwing'];
$payAmount = $_POST['payAmount'];
$patient_id = $_POST['Patient_ID'];

if ($payAmount > $amountOwing) {
    ?>
    <script>

        alert("Error: Payment amount can not be more than amount owing.");
        window.location.href = "singlePatient.php?patient_id=<?php echo $patient_id?>";

    </script>
<?php
} else {
    $patient_invoice_sql = "UPDATE patient_details SET invoice_owing=invoice_owing-$payAmount WHERE patient_id= '$patient_id'";
    query($patient_invoice_sql);
    header("Location: singlePatient.php?patient_id=$patient_id");
    die();


}
?>

