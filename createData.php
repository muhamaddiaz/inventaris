<?php 
    $server = "localhost";
    $username = "diaz";
    $password = "";
    $dbname = "inventaris";
    $nama_barang = $_POST['nama_barang'];
    $model_barang = $_POST['model_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $tahun_pembelian = $_POST['tahun_pembelian'];
    $kondisi = $_POST['kondisi'];
    $keterangan = $_POST['keterangan'];
    $conn = new mysqli($server, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    $sql = "INSERT INTO inventaris_data 
    (nama_barang, model_barang, jumlah_barang, tahun_pembelian, kondisi, keterangan) 
    VALUES('$nama_barang', '$model_barang', $jumlah_barang, '$tahun_pembelian', '$kondisi', '$keterangan')";
    if($conn->query($sql) == TRUE) {
        header('Location: '. 'http://localhost/inventaris/index.php?search=');
    } else {
        die('Error has been occured!'. $conn->error);
    }
    $conn->close();
?>