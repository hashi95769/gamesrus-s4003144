<?php
include('db_connect.inc');
session_start();

$username = $_POST['username'];
$password = sha1($_POST['password']);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->execute([$username, $password]);

if ($stmt->rowCount() == 1) {
    $_SESSION['username'] = $username;
    header("Location: index.php?msg=login");
} else {
    header("Location: login.php?msg=invalid");
}
exit;
?>
