<?php
$title = 'Films';

require "layout/header-categories.php";

// cek login
if (!isset($_SESSION['submit'])) {
    echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
    exit;
}

$films = query("SELECT f.id_film, f.title, f.studio, f.is_private, f.created_at, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_categories WHERE f.is_private = 0 ORDER BY f.created_at DESC");

?>

<main class="p-4">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm">

                    <div class="card-header">
                        <i class="bi bi-list-columns"></i>
                        <?= $title ?>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <a class="btn btn-sm btn-success mb-1 ms-3" href="films-add.php" title="Add"><i class="bi bi-plus-circle"></i> Add</a>
                            <a class="btn btn-sm btn-success mb-1 ms-3" href="films-download.php" title="Download"><i class="bi bi-plus-download"></i> Download</a>
                            <table id="example" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Name</th>
                                        <th>Studio</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1 ?>
                                    <?php foreach ($films as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['title'] ?></td>
                                            <td><?= $row['studio'] ?></td>
                                            <td><?= $row['category_title'] ?></td>
                                            <td><?= $row['is_private'] ? '<span class="badge bg-danger">Private</span>' : '<span class="badge bg-success">Public</span>'?></td>
                                            <td><?= $row['created_at'] ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-sm btn-primary mb-1" href="films-detail.php?id=<?= $row['id_film'] ?>" title="detail"><i class="bi bi-eye"></i></a>
                                                <a class="btn btn-sm btn-primary mb-1" href="films-edit.php?id=<?= $row['id_film'] ?>" title="Edit"><i class="bi bi-pencil-square"></i></a>
                                                <a class="btn btn-sm btn-danger mb-1" href="films-delete.php?id=<?= $row['id_film'] ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class="bi bi-trash"></i></a>
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