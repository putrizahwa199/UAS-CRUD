<?php
session_start();
//membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","store");

//menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];
    $addtotable = mysqli_query($conn, "insert into stok (namabarang, deskripsi, stok) values('$namabarang','$deskripsi','$stok')");
    
    if($addtotable){
        header('location:index.php');
    } else{
        echo 'Gagal';
        header('location:index.php');
    }
};


//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganjumlah = $stoksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$keterangan','$qty')");
    $updatestokmasuk = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganjumlah' where idbarang='$barangnya'");

    if($addtomasuk&&$updatestokmasuk){
        header('location:masuk.php');
    } else{
        echo 'Gagal';
        header('location:masuk.php');
    }
};

//menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stok where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildatanya['stok'];
    $tambahkanstoksekarangdenganjumlah = $stoksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, keterangan, qty) values('$barangnya','$keterangan','$qty')");
    $updatestokkeluar = mysqli_query($conn, "update stok set stok='$tambahkanstoksekarangdenganjumlah' where idbarang='$barangnya'");

    if($addtomasuk&&$updatestokkeluar){
        header('location:keluar.php');
    } else{
        echo 'Gagal';
        header('location:keluar.php');
    }
};

//menambah data karyawan 
if(isset($_POST['adddatakaryawan'])){
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telpon = $_POST['no_telp'];
   
    $addtokaryawan = mysqli_query($conn, "insert into karyawan (nama, jabatan, jenis_kelamin, alamat,tanggal_lahir, no_telp) values('$nama','$jabatan','$jenis_kelamin','$alamat','$tanggal_lahir','$no_telpon')");
    
    if($addtokaryawan){
        header('location:karyawan.php');
    } else{
        echo 'Gagal';
        header('location:karyawan.php');
    }
};

//update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idbarang'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
   
    $update = mysqli_query($conn, "update stok set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
    
    if($update){
        header('location:index.php');
    } else{
        echo 'Gagal';
        header('location:index.php');
    }
};

//menghapus stok barang
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idbarang'];
   
    $hapus = mysqli_query($conn, "delete from stok where idbarang='$idb'");
    
    if($hapus){
        header('location:index.php');
    } else{
        echo 'Gagal';
        header('location:index.php');
    }
};

//mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idbarang'];
    $idm = $_POST['idmasuk'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stoksekarang = $stoknya['stok'];

    $qtysekarang = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    

    if($qty>$qtysekarang){
        $selisih = $qty-$qtysekarang;
        $kurangin = $stoksekarang + $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
        
        if($kurangistoknya&&$updatenya){
            header('location:masuk.php');
            } else{
                echo 'Gagal';
                header('location:masuk.php');
            }
        }else{
            $selisih = $qtysekarang-$qty;
            $kurangin = $stoksekarang - $selisih;
            $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
            
            if($kurangistoknya&&$updatenya){
                header('location:masuk.php');
                } else{
                    echo 'Gagal';
                    header('location:masuk.php');
                }
        }
    }

//menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idm = $_POST['idmasuk'];

    $getdatastok = mysqli_query($conn, "select * from stok where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    $selisih = $stok-$qty;

    $update = mysqli_query($conn, "update stok set stok='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else{
        echo 'Gagal';
        header('location:masuk.php');
    }
};



//mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idbarang'];
    $idk = $_POST['idkeluar'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstok = mysqli_query($conn,"select * from stok where idbarang='$idb'");
    $stoknya = mysqli_fetch_array($lihatstok);
    $stoksekarang = $stoknya['stok'];

    $qtysekarang = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtysekarang);
    $qtysekarang = $qtynya['qty'];
    

    if($qty>$qtysekarang){
        $selisih = $qty-$qtysekarang;
        $kurangin = $stoksekarang - $selisih;
        $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', keterangan='$keterangan' where idkeluar='$idk'");
        
        if($kurangistoknya&&$updatenya){
            header('location:keluar.php');
            } else{
                echo 'Gagal';
                header('location:keluar.php');
            }
        }else{
            $selisih = $qtysekarang-$qty;
            $kurangin = $stoksekarang + $selisih;
            $kurangistoknya = mysqli_query($conn, "update stok set stok='$kurangin' where idbarang='$idb'");
            $updatenya = mysqli_query($conn, "update keluar set qty='$qty', keterangan='$keterangan' where idkeluar='$idk'");
            
            if($kurangistoknya&&$updatenya){
                header('location:keluar.php');
                } else{
                    echo 'Gagal';
                    header('location:keluar.php');
                }
        }
    }

//menghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idbarang'];
    $qty = $_POST['qty'];
    $idk = $_POST['idkeluar'];

    $getdatastok = mysqli_query($conn, "select * from stok where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastok);
    $stok = $data['stok'];

    $selisih = $stok+$qty;

    $update = mysqli_query($conn, "update stok set stok='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else{
        echo 'Gagal';
        header('location:keluar.php');
    }
};




//mengubah data karyawan
if(isset($_POST['updatedatakaryawan'])){
    $idkar = $_POST['id_karyawan'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $no_telpon = $_POST['no_telp'];

   
    $update = mysqli_query($conn, "update karyawan set nama='$nama', jabatan='$jabatan', jenis_kelamin='$jenis_kelamin', alamat='$alamat', tanggal_lahir='$tanggal_lahir', no_telp='$no_telpon' where id_karyawan='$idkar'");
    
    if($update){
        header('location:karyawan.php');
    } else{
        echo 'Gagal';
        header('location:karyawan.php');
    }
};

//menghapus data karyawan
if(isset($_POST['hapusdatakaryawan'])){
    $idkar = $_POST['id_karyawan'];
   
    $hapus = mysqli_query($conn, "delete from karyawan where id_karyawan='$idkar'");
    
    if($hapus){
        header('location:karyawan.php');
    } else{
        echo 'Gagal';
        header('location:karyawan.php');
    }
};




?>