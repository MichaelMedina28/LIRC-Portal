<?php include_once("controller.php"); ?>

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
</head>

<body>
    <?php include 'elements/navbar-user.php'; ?>
    <div class="container py-4 py-xl-5">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Forgot Password</h2>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body text-center d-flex flex-column align-items-center">
                        <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
                            </svg></div>
                        <p>Email Verified! Input the new password for the LIRC Portal ADMIN Account</p>

                        <form action="newPassword.php" method="POST" autocomplete="off">
                            <?php
                            if ($errors > 0) {
                                foreach ($errors as $displayErrors) {
                            ?>
                                    <div id="alert"><?php echo $displayErrors; ?></div>
                            <?php
                                }
                            }
                            ?>
                            <input class="form-control" type="password" id="password" name="password" placeholder="Password" required><br>
                            <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password" required><br>
                            <input class="form-control btn btn-primary" type="submit" name="changePassword" value="Save">
                        </form>

                        <div id="passwordRequirements"></div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordRequirements = document.getElementById('passwordRequirements');

            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                const requirements = [];

                if (password.length < 8) {
                    requirements.push('Password must be at least 8 characters long.');
                }

                if (!/[A-Z]/.test(password)) {
                    requirements.push('Password must contain at least one uppercase letter.');
                }

                if (!/[a-z]/.test(password)) {
                    requirements.push('Password must contain at least one lowercase letter.');
                }

                if (!/\d/.test(password)) {
                    requirements.push('Password must contain at least one number.');
                }

                passwordRequirements.innerHTML = requirements.length ? '<div id="alert">' + requirements.join('<br>') + '</div>' : '';
            });
        });
    </script>
</body>

</html>
