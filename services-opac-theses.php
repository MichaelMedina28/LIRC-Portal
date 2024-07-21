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
    <title>CCC LIRC OPAC - Theses</title>
    <meta property="og:type" content="website">
    <meta name="description" content="CCC Learning and Information Resource Center is our official website. Announcement and updates regarding the Library will be posted for information dissemination. Inquiries, comments and suggestions related to our Policies and library services will also be entertained for the improvement of our Services.">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/Features-Centered-Icons-icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <!-- table sorting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

    <?php include 'elements/new-styles.php'; ?>
</head>

<body>
    <?php include 'elements/navbar-user.php'; ?>

    <?php include 'elements/section-services-opac-theses.php'; ?>


    <?php include 'elements/footer-user.php'; ?>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your existing JavaScript files -->
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
    <script>
        function searchTable() {
            var input = document.getElementById("searchInput").value.toUpperCase();
            var table = document.getElementById("dataTable");
            var tr = table.getElementsByTagName("tr");
            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td");
                var found = false;
                for (var j = 0; j < td.length; j++) {
                    if (td[j].textContent.toUpperCase().indexOf(input) > -1) {
                        found = true;
                        break;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
    <script>
        //Start code to limit rows by 10
        // Constants
        const rowsPerPage = 15;
        const tableRows = document.querySelectorAll('tbody tr');
        let currentPage = 1;

        // Function to hide rows beyond the specified page
        function showRowsForPage(page) {
            tableRows.forEach((row, index) => {
                if (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) {
                    row.style.display = 'table-row'; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        }

        // Initial setup to show the first page
        showRowsForPage(currentPage);

        //End of the code to limit rows by 10



        //Start of the code for pagination
        // Function to update pagination links
        function updatePaginationLinks() {
            const totalPages = Math.ceil(tableRows.length / rowsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = ''; // Clear existing pagination links

            // Previous page link
            const prevLi = document.createElement('li');
            prevLi.classList.add('page-item');
            if (currentPage === 1) {
                prevLi.classList.add('disabled');
            }
            const prevLink = document.createElement('a');
            prevLink.classList.add('page-link');
            prevLink.setAttribute('aria-label', 'Previous');
            prevLink.href = '#';
            const prevSpan = document.createElement('span');
            prevSpan.setAttribute('aria-hidden', 'true');
            prevSpan.textContent = '«';
            prevLink.appendChild(prevSpan);
            prevLi.appendChild(prevLink);
            pagination.appendChild(prevLi);

            // Page links
            const startPage = Math.max(1, currentPage - 1);
            const endPage = Math.min(totalPages, startPage + 2);

            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                if (i === currentPage) {
                    li.classList.add('active');
                }
                const link = document.createElement('a');
                link.classList.add('page-link');
                link.href = '#';
                link.textContent = i;
                li.appendChild(link);
                pagination.appendChild(li);
            }

            // Next page link
            const nextLi = document.createElement('li');
            nextLi.classList.add('page-item');
            if (currentPage === totalPages) {
                nextLi.classList.add('disabled');
            }
            const nextLink = document.createElement('a');
            nextLink.classList.add('page-link');
            nextLink.setAttribute('aria-label', 'Next');
            nextLink.href = '#';
            const nextSpan = document.createElement('span');
            nextSpan.setAttribute('aria-hidden', 'true');
            nextSpan.textContent = '»';
            nextLink.appendChild(nextSpan);
            nextLi.appendChild(nextLink);
            pagination.appendChild(nextLi);

            // Update event listeners for pagination links
            const pageLinks = document.querySelectorAll('.page-link:not([aria-label="Previous"]):not([aria-label="Next"])');
            pageLinks.forEach(link => {
                link.addEventListener('click', () => {
                    currentPage = parseInt(link.textContent);
                    showRowsForPage(currentPage);
                    updatePaginationLinks();
                });
            });

            // Event listener for previous page
            const prevPageLink = document.querySelector('.page-link[aria-label="Previous"]');
            prevPageLink.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    showRowsForPage(currentPage);
                    updatePaginationLinks();
                }
            });

            // Event listener for next page
            const nextPageLink = document.querySelector('.page-link[aria-label="Next"]');
            nextPageLink.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    showRowsForPage(currentPage);
                    updatePaginationLinks();
                }
            });
        }

        // Show rows for the initial page
        showRowsForPage(currentPage);
        updatePaginationLinks();
        //End of the code for pagination
    </script>
</body>

</html>