<?php include 'headImports.php'; ?>
<!DOCTYPE html>

<html>

<head>


    <title>Townsville Children's Hospital - Staff Information</title>

</head>
<body>


<?php
require_once 'include.php';

if (!signed_in()) {
    include 'login.php';
    exit();
}

require 'lib/password.php';


if (isset($_POST['submit'])) {
    $oldPassword = escape($_POST['old_password']);
    $newPassword = escape($_POST['new_password']);
    $newPassword2 = escape($_POST['new_password2']);


    $err = "";

    if ($_POST['oldPassword'] == "" || $_POST['newPassword'] == "" || $_POST['newPassword2'] == "") {
        $err = "Please enter all fields";
    }

    if ($err == "") {

        $sql = "select password from staff where username =  '$username'";
        $hash = get_scalar($sql);

        if (password_verify($oldPassword, $hash)) {
            if ($newPassword == $newPassword2) {

                $hashedPW = password_hash($newPassword, PASSWORD_BCRYPT);

                $sql = "UPDATE staff SET password = '$hashedPW' WHERE username = '$username'";

                $query = query($sql);

                if ($query) {
                    echo "<script type='text/javascript'>alert('Password updated successfully');
					window.location = 'staff.php';</script>";
                } else {
                    echo "<script type='text/javascript'>alert('WARNING: Password update error');
					window.location = 'staff.php';</script>";
                }
            } else {
                $err = "The passwords does not match";
                echo $err;
            }
        } else {
            $err = "Old password is incorrect";
            echo $err;
        }
    } else {
        echo $err;
    }
}
?>

<div id="wrapper">

    <?php include 'header.php'; ?>


    <div id="main_container">

        <!--<div id="left_nav">
        
            <ul class="nav nav-pills nav-stacked">

            </ul>
                        
        </div>-->

        <div id="right_container" class="panel panel-default">

            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Staff</a></li>
                <li class="active">Staff details</li>
            </ol>



            <?php

            $username = escape($_GET['staff_username']);

            $sql = "SELECT * FROM staff WHERE username = '$username'";

            $result = query($sql);
            $row = mysql_fetch_row($result);

            ?>

            <h2 id="staff_name"><?php if (userAccessLvl() == "1") {
                    echo '<span class="edit_area" id="name">' . $row[0] . ' ' . $row[1] . '</span>';
                } else echo $row[0] . ' ' . $row[1]; ?></h2>

            <div id="user_photo">
                <?php

                $imagepath = 'images/staff/' . $username . '.jpg';

                if (file_exists($imagepath)) {
                    echo '<img src="' . $imagepath . '">';
                }
                ?>
            </div>


            <ul id="user_information">
                <li>
                    <h2>
                        <small>Staff information:</small>
                    </h2>
                </li>
                <li>Username:
                    <?php if (userAccessLvl() == "1") {
                        echo '<span class="edit_area" id="username">' . $row[3] . '</span>';
                    } else echo $row[3]; ?>
                </li>
                <li>Role: <?php if (userAccessLvl() == "1") {
                        echo '<span class="edit_area" id="Role">' . $row[2] . '</span>';
                    } else echo $row[2]; ?>
                </li>
                <li>Access level:
                    <?php if (userAccessLvl() == "1") {
                        echo '<span class="edit_area" id="access_level">' . $row[4] . '</span>';
                    } else echo $row[4]; ?>
                </li>
                <li>Email:
                    <?php if (userAccessLvl() == "1") {
                        echo '<span class="edit_area" id="access_level">' . $row[6] . '</span>';
                    } else echo $row[6]; ?>
                </li>
                <li>Phone:
                    <?php if (userAccessLvl() == "1") {
                        echo '<span class="edit_area" id="access_level">' . $row[7] . '</span>';
                    } else echo $row[7]; ?>
                </li>

            </ul>

            <?php if ($_SESSION['username'] == $username) {
                echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
					<p><input name="old_password" placeholder=" Enter old password" type="password"></p>
					<p><input name="new_password" placeholder=" Enter new password" type="password"></p>
					<p><input name="new_password2" placeholder=" Re-enter new password" type="password"></p>
					<input type="submit" value="Update password"/>
				</form>';

            }

            ?>


        </div>

    </div>

</div>

<script>
    $(document).ready(function () {
        $('.edit_area').editable('updatestaffdata.php', {
            type: 'textarea',
            cancel: 'Cancel',
            submit: 'OK',
            indicator: 'Saving...',
            tooltip: 'Click to edit',
            submitdata: {username: <?php echo $_SESSION['username']; ?>}
        });
    });
</script>