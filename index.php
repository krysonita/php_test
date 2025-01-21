<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</body>
</html>

</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        
        <a href="/myshop/create.php" class="btn btn-primary" role="button">New Client</a>
        <br>
        <br>
        <div class="col-sm-6">
        <input type="text" name="search" id="search_bar" placeholder="Search Client..." class="form-control">

        </div>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Create At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "myshop";

                    //Create connection 
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: ". $conn->connect_error);
                    }

                    // read all row from database table
                    $sql = "SELECT * FROM client";
                    $result = $conn->query($sql);

                    if (! $result) {
                        die("Invalid query: ". $conn->error);
                    }

                    // read data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>$row[id]</td>
                                <td>$row[name]</td>
                                <td>$row[email]</td>
                                <td>$row[phone]</td>
                                <td>$row[address]</td>
                                <td>$row[created_at]</td>
                                <td>
                                    <a href='/myshop/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='/myshop/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                            </tr>
                        ";
                    }
                ?>
                
            </tbody>
        </table>
    </div>
    <script src="js/search.js"></script>
</body>
</html>