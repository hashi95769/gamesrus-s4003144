<?php
session_start();
include("includes/db_connect.inc");

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gamename   = trim($_POST['gamename']);
    $type       = trim($_POST['type']);
    $description= trim($_POST['description']);
    $caption    = trim($_POST['caption']);
    $price      = floatval($_POST['price']);
    $platform   = trim($_POST['platform']);
    $username   = $_SESSION['username'];

    // Handle image upload
    $target_dir = "userimages/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . time() . "_" . $image_name;

    // Move uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO games (gamename, description, image, caption, price, platform, type, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdsss", $gamename, $description, $target_file, $caption, $price, $platform, $type, $username);

        if ($stmt->execute()) {
            header("Location: gallery.php?msg=GameAdded");
            exit();
        } else {
            echo "Database error: " . $stmt->error;
        }

    } else {
        echo "Error uploading image.";
    }

} else {
    header("Location: add.php");
    exit();
}
?>
