// Auto-dismiss success or error messages after 4 seconds
setTimeout(() => {
  const alert = document.querySelector(".alert");
  if (alert) alert.remove();
}, 4000);

// Confirmation before deleting a record
function confirmDelete(gameName) {
  return confirm(`Are you sure you want to delete "${gameName}"?`);
}
