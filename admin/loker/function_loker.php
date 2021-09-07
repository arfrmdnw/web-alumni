<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/database.php';


if (isset($_POST['submit'])) {
    // membuat variabel untuk menampung data dari form
    $id_loker   = $_POST['id_loker'];
    $judul = $_POST['judul'];
    $tgl_dibuat = $_POST['tgl_dibuat'];
    $tgl_bataswaktu = $_POST['tgl_bataswaktu'];
    $instansi = $_POST['instansi'];
    $isi = $_POST['isi'];
    $link_web = $_POST['link_web'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $filename = $_FILES['gambar']['name'];
    $ukuran = $_FILES['gambar']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) {
        header("Location:../index.php?halaman=list_loker&tambah=format");
    }else{
        $dgambar = $rand.'_'.$filename;
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'gambar/'.$rand.'_'.$filename);
        mysqli_query($kon, "INSERT INTO tbl_loker VALUES('$id_loker','$judul','$tgl_dibuat','$tgl_bataswaktu','$instansi','$isi','$link_web','$dgambar')");
        header("Location:../index.php?halaman=list_loker&tambah=berhasil");
    }

} elseif (isset($_POST['update_loker'])){
    // membuat variabel untuk menampung data dari form
    $id_loker   = $_POST['id_loker'];
    $judul = $_POST['judul'];
    $tgl_dibuat = $_POST['tgl_dibuat'];
    $tgl_bataswaktu = $_POST['tgl_bataswaktu'];
    $instansi = $_POST['instansi'];
    $isi = $_POST['isi'];
    $link_web = $_POST['link_web'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $gambar_baru = $_FILES['gambar_baru']['name'];
    $ukuran = $_FILES['gambar_baru']['size'];
    $ext = pathinfo($gambar_baru, PATHINFO_EXTENSION);

    if (!empty($gambar_baru)){
        if(!in_array($ext,$ekstensi) ) {
            header("Location:../index.php?halaman=list_loker&tambah=format");
        } else {
            if($ukuran < 1044070){
                $dgambar = $rand.'_'.$gambar_baru;
                move_uploaded_file($_FILES['gambar_baru']['tmp_name'], 'gambar/'.$rand.'_'.$gambar_baru);
                $data = "UPDATE tbl_loker SET judul='$judul', tgl_dibuat ='$tgl_dibuat', tgl_bataswaktu='$tgl_bataswaktu', instansi='$instansi',
                isi='$isi', link_web='$link_web', gambar='$dgambar' WHERE id_loker = '$id_loker'";
                echo "ERROR, data gagal dihapus". mysqli_error($kon);
            }else{
                header("Location:../index.php?halaman=list_alumni&tambah=gagal_ukuran");
                echo "ERROR, data gagal dihapus". mysqli_error($kon);
            }
        }
    } else {
        $data = "UPDATE tbl_loker SET judul='$judul', tgl_dibuat ='$tgl_dibuat', tgl_bataswaktu='$tgl_bataswaktu', instansi='$instansi',
        isi='$isi', link_web='$link_web' WHERE id_loker = '$id_loker'";
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    }

    $edit_loker=mysqli_query($kon,$data);

    if ($edit_loker) {
        header("Location:../index.php?halaman=list_loker&ubah=berhasil");
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    } else {
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    }

} elseif ($_GET['halaman'] == 'deleteloker'){
    $id_loker = $_GET['id_loker'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM tbl_loker WHERE id_loker = '$id_loker'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=list_loker&hapus=berhasil");
    }
    else{
        header("Location:../index.php?halaman=list_loker&hapus=gagal");
    }
    mysqli_close($kon);
}
?>