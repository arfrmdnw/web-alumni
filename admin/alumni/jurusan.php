<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>DATA JURUSAN</h2>
  </div>
  <div class="card-body">
    <form method="post" action="index.php?halaman=list_jurusan">
      <?php
      if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah']=='berhasil'){
              echo"<div class='alert alert-success'><strong>Berhasil!</strong> admin telah di tambahkan!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }else if ($_GET['tambah']=='gagal'){
              echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> admin gagal di tambahkan!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button></div>";
          }
      }
      if (isset($_GET['hapus'])) {
          //Mengecek nilai variabel hapus
          if ($_GET['hapus']=='berhasil'){
              echo"<div class='alert alert-success'><strong>Berhasil!</strong> admin telah di hapus!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }else if ($_GET['hapus']=='gagal'){
            echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> admin gagal di hapus!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }
      }
      ?>
      <div class="row">
        <div class="col-6">
          <button type="button" class="mb-4 btn btn-primary btn-pill" data-toggle="modal" data-target="#tambahjurusan">
            Tambah Data
          </button>
        </div>
        <div class="col-6">
          <div class="input-group">
            <input type="text" name="kata_cari" class="form-control" placeholder="Cari" aria-label="search">
            <div class="input-group-append">
              <button type="submit" class="input-group-text bg-primary"><i class="mdi mdi-table-search"></i></button>
            </div>
          </div>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Jurusan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // include database
            include '../config/database.php';
            $batas = 5;
            $halaman = isset($_GET['page'])?(int)$_GET['page'] : 1;
            $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

            $previous = $halaman - 1;
            $next = $halaman + 1;

            $data = mysqli_query($kon,"SELECT * FROM tbl_jurusan");
            $jumlah_data = mysqli_num_rows($data);
            $total_halaman = ceil($jumlah_data / $batas);
            $nobaru = $halaman_awal+1;

            if(isset($_POST['kata_cari'])) {
              $kata_cari = $_POST['kata_cari'];
              $query = "SELECT * FROM tbl_jurusan  WHERE nama_jurusan like '%".$kata_cari."%' ORDER BY id_jurusan ASC";
              } else {
              $query = "SELECT * FROM tbl_jurusan limit $halaman_awal, $batas";
              }
              $result = mysqli_query($kon, $query);

              if(!$result) {
              die("Query Error : ".mysqli_errno($kon)." - ".mysqli_error($kon));
              }
              while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
              <td><?php echo $nobaru++; ?></td>
              <td><?php echo $row['nama_jurusan']; ?></td>
              <td><button type="button" class="mb-1 btn btn-danger" data-toggle="modal" data-target="#deletejurusan<?php echo $row['id_jurusan']; ?>"><i class=" mdi mdi-close-circle-outline"></i></button></td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="deletejurusan<?php echo $row['id_jurusan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Jurusan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah anda ingin menghapus "<?php echo $row['nama_jurusan']; ?>" ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                  <a href="../admin/alumni/function_jurusan.php?halaman=deletejurusan&id_jurusan=<?php echo $row['id_jurusan']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
          </tbody>
        </table>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination border-rounded justify-content-center">
          <li class="page-item active">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=list_jurusan&page=$previous'"; } ?> aria-label="Previous">
              <span aria-hidden="true" class="mdi mdi-chevron-left"></span>
            </a>
          </li>
          <?php
          for($x=1;$x<=$total_halaman;$x++){
					?>
          <li class="page-item">
            <a class="page-link" href="?halaman=list_jurusan&page=<?php echo $x ?>"><?php echo $x; ?></a>
          </li>
          <?php
				}
				?>
          <li class="page-item active">
            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=list_jurusan&page=$next'"; } ?> aria-label="Next">
              <span aria-hidden="true" class="mdi mdi-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </form>
  </div>
</div>

<!-- tambah -->
<div class="modal fade" id="tambahjurusan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="alumni/function_jurusan.php">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <?php
                include '../config/database.php';
                $data_jurusan = mysqli_query($kon,"SELECT * FROM tbl_jurusan ORDER BY id_jurusan DESC LIMIT 1");
                $jumlah_jurusan = mysqli_num_rows($data_jurusan);
                $d = mysqli_fetch_array($data_jurusan);
                if($jumlah_jurusan<=0){
                  $nobaru = 1;
                } else {
                  $nobaru = $d['id_jurusan'] + 1;
                }
                ?>
                <label for="idj">ID Jurusan</label>
                <input type="text" class="form-control" placeholder="<?php echo $nobaru; ?>" disabled>
                <input type="text" class="form-control" name="id_jurusan" id="idj" value="<?php echo $nobaru; ?>" placeholder="<?php echo $nobaru; ?>" hidden>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namaj">Nama Jurusan</label>
                <input type="Text" class="form-control" name="nama_jurusan" id="namaj" placeholder="Nama Jurusan">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary btn-pill">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>