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
            function validate2() {
                let a = $('#id_barang');
                let e_a = $('#e_spot1');
                if(a.val() == '') {
                    e_a.text('* Id tidak boleh kosong');
                    return false;
                } else {
                    e_a.text('');
                    if(confirm("Apa anda yakin ?")) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
            function validate() {
                let b = $('#nama_barang');
                let c = $('#model_barang');
                let d = $('#jumlah_barang');
                let e = $('#tahun_pembelian');
                let f = $('#kondisi');
                let g = $('#keterangan');
                let e_b = $('#e_spot2');
                let e_c = $('#e_spot3');
                let e_d = $('#e_spot4');
                let e_e = $('#e_spot5');
                let error = false;
                if(b.val() == '') {
                    e_b.text('* nama barang tidak boleh kosong');
                    error++;
                } else {
                    e_b.text('');
                }
                if(c.val() == '') {
                    e_c.text('* model barang tidak boleh kosong');                    
                    error++;
                } else {
                    e_c.text('');
                }
                if(d.val() == '') {
                    e_d.text('* jumlah barang tidak boleh kosong');
                    error++;
                } else {
                    e_d.text('');
                }
                if(e.val() == '') {
                    e_e.text('* tahun pembelian tidak boleh kosong');
                    error++;
                } else {
                    e_e.text('');
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
                                <input type="search" class="form-control" name="search" placeholder="Search ID" />
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
                            $sql = "SELECT * FROM inventaris_data WHERE id_barang=$search";
                        } else {
                            $sql = "SELECT * FROM inventaris_data";
                        }
                        $result = $conn->query($sql);
                        if($result->num_rows > 0) {
                            echo "<table class='table table-bordered table-responsive'>";
                            echo "<tr class='thead-dark'>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Model Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Tahun Pembelian</th>
                            <th>Kondisi</th>
                            <th>Keterangan</th>
                            <tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>$row[id_barang]</td>
                                <td>$row[nama_barang]</td>
                                <td>$row[model_barang]</td>
                                <td>$row[jumlah_barang]</td>
                                <td>$row[tahun_pembelian]</td>
                                <td>$row[kondisi]</td>
                                <td>$row[keterangan]</td>
                                </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<h1 class='text-center'>No Data</h1>";
                        }
                    ?>
                </div>
                <div class="col-md-4">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                            Rekam data inventaris
                        </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Hapus data inventaris
                        </button>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel">Hapus data inventaris</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> 
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars('deleteData.php') ?>" method="post" onsubmit='return validate2()'>
                                        <p id="e_spot1" class="text-danger"></p>
                                        <input type="number" name="id_barang" class="form-control" id="id_barang" placeholder="Masukan ID barang"/>
                                        <br>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-danger">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="createModalLabel">Rekam data inventaris</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?php echo htmlspecialchars('createData.php'); ?>" method="post" onsubmit='return validate()'>
                                        <p id="e_spot2" class="text-danger"><p>
                                        <input id="nama_barang" class="form-control" type="text" name="nama_barang" placeholder="Nama Barang" />
                                        <p id="e_spot3" class="text-danger"><p>
                                        <input id="model_barang" class="form-control" type="text" name="model_barang" placeholder="Model Barang" />
                                        <p id="e_spot4" class="text-danger"><p>
                                        <input id="jumlah_barang" class="form-control" type="number" name="jumlah_barang" placeholder="Jumlah Barang" />

                                        <p id="e_spot5" class="text-danger"><p>
                                        <input id="tahun_pembelian" class="form-control" type="date" name="tahun_pembelian" placeholder="Tahun Pembelian" />
                                        <br>
                                        <label for="kondisi">Kondisi: </label>
                                        <select name="kondisi" id="kondisi" class="form-control">
                                            <option value="Baru">Baru</option>
                                            <option value="Bekas">Bekas</option>
                                        </select>
                                        <!--<input id="kondisi" class="form-control" type="number" name="jumlah_barang" placeholder="Jumlah Barang" />-->
                                        <br>
                                        <label for="keterangan">Keterangan: </label>
                                        <select name="keterangan" id="kondisi" class="form-control">
                                            <option value="Baik">Baik</option>
                                            <option value="Cukup">Cukup</option>
                                            <option value="Kurang baik">Kurang baik</option>
                                        </select>
                                        <!--<input id="keterangan" class="form-control" type="number" name="jumlah_barang" placeholder="Jumlah Barang" />-->
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