<?php
$title = 'Edit users';

require 'layout/header-categories.php';

// cek login
if (!isset($_SESSION['submit'])) {
    echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";
    exit;
}

// mengambil id_user dari url
$id_user = (int)$_GET['id'];

// mengambil data
$getDataById = query("SELECT * FROM users WHERE id_user = $id_user")[0];

// mengecek form submit
if (isset($_POST['submit'])) {
    if (update_users($_POST) > 0) {
        echo "<script>alert ('Data berhasil diubah')
      document.location.href = 'users.php'</script>";
    } else {
        echo "<script>alert ('Data gagal diubah')
      document.location.href = 'users.php'</script>";
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
                                <?php if ($_SESSION['role'] == 'admin') : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_user" value="<?= $getDataById['id_user'] ?>">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $getDataById['username'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $getDataById['email'] ?>" required>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="role">Role</label>
                                            <select name="role" id="role" class="form-select" required>
                                                <option value="" hidden>--Select--</option>
                                                <option value="admin">Admin</option>
                                                <option value="operator">Operator</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="float-end">
                                            <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Edit</button>
                                        </div>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_user" value="<?= $getDataById['id_user'] ?>">
                                        <div class="mb-3">
                                            <label for="title">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $getDataById['username'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $getDataById['email'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="float-end">
                                            <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Edit</button>
                                        </div>
                                    </form>
                                <?php endif ?>
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