<?php
require_once "../includes/db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT id FROM legal_info WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $deleteStmt = $conn->prepare("DELETE FROM legal_info WHERE id = ?");
        $deleteStmt->bind_param("i", $id);
        if ($deleteStmt->execute()) {
            header("Location: manage_legal.php?deleted=1");
            exit;
        } else {
            header("Location: manage_legal.php?error=delete_failed");
            exit;
        }

    } else {
        $stmt->close();
        header("Location: manage_legal.php?error=not_found");
        exit;
    }
} else {
    header("Location: manage_legal.php");
    exit;
}
