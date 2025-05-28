<?php include('header.inc'); ?>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'login'): ?>
  <div class="alert alert-success">Login successful. Welcome back!</div>
<?php endif; ?>

<h1 class="text-center mt-5">Welcome to GamesRUs</h1>
<p class="text-center">This is your homepage. Use the nav bar to explore the site.</p>

<?php include('footer.inc'); ?>
