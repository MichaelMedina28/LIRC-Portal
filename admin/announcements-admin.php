<?php
session_start();
if ($_SESSION['adminloggedin'] != true) {
    header("Location: ../login.php");
    exit;
}
require_once "../db_connection.php";
// Check if the form is submitted for deletion
if (isset($_POST['delete-btn'])) {
    // Include your database connection code here
    // For example: $db = new mysqli('localhost', 'username', 'password', 'database');

    // Retrieve the row ID from the form
    $row_id = $_POST['row_id'];

    // SQL query to delete the row with the given ID
    $sql = "DELETE FROM announcement WHERE title_id = $row_id";

    // Execute the query
    if ($db->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $db->error;
    }

    // Close the database connection
    $db->close();
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

    <!-- table sorting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.12.1/bootstrap-table.min.js"></script>

    <?php include '../elements/new-styles.php'; ?>
</head>

<body>
    <?php include '../elements/navbar-admin.php'; ?>
    <div class="container">
        <div class="row my-3">
            <div class="col-md-8 col-xl-6 text-center mx-auto">
                <h2>Announcements</h2>
            </div>
        </div>
        <form>
            <div class="row mb-3">
                <div class="col d-flex justify-content-end"><a class="btn btn-primary" role="button" href="announcements-new.php">Add New Announcement<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20" fill="none" class="ms-1">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C4.89543 2 4 2.89543 4 4V16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V7.41421C16 6.88378 15.7893 6.37507 15.4142 6L12 2.58579C11.6249 2.21071 11.1162 2 10.5858 2H6ZM11 8C11 7.44772 10.5523 7 10 7C9.44772 7 9 7.44772 9 8V10H7C6.44772 10 6 10.4477 6 11C6 11.5523 6.44772 12 7 12H9V14C9 14.5523 9.44771 15 10 15C10.5523 15 11 14.5523 11 14L11 12H13C13.5523 12 14 11.5523 14 11C14 10.4477 13.5523 10 13 10H11V8Z" fill="currentColor"></path>
                        </svg></a></div>
            </div>
            <div class="row">
                <div class="col"></div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <!-- Removed search button and added event listener to input -->
                        <input id="searchInput" class="form-control" type="text" placeholder="Search The Library Here" oninput="searchTable()">
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <?php
                    // Assuming you have established your database connection
                    // Fetching data for the table
                    require_once "../db_connection.php";

                    $stmt = $conn->prepare('SELECT * FROM announcement ORDER BY title_id DESC');

                    if (!$stmt) {
                        die('Error in SQL query: ' . $conn->error); // Check for errors in prepare statement
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are rows fetched
                    if ($result->num_rows > 0) {
                    ?>
                        <table class="table my-0 table-bordered" id="dataTable" data-toggle="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th data-sortable="true">Announcement ID</th>
                                    <th data-sortable="true">Announcement / Events</th>
                                    <th data-sortable="true">Date Created</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryResult = mysqli_num_rows($result);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['title_id']; ?></td>
                                        <td class="fw-bold"><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['title_date']; ?></td>

                                        <td class="d-flex align-items-center">
                                            <button class="btn btn-primary d-flex align-items-center p-1 me-1" data-bs-toggle="tooltip" data-bss-tooltip="" type="button" title="View" onclick="window.location.href='announcements-view.php?id=<?php echo $row['title_id']; ?>'"><i class="far fa-eye"></i></button>
                                            <button class="btn btn-primary d-flex align-items-center p-1 me-1" data-bs-toggle="tooltip" data-bss-tooltip="" type="button" title="Edit" onclick="window.location.href='announcements-update.php?id=<?php echo $row['title_id']; ?>'"><i class="far fa-edit"></i></button>
                                        </td>

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
                        echo '<div style="text-align: center;">No payments due.</div>';
                    }


                    // Calculate the date 5 years ago
                    $fiveYearsAgo = date('Y-m-d', strtotime('-6 months'));

                    $deleteQuery = "DELETE FROM announcement WHERE title_date <= '$fiveYearsAgo'";
                    $result2 = mysqli_query($conn, $deleteQuery);
                    ?>
                    </tbody>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                    </table>
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

        </form>
    </div>
    <?php include '../elements/footer-admin.php'; ?>
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
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/bold-and-bright.js"></script>
</body>

</html>