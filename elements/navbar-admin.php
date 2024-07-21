<div id="navbar-admin">
    <nav class="navbar navbar-expand-md sticky-top navbar-shrink py-3" id="nav-main">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="index-admin.php"><img class="nav-img-brand" src="<?php echo $assetPath; ?>img/logo-home.png"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index-admin.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="announcements-admin.php">Announcements</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Services</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="services-oer.php">Online Electronic Resources</a><a class="dropdown-item" href="services-ms.php">Multimedia Station &<br>Faculty Research Commons</a></div>
                    </li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="/">OPAC</a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="services-opac-books.php">Books</a><a class="dropdown-item" href="services-opac-theses.php">Theses</a><a class="dropdown-item" href="services-opac-journals.php">Journals</a><a class="dropdown-item" href="https://drive.google.com/drive/folders/1CksX6xsuaToyCI4X1BsGZkz1LcVW9sGq?usp=sharing" target="_blank">EBooks (Google Drive)<br> <span class="text-danger">CCC Email Required</span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-user-circle"></i></a>
                        <div class="dropdown-menu"><a class="dropdown-item" href="logout.php">Logout</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    // Get the current page URL
    var currentPageUrl = window.location.href;

    // Get all the links in the navbar
    var navLinks = document.querySelectorAll('#navbar-admin .nav-link');

    // Loop through each link and check if its href matches the current page URL
    navLinks.forEach(function(link) {
        if (link.href === currentPageUrl) {
            // Add the "active" class to the link
            link.classList.add('active');
        }
    });

    window.onload = function() {
        var dropdownItems = document.querySelectorAll('.dropdown-item');
        var currentUrl = window.location.href;

        dropdownItems.forEach(function(item) {
            if (item.href === currentUrl) {
                item.classList.add('active', 'bg-primary');
                item.closest('.dropdown').querySelector('.dropdown-toggle').classList.add('active');
            }
        });
    };
</script>