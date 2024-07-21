<?php
session_start();

require_once "../db_connection.php";


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

    $logSql = "INSERT INTO announcement (title, title_date, title_information, title_pic) VALUES ('$title', '$title_date', '$title_information', '$fileName')";
    $conn->query($logSql); // Assuming $conn is your database connection

    header("Location: announcements-admin.php");
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
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
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
                                <div class="card-body px-4 py-5 px-md-5">
                                    <h4 class="mb-3">Create Announcement</h4>
                                    <div class="row mb-3">
                                        <div class="col"><input class="form-control fw-bold" type="text" placeholder="Title" name="title" required></div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3 col-md-5"><input class="form-control text-muted" type="date" name="title-date" value="<?php echo date('Y-m-d'); ?>" readonly></div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3"><textarea class="form-control h-100" placeholder="Announcement Information" name="title-information" required></textarea></div>
                                    </div>
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
                                        <div class="col d-flex justify-content-end p-3">
                                            <a class="btn btn-primary me-3" role="button" href="announcements-admin.php">Back</a>
                                            <button class="btn btn-info" type="submit" name="save-btn" id="save-btn">Create</button>
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