<?php
session_start();
include 'config.php'; // DATABSE DINE

$admin = $_SESSION['admin'] ?? 'ProjectAdmin'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['note'] ?? '');

    $stmt = $conn->prepare("SELECT id FROM admin_notes WHERE admin_username = ?");
    $stmt->bind_param("s", $admin);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $stmt = $conn->prepare("UPDATE admin_notes SET note = ? WHERE admin_username = ?");
        $stmt->bind_param("ss", $note, $admin);
    } else {
        // insert new note
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO admin_notes (note, admin_username) VALUES (?, ?)");
        $stmt->bind_param("ss", $note, $admin);
    }

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
