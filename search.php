<?php
// Include database connection
require_once "db_connection.php";

// Get the search query from the request
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare the SQL query
$query = "SELECT * FROM opac_books WHERE 
    copies LIKE '%$searchQuery%' OR 
    call_number LIKE '%$searchQuery%' OR 
    accession_number LIKE '%$searchQuery%' OR 
    title LIKE '%$searchQuery%' OR 
    edition LIKE '%$searchQuery%' OR 
    author LIKE '%$searchQuery%' OR 
    year LIKE '%$searchQuery%' OR 
    publisher LIKE '%$searchQuery%' OR 
    place_of_publication LIKE '%$searchQuery%' OR 
    isbn LIKE '%$searchQuery%' OR 
    section LIKE '%$searchQuery%'";

// Perform the SQL query
$result = mysqli_query($conn, $query);

// Check if there are rows fetched
if ($result->num_rows > 0) {
    // Output the search results as HTML
    while ($row = $result->fetch_assoc()) {
        // Output each row as HTML
        echo "<tr>";
        echo "<td>{$row['copies']}</td>";
        echo "<td>{$row['call_number']}</td>";
        echo "<td>{$row['accession_number']}</td>";
        echo "<td>{$row['title']}</td>";
        echo "<td>{$row['edition']}</td>";
        echo "<td>{$row['author']}</td>";
        echo "<td>{$row['year']}</td>";
        echo "<td>{$row['publisher']}</td>";
        echo "<td>{$row['place_of_publication']}</td>";
        echo "<td>{$row['isbn']}</td>";
        echo "<td>{$row['section']}</td>";
        echo "</tr>";
    }
} else {
    // Output a message if no results found
    echo '<tr><td colspan="11" class="text-center">No results found.</td></tr>';
}
?>
