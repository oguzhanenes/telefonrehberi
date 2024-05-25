<?php
include 'conn.php';

function addUserToDatabase($conn, $username, $name, $surname, $email, $password) {
    // SQL INSERT sorgusunu hazırlayın
    $sql = "INSERT INTO users (username, name, surname, email, password) VALUES ('$username', '$name', '$surname', '$email', '$password')";

    // Sorguyu çalıştırın
    if ($conn->query($sql) === TRUE) {
        // echo "Yeni kayıt başarıyla oluşturuldu";
        header("Location: success_register.php");
        exit(); // İşlemi sonlandır
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

$usernameErr = $nameErr = $surnameErr = $emailErr = $passwordErr = "";
$username = $name = $surname = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Kullanıcı adı kontrolü
    if (empty($username)) {
        $usernameErr = "Kullanıcı adı girin!";
    }

    // Ad kontrolü
    if (empty($name)) {
        $nameErr = "Ad girin!";
    }

    // Soyad kontrolü
    if (empty($surname)) {
        $surnameErr = "Soyad girin!";
    }

    // Email kontrolü
    if (empty($email)) {
        $emailErr = "Email girin!";
    }

    // Şifre kontrolü
    if (empty($password)) {
        $passwordErr = "Şifre girin!";
    }

    // Hata olmadığında kullanıcıyı veritabanına ekle
    if (empty($usernameErr) && empty($nameErr) && empty($surnameErr) && empty($emailErr) && empty($passwordErr)) {
        addUserToDatabase($conn, $username, $name, $surname, $email, $password); // $conn, $username, $name, $surname, $email, $password değişkenlerini kullanarak fonksiyonu çağırın
    }
}
?>




<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
    <title>Telefon Rehberi</title>
</head>

<body class="h-100 d-flex flex-column">
    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #003285;">
        <div class="container">
            <a href="index.html" class="navbar-brand">
                <i class="fa-solid fa-phone"></i>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobile">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="mobile" class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto ms-2">
                    <li class="nav-item ms-2">
                        <a href="index.html" class="nav-link">Anasayfa</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="#" class="nav-link">Hakkımızda</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="#" class="nav-link">İletişim</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="login.php" type="button" class="btn btn-outline-light btn-md" type="submit">Giriş</a>
                    <a href="register.php" type="button" class="btn btn-light btn-md ms-2" type="submit">Kayıt Ol</a>
                </form>
            </div>
        </div>
    </nav>



    <main>
        <section>
            <h1 class="display-4 fw-bold text-center mt-5">Kayıt Ekranı</h1>
            <div class="pt-5 mt-2 px-4 border-bottom">
                <div class="col-lg-6 mx-auto mb-4">
                    <form action="register.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">İsim</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <div class="text-danger"><?php echo $nameErr  ?></div>
                        </div>
                        <div class="col-12">
                            <label for="surname" class="form-label">Soyad</label>
                            <input type="text" class="form-control" id="surname" name="surname">
                            <div class="text-danger"><?php echo $surnameErr  ?></div>
                        </div>
                        <div class="col-12">
                            <label for="username" class="form-label">Kullanıcı Adı</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="text-danger"><?php echo $usernameErr  ?></div>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">E-posta</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <div class="text-danger"><?php echo $emailErr  ?></div>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="text-danger"><?php echo $passwordErr  ?></div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Kayıt</button>
                            <!-- <a href="login.html" type="submit" class="btn btn-primary">Kayıt</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <footer class="py-5 bg-dark text-white mt-auto">
        <div class="container text-center">
            <span>Bütün Hakları Saklıdır. @2024</span>
        </div>
    </footer>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>