<?php 
    $server = "localhost";
    $username = "diaz";
    $password = "";
    $dbname = "inventaris";
    $id = $_POST['id_barang'];
    $conn = new mysqli($server, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $sql = "DELETE FROM inventaris_data WHERE id_barang=$id";
    if($conn->query($sql) == TRUE) {
        header('Location: '. 'http://localhost/inventaris/index.php?search=');
    } else {
        die($conn->error);
    }
    $conn->close();
?>