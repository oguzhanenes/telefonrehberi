<?php
require_once "conn.php";

$sql = "SELECT * FROM contacts";
$result = $baglanti->query($sql);



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
                        <a href="#" class="nav-link">Kayıtlı Kişiler</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kişi İşlemleri
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="addcontact.php">Yeni Kişi Ekle</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="profile">
                    <span class="name">Ad Soyad</span>
                    <button class="exit-button">
                        <img src="img/box-arrow-right.svg">
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="content d-flex justify-content-center flex-grow-1 py-5">
        <div class="contacts-holder d-flex flex-column w-50 gap-2">
            <?php
            if ($result->num_rows > 0) {
                // output data of each row
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
                            <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editModal"><img src="img/pencil-square.svg"></button>
                            <button class="delete-button"><img src="img/trash.svg"></button>
                        </div>
                  </div>';
                }
            }
            ?>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Bilgileri Düzenle</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="updateContact.php" method="post">
                        <div class="mb-3">
                            <label for="firstNameInput" class="form-label">Ad</label>
                            <input type="text" class="form-control" id="firstNameInput" name="firstName">
                        </div>
                        <div class="mb-3">
                            <label for="lastNameInput" class="form-label">Soyad</label>
                            <input type="text" class="form-control" id="lastNameInput" name="lastName">
                        </div>
                        <div class="mb-3">
                            <label for="phoneInput" class="form-label">Numara</label>
                            <input type="tel" class="form-control" id="phoneInput" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="groupInput" class="form-label">Grup</label>
                            <select class="form-select" aria-label="Default select example" name="group" id="groupInput">
                                <option value="0">Yok</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>


    <footer class="py-2 bg-dark text-white mt-auto">
        <div class="container text-center">
            <span>Bütün Hakları Saklıdır. @2024</span>
        </div>
    </footer>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>