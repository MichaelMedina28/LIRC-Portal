<div class="container">
    <div class="row my-3">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
            <h2>Services</h2>
            <p><strong>Online Public Access Catalogue - Journals</strong></p>
        </div>
    </div>
    <form>
        <div class="col">
            <div class="row  d-flex justify-content-end">
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
                    <table id="dataTable" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Article Title</th>
                                <th>Article Author</th>
                                <th>Publisher</th>
                                <th>Volume Number</th>
                                <th>Date</th>
                                <th>ISSN</th>
                                <th>Copy</th>
                                <th>Date Encoded</th>
                                <th>Encoder</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP code to fetch data from the database and display it -->
                            <?php
                            require_once $dbPath . "db_connection.php";

                            $query = "SELECT * FROM opac_journals";
                            $result = mysqli_query($conn, $query);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$row['title']}</td>";
                                    echo "<td>{$row['article_title']}</td>";
                                    echo "<td>{$row['article_author']}</td>";
                                    echo "<td>{$row['publisher']}</td>";
                                    echo "<td>{$row['volume_number']}</td>";
                                    echo "<td>{$row['date']}</td>";
                                    echo "<td>{$row['issn']}</td>";
                                    echo "<td>{$row['copy']}</td>";
                                    echo "<td>{$row['date_encoded']}</td>";
                                    echo "<td>{$row['encoder']}</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo '<tr><td colspan="10" style="text-align: center;">No records found</td></tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <!-- Table footer content if any -->
                        </tfoot>
                    </table>
                </div>
            </div>
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