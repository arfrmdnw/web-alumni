<?php
include '../../config/database.php';

if (isset($_POST['submit'])) {
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO tbl_jurusan VALUES('$id_jurusan' , '$nama_jurusan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=list_jurusan&tambah=berhasil");
    }
    else{
        header("Location:../index.php?halaman=list_jurusan&tambah=gagal");
    }
}
elseif ($_GET['halaman'] == 'deletejurusan'){
    $id_jurusan = $_GET['id_jurusan'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM tbl_jurusan WHERE id_jurusan = '$id_jurusan'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=list_jurusan&hapus=berhasil");
    }
    else{
        header("Location:../index.php?halaman=list_jurusan&hapus=gagal");
    }
    mysqli_close($kon);
}
?>