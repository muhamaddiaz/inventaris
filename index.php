<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inventaris</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
            .ct-top {
                padding: 0;
                background-image: url(./assets/train.jpg);
            }
            .faded {
                padding: 50px;
                background-color: rgba(0, 0, 0, .5);
            }
        </style>
        <script>
            function validate() {
                let b = $('#nama_data');
                let c = $('#nama_invent');
                let d = $('#kuantitas');
                let e_b = $('#e_spot2');
                let e_c = $('#e_spot3');
                let e_d = $('#e_spot4');
                let error = false;
                if(b.val() == '') {
                    e_b.text('* nama barang tidak boleh kosong');
                    error++;
                } else {
                    e_b.text('');
                }
                if(c.val() == '') {
                    e_c.text('* nama inventaris tidak boleh kosong');                    
                    error++;
                } else {
                    e_c.text('');
                }
                if(d.val() == '') {
                    e_d.text('* kuantitas tidak boleh kosong');
                    error++;
                } else {
                    e_d.text('');
                }
                console.log(error);
                if(error != 0) {
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <div class="container-fluid text-center text-white ct-top">
            <div class="faded">
                <h1 class="display-3">Inventaris Web</h1>
                <p>Pencatatan setiap data inventaris yang masuk</p>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search" placeholder="Search ID">
                                <span class="input-group-btn">
                                    <input class="btn btn-success" type="submit" value="Go" />
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <br>
            <div class="row">
                <div class="col-md-8">
                    <?php
                        $server = "localhost";
                        $username = "diaz";
                        $password = "";
                        $dbname = "inventaris";
                        $search = $_GET['search'];
                        $conn = new mysqli($server, $username, $password, $dbname);
                        if($search != '') {
                            $sql = "SELECT * FROM data_inventaris WHERE id_inventaris=$search";
                        } else {
                            $sql = "SELECT * FROM data_inventaris";
                        }
                        $result = $conn->query($sql);
                        if($result->num_rows > 0) {
                            echo "<table class='table table-bordered'>";
                            echo "<tr class='thead-dark'><th>ID Inventaris</th><th>Nama Barang</th><th>Nama Inventaris</th><th>Kuantitas</th><tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>$row[id_inventaris]</td><td>$row[nama_data]</td><td>$row[nama_inventaris]</td><td>$row[kuantitas]</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<h1 class='text-center'>No Data</h1>";
                        }
                    ?>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Rekam data inventaris
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Rekam data inventaris</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars('createData.php'); ?>" method="post" onsubmit='return validate()'>
                                        <p id="e_spot2" class="text-danger"><p>
                                        <input id="nama_data" class="form-control" type="text" name="nama_data" placeholder="Nama Barang" />
                                        <p id="e_spot3" class="text-danger"><p>
                                        <input id="nama_invent" class="form-control" type="text" name="nama_invent" placeholder="Nama Inventaris" />
                                        <p id="e_spot4" class="text-danger"><p>
                                        <input id="kuantitas" class="form-control" type="number" name="kuantitas" placeholder="Kuantitas" />
                                        <br>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>