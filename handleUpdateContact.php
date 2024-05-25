<?php

if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    header("location:contact.php");
    exit();
}

require_once "conn.php";

$contact_id = $_POST["contactId"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$phone = str_replace(" ", "", $_POST["phone"]);
$address = $_POST["address"];
$country = $_POST["country"];
$city = $_POST["city"];
$district = $_POST["district"];

$stmt = $baglanti->prepare("UPDATE contacts 
                            SET name = ?, surname = ?, phone = ?, email = ?, address = ?, country = ?, city = ?, district = ?
                            WHERE contact_id = ?");
$stmt->bind_param("ssssssssi", $name, $surname, $phone, $email, $address, $country, $city, $district, $contact_id);
$stmt->execute();
$baglanti->close();


header("location: contact.php");
