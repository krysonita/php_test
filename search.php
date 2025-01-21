<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the search term from POST
    $searchTerm = isset($_POST['searchTerm']) ? $conn->real_escape_string($_POST['searchTerm']) : '';

    // Log the search term for debugging
    error_log("Search Term: " . $searchTerm);

    // Create SQL query
    if (empty($searchTerm)) {
        // Fetch all rows if no search term is provided
        $sql = "SELECT * FROM client ";
    } else {
        // Search for rows matching the search term
        $sql = "SELECT * FROM client 
                WHERE 
                    `id` LIKE '%$searchTerm%' OR
                    `name` LIKE '%$searchTerm%' OR
                    `email` LIKE '%$searchTerm%' OR
                    `phone` LIKE '%$searchTerm%' OR
                    `address` LIKE '%$searchTerm%' OR
                    `created_at` LIKE '%$searchTerm%' ";
    }

    // Log the SQL query for debugging
    error_log("SQL Query: " . $sql);

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query failed
    if (!$result) {
        error_log("SQL Error: " . $conn->error); // Log the error
        die("SQL Error: " . $conn->error);
    }

    // Output the results as table rows
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='/myshop/edit.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='/myshop/delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>
            ";
        }
    } else {
        // No results found
        echo "<tr><td colspan='7'>No clients found...</td></tr>";
    }
?>