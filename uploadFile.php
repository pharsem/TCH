<?php include 'headImports.php'; ?>
<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$test_id = $_POST['Test_ID'];
$patient_id = $_POST['Patient_ID'];
$date = $_POST['date_finished'];
$time = $_POST['time_finished'];
$notes = $_POST['test_notes'];


if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
    && ($_FILES["file"]["size"] < 20000)
    && in_array($extension, $allowedExts)
) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

        if (file_exists("upload/" . $test_id)) {
            echo $_FILES["file"]["name"] . " already exists. ";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "upload/" . $test_id . ".jpg");
            echo "Stored in: " . "upload/" . $test_id;
            $address = "upload/" . $test_id;
            //insert test results
            $test_result_sql = "INSERT INTO test_result(date, time, file_location, test_notes, patient_id, test_id) VALUES
							('$date', '$time', '$address', '$notes', '$patient_id', '$test_id')";
            query($test_result_sql);
            //get request details from request table
            $test_request_sql = "SELECT * FROM testing_request WHERE test_id = '$test_id'";
            $test_request_result = query($test_request_sql);
            $test_request_row = mysql_fetch_row($test_request_result);
            //insert request details into Completed request table
            $completed_test_result_sql = "INSERT INTO `completed_testing_request`(`test_id`, `patient_ID`, `test_date`, `start_time`, `end_time`,
										`test_type`, `assign_to`, `doctors_notes`) VALUES ('$test_request_row[0]','$test_request_row[1]','$test_request_row[2]','$test_request_row[3]','$test_request_row[4]','$test_request_row[5]','$test_request_row[6]','$test_request_row[7]')";
            query($completed_test_result_sql);
            $delete_test_request_sql = "DELETE FROM `testing_request` WHERE test_id = '$test_id'";
            query($delete_test_request_sql);

        }
    }
} else {
    echo "Invalid file";
}

echo "<br><a href='singlePatient.php?patient_id=$patient_id'>Return to Patient Details</a>";
?> 
