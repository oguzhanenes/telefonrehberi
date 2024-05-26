<?php
session_start();
$usernameErr = $passwordErr = "";
$username = $password = $loginErr = "";

include 'conn.php';

if (isset($_SESSION["loggedIn"])) {
    header("location:contact.php");
    exit();
}

if (isset($_POST["login"])) {

    if (empty($_POST["username"])) {
        $usernameErr = "Kullanıcı adı girin!";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Şifre girin!";
    } else {
        $password = $_POST["password"];
    }

    if (empty($usernameErr) && empty($passwordErr)) {
        $sql = "SELECT user_id,username, password from users WHERE username=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);


            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    //parola kontrolü
                    mysqli_stmt_bind_result($stmt, $user_id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            $_SESSION["loggedIn"] = true;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["username"] = $username;

                            header("Location: success_login.php");
                        } else {
                            $loginErr = "Parola hatalı";
                        }
                    }
                } else {
                    $loginErr = "Kullanıcı adı hatalı";
                }
            } else {
                $loginErr = "Hata oluştu";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>





<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="info.html" class="nav-link">Hakkımızda</a>
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
            <h1 class="display-4 fw-bold text-center mt-5">Giriş Ekranı</h1>
            <div class="pt-5 mt-2 px-4 border-bottom">
                <div class="col-lg-6 mx-auto mb-4">
                    <?php
                    if (!empty($loginErr)) {
                        echo "<div class='alert alert-danger'>" . $loginErr . "</div>";
                    } ?>
                    <form action="login.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label for="username" class="form-label">Kullanıcı Adı</label>
                            <input type="text" class="form-control" id="username" name="username">
                            <div class="text-danger"><?php echo $usernameErr  ?></div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="text-danger"><?php echo $passwordErr  ?></div>

                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary" name="login">Giriş</button>
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