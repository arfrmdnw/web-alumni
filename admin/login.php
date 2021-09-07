
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title></title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
  <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet" />
  <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />

</head>

</head>
<style type="text/css">
    body{
    background-image: url(../img/cool-background.svg);
    background-repeat: no-repeat;
     background-size: 100% 100%;
}
</style>
  <body class="bg-light-gray" id="body">
      <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-body p-5">
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
              <h4 class="text-dark mb-4">Sign In</h4>
              <form method="POST" action="cek_login.php">
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username">
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign In</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>