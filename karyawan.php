<?php
require 'function.php';
require 'cek.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Aditri Store</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stok Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="karyawan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Karyawan
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Login sebagai:</div>
                    Admin
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Karyawan</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data Karyawan
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Lahir</th>
                                        <th>NO Telpon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatakaryawan = mysqli_query($conn, "select * from karyawan");
                                    $i = 1;
                                    while($data=mysqli_fetch_array($ambilsemuadatakaryawan)){
                                        $nama = $data['nama'];
                                        $jabatan = $data['jabatan'];
                                        $jenis_kelamin = $data['jenis_kelamin'];
                                        $alamat = $data['alamat'];
                                        $tanggal_lahir = $data['tanggal_lahir'];
                                        $no_telpon = $data['no_telp'];
                                        $idkar = $data['id_karyawan'];


                                    ?>

                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$nama;?></td>
                                        <td><?=$jabatan;?></td>
                                        <td><?=$jenis_kelamin;?></td>
                                        <td><?=$alamat;?></td>
                                        <td><?=$tanggal_lahir;?></td>
                                        <td><?=$no_telpon;?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#ubah<?=$idkar;?>">
                                                Ubah
                                            </button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#hapus<?=$idkar;?>">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Ubah data Modal -->
                                    <div class="modal fade" id="ubah<?=$idkar;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Ubah Barang</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="text" name="nama" value="<?=$nama;?>"
                                                            class="form-control" required>
                                                        <br>
                                                        <input type="text" name="jabatan" value="<?=$jabatan;?>"
                                                            class="form-control" required>
                                                        <br>
                                                        <select class="form-control" name="jenis_kelamin"
                                                            id="jenis_kelamin">
                                                            <option value="">- Jenis Kelamin -</option>
                                                            <option value="perempuan"
                                                                <?php if ($jenis_kelamin == "perempuan") echo "selected" ?>>
                                                                Perempuan
                                                            </option>
                                                            <option value="laki-laki"
                                                                <?php if ($jenis_kelamin == "laki-laki") echo "selected" ?>>
                                                                Laki-laki
                                                            </option>
                                                        </select>
                                                        <br>
                                                        <input type="text" name="alamat" value="<?=$alamat;?>"
                                                            class="form-control" required>
                                                        <br><input type="date" name="tanggal_lahir"
                                                            value="<?=$tanggal_lahir;?>" class="form-control" required>
                                                        <br><input type="number" name="no_telp"
                                                            value="<?=$no_telpon;?>" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="id_karyawan" value="<?=$idkar;?>">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="updatedatakaryawan">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- hapus data Modal -->
                                    <div class="modal fade" id="hapus<?=$idkar;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="post">
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus <?=$nama;?>?
                                                        <input type="hidden" name="id_karyawan" value="<?=$idkar;?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger"
                                                            name="hapusdatakaryawan">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                    };
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="nama" placeholder="Nama" class="form-control" required>
                    <br>
                    <input type="text" name="jabatan" placeholder="Jabatan" class="form-control" required>
                    <br>
                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="">- Jenis Kelamin -</option>
                        <option value="perempuan" <?php if ($jenis_kelamin == "perempuan") echo "selected" ?>>Perempuan
                        </option>
                        <option value="laki-laki" <?php if ($jenis_kelamin == "laki-laki") echo "selected" ?>>Laki-laki
                        </option>
                    </select>
                    <br>
                    <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
                    <br>
                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal lahir" required>
                    <br>
                    <input type="number" name="no_telp" class="form-control" placeholder="No Telpon" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="adddatakaryawan">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>