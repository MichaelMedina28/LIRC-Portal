<?php
session_start();
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}
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

            $title_date = date('Y-m-d', strtotime($title_date));
        }
    }
}

if (isset($_POST['save-btn'])) {
    $title = $_POST['title'];
    $title_date = $_POST['title-date'];
    $title_information = $_POST['title-information'];

    //Announcement Picture
    $file = $_FILES["titie-pic"];

    // File details
    $fileName = "$title - " . $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];
    // Move the uploaded file to a desired location on the server
    $destination = "../ann_pic/" . $fileName;
    move_uploaded_file($fileTmpName, $destination);

    // Check if a new account picture is uploaded
    if (!empty($_FILES['titie-pic']['name'])) {
        // File details and upload logic
        // ...
        $destination = "../ann_pic/" . $fileName;
        move_uploaded_file($fileTmpName, $destination);
    } else {
        // No new account picture uploaded, retain the existing value in the database
        $sql1 = "SELECT title_pic FROM announcement WHERE title_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $title_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            $row = $result1->fetch_assoc();
            $destination = $row["title_pic"];
        }
        $stmt1->close();
    }

    $logSql = "UPDATE announcement 
           SET title = '$title', 
               title_date = '$title_date', 
               title_information = '$title_information', 
               title_pic = '$destination' 
           WHERE title_id = $title_id";
    $conn->query($logSql); // Assuming $conn is your database connection

    header("Location: announcements-admin.php");
}

if (isset($_POST['delete-btn'])) {
    // Include your database connection code here
    // For example: $db = new mysqli('localhost', 'username', 'password', 'database');

    // Retrieve the row ID from the form
    $param_id = trim($_GET["id"]);

    // SQL query to delete the row with the given ID
    $sql = "DELETE FROM announcement WHERE title_id = $param_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: announcements-admin.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
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
    <div class="container py-3 py-xl-3">
        <div class="row mb-3">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Announcements</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section>
                    <div class="container p-3">
                        <form method="post" enctype="multipart/form-data">
                            <div class="card shadow-lg py-3">
                                <div class="card-body px-4 py-3 px-md-5">
                                    <h4 class="mb-3">Update Announcement</h4>
                                    <div class="row mb-3">
                                        <div class="col"><input class="form-control fw-bold" type="text" placeholder="Title" name="title" value="<?php echo $title ?>"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3 col-md-5"><input class="form-control text-muted" type="date" name="title-date" value="<?php echo $title_date ?>" value="<?php echo date('Y-m-d'); ?>" readonly></div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3"><textarea class="form-control h-100" placeholder="Announcement Information" name="title-information"><?php echo $title_information ?></textarea></div>
                                    </div>

                                    <div class="d-xl-flex justify-content-xl-center">
                                        <img class="img-fluid" src="../ann_pic/<?php echo $row['title_pic']; ?>" alt="The user does not submit an announcement image.">
                                    </div>

                                    <br>

                                    <div class="row">
                                    <div class="col mb-3">
                                            <input class="form-control" type="file" name="titie-pic" accept=".jpg,.jpeg,.png,.gif,.bmp|image/*" required onchange="checkFileSize(this)">
                                        </div>

                                        <script>
                                            function checkFileSize(input) {
                                                if (input.files[0].size > 5000000) { // File size in bytes
                                                    alert("The selected file is too large. Please select a file smaller than 5MB.");
                                                    input.value = ""; // Clear the input field
                                                }
                                            }
                                        </script>
                                    </div>

                                    <div class="row">
                                        <div class="col d-flex justify-content-start p-3">
                                            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete</a>
                                        </div>

                                        <!-- Disapprove Confirmation Modal -->
                                        <div class="modal fade" role="dialog" tabindex="-1" id="delete-modal">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Delete Announcement</h4>
                                                        <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="p-text">Are you sure you want to delete this announcement?</p>
                                                        <!-- You can add more details or context here if needed -->


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-icon-split m-1" type="button" data-bs-dismiss="modal"><span class="text-white-50 icon"></span><span class="text-white text">Cancel</span></button>
                                                        <!-- You can add an action to disapprove here -->
                                                        <button class="btn btn-danger btn-icon-split m-1" type="submit" name="delete-btn"><span class="text-white-50 icon"></span><span class="text-white text">Delete</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col d-flex justify-content-end p-3">
                                            <a class="btn btn-primary me-3" role="button" href="announcements-admin.php">Back</a>
                                            <button class="btn btn-info" type="submit" name="save-btn" id="save-btn">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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