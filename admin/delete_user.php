<?php
require_once "../includes/db.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $check = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $check->close();

        $delete = $conn->prepare("DELETE FROM users WHERE id = ?");
        $delete->bind_param("i", $id);

        if ($delete->execute()) {
            header("Location: manage_users.php?deleted=1");
            exit;
        } else {
            header("Location: manage_users.php?error=delete_failed");
            exit;
        }
    } else {
        $check->close();
        header("Location: manage_users.php?error=user_not_found");
        exit;
    }
} else {
    header("Location: manage_users.php");
    exit;
}
