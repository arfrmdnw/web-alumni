<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>DATA LOWONGAN PEKERJAAN</h2>
  </div>
  <div class="card-body">
  <form method="post" action="index.php?halaman=list_loker">
  <?php
      if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah']=='berhasil'){
              echo"<div class='alert alert-success'><strong>Berhasil!</strong> tambah data alumni telah di tambahkan!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }else if ($_GET['tambah']=='gagal_ukuran'){
              echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> ukuran foto terlalu besar!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button></div>";
          }else if ($_GET['tambah']=='format'){
            echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> format foto tidak sesuai!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
        }
      }
      if (isset($_GET['hapus'])) {
          //Mengecek nilai variabel hapus
          if ($_GET['hapus']=='berhasil'){
              echo"<div class='alert alert-success'><strong>Berhasil!</strong> data Lowongan telah di hapus!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }else if ($_GET['hapus']=='gagal'){
            echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data Lowongan gagal di hapus!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }
      }
      if (isset($_GET['ubah'])) {
        //Mengecek nilai variabel hapus
        if ($_GET['ubah']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> mengubah data Lowongan!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
        }else if ($_GET['ubah']=='gagal'){
          echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> mengubah data Lowongan!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
        }
    }
      ?>
    <div class="row">
      <div class="col-6">
      <button type="button" class="mb-4 btn btn-primary btn-pill" data-toggle="modal" data-target="#tambahloker">
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
              <th scope="col">Judul</th>
              <th scope="col">Instansi</th>
              <th scope="col">Tanggal Dibuat</th>
              <th scope="col">Batas Waktu</th>
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

          $data = mysqli_query($kon,"SELECT * FROM tbl_loker");
          $jumlah_data = mysqli_num_rows($data);
          $total_halaman = ceil($jumlah_data / $batas);
          $nobaru = $halaman_awal+1;

          if(isset($_POST['kata_cari'])) {
            $kata_cari = $_POST['kata_cari'];
            $query = "SELECT * FROM tbl_loker WHERE id_loker like '%".$kata_cari."%' OR judul like '%".$kata_cari."%' OR instansi like '%".$kata_cari."%' OR tgl_dibuat like '%".$kata_cari."%' OR tgl_bataswaktu like '%".$kata_cari."%' ORDER BY id_loker ASC";
            } else {
              $query = "SELECT * FROM tbl_loker limit $halaman_awal, $batas";
            }
            $result = mysqli_query($kon, $query);

            if(!$result) {
            die("Query Error : ".mysqli_errno($kon)." - ".mysqli_error($kon));
            }
            while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
            <td><?php echo $nobaru++; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['instansi']; ?></td>
            <td><?php echo $row['tgl_dibuat']; ?></td>
            <td><?php echo $row['tgl_bataswaktu']; ?></td>
            <td><button type="button" class="mb-1 btn btn-primary" data-toggle="modal" data-target="#ubahaloker<?php echo $row['id_loker']; ?>"><i class=" mdi mdi-account-edit"></i></button>
              <button type="button" class="mb-1 btn btn-danger"  data-toggle="modal" data-target="#deleteloker<?php echo $row['id_loker']; ?>"><i class=" mdi mdi-close-circle-outline"></i></button></td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="deleteloker<?php echo $row['id_loker']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Lowongan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah anda ingin menghapus Data dengan Judul : "<?php echo $row['judul']; ?>" ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                  <a href="../admin/loker/function_loker.php?halaman=deleteloker&id_loker=<?php echo $row['id_loker']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Update -->
          <div class="modal fade" id="ubahaloker<?php echo $row['id_loker']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLarge">UPDATE DATA LOWONGAN PEKERJAAN</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <form method="POST" action="loker/function_loker.php" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="lblloker">ID Loker</label>
                            <input type="text" class="form-control" id="lblloker" placeholder="<?php echo $row['id_loker']; ?>" disabled>
                            <input type="text" name="id_loker" value="<?php echo $row['id_loker']; ?>" class="form-control" id="lblloker" placeholder="ID Loker" hidden>
                          </div>
                          <div class="form-group">
                            <label for="lbljudul">Judul Loker</label>
                            <input type="text" name="judul" value="<?php echo $row['judul']; ?>" class="form-control" id="lbljudul" placeholder="Judul Loker" required>
                          </div>
                          <div class="form-group">
                            <label for="lblinstansi">Instansi</label>
                            <input type="text" name="instansi" value="<?php echo $row['instansi']; ?>" class="form-control" id="lblinstansi" placeholder="Instansi" required>
                          </div>
                          <div class="form-group">
                            <label for="lblisi">Isi</label>
                            <textarea name="isi" class="ckeditor" placeholder="Isi" id="lblisi" required><?php echo $row['isi']; ?></textarea>
                          </div>
                          <div class="row">
                          <div class="col-8 col-sm-6">
                            <div class="form-group">
                              <label for="lbltglskrng">Tanggal Dibuat</label>
                              <input type="text" class="form-control" placeholder="<?php echo date("Y/m/d");?>" disabled>
                              <input type="text" name="tgl_dibuat" class="form-control" value="<?php echo date("Y/m/d");?>" hidden>
                            </div>
                          </div>
                          <div class="col-4 col-sm-6">
                            <div class="form-group">
                              <label for="lbltglbataswaktu">Tanggal Batas Waktu</label>
                              <input type="date" name="tgl_bataswaktu"  class="form-control" value="<?php echo date('Y-m-d',strtotime($row['tgl_bataswaktu']))?>" id="lbltglbataswaktu" required>
                            </div>
                          </div>
                          </div>
                          <div class="form-group">
                              <label for="lbllink">Link Website</label>
                              <input type="text" name="link_web" value="<?php echo $row['link_web']; ?>" class="form-control" id="lbllink" placeholder="Link Website" required>
                          </div>
                          <div class="form-group">
                              <label for="foto">Pilih Gambar</label>
                              <input type="file" name="gambar_baru" class="form-control-file">
                          </div>
                          <div class="form-group">
                            <label>Foto Saat ini:</label>
                            <img  src="loker/gambar/<?php echo $row['gambar'];?>" alt="Card image cap" width="80px">
                            <input type="file" name="gambar_lama" value="<?php echo $row['gambar'];?>" hidden class="form-control-file">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_loker" class="btn btn-primary btn-pill">Save Changes</button>
                      </div>
                    </form>
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
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=list_loker&page=$previous'"; } ?> aria-label="Previous">
              <span aria-hidden="true" class="mdi mdi-chevron-left"></span>
            </a>
          </li>
          <?php
          for($x=1;$x<=$total_halaman;$x++){
					?>
          <li class="page-item">
            <a class="page-link" href="?halaman=list_loker&page=<?php echo $x ?>"><?php echo $x; ?></a>
          </li>
          <?php
				}
				?>
          <li class="page-item active">
            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=list_loker&page=$next'"; } ?> aria-label="Next">
              <span aria-hidden="true" class="mdi mdi-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </form>
  </div>
</div>

<!-- Tambah -->
<div class="modal fade" id="tambahloker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLarge">TAMBAH DATA LOWONGAN PEKERJAAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="loker/function_loker.php" enctype="multipart/form-data">
                <div class="form-group">
                  <?php
                  // mengambil data produk dengan kode paling besar
                  include '../config/database.php';
                  $query = mysqli_query($kon, "SELECT max(id_loker) as kodeTerbesar FROM tbl_loker");
                  $data = mysqli_fetch_array($query);
                  $id_loker = $data['kodeTerbesar'];
                  $id_lokerurut = (int) substr($id_loker, 3, 3);
                  $id_lokerurut++;
                  $huruf = "LKR";
                  $kodeloker = $huruf . sprintf("%03s", $id_lokerurut);
                  ?>
                  <label for="lblloker">ID Loker</label>
                  <input type="text" class="form-control" id="lblloker" placeholder="<?php echo $kodeloker; ?>" disabled>
                  <input type="text" name="id_loker" value="<?php echo $kodeloker; ?>" class="form-control" id="lblloker" placeholder="ID Loker" hidden>
                </div>
                <div class="form-group">
                  <label for="lbljudul">Judul Loker</label>
                  <input type="text" name="judul" class="form-control" id="lbljudul" placeholder="Judul Loker" required>
                </div>
                <div class="form-group">
                  <label for="lblinstansi">Instansi</label>
                  <input type="text" name="instansi" class="form-control" id="lblinstansi" placeholder="Instansi" required>
                </div>
                <div class="form-group">
                  <label for="lblisi">Isi</label>
                  <textarea name="isi" class="ckeditor" placeholder="Isi" id="lblisi" required></textarea>
                </div>
                <div class="row">
                <div class="col-8 col-sm-6">
                  <div class="form-group">
                    <label for="lbltglskrng">Tanggal Dibuat</label>
                    <input type="text" name="tgl_dibuat" class="form-control" value="<?php echo date("Y/m/d");?>">
                  </div>
                </div>
                <div class="col-4 col-sm-6">
                  <div class="form-group">
                    <label for="lbltglbataswaktu">Tanggal Batas Waktu</label>
                    <input type="date" name="tgl_bataswaktu" class="form-control" id="lbltglbataswaktu" placeholder="dd/mm/yy" required>
                  </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="lbllink">Link Website</label>
                    <input type="text" name="link_web" class="form-control" id="lbllink" placeholder="Link Website" required>
                </div>
                <div class="form-group">
                    <label for="foto">Pilih Gambar</label>
                    <input type="file" name="gambar" class="form-control-file" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary btn-pill">Save Changes</button>
            </div>
          </form>
          </div>
        </div>
      </div>
