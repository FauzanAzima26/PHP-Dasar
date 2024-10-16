<?php
$title = "Edit Film";
require 'layout/header-categories.php';

$tampil = query("SELECT * FROM categories ORDER BY created_at DESC");

$id_film = (int)$_GET['id'];

$row = query("SELECT * FROM films WHERE id_film = $id_film")[0];

if (!isset($_SESSION['username'])) {
  echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
  exit;
}

if (isset($_POST['submit'])) {
  if (edit_film($_POST) > 0) {
    echo "<script>alert('Data berhasil diedit'); document.location.href = 'films.php';</script>";
  } else {
    echo "<script>alert('Data gagal diedit'); document.location.href = 'films.php';</script>";
  }
}
?>
<main class="p-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">

          <div class="card-header">
            <i class="bi bi-plus-circle"></i>
            <?= $title ?>
          </div>

          <div class="card-body shadow-sm">
            <form action="" method="post">
              <input type="hidden" name="id_film" value="<?= $row['id_film'] ?>">
              <div class="mb-3">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?= $row['title'] ?>" required>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="<?= $row['slug'] ?>" readonly>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="description">Description</label>
                  <textarea rows="3" class="form-control" name="description" id="description" value="<?= $row['description'] ?>"></textarea>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="release_date">Release date</label>
                    <input type="date" class="form-control" name="release_date" id="release_date" value="<?= $row['release_date'] ?>" required>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="studio">Studio</label>
                    <input type="text" class="form-control" name="studio" id="studio" value="<?= $row['studio'] ?>" required>
                  </div>
                </div>
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="is_private">Private</label>
                    <select name="is_private" id="is_private" class="form-select" value="<?= $row['is_private'] ?>" required>
                      <option value="" hidden>--Select--</option>
                      <option value="0">Public</option>
                      <option value="1">Private</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="category_id">Category</label>
                    <select class="form-select" name="category_id" id="category_id" value="<?= $row['category_id'] ?>" required>
                      <option value="" hidden>--Select--</option>
                      <?php foreach ($tampil as $row) : ?>
                        <option value="<?= $row['id_categories'] ?>"><?= $row['title'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="float-end">
                  <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $('#title').on('input', function() {
      $('#slug').val(slugify($(this).val()));
    });
  });
</script>
<script src="assets/helper.js"></script>

<?php
require 'layout/footer.php';
?>