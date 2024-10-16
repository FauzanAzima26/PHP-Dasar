<?php
$title = 'Users Add';

// require 'layout/header.php'; or
include 'layout/header-categories.php';

// if (!isset($_SESSION['username'])) {
//     echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
//     exit;
// }

if (isset($_POST['submit'])) {
    if (add_users($_POST) > 0) {
        echo "<script>alert ('Data berhasil disimpan')
    document.location.href = 'users.php'</script>";
    } else {
        echo "<script>alert ('Data gagal disimpan')
    document.location.href = 'users.php'</script>";
    }
}
?>

<!-- main -->
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
                            <div class="mb3">
                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="title">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" require>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="mb-5 col-md-12">
                                        <label class="form-label" for="role">Pilih role</label>
                                        <select name="role" id="role" class="form-select" required>
                                            <option value="" hidden>-- Select --</option>
                                            <option value="admin">Administrator</option>
                                            <option value="operator">Operator</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="slug">Password</label>
                                        <input type="text" class="form-control" name="password" id="password" required>
                                    </div>
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-upload"></i> Submit</button>
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
require 'layout/footer.php';
?>