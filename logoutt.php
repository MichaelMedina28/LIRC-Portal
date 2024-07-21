<?php
session_start();

// Include your database connection script
include_once("../db_connection.php");

if (isset($_SESSION['user_id'])) {
    // Get the user's ID from the session
    $user_id = $_SESSION['user_id'];

    date_default_timezone_set('Asia/Manila');

    // Update the logout time in the database
    $logout_time = date('Y-m-d g:i a');
    
    // Use an UPDATE query to set the logout_time
    $updateLogoutTimeSql = "UPDATE users SET logout_time = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateLogoutTimeSql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $logout_time, $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the SQL statement
        echo "Error: " . mysqli_error($conn);
    }
}

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header('location: login.php');
exit();
?>
