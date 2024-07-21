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
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png">
    <link rel="icon" type="image/png" sizes="500x500" href="assets/img/logo.png" media="(prefers-color-scheme: dark)">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
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
    <div class="container">
        <div class="row my-3 ">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Announcements</h2>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 mx-auto" style="max-width: 900px;">
            <?php
            require_once "db_connection.php";

            // Assuming you have a database connection

            $latest_announcement_query = "SELECT * FROM announcement ORDER BY title_id DESC LIMIT 4";
            $result = mysqli_query($conn, $latest_announcement_query);

            while ($row = mysqli_fetch_assoc($result)) {
                $announcement_title = $row['title'];
                $announcement_description = $row['title_information'];
                $announcement_image = $row['title_pic'];
                $announcement_id = $row['title_id']; // Assuming you have a field for the image filename in your database
            ?>


                <div class="col mb-4">
                    <div><a href="#"><img class="rounded img-fluid shadow w-100 fit-cover" src="ann_pic/<?php echo $announcement_image; ?>" style="height: 250px;" /></a>
                        <div class="py-4">
                            <h4 class="fw-bold"><?php echo $announcement_title; ?></h4>
                            <p><?php echo mb_strimwidth($announcement_description, 0, 50, "..."); ?></p>
                            <a class="btn btn-primary shadow" type="button" href="announcements-view.php?id=<?php echo $announcement_id; ?>">Learn more</a>
                        </div>
                    </div>
                </div>


            <?php
            }
            ?>

        </div>
        <form>
            <div class="row mb-3">
                <section id="section-search-announcement">
                    <div class="col">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h2> Search Announcements</h2>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <!-- Removed search button and added event listener to input -->
                            <input id="searchInput" class="form-control" type="text" placeholder="Search The Library Here" oninput="searchTable()">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="table-responsive text-nowrap">
                        <?php
                        // Assuming you have established your database connection
                        // Fetching data for the table
                        require_once "db_connection.php";

                        $stmt = $conn->prepare('SELECT * FROM announcement ORDER BY title_id DESC');

                        if (!$stmt) {
                            die('Error in SQL query: ' . $conn->error); // Check for errors in prepare statement
                        }

                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Check if there are rows fetched
                        if ($result->num_rows > 0) {
                        ?>

                            <table class="table table-hover table-bordered" id="dataTable" data-toggle="table">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="col-9" data-sortable="true">Announcement / Events</th>
                                        <th class="col-3">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $queryResult = mysqli_num_rows($result);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td class="fw-bold"><a href="announcements-view.php?id=<?php echo $row['title_id']; ?>"><?php echo $row['title']; ?></a></td>
                                            <td><?php echo $row['title_date']; ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10"><strong>Total Announcements: <?php echo $queryResult; ?></strong></td>
                                        <!-- Assuming you have 10 columns in your table, adjust colspan value if needed -->
                                    </tr>
                                </tfoot>
                            </table>
                        <?php
                        } else {
                            echo '<div style="text-align: center;">No logs available.</div>';
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr></tr>
                        </tfoot>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <nav class="fw-bold">
                        <ul id="pagination" class="pagination">
                            <li class="page-item" id="previous"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item" id="next"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>

        </form>
    </div>
    <?php include 'elements/footer-user.php'; ?>
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
        // Constants
        const rowsPerPage = 10;
        const tableRows = document.querySelectorAll('tbody tr');
        let currentPage = 1;

        // Function to show rows for a specific page
        function showRowsForPage(page) {
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = page * rowsPerPage;
            tableRows.forEach((row, index) => {
                if (index >= startIndex && index < endIndex) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

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

        $('table').bootstrapTable();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/bold-and-bright.js"></script>
</body>

</html>