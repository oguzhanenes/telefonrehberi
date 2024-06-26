<?php

session_start();
if (empty($_SESSION["loggedIn"])) {
    header("location:login.html");
    exit();
}

require_once "conn.php";

$sql = "SELECT * FROM contacts WHERE user_id = ? ORDER BY name, surname";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();

$result = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <script src="js/contact.js" defer></script>
    <title>Telefon Rehberi</title>
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

    <div class="content d-flex flex-column align-items-center gap-4 flex-grow-1 py-5">
        <h3 class="w-50">Kişiler</h3>
        <div class="contacts-holder d-flex flex-column w-50">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="contact-card" data-id="' . $row["contact_id"] . '" data-group="' . $row["group_id"] . '">
                        <img src="' . $row["image_path"] . '" alt="profile-photo">
                        <div class="contact-info">
                            <div>
                                <span class="first-name"><strong>' . $row["name"] . '</strong></span>
                                <span class="last-name"><strong>' . $row["surname"] . '</strong></span>
                            </div>
                            <span class="phone">' . $row["phone"] . '</span>
                        </div>
                        <!--<div class="group-tag-holder">
                            <span>İş</span>
                        </div>-->
                        <div class="buttons">
                            <button class="delete-button"><img src="img/trash.svg"></button>
                        </div>
                  </div>';
                }
            }
            ?>
        </div>
    </div>

    <footer class="py-1 bg-dark text-white mt-auto">
        <div class="container text-center">
            <span>Bütün Hakları Saklıdır. @2024</span>
        </div>
    </footer>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>