<?php
// Initialize the session
session_start();

// Include the database connection file
include_once '../db_connection.php';

if (isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true) {

    // Unset specific user-related session variables
    unset($_SESSION["adminloggedin"]);
}

// Redirect to login page
header("location: ../login.php");
exit;
?>