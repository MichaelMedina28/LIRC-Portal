<div class="container">
    <div class="row my-3">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Services</h2>
            <p><strong>Online Public Access Catalogue - Books</strong></p>
        </div>
    </div>
    <form>
        <div class="col">
            <div class="row mb-3 d-flex justify-content-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <!-- Removed search button and added event listener to input -->
                        <input id="searchInput" class="form-control" type="text" placeholder="Search The Library Here" oninput="searchTable()">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="table-responsive text-nowrap">
                    <table id="dataTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Copies</th>
                                <th>Call Number</th>
                                <th>Accession Number</th>
                                <th>Title</th>
                                <th>Edition</th>
                                <th>Author</th>
                                <th>Year</th>
                                <th>Publisher</th>
                                <th>Place of Publication</th>
                                <th>ISBN</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetching data from the database
                            require_once $dbPath . "db_connection.php";

                            $query = "SELECT * FROM opac_books";
                            $result = mysqli_query($conn, $query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['copies']; ?></td>
                                        <td><?php echo $row['call_number']; ?></td>
                                        <td><?php echo $row['accession_number']; ?></td>
                                        <td><?php echo $row['title']; ?></td>
                                        <td><?php echo $row['edition']; ?></td>
                                        <td><?php echo $row['author']; ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td><?php echo $row['publisher']; ?></td>
                                        <td><?php echo $row['place_of_publication']; ?></td>
                                        <td><?php echo $row['isbn']; ?></td>
                                        <td><?php echo $row['section']; ?></td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="11" style="text-align: center;">No records found</td></tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <!-- Your table footer content -->
                        </tfoot>
                    </table>
                </div>
    </form>
    <div class="row my-3">
        <div class="col-md-6 align-self-center">
            <!-- <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p> -->
        </div>
        <div class="col-md-6 d-flex justify-content-end">
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


</div>