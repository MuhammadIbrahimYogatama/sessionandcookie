<?php
    //koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "basicphp");

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data) {
        global $conn;
        //ambil data dari tiap elemen dalam form
        $nama = htmlspecialchars($data["nama"]);
        $nim = htmlspecialchars($data["nim"]);
        $fakultas = htmlspecialchars($data["fakultas"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $agama = htmlspecialchars($data["agama"]);

        //query insert data
        $query = "INSERT INTO mahasiswa
                    VALUES
                    ('', '$nama', '$nim', '$fakultas', '$jurusan', '$alamat', '$agama')
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

        return mysqli_affected_rows($conn);
    }

    function ubah($data){
        global $conn;

        //ambil data dari tiap elemen dalam form
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $nim = htmlspecialchars($data["nim"]);
        $fakultas = htmlspecialchars($data["fakultas"]);
        $jurusan = htmlspecialchars($data["jurusan"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $agama = htmlspecialchars($data["agama"]);

        //query insert data
        $query = "UPDATE mahasiswa SET
                    nama = '$nama',
                    nim = '$nim',
                    fakultas = '$fakultas',
                    jurusan = '$jurusan',
                    alamat = '$alamat',
                    agama = '$agama'
                  
                WHERE id = $id
                ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function registrasi($data){
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        //cek username udah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "<script>
                    alert('username sudah terdaftar!')
                </script>";
            return false;
        }

        //cek konfirmasi password
        if ($password !== $password2) {
            echo "<script>
                    alert('konfirmasi password tidak sesuai!');
                </script>";
            return false;
        }

        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO user VALUES
                        ('', '$username', '$password')
                    ");

        return mysqli_affected_rows($conn);

    }
    
?>
