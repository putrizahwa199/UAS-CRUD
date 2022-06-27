<?php

    //header hasil berbentuk json
    header("Content-Type:application/json");

    $method = $_SERVER['REQUEST_METHOD'];


    //variable hasil
    $result = array();

    //cek metode
    if($method=='GET'){
        //jika metode sesuai
        $result['status'] = [
            "code" => 200,
            "description" => 'Request Valid'
        ];

        //s:koneksi database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "store";
        //create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        //e:koneksi database

        //buat query
        $sql = "SELECT * FROM karyawan";
        //eksekusi query
        $hasil_query = $conn->query($sql);
        //masukkan ke array result
        $result['results'] = $hasil_query->fetch_all(MYSQLI_ASSOC);

    }else{
        $result['status'] = [
            "code" => 400,
            "description" => 'Request not Valid'
        ];
    }

    //ta,pilkan dlm format json
    echo json_encode($result);
?>