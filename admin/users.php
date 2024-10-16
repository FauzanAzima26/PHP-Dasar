<?php
$title = 'Users';

include 'layout/header-categories.php';

if (!isset($_SESSION['submit'])) {
  echo "<script>alert('Silahkan login terlebih dahulu'); document.location.href='login.php';</script>";
  exit;
}

$users = query("SELECT * FROM users ORDER BY created_at DESC");

$id_user = (int)$_SESSION['id_user'];
$getDataById = query("SELECT * FROM users WHERE id_user = $id_user");  

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
              <?php if($_SESSION['role'] == 'admin') : ?>
                <a class="btn btn-sm btn-success mb-1 ms-3" href="users-add.php" title="Add"><i class="bi bi-plus-circle"></i> Add</a>
              <?php endif ?>
              <table id="example" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created at</th>
                    <th width="20%">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1 ?>
                  <?php if($_SESSION['role'] == 'admin') : ?>
                  <?php foreach ($users as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['role'] ?></td>
                      <td><?= $row['created_at'] ?></td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-primary mb-1" href="users-edit.php?id=<?= $row['id_user'] ?>" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        <a class="btn btn-sm btn-danger mb-1" href="users-delete.php?id=<?= $row['id_user'] ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <?php else : ?>
                    <?php foreach ($getDataById as $row) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['role'] ?></td>
                      <td><?= $row['created_at'] ?></td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-primary mb-1" href="users-edit.php?id=<?= $row['id_user'] ?>" title="Edit"><i class="bi bi-pencil-square"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                  <?php endif ?>
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