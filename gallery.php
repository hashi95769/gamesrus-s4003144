<?php
include("includes/db_connect.inc");
include("includes/header.inc");
include("includes/nav.inc");
session_start();

// Get selected type (if any)
$typeFilter = isset($_GET['type']) ? $_GET['type'] : '';

// Get all unique types for dropdown
$typeQuery = $conn->query("SELECT DISTINCT type FROM games");
$types = [];
while ($row = $typeQuery->fetch_assoc()) {
    $types[] = $row['type'];
}

// Prepare main query
if ($typeFilter && $typeFilter != "All") {
    $stmt = $conn->prepare("SELECT * FROM games WHERE type = ?");
    $stmt->bind_param("s", $typeFilter);
} else {
    $stmt = $conn->prepare("SELECT * FROM games");
}
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
  <h2 class="text-center text-danger mb-4">GamesRUs has a lot to offer!</h2>

  <!-- Filter Dropdown -->
  <form method="GET" class="mb-4 text-center">
    <label for="type" class="form-label fw-bold">Select type...</label>
    <select name="type" id="type" class="form-select w-50 mx-auto" onchange="this.form.submit()">
      <option value="All">All</option>
      <?php foreach ($types as $type): ?>
        <option value="<?= htmlspecialchars($type) ?>" <?= $type == $typeFilter ? 'selected' : '' ?>>
          <?= htmlspecialchars($type) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>

  <!-- Game Grid -->
  <div class="row">
    <?php while ($game = $result->fetch_assoc()): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?= htmlspecialchars($game['image']) ?>" class="card-img-top" style="height: 300px; object-fit: cover;" alt="Game Image">
          <div class="card-body text-center">
            <h5 class="card-title">
              <a href="details.php?id=<?= $game['gameid'] ?>" class="text-decoration-none text-danger fw-bold">
                <?= htmlspecialchars($game['gamename']) ?>
              </a>
            </h5>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<?php include("includes/footer.inc"); ?>
