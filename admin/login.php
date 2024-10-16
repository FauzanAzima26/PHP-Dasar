<?php

require 'config/app.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");

    //cek user
    if (mysqli_num_rows($result) == 1) {
        $hasil = mysqli_fetch_assoc($result);

        if (password_verify($password, $hasil['password'])) {

            $_SESSION['submit'] = true;
            $_SESSION['id_user'] = $hasil['id_user'];
            $_SESSION['username'] = $hasil['username'];
            $_SESSION['email'] = $hasil['email'];
            $_SESSION['role'] = $hasil['role'];

            header('Location: users.php');
            exit;
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login Form</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container col-4 bg-white p-5 rounded shadow">
        <form method="post">

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error:</strong> Email or password incorrect
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign in</button>

            <!-- <p class="mt-5 mb-3 text-body-secondary">Copyright &copy; <?= date('Y') ?></p> -->
        </form>
    </div>
</body>

</html>