<?php 
    $server = "localhost";
    $username = "diaz";
    $password = "";
    $dbname = "inventaris";
    $nama_data = $_POST['nama_data'];
    $nama_inventaris = $_POST['nama_invent'];
    $kuantitas = $_POST['kuantitas'];
    $conn = new mysqli($server, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $sql = "INSERT INTO data_inventaris (nama_data, nama_inventaris, kuantitas) VALUES('$nama_data', '$nama_inventaris', $kuantitas)";
    if($conn->query($sql) == TRUE) {
        header('Location: '. 'http://localhost/inventaris/index.php');
    } else {
        die('Error has been occured!'. $conn->error);
    }
    $conn->close();
?>