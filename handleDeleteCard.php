<?php
if (!$_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$contactId = $_POST['id'];

require_once "conn.php";

$stmt = $baglanti->prepare('SELECT image_path FROM contacts WHERE contact_id = ?');
$stmt->bind_param('i', $contactId);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (file_exists($result["image_path"]) && $result["image_path"] != "uploads/defaultProfilePhoto.jpg") {
    unlink($result["image_path"]);
}

$stmt = $baglanti->prepare('DELETE FROM contacts WHERE contact_id = ?');
$stmt->bind_param('i', $contactId);
$result = $stmt->execute();
$stmt->close();
$baglanti->close();

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete contact.']);
}
