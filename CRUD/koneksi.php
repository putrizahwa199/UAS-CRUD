
<?php

    header('Access-Control-Allow-Origin: *');
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

echo json_encode($result,JSON_PRETTY_PRINT);
?>