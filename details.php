<?php
include("includes/db_connect.inc");
include("includes/header.inc");
include("includes/nav.inc");
session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container mt-5 text-danger'>Invalid game ID.</div>";
    include("includes/footer.inc");
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM games WHERE gameid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo "<div class='container mt-5 text-danger'>Game not found.</div>";
    include("includes/footer.inc");
    exit();
}

$game = $result->fetch_assoc();
?>

<div class="container mt-5">
  <div class="text-center">
    <img src="<?= htmlspecialchars($game['image']) ?>" class="img-fluid mb-3" style="max-height: 400px;" alt="Game Image">
    <h2 class="text-danger"><?= htmlspecialchars($game['gamename']) ?></h2>
    <p><strong><?= htmlspecialchars($game['type']) ?></strong></p>
    <p><strong><?= htmlspecialchars($game['platform']) ?></strong></p>
    <p><strong>$<?= number_format($game['price'], 2) ?></strong></p>
    <p><?= nl2br(htmlspecialchars($game['description'])) ?></p>

    <?php if (isset($_SESSION['username'])): ?>
      <a href="edit.php?id=<?= $game['gameid'] ?>" class="btn btn-primary">Edit</a>
      <a href="delete.php?id=<?= $game['gameid'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this game?');">Delete</a>
    <?php endif; ?>
  </div>
</div>

<?php include("includes/footer.inc"); ?>
