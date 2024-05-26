<?php

if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header("location: contact.php");
    exit();
}

require_once "conn.php";
// $user_id = $_SESSION["user_id"];
$user_id = 1;
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$phone = str_replace(" ", "", $_POST["phone"]);
$address = $_POST["address"];
$country = $_POST["country"];
$city = $_POST["city"];
$district = $_POST["district"];

// if (empty($name) || empty($surnmae) || empty($phone)) {
//     header("location:addcontact.php");
//     exit();
// }

if (!empty($_FILES["image"]["name"])) {
    $target_dir = "uploads/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $new_image_path = $target_dir . uniqid() . "." . $imageFileType;
    $uploadOk = 1;

    if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
        $uploadOk = 1;
    } else {
        $error = "File is not an image.";
        header("location:contact.php?message=$error");
        exit();
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        header("location:contact.php?message=$error");
        exit();
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $error = "Sorry, only JPG, JPEG & PNG files are allowed.";
        header("location:contact.php?message=$error");
        exit();
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
        header("location:contact.php?message=$error");
        exit();
    } else {

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_path)) {
            $error = "Sorry, there was an error uploading your file.";
            header("location:contact.php?message=$error");
            exit();
        }
    }
} else {
    $new_image_path = "uploads/defaultProfilePhoto.jpg";
}


$sql = "INSERT INTO contacts (user_id, name, surname, phone, email, address, city, district, country, image_path)
            VALUES ($user_id, '$name', '$surname', '$phone', '$email', '$address', '$city', '$district', '$country', '$new_image_path')";
$baglanti->query($sql);
$baglanti->close();
header("location: contact.php");
