<?php
include '../../config/database.php';

if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notlpn = $_POST['notlpn'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $status = $_POST['status'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO tbl_user VALUES('$id_user' , '$nama' , '$alamat' , '$notlpn' , '$username' , '$password' , '$status')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=list_admin&tambah=berhasil");
    }
    else{
        header("Location:../index.php?halaman=list_admin&tambah=gagal");
    }
} elseif(isset($_POST['update_admin'])){
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notlpn = $_POST['notlpn'];
    $username = $_POST['username'];
    $status = $_POST['status'];

    $ambil_password = mysqli_query($kon,"SELECT password FROM tbl_user WHERE id_user = '$id_user' limit 1");
    $data = mysqli_fetch_array($ambil_password);

    if ($data['password']==$_POST["password"]){
        $password = $_POST["password"];
    } else {
        $password = md5($_POST["password"]);
    }

    //Query input menginput data kedalam tabel anggota
    $dataupdate = "UPDATE tbl_user set nama='$nama', alamat='$alamat', notlpn='$notlpn', username='$username', password='$password', status='$status' where id_user = '$id_user'";

    //Mengeksekusi/menjalankan query
    $hasil=mysqli_query($kon, $dataupdate);

    if ($hasil) {
        header("Location:../index.php?halaman=list_admin&tambah=berhasil");
    }
    else{
        header("Location:../index.php?halaman=list_admin&tambah=gagal");
    }
} elseif ($_GET['halaman'] == 'deleteadmin'){
    $id_user = $_GET['id_user'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM tbl_user WHERE id_user = '$id_user'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=list_admin&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=list_admin&hapus=gagal");
    }
    mysqli_close($kon);
}
?>