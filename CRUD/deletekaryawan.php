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
                $sql = $connect->prepare("SELECT *  FROM karyawan WHERE idkaryawan =:idkaryawan");
                $array_execute[":idkaryawan"] = $idk;
                $sql->execute($array_execute);
                $sqlNumOfRows = $sql->rowCount();
                if ($sqlNumOfRows >= 1) {
                    $sql2 = $connect->prepare("DELETE FROM karyawan WHERE idkaryawan =:idkaryawan");
                    $array_executes[":idkaryawan"] = $idk;
                    if ($sql2 -> execute($array_executes)) {
                        $result['message'] = "Berhasil menghapus data ($nama) !";
                    } else {
                        $result["error"] = true;
                        $result["message"] = "Gagal menghapus data";
                    }
                } else {
                    $result["error"] = true;
                    $result['message'] = "idkaryawan ($idk) data tidak ditemukan!";
                }
            }else{
                $result['message'] = "POST method needed";
            }

            echo json_encode($result,JSON_PRETTY_PRINT);