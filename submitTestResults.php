<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Submit Test Results</title>

</head>
<body>


<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}
$test_id = $_GET['test_id'];
$patient_id = $_GET['patient_id'];
?>

<div id="wrapper">

    <?php include 'header.php'; ?>


    <div id="main_container">


        <div id="right_container" style="width: 100%;" class="panel panel-default">

            <ol class="breadcrumb">

            </ol>

            <h2>Submit test result</h2>


            <form class="navbar-form" action="uploadFile.php" method="post" enctype="multipart/form-data">

                <div id="form_box">
                    <input type="hidden" name="Patient_ID" value="<?php echo $patient_id; ?>">
                    <input type="hidden" name="Test_ID" value="<?php echo $test_id; ?>">

                    <p>Date finished:<input id="add_form" type="date" name="date_finished" class="form-control"></p>

                    <p>Time finished:<input id="add_form" type="time" name="time_finished" class="form-control"></p>

                    <p>Test notes: <input id="add_form" type="text" name="test_notes" class="form-control"></p>

                    <p>Attach file:

                        <input type="file" name="file" id="file"></p>

                    <p><label for="file">Filename:</label></p>

                    <input class="btn btn-default" type="submit" name="Submit">

                </div>

            </form>


        </div>

    </div>

</div>

</body>
</html>
