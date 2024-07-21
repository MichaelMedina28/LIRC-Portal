<?php

session_start();
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}

date_default_timezone_set('Asia/Manila');

// Check existence of id parameter before processing further
require_once "../db_connection.php";
// Prepare a select statement
$sql = "SELECT * FROM announcement WHERE title_id = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);

    // Set parameters
    $param_id = trim($_GET["id"]);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set
            contains only one row, we don't need to use while loop */
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Retrieve individual field value
            $title = $row["title"];
            $title_id = $row["title_id"];
            $title_date = $row["title_date"];
            $title_information = $row["title_information"];
            $title_pic = $row["title_pic"];
        }
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
    <title>CCC LIRC Announcement</title>
    <meta property="og:type" content="website">
    <meta name="description" content="CCC Learning and Information Resource Center is our official website. Announcement and updates regarding the Library will be posted for information dissemination. Inquiries, comments and suggestions related to our Policies and library services will also be entertained for the improvement of our Services.">
    <link rel="icon" type="image/png" sizes="500x500" href="../assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="500x500" href="../assets/img/logo.png" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="../assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="../assets/css/Features-Centered-Icons-icons.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <?php include '../elements/new-styles.php'; ?>
</head>

<body>
    <?php include '../elements/navbar-admin.php'; ?>
    <div class="container py-3">
        <div class="row mb-3">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Announcements</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section>
                    <div class="container p-3">
                        <div class="card shadow-lg py-3">
                            <div class="card-body px-4 py-3 px-md-5">
                                <h5 class="fw-bold card-title"><?php echo $title ?></h5>
                                <p class="text-muted card-text mb-4"><?php echo $title_date ?></p>
                                <p class="card-text"><?php echo $title_information ?></p>

                                <div class="d-xl-flex justify-content-xl-center">
                                    <img class="img-fluid" src="../ann_pic/<?php echo $row['title_pic']; ?>">
                                </div>


                                <div class="row">
                                    <div class="col d-flex justify-content-end p-3"><a class="btn btn-primary" role="button" href="announcements-admin.php">Back</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include '../elements/footer-admin.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/bold-and-bright.js"></script>
</body>

</html>