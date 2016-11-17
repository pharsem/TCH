<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

if ((userAccessLvl == "1")) {
    $error = 'Only site admins may access this page.';
    include 'accessDenied.php';
    exit();
}
?>

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
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    First name: <input type="text" name="firstname"><br>
    Surname: <input type="text" name="surname"><br>
    Role:
    <select name="role" id="role">
        <option value="System admin">System admin</option>
        <option value="Doctor">Doctor</option>
        <option value="Nurse">Nurse</option>
        <option value="Receptionist">Receptionist</option>
    </select><br/>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
    Access Level:
    <select name="accesslvl" id="accesslvl">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select><br/>
    <input type="submit" name="submit">
</form>
<?php
//}
?>
</body>
</html>