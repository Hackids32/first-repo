<?php
session_start();
?>
<script>
  // Delete first
  localStorage.clear();
</script>
<?php
session_destroy();
echo "<script>alert('Sampai jumpa lagi'); window.location = 'index.php'</script>";
?>