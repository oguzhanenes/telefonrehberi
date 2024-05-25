<?php

    const host = "localhost";
    const username = "root";
    const password ="";
    const database="rehber";


    $conn =mysqli_connect(host,username,password,database);

    if(mysqli_connect_errno()>0){
        die("hata:".mysqli_connect_errno());

    }
    // mysqli_close($conn);

    // echo "mysql bağlantısı kapatıldı";


?>
