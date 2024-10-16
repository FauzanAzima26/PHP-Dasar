<?php
$title = 'Dashboard';

// require 'layout/header.php'; or
include 'layout/header.php';

if (!isset($_SESSION['submit'])) {
  echo "<script>alert('Anda harus login terlebih dahulu'); document.location.href = 'login.php';</script>";
  exit;
}
?>

<!-- main -->
<main class="p-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header">
            <i class="bi bi-house"></i>
            <?= $title ?>
          </div>
          <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt velit commodi tempore consectetur neque recusandae eius ab voluptatem ratione deleniti beatae enim, amet earum, reiciendis eaque maiores sunt minima reprehenderit.
          </div>

          <div class="card-footer">
            Footer
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
</main>

<?php
require 'layout/footer.php';
?>