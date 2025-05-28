<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GamesRUs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand" href="index.php"><img src="img/icon.png" width="30"> GamesRUs</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item"><a class="nav-link" href="games.php">Games</a></li>
      <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
      <?php if (isset($_SESSION['username'])): ?>
        <li class="nav-item"><a class="nav-link" href="add.php">Add more</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
      <?php endif; ?>
    </ul>
    <form class="d-flex" method="GET" action="search.php">
      <input class="form-control me-2" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light" type="submit">🔍</button>
    </form>
  </div>
</nav>
<main class="container mt-4">
