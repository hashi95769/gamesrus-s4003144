<?php
session_start();
include("includes/db_connect.inc");
include("includes/header.inc");
include("includes/nav.inc");

// Protect page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-5 text-danger'>Invalid game ID.</div>";
    include("includes/footer.inc");
    exit();
}

$id = intval($_GET['id']);

// Fetch game data
$stmt = $conn->prepare("SELECT * FROM games WHERE gameid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();

if (!$game) {
    echo "<div class='container mt-5 text-danger'>Game not found.</div>";
    include("includes/footer.inc");
    exit();
}
?>

<div class="container mt-5 mb-5">
  <h2 class="text-center text-danger mb-4">Edit game</h2>

  <form action="edit_process.php" method="post" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
    <input type="hidden" name="id" value="<?= $game['gameid'] ?>">
    <input type="hidden" name="old_image" value="<?= $game['image'] ?>">

    <div class="mb-3">
      <label class="form-label">Game Name *</label>
      <input type="text" name="gamename" required class="form-control" value="<?= htmlspecialchars($game['gamename']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Type *</label>
      <input type="text" name="type" required class="form-control" value="<?= htmlspecialchars($game['type']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Description *</label>
      <textarea name="description" required class="form-control"><?= htmlspecialchars($game['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Select new image (optional)</label>
      <input type="file" name="image" class="form-control">
      <small>Current image: <?= basename($game['image']) ?></small>
    </div>

    <div class="mb-3">
      <label class="form-label">Image Caption *</label>
      <input type="text" name="caption" required class="form-control" value="<?= htmlspecialchars($game['caption']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Price *</label>
      <input type="number" step="0.01" name="price" required class="form-control" value="<?= $game['price'] ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Platform *</label>
      <input type="text" name="platform" required class="form-control" value="<?= htmlspecialchars($game['platform']) ?>">
    </div>

    <button type="submit" class="btn btn-primary">✔️ Submit</button>
    <button type="reset" class="btn btn-outline-danger">❌ Clear</button>
  </form>
</div>

<?php include("includes/footer.inc"); ?>
