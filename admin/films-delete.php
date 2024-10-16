<?php
require "config/app.php";   

$id_film = (int)$_GET['id'];

$row = query("SELECT * FROM films WHERE id_film = $id_film")[0];

if(!$row){
    echo "<script>
    alert ('film tidak ditemukan')
    document.location.href = 'films.php'
    </script>";
}

if (delete_film($id_film) > 0) {
    echo "<script>alert ('Data dihapus')
    document.location.href = 'films.php'</script>";
} else {
    echo "<script>alert ('Data gagal dihapus')
    document.location.href = 'films.php'</script>";
}
?>