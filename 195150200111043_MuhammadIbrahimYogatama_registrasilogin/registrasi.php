<?php
    require 'functions.php';

    if (isset($_POST["register"])) {
        
        if (registrasi($_POST) > 0) {
            echo "<script>
                    alert('user baru berhasil ditambahkan!'); 
                    document.location.href = 'login.php';
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Registrasi</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <style>
            label {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="container">

            <h1 class="text-center">Halaman Registrasi</h1>

            <!--Awal Card Form-->
            <div class="card mt-3">
                <div class="card-header">
                    Input Registrasi Admin
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
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password2" id="password2" required>
                        </div>
                        <div class="form-group">
                            Sudah punya akun? <a href="login.php">Masuk</a>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" name="register">Daftar</button>
                        
                    </form>
                </div>
            </div>
            <!--Akhir Card Form-->
            
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
