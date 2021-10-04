<?php
    session_start();

    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    //Tambah Data
    //ambil data dari table mahasiswa / query data mahasiswa
    $mahasiswa = query("SELECT * FROM mahasiswa");

    //cek apakah tombol submit sudah ditekan atau belum
    if (isset($_POST["submit"])) {
        
        //cek apakah data berhasil ditambahkan atau tidak
        if (tambah($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil disimpan!');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('data gagal disimpan!');
                document.location.href = 'index.php';
            </script>
            ";
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tugas Pemrograman Web CRUD</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <h1 class="text-center">Tugas Pemrograman Web</h1>
            <h2 class="text-center">CRUD</h2>

            <a href="logout.php" class="btn btn-danger">Logout</a>

            <!-- Awal Card Form -->
            <div class="card mt-3">
                <div class="card-header">
                    Input Data Mahasiswa
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM Anda" id="nim" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="fakultas">Fakultas</label>
                            <input type="text" name="fakultas" class="form-control" placeholder="Masukkan Fakultas Anda" id="fakultas" required>
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan Anda" id="jurusan" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Anda" id="alamat" required>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select name="agama" class="form-control" placeholder="Masukkan Agama Anda" id="agama" required>
                                <option></option>
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

            <!-- Awal Card Table -->
            <div class="card mt-3">
                <div class="card-header">
                    Daftar Mahasiswa
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>NO</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Jurusan</th>
                            <th>Alamat</th>
                            <th>Agama</th>
                            <th>Aksi</th>
                        </tr>
                        
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa as $row) : ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row["nim"]; ?></td>
                            <td><?php echo $row["nama"]; ?></td>
                            <td><?php echo $row["fakultas"]; ?></td>
                            <td><?php echo $row["jurusan"]; ?></td>
                            <td><?php echo $row["alamat"]; ?></td>
                            <td><?php echo $row["agama"]; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger" onclick="return confirm('yakin hapus?');">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        <?php endforeach ?>
                    
                    </table>
                </div>
            </div>
            <!-- Akhir Card Table -->
        
        </div>

        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </body>
</html>
