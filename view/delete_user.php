<?php
require_once('model/pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteUserID = $_POST['userID'];

    $stmt = $conn->prepare("DELETE FROM users WHERE userID = ?");
    $stmt->execute([$deleteUserID]);

    header("Location: index.php?action=show_users");
    exit();
}
?>
