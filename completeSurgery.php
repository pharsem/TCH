<?php
require_once 'include.php';


$surgery_id = $_POST['Surgery_ID'];


$delete_surgery_sql = "DELETE FROM `surgery` WHERE `surgery_id` = '1'";
query($delete_surgery_sql);
?>
<script>

    alert("Surgery has been deleted from database");
    window.location.href = "index.php";

</script>
