<?php
require "config/app.php";

// / mengambil id_user dari url
$id_user = (int)$_GET['id'];

// mengambil data
$getDataById = query("SELECT * FROM  users WHERE id_user = $id_user")[0];

if (!$getDataById) {
  echo "<script>
    alert ('categories tidak ditemukan')
    document.location.href = users.php
    </script>";
}

if (delete_users($id_user) > 0) {
  echo "<script>alert ('Data dihapus')
      document.location.href = 'users.php'</script>";
} else {
  echo "<script>alert ('Data gagal dihapus')
      document.location.href = 'users.php'</script>";
}
