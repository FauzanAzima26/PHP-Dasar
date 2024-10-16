<?php
$title = 'Edit Kategori';

require 'layout/header-categories.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
    exit;
}

$id_category = (int)$_GET['id'];

$getDataById = query("SELECT * FROM categories WHERE id_categories = $id_category")[0];

if (isset($_POST['submit'])) {
    if (update_category($_POST) > 0) {
        echo "<script>alert ('Data berhasil diubah')
      document.location.href = 'categories.php'</script>";
    } else {
        echo "<script>alert ('Data gagal diubah')
      document.location.href = 'categories.php'</script>";
    }
}
?>

<main class="p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">

                    <div class="card-header">
                        <i class="bi bi-pencil-square"></i>
                        <?= $title ?>
                    </div>

                    <div class="card-body shadow-sm">
                        <form action="" method="post">
                            <div class="mb3">
                                <form action="" method="post">
                                    <input type="hidden" name="id_categories" value="<?= $getDataById['id_categories'] ?>">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?= $getDataById['title'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" name="slug" id="slug" value="<?= $getDataById['title'] ?>" readonly>
                                    </div>
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Edit</button>
                                    </div>
                                </form>
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
        })
    });
</script>
<script src="assets/helper.js"></script>

<?php
require 'layout/footer-categories.php';
?>