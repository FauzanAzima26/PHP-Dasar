<?php
$title = 'Categories';

// require 'layout/header.php'; or
include 'layout/header-categories.php';

if (!isset($_SESSION['username'])) {
  echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
  exit;
}

$tampil = query("SELECT * FROM categories ORDER BY created_at DESC");

// debugging:
// print_r($tampil);

?>

<!-- main -->
<main class="p-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">

          <div class="card-header">
            <i class="bi bi-list-columns"></i>
            <?= $title ?>
          </div>

          <div class="card-body">
            <div class="table-responsive">
            <a class="btn btn-sm btn-success mb-1 ms-3" href="categories-download.php" title="Add"><i class="bi bi-plus-download"></i> Download</a>
              <a class="btn btn-sm btn-success mb-1 ms-3" href="categories-add.php" title="Add"><i class="bi bi-plus-circle"></i> Add</a>
              <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Created at></th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1 ?>
                  <?php foreach ($tampil as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['title'] ?></td>
                      <td><?= $row['slug'] ?></td>
                      <td><?= $row['created_at'] ?></td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-primary mb-1" href="categories-edit.php?id=<?= $row['id_categories'] ?>" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-sm btn-danger mb-1" href="categories-delete.php?id=<?= $row['id_categories'] ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- <div class="card-footer">
            Footer
          </div> -->

        </div>
      </div>
    </div>
  </div>
</main>

<?php
require 'layout/footer-categories.php';
?>