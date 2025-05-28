<?php
include('db_connect.inc');

$username = $_POST['username'];
$password = sha1($_POST['password']); // Hashed for security

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);

if ($stmt->rowCount() > 0) {
    header("Location: register.php?msg=exists");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

header("Location: login.php?msg=registered");
exit;
?>
