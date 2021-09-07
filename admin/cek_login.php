<?php
    // mengaktifkan session php
    session_start();

    // menghubungkan dengan koneksi
    include "../config/database.php";

    // menangkap data yang dikirim dari form
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    // menyeleksi data admin dengan username dan password yang sesuai
    $sql = "select * from tbl_user where username='".$user."' and password='".$pass."' limit 1";
    $hasil = mysqli_query ($kon,$sql);
    $jumlah = mysqli_num_rows($hasil);
    $row = mysqli_fetch_assoc($hasil);

    if($jumlah > 0){
            if ($row["status"]=='Admin'){
            $_SESSION["id_user"]=$row["id_user"];
            $_SESSION["nama"]=$row["nama"];
            $_SESSION["username"]=$row["username"];
            //Redirect ke halaman admin
            header("Location:index.php?halaman=dashboard");

        }else if ($row["status"]=='Kepala Sekolah'){
            $_SESSION["id_user"]=$row["id_user"];
            $_SESSION["nama"]=$row["nama"];
            $_SESSION["username"]=$row["username"];
            //Redirect ke halaman admin
            header("Location:index.php?halaman=dashboard");

        } else {
            header("location:login.php?pesan=pengguna");
        }
    }else {
        header("location:login.php?pesan=gagal");
    }
?>