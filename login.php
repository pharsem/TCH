<?php include 'headImports.php'; ?>


<?php
// to connect with include.php file
require_once 'include.php';
$error = false;

// using a compatibility library to allow PHP version < 5.5 to use the built in password_* functions
require 'lib/password.php';

// Form processing
if ($_POST) {
    // escape special characters in form input to prevent SQL injection
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);

    // using bcrypt to hash the password with a random salt
    $sql = "select password from staff where username =  '$username'";
    $hash = get_scalar($sql);

    // check if username is in the database
    if ((authorize($username)) > 0) {
        // check if the password is correct
        if (password_verify($password, $hash)) {
            $_SESSION['signedin'] = true;
            $_SESSION['username'] = $username;
            $sql1 = "insert into login_log (username) VALUES ('$username')";
            $query = query($sql1);
            redirect('index.php'); // a redirect is performed to avoid double entry if refresh is pressed.
        }
    } else {
        // if there is an error during login.
        $error = true;
    }

}
?>


<head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">

    <title>Townsville Children's Hospital - Log-in</title>
</head>

<body>

<div id="login_main_container">

    <div id="text_box_background">
        <form id="login" action="" method="post">

            <input name="username" class="text_box" id="text_box_name" placeholder="Username" type="text">

            <input name="password" class="text_box" id="text_box_password" placeholder="Password" type="password">

            <div id="login_text"><input type="submit" value="Login"/>
            </div>
        </form>

    </div>


    <div id="login_logo_background">
        <div id="login_logo_text">Townsville Childrens Hospital</div>
    </div>

    <div id="footer">
        <a>Forgot Password? Call Helpdesk on: 3862-2852</a>
    </div>

    <div id="login_error">
        <?php if ($error) { ?>
            <p><?php echo 'The entered username and/or password was invalid.'; ?></p>
        <?php } ?>
    </div>

</div>

</body>

