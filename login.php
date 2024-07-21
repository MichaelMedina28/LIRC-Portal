<?php
$loginAttempts = 0;
$invalidPassword = ""; // Initialize the variable to hold the invalid password message
session_start();
include_once("db_connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Increment login attempts regardless of email validity
    $updateAttemptsSql = "UPDATE users SET login_attempts = login_attempts + 1 WHERE email = ?";
    $stmt2 = mysqli_prepare($conn, $updateAttemptsSql);
    if ($stmt2) {
        mysqli_stmt_bind_param($stmt2, "s", $email);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }

    $sql = "SELECT * FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                $hashedPassword = $row['password'];
                $status = $row['status'];
                $loginAttempts = $row['login_attempts'];

                if ($status === 'active') {
                    if ($loginAttempts < 5) {
                        if (password_verify($password, $hashedPassword)) {
                            // Reset login attempts
                            $updateAttemptsSql = "UPDATE users SET login_attempts = 0 WHERE id = ?";
                            $stmt2 = mysqli_prepare($conn, $updateAttemptsSql);
                            if ($stmt2) {
                                mysqli_stmt_bind_param($stmt2, "i", $row['id']);
                                mysqli_stmt_execute($stmt2);
                                mysqli_stmt_close($stmt2);
                            }

                            $_SESSION['adminloggedin'] = true;

                            date_default_timezone_set('Asia/Manila');

                            $date_added = date('Y-m-d H:i:s');
                            $updateLoginTimeSql = "UPDATE users SET login_time = ? WHERE id = ?";

                            $stmt3 = mysqli_prepare($conn, $updateLoginTimeSql);
                            if ($stmt3) {
                                mysqli_stmt_bind_param($stmt3, "si", $date_added, $row['id']);
                                mysqli_stmt_execute($stmt3);
                                mysqli_stmt_close($stmt3);
                            }

                            // Redirect to main.php
                            header('location: admin/index-admin.php');
                            exit(); // Ensure script execution stops after redirection
                        } else {
                            $invalidPassword = "Invalid password."; // Set the error message
                        }
                    } else {
                        // Exceeded login attempts, deny login
                        $invalidPassword = "You have exceeded the maximum number of login attempts. Please try again later.";
                    }
                } else {
                    // User is inactive, deny login
                    $invalidPassword = "Your account is inactive. Please contact the system administrator.";
                }
            } else {
                $invalidPassword = "Invalid email.";
            }
        } else {
            $invalidPassword = "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $invalidPassword = "Error: " . mysqli_error($conn);
    }
}
?>

<?php
$currentDir = basename(__DIR__);
$assetPath = ($currentDir === 'admin') ? '../assets/' : 'assets/';
$elementPath = ($currentDir === 'admin') ? '../elements/' : 'elements/';
$dbPath = ($currentDir === 'admin') ? '../' : '';
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CCC LIRC Login</title>
    <meta property="og:type" content="website">
    <meta name="description" content="CCC Learning and Information Resource Center is our official website. Announcement and updates regarding the Library will be posted for information dissemination. Inquiries, comments and suggestions related to our Policies and library services will also be entertained for the improvement of our Services.">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/Features-Centered-Icons-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <?php include 'elements/new-styles.php'; ?>
    <style>
        .login-attempts {
            color: red; /* Modify the color here */
        }
    </style>
</head>
<body>
    <?php include 'elements/navbar-user.php'; ?>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Admin - Login</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="col d-flex justify-content-center">
                    <?php include 'elements/login-picture.php'; ?>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card">
                    <div class="card-body text-center d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
                            </svg></div>
                        <form class="text-center" method="post">
                            <div class="mb-3"><input class="form-control" type="email" name="email" id="email" placeholder="Email"></div>
                            <div class="mb-3"><input class="form-control" type="password" name="password" id="password" placeholder="Password"></div>
                            <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit" value="Login" id="loginButton">Log in</button></div>
                            <?php if (!empty($invalidPassword)): ?>
                                <div class="text-danger"><?php echo $invalidPassword; ?></div> <!-- Display the error message -->
                            <?php endif; ?>
                            <a href="forgot.php">Forgot Password?</a>

                            <?php
                            // Display error message if login attempts limit is exceeded
                            if (isset($_POST['email'])) {
                                echo '<div class="error-message login-attempts">';
                                echo 'Login attempts remaining: ' . (5 - $loginAttempts);
                                echo '</div>';
                                if ($loginAttempts == 3) {
                                    // Display countdown using JavaScript
                                    echo '<div id="countdown"></div>';
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'elements/footer-user.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>
</html>
