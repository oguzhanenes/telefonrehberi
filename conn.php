<?php

const host = "localhost";
const username = "root";
const password = "";
const database = "rehber";


$baglanti = mysqli_connect(host, username, password, database);
if (mysqli_connect_errno() > 0) {
    die("hata:" . mysqli_connect_errno());
}
// echo "bağlantı kuruldu";

// mysqli_close($baglanti);

// echo "mysql bağlantısı kapatıldı";
