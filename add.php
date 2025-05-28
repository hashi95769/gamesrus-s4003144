<?php
include("includes/db_connect.inc");
include("includes/header.inc");
include("includes/nav.inc");
session_start();

// Protect this page – only logged-in users can access
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5 mb-5">
  <h2 class="text-center text-danger mb-4">Add a game</h2>
  <p class="text-center">You can add a new game here</p>
  
  <form action="add_process.php" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">

    <div class="mb-3">
      <label class="form-label">Game Name *</label>
      <input type="text" name="gamename" required class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Type *</label>
      <input type="text" name="type" required class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Description *</label>
      <textarea name="description" required class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Select an image *</label>
      <input type="file" name="image" required class="form-control">
      <small class="form-text text-muted">Max image size: 500px</small>
    </div>

    <div class="mb-3">
      <label class="form-label">Image Caption *</label>
      <input type="text" name="caption" required class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Price *</label>
      <input type="number" step="0.01" name="price" required class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Platform *</label>
      <input type="text" name="platform" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">🎮 Submit</button>
    <button type="reset" class="btn btn-outline-danger">❌ Clear</button>
  </form>
</div>

<?php include("includes/footer.inc"); ?>
