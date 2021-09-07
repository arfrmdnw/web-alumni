<?php
error_reporting(1);
// include database
include 'config/database.php';
?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cari Alumni</title>
    <link href="alumni/assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="img/alumni.png" rel="shortcut icon" type="image/jpg">

</head>
<style type="text/css">
    body{
    background-image: url(img/cool-background.svg);
    background-repeat: no-repeat;
     background-size: 100% 100%;
}
</style>
<body class="h-100">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center"  href="./"> <center><img src="img/alumni.png"></center> <h4 style="color: #2c3e50">.:CARI DATA ALUMNI:.</h4> </a>
                                <?php
                                if(isset($_GET['pesan'])){
                                    if($_GET['pesan'] == "gagal"){
                                    echo "<div class='alert alert-danger'> Username dan password salah.</div>";
                                    }else if($_GET['pesan'] == "logout"){
                                    echo "<div class='alert alert-warning'> Anda telah berhasil logout</div>";
                                    }else if($_GET['pesan'] == "belum_login"){
                                    echo "<div class='alert alert-danger'> Anda Harus Login dulu!! </div>";
                                    }else if($_GET['pesan'] == "pengguna"){
                                    echo "<div class='alert alert-warning'> Tidak ada data pengguna.</div>";
                                    }
                                }
                                ?>
                                <form class="mt-5 mb-5 login-input" action="cek_logalumni.php" method="POST">
                                    <?php
                                     $show = mysqli_query($kon, "SELECT * FROM `tbl_alumni`") or die(mysqli_error($kon));
                                    ?>
                                    <div class="form-group">
                                        <select name="nama_alumni" id="nama_alumni" class="form-control js-example-basic-single">
                                            <option>- Cari Nama Alumni -</option>
                                            <?php while($a = mysqli_fetch_array($show)){ ?>
                                            <option value="<?php echo $a['nis'] ?>"> <?php echo $a['nama'] ?> </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <hr>
                                </form>
                                <div id="nis"></div>



                                  <!--  <button type="button" id="nis" name="search" value="search" class="btn btn-sm login-form__btn submit w-100" data-toggle="modal" data-target="#basicModal">Cari Data</button> -->
                                <!-- Modal -->
                                <div class="modal fade" id="basicModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Alumni</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <?php
                                                if(isset($_POST['search'])) {
                                                    $nama_alumni = $_POST['nama_alumni'];
                                                    $thn_lulus_alumni = $_POST['thn_lulus_alumni'];
                                                    $result = mysqli_query($kon, "SELECT * FROM `tbl_alumni` WHERE `nama` LIKE '%".$nama_alumni."%' AND `thn_lulus` LIKE '%".$thn_lulus_alumni."%'") or die(mysqli_error($kon));
                                                    $jumlah = mysqli_fetch_row($result);
                                                    if ($jumlah){
                                                        ?>
                                                <div class="container-fluid">
                                                    <?php
                                                    while($a = mysqli_fetch_array($result))
                                                    {
                                                    ?>
                                                    <form action="cek_logalumni.php" method="POST">
                                                    <div class="form-group">
                                                        <label for="nalumni">Nama Alumni :</label>
                                                        <input type="text" name="nama" id="nalumni" class="form-control" value="<?php echo $a['nama'];?>"  disabled>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="djurusan">Jurusan :</label>
                                                            <input type="text" name="jurusan" id="djurusan" class="form-control" value="<?php echo $a['nama_jurusan'];?>"  disabled>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="dthnlulus">Tahun Lulus :</label>
                                                            <input type="text" name="thn_lulus" id="dthnlulus" class="form-control" value="<?php echo $a['thn_lulus'];?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password :</label>
                                                        <input type="password" name="tgl_lahir" class="form-control" placeholder="Gunakan Tanggal Lahir" required>
                                                    </div>
                                                </form>
                                                <?php
                                                    }
                                                ?>
                                                </div>
                                                <?php
                                                    }
                                                }else{
                                                    echo 'Data tidak ditemukan';
                                                }
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="alumni/assets/plugins/common/common.min.js"></script>
    <script src="alumni/assets/js/custom.min.js"></script>
    <script src="alumni/assets/js/settings.js"></script>
    <script src="alumni/assets/js/gleek.js"></script>
    <script src="alumni/assets/js/styleSwitcher.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

$(document).ready(function(){
 //saat pilihan provinsi di pilih, maka akan mengambil data kota
 //di data-wilayah.php menggunakan ajax
 $("#nama_alumni").change(function(){
                var id = $(this).val();
                var data = "nama_alumni="+id+"&data=nis";
                $.ajax({
                    type: 'POST',
                    url: "search.php",
                    data: data,
                    success: function(hasil) {
                        $("#nis").html(hasil);
                    }
                    });
                });
             });

    </script>
</body>
</html>




