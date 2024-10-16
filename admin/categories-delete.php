<?php
require "config/app.php";

$id_category = (int)$_GET['id'];

$getDataById = query("SELECT * FROM  categories WHERE id_categories = $id_category")[0];

if (!$getDataById) {
  echo "<script>
    alert ('categories tidak ditemukan')
    document.location.href = categories.php
    </script>";
}

if (delete_category($id_category) > 0) {
  echo "<script>alert ('Data dihapus')
      document.location.href = 'categories.php'</script>";
} else {
  echo "<script>alert ('Data gagal dihapus')
      document.location.href = 'categories.php'</script>";
}
