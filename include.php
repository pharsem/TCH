<?php

// Connects to the mysql database and selects the default database
function dbconnect()
{
    mysql_connect('localhost', 'root', '') or die(mysql_error());
    mysql_select_db('database') or die(mysql_error());
}


// Utility to perform a HTTP redirect
function redirect($url)
{
    ob_start();
    header('Location: ' . $url);
    die();
}


// Performs a query or displays the error on failure. Returns the mysql result.
function query($sql)
{
    $res = mysql_query($sql) or die(mysql_error() . ' in ' . $sql);
    return $res;
}


// Retrieves the first item in the first record that is returned.
function get_scalar($sql)
{
    $res = query($sql);
    $row = mysql_fetch_row($res);
    return $row[0];
}

// Escape input to prevent SQL injection
function escape($str)
{
    return mysql_real_escape_string($str);
}

// Simple method to check if a user is logged in
function signed_in()
{
    return $_SESSION['signedin'] == true;
}

// Tries to authorize an admin user using their username and password.
function authorize($username)
{
    $username = escape($username);
    $sql = "SELECT COUNT(*) FROM staff WHERE username = '$username'";
    $count = get_scalar($sql);
    return $count;
}

//Logout function
function logout()
{
    session_destroy();
    redirect('login.php');
}

// Return the currently logged in user's access level
function userAccessLvl()
{

    $username = ($_SESSION['username']);

    $sql = "SELECT access_level FROM staff WHERE username = '$username'";

    $accessLvl = get_scalar($sql);

    return $accessLvl;
}


error_reporting(E_ALL & ~E_NOTICE); // set error reporting to not report notices
dbconnect(); // connect to the database

?>