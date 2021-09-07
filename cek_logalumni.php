<?php
session_start();
include "../config/database.php";

$nama = $_POST['nama'];
$tgl_lahir = $_POST['tgl_lahir'];

$sql = "select * from tbl_alumni where nama='".$nama."' and tgl_lahir='".$tgl_lahir."' limit 1";
    $hasil = mysqli_query ($kon,$sql);
    $jumlah = mysqli_num_rows($hasil);
    $row = mysqli_fetch_assoc($hasil);

    if($jumlah > 0){
        $_SESSION['nis'] = $row['nis'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['jurusan'] = $row['jurusan'];
        $_SESSION['tgl_lahir'] = $row['tgl_lahir'];
        $_SESSION['thn_lulus'] = $row['thn_lulus'];
        header("Location:alumni/index.php");
    } else {
        header("location:login.php?pesan=gagal");
    }
?>