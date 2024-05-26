<?php
// Kullanici giris yapmadiysa logiin sayfasına yönlendir.
session_start();
if (empty($_SESSION["loggedIn"])) {
    header("location:login.php");
    exit();
}

require_once "conn.php";
$id = $_GET["id"];

// URL'de Id yoksa contact sayfasına döndür
if (is_null($id)) header("location:contact.php");

$sql = "SELECT * FROM contacts WHERE contact_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Eger sonuc yoksa contact.php sayfasına dön
if (mysqli_num_rows($result) == 0) {
    header("location: contact.php");
    exit();
}

$result = $result->fetch_assoc();

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <?php echo "<title>" . $result['name'] . " " . $result['surname'] . "</title>"; ?>
</head>

<body class="h-100 d-flex flex-column">
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #003285;">
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
                        <a href="contact.php" class="nav-link">Kayıtlı Kişiler</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="addcontact.php" class="nav-link">Yeni Kişi Ekle</a>
                    </li>
                </ul>
                <div class="profile">
                    <span class="name"><?php echo $_SESSION["username"] ?></span>
                    <button class="exit-button">
                        <a href="logout.php"><img src="img/box-arrow-right.svg"></a>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="form d-flex flex-column gap-3 align-items-center col-lg-5 mx-auto mt-4 flex-grow-1">
        <?php
        if (!empty($_GET["message"])) {
            echo "<div class='alert alert-danger col-lg-12' role='alert'>" . $_GET['message'] . "</div>";
        }
        ?>
        <img src=<?php echo $result['image_path'] ?>>
        <form class="row g-3" action="handleUpdateContact.php" method="post" enctype="multipart/form-data">
            <div>
                <input type="hidden" class name="contactId" value=<?php echo $id; ?>>
            </div>
            <div class="col-12">
                <label for="name" class="form-label">İsim</label>
                <input type="text" class="form-control" id="name" name="name" value=<?php echo $result['name']; ?> required>
            </div>
            <div class="col-12">
                <label for="surname" class="form-label">Soyad</label>
                <input type="text" class="form-control" id="surname" name="surname" value=<?php echo $result['surname']; ?> required>
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">Telefon</label>
                <input type="tel" class="form-control" id="phone" name="phone" minlength="10" maxlength="10" pattern="[0-9]*" value=<?php echo $result['phone']; ?> required>
            </div>
            <div class="col-12">
                <label for="inputEmail" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="inputEmail" name="email" value=<?php echo $result['email']; ?>>
            </div>
            <div class="col-md-4">
                <label for="inputCountry" class="form-label">Ülke</label>
                <input type="text" class="form-control" id="inputCountry" name="country" value=<?php echo $result['country']; ?>>
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">İl</label>
                <input type="text" class="form-control" id="inputCity" name="city" value=<?php echo $result['city']; ?>>
            </div>
            <div class="col-md-4">
                <label for="inputDistrict" class="form-label">İlçe</label>
                <input type="text" class="form-control" id="inputDistrict" name="district" value=<?php echo $result['district']; ?>>
            </div>
            <div class="col-12">
                <label for="address" class="form-label">Adres</label>
                <input type="text" class="form-control" id="address" name="address" value=<?php echo $result['address']; ?>>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Yeni Fotoğraf</label>
                <input class="form-control" type="file" id="image" name="image" accept="image/*">
            </div>
            <div class="col-12">
                <button href="#" type="submit" class="btn btn-primary">Güncelle</button>
            </div>

        </form>
    </div>

    <footer class="py-1 mt-5 bg-dark text-white">
        <div class="container text-center">
            <span>Bütün Hakları Saklıdır. @2024</span>
        </div>
    </footer>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>