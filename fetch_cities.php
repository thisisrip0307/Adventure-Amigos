<?php
// Database connection

require_once 'partials/__dbconnect.php';

if (isset($_POST['query'])) {
    $query = $conn->real_escape_string($_POST['query']);

    // Query to fetch cities matching the input
    $sql = "SELECT name FROM Cities WHERE name LIKE '%$query%' LIMIT 10";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='suggestion'>" . $row['name'] . "</div>";
        }
    } else {
        echo "<div>No suggestions found</div>";
    }
}

$conn->close();
?>
