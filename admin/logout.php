<?php

require 'config/app.php';

if (!isset($_SESSION['submit'])) {
    echo "<script>
            alert('Silahkan login terlebih dahulu');
            document.location.href = 'login.php';
          </script>";
    exit;
}

$_SESSION = [];

session_unset();
session_destroy();
header("location: login.php");