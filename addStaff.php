<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Add Staff</title>

</head>
<body>


<?php
require_once 'include.php';

require 'lib/password.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

if ((userAccessLvl() != "1")) {
    $error = 'Only site admins may access this page.';
    include 'accessDenied.php';
    exit();
}

?>

<div id="wrapper">

    <?php include 'header.php'; ?>


    <div id="main_container">


        <div id="right_container" style="width: 100%;" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Staff</a></li>
                <li class="active">Add new Staff</li>
            </ol>

            <h2>Add staff</h2>

            <?php

            if (isset($_POST['submit'])) {
                $username = escape($_POST['username']);
                $password = escape($_POST['password']);
                $firstname = escape($_POST['firstname']);
                $surname = escape($_POST['surname']);
                $role = ($_POST['role']);
                $accesslvl = ($_POST['accesslvl']);

                $hashedPW = password_hash($password, PASSWORD_BCRYPT);

                $error = '';

                if ($_POST['username'] == "" || $_POST['password'] == "" || $_POST['firstname'] == "" || $_POST['surname'] == "") {
                    $err .= "Please enter all fields";
                }

                if ($err == "") {
                    $sql = "insert into staff (username, password, first_name, surname, role, access_level)
				values('$username','$hashedPW', '$firstname', '$surname', '$role', '$accesslvl')";

                    $query = query($sql);

                    if ($query) {
                        echo "<script type='text/javascript'>alert('User registered successfully');
			window.location = 'staff.php';</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('WARNING: User registration error');
			window.location = 'staff.php';</script>";
                    }
                } else {
                    echo $err;
                }
            }
            //else {
            ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" class="navbar-form" method="post">

                <div id="form_box">

                    <p>First name: <input id="add_form" type="text" name="firstname" class="form-control"></p>

                    <p>Surname: <input id="add_form" type="text" name="surname" class="form-control"></p>

                    <p>Role:<select name="role" id="add_form" class="form-control">
                            <option value="System admin" class="form-control">System admin</option>
                            <option value="Doctor" class="form-control">Doctor</option>
                            <option value="Nurse" class="form-control">Nurse</option>
                            <option value="Receptionist" class="form-control">Receptionist</option>
                            <option value="Hospital Admin" class="form-control">Hospital admin</option>
                        </select></p>

                    <p>Username: <input id="add_form" type="text" name="username" class="form-control"></p>

                    <p>Password: <input id="add_form" type="password" name="password" class="form-control"></p>

                    <p>Access Level:
                        <select name="accesslvl" id="add_form" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select></p>
                    <input class="btn btn-default" type="submit" name="submit">

                </div>

            </form>
            <?php
            //}
            ?>

        </div>

    </div>

</div>

</body>
</html>
