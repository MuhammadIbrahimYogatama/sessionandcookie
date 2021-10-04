<?php
    session_start();
    require 'functions.php';

    //cek cookie
    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        //ambil username berdasarkan id
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if ($key === hash('sha256', $row['username'])) {
            $_SESSION['login'] = true;
        }

    }

    if (isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_POST["login"])) {
        
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        //cek username
        if (mysqli_num_rows($result) === 1) {
            
            //cek password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                //set session
                $_SESSION["login"] = true;

                //cek remember me
                if (isset($_POST['remember'])) {
                    //buat cookie
                    setcookie('id', $row['id'], time() + 3600);
                    setcookie('key', hash('sha256', $row['username']), time() + 3600);
                }

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Halaman Login</h1>

            <?php if(isset($error)) : ?>
                <p style="color: red; font-style: italic;">username / password salah</p>
            <?php endif; ?>

            <!--Awal Card Form-->
            <div class="card mt-3">
                <div class="card-header">
                    Input Login Admin
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                        <div class="form-group">
                            Belum punya akun? <a href="registrasi.php">Daftar</a>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" name="login">Login</button>
                            
                    </form>
                </div>
            </div>
            <!-- Akhir Card Form -->
            
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
