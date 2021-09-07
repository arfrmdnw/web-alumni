<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/database.php';


if (isset($_POST['submit'])) {
    // membuat variabel untuk menampung data dari form
    $nis   = $_POST['nis'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jns_kelamin = $_POST['jns_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $notlpn = $_POST['notlpn'];
    $email = $_POST['email'];
    $nama_jurusan = $_POST['nama_jurusan'];
    $thn_lulus = $_POST['thn_lulus'];
    $status = $_POST['status'];
    $nama_instansi = $_POST['nama_instansi'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $filename = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) {
        header("Location:../index.php?halaman=list_alumni&tambah=format");
    }else{
        if($ukuran < 1044070){
            $dfoto = $rand.'_'.$filename;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$rand.'_'.$filename);
            mysqli_query($kon, "INSERT INTO tbl_alumni VALUES('$nis','$nama','$tempat_lahir','$tgl_lahir','$jns_kelamin','$agama','$alamat','$notlpn','$email','$nama_jurusan','$thn_lulus','$status','$nama_instansi','$dfoto')");
            header("Location:../index.php?halaman=list_alumni&tambah=berhasil");
        }else{
            header("Location:../index.php?halaman=list_alumni&tambah=gagal_ukuran");
        }
    }

} elseif (isset($_POST['update_alumni'])){
    // membuat variabel untuk menampung data dari form
    $nis   = $_POST['nis'];
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jns_kelamin = $_POST['jns_kelamin'];
    $agama = $_POST['agama'];
    $alamat = $_POST['alamat'];
    $notlpn = $_POST['notlpn'];
    $email = $_POST['email'];
    $nama_jurusan = $_POST['nama_jurusan'];
    $thn_lulus = $_POST['thn_lulus'];
    $status = $_POST['status'];
    $nama_instansi = $_POST['nama_instansi'];

    $rand = rand();
    $ekstensi =  array('png','jpg','jpeg');
    $foto_baru = $_FILES['foto_baru']['name'];
    $ukuran = $_FILES['foto_baru']['size'];
    $ext = pathinfo($foto_baru, PATHINFO_EXTENSION);

    if (!empty($foto_baru)){
        if(!in_array($ext,$ekstensi) ) {
            header("Location:../index.php?halaman=list_alumni&tambah=format");
        } else {
            if($ukuran < 1044070){
                $dfoto = $rand.'_'.$foto_baru;
                move_uploaded_file($_FILES['foto_baru']['tmp_name'], 'foto/'.$rand.'_'.$foto_baru);
                $data = "UPDATE tbl_alumni SET nama='$nama', tempat_lahir ='$tempat_lahir', tgl_lahir='$tgl_lahir', jns_kelamin='$jns_kelamin',
                agama='$agama', alamat='$alamat', notlpn='$notlpn', email='$email', nama_jurusan='$nama_jurusan', thn_lulus='$thn_lulus',
                status='$status', nama_instansi='$nama_instansi', foto='$dfoto' WHERE nis=$nis";
                echo "ERROR, data gagal dihapus". mysqli_error($kon);
            }else{
                header("Location:../index.php?halaman=list_alumni&tambah=gagal_ukuran");
                echo "ERROR, data gagal dihapus". mysqli_error($kon);
            }
        }
    } else {
        $data = "UPDATE tbl_alumni SET nama='$nama', tempat_lahir ='$tempat_lahir', tgl_lahir='$tgl_lahir', jns_kelamin='$jns_kelamin',
            agama='$agama', alamat='$alamat', notlpn='$notlpn', email='$email', nama_jurusan='$nama_jurusan', thn_lulus='$thn_lulus',
            status='$status', nama_instansi='$nama_instansi' WHERE nis=$nis";
                       echo "ERROR, data gagal dihapus". mysqli_error($kon);
    }

    $edit_alumni=mysqli_query($kon,$data);

    if ($edit_alumni) {
        header("Location:../index.php?halaman=list_alumni&ubah=berhasil");
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=list_alumni&ubah=gagal");
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    }

} elseif ($_GET['halaman'] == 'deletealumni'){
    $nis = $_GET['nis'];

    $sql="DELETE FROM tbl_alumni WHERE nis=$nis";
    $hapus_artikel=mysqli_query($kon,$sql);

    if ($hapus_artikel) {
        # redirect ke index.php
        header("Location:../index.php?halaman=list_alumni&hapus=berhasil");
    }
    else{
        echo "ERROR, data gagal dihapus". mysqli_error($kon);
    }

}
?>