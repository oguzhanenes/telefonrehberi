<?php

session_start();
if (empty($_SESSION["loggedIn"])) {
    header("location:index.html");
    exit();
}

if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$contactId = $_POST['id'];

require_once "conn.php";

$stmt = $conn->prepare('SELECT image_path FROM contacts WHERE contact_id = ?');
$stmt->bind_param('i', $contactId);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Kullanıcının fotoğrafı varsa sil
if (file_exists($result["image_path"]) && $result["image_path"] != "uploads/defaultProfilePhoto.jpg") {
    unlink($result["image_path"]);
}

$stmt = $conn->prepare('DELETE FROM contacts WHERE contact_id = ?');
$stmt->bind_param('i', $contactId);
$result = $stmt->execute();
$stmt->close();
$conn->close();

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete contact.']);
}
