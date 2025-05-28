<?php include('header.inc'); ?>
<h2 class="text-center mb-4">Register</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'exists'): ?>
  <div class="alert alert-danger">Username already exists.</div>
<?php endif; ?>

<form action="register_process.php" method="POST" class="mx-auto" style="max-width:500px;">
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-pink w-100">Register</button>
</form>
<?php include('footer.inc'); ?>
