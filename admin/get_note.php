<?php
session_start();
include 'config.php';

$admin = $_SESSION['admin'] ?? 'ProjectAdmin';

$stmt = $conn->prepare("SELECT note FROM admin_notes WHERE admin_username = ?");
$stmt->bind_param("s", $admin);
$stmt->execute();
$stmt->bind_result($note);
$stmt->fetch();

echo $note ?: '';
$stmt->close();
$conn->close();
?>
