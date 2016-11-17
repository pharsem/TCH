<?php include 'headImports.php'; ?>

<head>


    <title>Townsville Children's Hospital - Add Patient</title>

</head>
<body>


<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

require 'lib/password.php';

?>

<div id="wrapper">

    <?php include 'header.php'; ?>


    <div id="main_container">


        <div id="right_container" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Patients</a></li>
                <li class="active">Add new Patient</li>
            </ol>

            <h2>Add Patient</h2>

            <?php

            if (isset($_POST['submit'])) {
                $firstName = escape($_POST['firstName']);
                $surname = escape($_POST['surname']);
                $DOB = escape($_POST['dob']);
                $nationality = escape($_POST['nationality']);
                $gender = ($_POST['gender']);
                $contactNumber = ($_POST['contactNumber']);
                $address = ($_POST['address']);
                $emergencyContact = ($_POST['emergencyContact']);
                $emergencyContactNumber = ($_POST['emergencyContactNumber']);


                $err = "";


                if ($err == "") {
                    $sql = "INSERT INTO patient_details (first_name, surname, dob, nationality, gender, contact_number, address, emergency_contact, emergency_contact_number) 
                            values('$firstName','$surname', '$DOB', '$nationality', '$gender', '$contactNumber', '$address', '$emergencyContact', '$emergencyContactNumber')";

                    $query = query($sql);

                    if ($query) {
                        echo "<script type='text/javascript'>alert('Patient registered successfully');
                        </script>";
                    } else {
                        echo "<script type='text/javascript'>alert('WARNING: Patient registration error');
                        </script>";
                    }
                } else {
                    echo $err;
                }
            }

            ?>

            <form class="navbar-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                <div id="form_box">

                    <p>First name:<input id="add_form" type="text" name="firstName" class="form-control"></p>

                    <p>Surname: <input id="add_form" type="text" name="surname" class="form-control"></p>

                    <p>Date of Birth: <input id="add_form" type="text" name="dob" class="form-control"></p>

                    <p>Nationality: <input id="add_form" type="text" name="nationality" class="form-control"></p>

                    <p>Gender:
                        <select id="ad_form" name="gender" id="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select></p>
                    <p>Contact Number: <input id="add_form" type="text" name="contactNumber" class="form-control"></p>

                    <p>Address: <input id="add_form" type="text" name="address" class="form-control"></p>

                    <p>Emergency Contact:<input id="add_form" type="text" name="emergencyContact" class="form-control">
                    </p>

                    <p>Emergency Contact Number:<input id="add_form" type="text" name="emergencyContactNumber"
                                                       class="form-control"></p>


                    <input class="btn btn-default" type="submit" name="submit">

                </div>

            </form>


        </div>

    </div>

</div>
</body>
