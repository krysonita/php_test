<?php 
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "myshop";

    // Create Connection
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM client WHERE id=$id";
    $conn->query($sql);
}

header("location: /myshop/index.php");
exit;
?>