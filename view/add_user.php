<?php
require_once('model/pdo.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)");
    $stmt->execute([$email, $password, $firstname, $lastname]);

    header("Location: index.php?action=show_users");
    exit();
}
?>
