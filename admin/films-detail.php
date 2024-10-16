<?php
$title = 'Detail Films';
require "layout/header-categories.php";

if (!isset($_SESSION['username'])) {
    echo "<script>alert ('Silahkan login terlebih dahulu'); document.location.href = 'login.php';</script>";    
    exit;
}

$id_film = (int)$_GET['id'];

$film = query("SELECT f.*, c.title AS category_title FROM films f JOIN categories c ON f.category_id = c.id_categories WHERE f.id_film = $id_film")[0];

if (!$film) {
    echo "<script>alert('Data not found'); document.location.href = 'films.php';</script>";
}

?>

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
                            <a class="btn btn-sm btn-success mb-1 ms-3" href="films-add.php" title="Add"><i class="bi bi-plus-circle"></i> Add</a>
                            <table id="example" class="table table-bordered table-striped" style="width:100%">
                                <tr>
                                    <th>Video</th>
                                    <td>
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $film['url']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td><?= $film['category_title'] ?></td>
                                </tr>

                                <tr>
                                    <th>Title</th>
                                    <td><?= $film['title'] ?></td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td><?= $film['slug'] ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><?= $film['description'] ?></td>
                                </tr>
                                <tr>
                                    <th>Release date</th>
                                    <td><?= $film['release_date'] ?></td>
                                </tr>
                                <tr>
                                    <th>Studio</th>
                                    <td><?= $film['studio'] ?></td>
                                </tr>
                                <tr>
                                    <th>Private</th>
                                    <td><?= $film['is_private'] ? 'Private' : 'Public' ?></td>
                                </tr>
                            </table>
                            <div class="float-end">
                                <a href="films.php" class="btn btn-secondary">Back</a>
                            </div>
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