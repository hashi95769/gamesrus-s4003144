<?php
session_start();
include("includes/db_connect.inc");

// Validate session
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id         = intval($_POST['id']);
    $gamename   = trim($_POST['gamename']);
    $type       = trim($_POST['type']);
    $desc       = trim($_POST['description']);
    $caption    = trim($_POST['caption']);
    $price      = floatval($_POST['price']);
    $platform   = trim($_POST['platform']);
    $old_image  = $_POST['old_image'];
    $new_image  = $old_image;

    // Handle image upload if a new one is selected
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "userimages/";
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            $new_image = $target_file;
        } else {
            echo "Error uploading new image.";
            exit();
        }
    }

    // Update query
    $stmt = $conn->prepare("UPDATE games SET gamename=?, type=?, description=?, image=?, caption=?, price=?, platform=? WHERE gameid=?");
    $stmt->bind_param("sssssdsi", $gamename, $type, $desc, $new_image, $caption, $price, $platform, $id);

    if ($stmt->execute()) {
        header("Location: details.php?id=" . $id);
        exit();
    } else {
        echo "Update error: " . $stmt->error;
    }
}
?>
