<?php
    session_start();

    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }
    
    require 'functions.php';

    //ambil data di URL
    $id = $_GET["id"];

    //query data mahasiswa berdasarkan id
    $mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

    //cek apakah tombol submit sudah ditekan atau belum
   
    if (isset($_POST["submit"])) {
        
        //cek apakah data berhasil diubah atau tidak
        if (ubah($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal diubah!');
                document.location.href = 'index.php';
            </script>
            ";
        }

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Data CRUD</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <h1 class="text-center">Tugas Pemrograman Web</h1>
            <h2 class="text-center">Edit Data</h2>

            <!-- Awal Card Form -->
            <div class="card mt-3">
                <div class="card-header">
                    Input Data Mahasiswa
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">

                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda" id="nim" required
                            value="<?php echo $mhs["nim"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" id="nama" required
                            value="<?php echo $mhs["nama"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="fakultas">Fakultas</label>
                            <input type="text" name="fakultas" class="form-control" placeholder="Masukkan Fakultas Anda" id="fakultas" required
                            value="<?php echo $mhs["fakultas"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan Anda" id="jurusan" required
                            value="<?php echo $mhs["jurusan"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Anda" id="alamat" required value="<?php echo $mhs["alamat"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" class="form-control" placeholder="Masukkan Agama Anda" id="agama" required>
                                <option value="<?php echo $mhs["agama"]; ?>"><?php echo $mhs["agama"]; ?></option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghuchu">Konghuchu</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" name="submit">Simpan</button>
                        <button type="reset" class="btn btn-danger" name="reset">Reset</button>

                    </form>
                </div>
            </div>
            <!-- Akhir Card Form -->
        
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
