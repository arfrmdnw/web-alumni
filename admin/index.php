<?php
session_start();

if (!$_SESSION["username"]) {
  header('location:login.php?pesan=belum_login');
}

$id_user=$_SESSION["id_user"];
$username=$_SESSION["username"];
$nama=$_SESSION["nama"];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Dahsboard Admin Alumni</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
  <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- PLUGINS CSS STYLE -->
  <link href="assets/plugins/toaster/toastr.min.css" rel="stylesheet" />
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />
  <link href="assets/plugins/icon/materialdesignicons.min.css" rel="stylesheet" />
  <link href="assets/plugins/flag-icons/css/flag-icon.min.css" rel="stylesheet"/>
  <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  <link href="assets/plugins/ladda/ladda.min.css" rel="stylesheet" />
  <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />
</head>
<style type="text/css">
    body{
    background-image: url(assets/img/cool-background.svg);
    background-repeat: no-repeat;
     background-size: 100% 100%;
}
</style>

  <body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">
    <div class="wrapper">
              <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="#">
                <span class="brand-name">ADMIN ALUMNI</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                  <li  class="has-sub <?php if($_GET['halaman']=='dashboard') { echo 'active';} ?>">
                    <a class="sidenav-item-link" href="index.php?halaman=dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>
                  </li>
                  <li  class="has-sub <?php if($_GET['halaman']=='list_alumni' or $_GET['halaman']=='list_admin' or $_GET['halaman']=='list_jurusan') { echo 'active expand';} ?>" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#ui-elements"
                      aria-expanded="false" aria-controls="ui-elements">
                      <i class="mdi mdi-folder-multiple-outline"></i>
                      <span class="nav-text">Data</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse <?php if($_GET['halaman']=='list_alumni' or $_GET['halaman']=='list_admin' or $_GET['halaman']=='list_jurusan') { echo 'show';}?>"  id="ui-elements" data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        <li  class="has-sub <?php if($_GET['halaman']=='list_alumni') { echo 'active';} ?>" >
                          <a class="sidenav-item-link" href="index.php?halaman=list_alumni">
                            <span class="nav-text">Alumni</span>
                          </a>
                        </li>
                        <li  class="has-sub <?php if($_GET['halaman']=='list_admin') { echo 'active';} ?>" >
                          <a class="sidenav-item-link" href="index.php?halaman=list_admin">
                            <span class="nav-text">Admin</span>
                          </a>
                        </li>
                        <li  class="has-sub <?php if($_GET['halaman']=='list_jurusan') { echo 'active';} ?>" >
                          <a class="sidenav-item-link" href="index.php?halaman=list_jurusan">
                            <span class="nav-text">Jurusan</span>
                          </a>
                        </li>
                      </div>
                    </ul>
                  </li>
                  <li  class="has-sub <?php if($_GET['halaman']=='list_loker') { echo 'active';} ?>" >
                    <a class="sidenav-item-link" href="index.php?halaman=list_loker">
                      <i class="mdi mdi-newspaper"></i>
                      <span class="nav-text">Lowongan</span>
                    </a>
                  </li>
                  <li  class="has-sub <?php if($_GET['halaman']=='list_laporan') { echo 'active';} ?>" >
                    <a class="sidenav-item-link" href="#">
                      <i class="mdi mdi-file-document"></i>
                      <span class="nav-text">Laporan</span>
                    </a>
                  </li>
              </ul>
            </div>
          </div>
        </aside>



      <div class="page-wrapper">
                  <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar">
              <!-- Sidebar toggle button -->
              <button></button>

              <div class="navbar-right">
                <ul class="nav navbar-nav">
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="assets/img/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block"><?php echo $nama; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <a href="#">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                      <li class="dropdown-footer">
                        <a href="logout.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>


        <div class="content-wrapper">
          <div class="content">
          <?php
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
                switch ($halaman) {
                    case 'list_admin':
                        include "admin/list_admin.php";
                        break;
                    case 'list_alumni':
                        include "alumni/list_alumni.php";
                        break;
                    case 'list_loker':
                        include "loker/list_loker.php";
                        break;
                    case 'list_jurusan':
                        include "alumni/jurusan.php";
                        break;
                    case 'list_laporan':
                      include "laporan/laporan.php";
                      break;
                    default:
                    echo '<script language="javascript">';
                    echo 'alert("Maaf. Halaman tidak di temukan !")';
                    echo '</script>';
                    case 'dashboard';
                    include "admin/dashboard.php";
                    break;
                }
            }else {
                include "admin/dashboard.php";
            }
          ?>
          </div>
        </div>

        <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year">2019</span> Copyright
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>
      </div>
    </div>

    <script>
      var doughnut = document.getElementById("doChart");
  if (doughnut !== null) {
    var myDoughnutChart = new Chart(doughnut, {
      type: "doughnut",
      data: {
        labels: ["completed", "unpaid", "pending", "canceled"],
        datasets: [
          {
            label: ["completed", "unpaid", "pending", "canceled"],
            data: [4100, 2500, 1800, 2300],
            backgroundColor: ["#4c84ff", "#29cc97", "#8061ef", "#fec402"],
            borderWidth: 1
            // borderColor: ['#4c84ff','#29cc97','#8061ef','#fec402']
            // hoverBorderColor: ['#4c84ff', '#29cc97', '#8061ef', '#fec402']
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        cutoutPercentage: 75,
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return "Order : " + data["labels"][tooltipItem[0]["index"]];
            },
            label: function(tooltipItem, data) {
              return data["datasets"][0]["data"][tooltipItem["index"]];
            }
          },
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 14,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2
        }
      }
    });
  }
    </script>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/plugins/toaster/toastr.min.js"></script>
<script src="assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/charts/Chart.min.js"></script>
<script src="assets/plugins/ladda/spin.min.js"></script>
<script src="assets/plugins/ladda/ladda.min.js"></script>
<script src="assets/plugins/jquery-mask-input/jquery.mask.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/plugins/jekyll-search.min.js"></script>
<script src="assets/js/sleek.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/date-range.js"></script>
<script src="assets/js/map.js"></script>
<script src="assets/ckeditor/ckeditor.js"></script>

</body>
</html>
