<?php

        header('Access-Control-Allow-Origin:*');
        header('Access-Control-Allow-Headers:*');
        $host = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "store";
        $dsn = "mysql:host={$host};dbname={$dbname}";


        $connect = new PDO($dsn, $user, $pass);
        $result = array();
        $result["error"] = false;
        $result['message'] = "";
        if ($connect){
            $result["is_db_connected"] = true;
            $result["connection_msg"] = "Berhasil terhubung!";
        }else{
            $result["is_db_connected"] = false;
            $result["connection_msg"] = "Gagal terhubung!";
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nama = $_POST['nama'];
                $jabatan = $_POST['jabatan'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $alamat = $_POST['alamat'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $no_telpon = $_POST['no_telp'];
                $sql = $connect->prepare("SELECT *  FROM karyawan WHERE idkaryawan =:idkaryawan");
                $array_execute[":idkaryawan"] = $idk;
                $sql -> execute($array_execute);
                $sqlNumOfRows = $sql->rowCount();

                if ($sqlNumOfRows < 1){
                    $sql2 = $connect->prepare("INSERT INTO karyawan (idkaryawan,nama,jabatan,jenis_kelamin,alamat,tanggal_lahir,no_telp)
                                                    VALUES(:idkaryawan,:nama,:jabatan,:jenis_kelamin,:alamat,:tanggal_lahir,:no_telp)");

                    $array_execute[":idkaryawan"] = $idk;
                    $array_execute[":nama"] = $nama;
                    $array_execute[":jabatan"] = $jabatan;
                    $array_execute[":jenis_kelamin"] = $jenis_kelamin;
                    $array_execute[":alamat"] = $alamat;
                    $array_execute[":tanggal_lahir"] = $tanggal_lahir;
                    $array_execute[":no_telp"] = $no_telpon;
                    if ($sql2 -> execute($array_execute)){
                        $result['message'] = "Berhasil menambah data ($nama) !";
                    }else{
                        $result["error"] = true;
                        $result["message"] = "Gagal menambah data";
                    }
                }else{
                    $result["error"] = true;
                    $result['message'] = "idkaryawan ($idk) sudah ada ";
                }
        }else{
            $result["error"] = true;
            $result["message"] = "post method needed";
        }


        echo json_encode($result, JSON_PRETTY_PRINT);