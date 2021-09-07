<div class="card card-default">
  <div class="card-header card-header-border-bottom">
    <h2>DATA ALUMNI</h2>
  </div>
  <div class="card-body">
  <form method="post" action="index.php?halaman=list_alumni">
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
              echo"<div class='alert alert-success'><strong>Berhasil!</strong> data alumni telah di hapus!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }else if ($_GET['hapus']=='gagal'){
            echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data aalumni gagal di hapus!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }
      }
      if (isset($_GET['ubah'])) {
        //Mengecek nilai variabel hapus
        if ($_GET['ubah']=='berhasil'){
            echo"<div class='alert alert-success'><strong>Berhasil!</strong> mengubah data alumni!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
        }else if ($_GET['hapus']=='gagal'){
          echo"<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> mengubah data alumni!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
        }
    }
      ?>
    <div class="row">
      <div class="col-6">
      <button type="button" class="mb-4 btn btn-primary btn-pill" data-toggle="modal" data-target="#tambahalumni">
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
              <th scope="col">NIS</th>
              <th scope="col">Nama</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">Jurusan</th>
              <th scope="col">Tahun Lulus</th>
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

          $data = mysqli_query($kon,"SELECT * FROM tbl_alumni");
          $jumlah_data = mysqli_num_rows($data);
          $total_halaman = ceil($jumlah_data / $batas);
          $nobaru = $halaman_awal+1;

          if(isset($_POST['kata_cari'])) {
            $kata_cari = $_POST['kata_cari'];
            $query = "SELECT * FROM tbl_alumni WHERE nis like '%".$kata_cari."%' OR nama like '%".$kata_cari."%' OR tgl_lahir like '%".$kata_cari."%' OR nama_jurusan like '%".$kata_cari."%' ORDER BY nis ASC";
            } else {
              $query = "SELECT * FROM tbl_alumni limit $halaman_awal, $batas";
            }
            $result = mysqli_query($kon, $query);

            if(!$result) {
            die("Query Error : ".mysqli_errno($kon)." - ".mysqli_error($kon));
            }
            while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
            <td><?php echo $nobaru++; ?></td>
            <td><?php echo $row['nis']; ?></td>
            <td><?php echo $row['nama']; ?></td>
            <td><?php echo $row['tgl_lahir']; ?></td>
            <td><?php echo $row['nama_jurusan']; ?></td>
            <td><?php echo $row['thn_lulus']; ?></td>
            <td><button type="button" class="mb-1 btn btn-primary" data-toggle="modal" data-target="#ubahalumni<?php echo $row['nis']; ?>"><i class=" mdi mdi-account-edit"></i></button>
              <button type="button" class="mb-1 btn btn-danger"  data-toggle="modal" data-target="#deletealumni<?php echo $row['nis']; ?>"><i class=" mdi mdi-close-circle-outline"></i></button></td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="deletealumni<?php echo $row['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Alumni</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Apakah anda ingin menghapus "<?php echo $row['nama']; ?>" ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                  <a href="../admin/alumni/function_alumni.php?halaman=deletealumni&nis=<?php echo $row['nis']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Update Data -->
          <div class="modal fade" id="ubahalumni<?php echo $row['nis']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLarge">UBAH DATA ALUMNI</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="container-fluid">
                    <form method="POST" action="alumni/function_alumni.php" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="lblnis">NIS</label>
                            <input type="number" class="form-control" id="lblnis" placeholder="<?php echo $row['nis']; ?>" disabled>
                            <input name="nis" value="<?php echo $row['nis']; ?>" type="hidden" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="lblnama">Nama Siswa</label>
                            <input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="form-control" id="lblnama" placeholder="Nama Siswa" required>
                          </div>
                          <div class="row">
                          <div class="col-8 col-sm-6">
                            <div class="form-group">
                              <label for="lbltmptlahir">Tempat Lahir</label>
                              <input type="text" name="tempat_lahir" value="<?php echo $row['tempat_lahir']; ?>" class="form-control" id="lblnis" placeholder="Tempat Lahir" required>
                            </div>
                          </div>
                          <div class="col-4 col-sm-6">
                            <div class="form-group">
                              <label for="lbltgllahir">Tanggal Lahir</label>
                              <input type="date"  name="tgl_lahir" value="<?php echo $row['tgl_lahir']; ?>" class="form-control" id="lbltgllahir" placeholder="dd/mm/yy" required>
                            </div>
                          </div>
                          </div>
                          <div class="form-group">
                            <label for="lbljnskelamin">Jenis Kelamin</label>
                            <select name="jns_kelamin" class="form-control" id="lbljnskelamin" required>
                              <option> - </option>
                              <option value="Laki - Laki" <?php if ($row['jns_kelamin']=='Laki - Laki') echo "selected"; ?>>Laki - Laki</option>
                              <option value="Perempuan" <?php if ($row['jns_kelamin']=='Peremuan') echo "selected"; ?>>Perempuan</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="lblagama">Agama</label>
                            <select name="agama" class="form-control" id="lblagama" required>
                              <option> - </option>
                              <option value="Islam" <?php if ($row['agama']=='Islam') echo "selected"; ?>>Islam</option>
                              <option value="Protestan"<?php if ($row['agama']=='Protestan') echo "selected"; ?>>Protestan</option>
                              <option value="Katolik" <?php if ($row['agama']=='Katolik') echo "selected"; ?>>Katolik</option>
                              <option value="Hindu" <?php if ($row['agama']=='Hindu') echo "selected"; ?>>Hindu</option>
                              <option value="Buddha" <?php if ($row['agama']=='Buddha') echo "selected"; ?>>Buddha</option>
                              <option value="Khonghucu" <?php if ($row['agama']=='Khonghucu') echo "selected"; ?>>Khonghucu</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="lblalamat">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat" id="lblalamat" rows="3" required><?php echo $row['alamat']; ?></textarea>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="lblnotlpn">No Telepon</label>
                            <input type="text" value="<?php echo $row['notlpn']; ?>" name="notlpn" class="form-control" id="lblnotlpn" placeholder="081234567890" maxlength="14" required>
                          </div>
                          <div class="form-group">
                            <label for="lblemail">Email</label>
                            <input type="email" value="<?php echo $row['email']; ?>" name="email" class="form-control" id="lblemail" placeholder="NamaEmail@email.com" required>
                          </div>
                          <div class="form-group">
                            <label for="lbljurusan">Jurusan</label>
                            <select name="nama_jurusan" class="form-control" id="lbljurusan">
                              <option> - </option>
                            <?php
                            include '../config/database.php';
                            $data_jurusan = mysqli_query($kon,"SELECT * FROM tbl_jurusan");
                            $jumlah_jurusan = mysqli_num_rows($data_jurusan);
                            while ($d = mysqli_fetch_array($data_jurusan)){
                            ?>
                              <option value="<?php echo $d['nama_jurusan']; ?>" ><?php echo $d['nama_jurusan']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                          <div class="row">
                          <div class="col-8 col-sm-6">
                            <div class="form-group">
                              <label for="lblthnlulus">Tahun Lulus</label>
                              <input type="text" value="<?php echo $row['thn_lulus']; ?>" name="thn_lulus" class="form-control" id="lblthnlulus" placeholder="Tahun Lulus" required>
                            </div>
                          </div>
                          <div class="col-4 col-sm-6">
                            <div class="form-group">
                              <label for="cmbstatus">Status</label>
                              <select name="status" class="form-control" id="cmbstatus" required>
                                <option selected> - </option>
                                <option value="Bekerja" <?php if ($row['status']=='Bekerja') echo "selected"; ?>>Bekerja</option>
                                <option value="Kuliah" <?php if ($row['status']=='Kuliah') echo "selected"; ?>>Kuliah</option>
                                <option value="WiraUsaha" <?php if ($row['status']=='Wirausaha') echo "selected"; ?>>Wirausaha</option>
                              </select>
                            </div>
                          </div>
                          </div>
                          <div class="form-group">
                            <label for="lblnmakerjakuliah">Nama Kampus / Nama Perusahaan</label>
                            <input type="text" value="<?php echo $row['nama_instansi']; ?>" name="nama_instansi" class="form-control" id="lblnmakerjakuliah" placeholder="Nama Kampus / Nama Perusahaan" required>
                          </div>
                          <div class="form-group">
                            <label for="foto">Pilih Foto</label>
                            <input type="file" name="foto_baru" class="form-control-file">
                          </div>
                          <div class="form-group">
                            <label>Foto Saat ini:</label>
                            <img  src="alumni/foto/<?php echo $row['foto'];?>" alt="Card image cap" width="80px">
                            <input type="file" name="foto_lama" value="<?php echo $row['foto'];?>" hidden class="form-control-file">
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                  <button type="submit" name="update_alumni" class="btn btn-primary btn-pill">Save Changes</button>
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
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=list_alumni&page=$previous'"; } ?> aria-label="Previous">
              <span aria-hidden="true" class="mdi mdi-chevron-left"></span>
            </a>
          </li>
          <?php
          for($x=1;$x<=$total_halaman;$x++){
					?>
          <li class="page-item">
            <a class="page-link" href="?halaman=list_alumni&page=<?php echo $x ?>"><?php echo $x; ?></a>
          </li>
          <?php
				}
				?>
          <li class="page-item active">
            <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=list_alumni&page=$next'"; } ?> aria-label="Next">
              <span aria-hidden="true" class="mdi mdi-chevron-right"></span>
            </a>
          </li>
        </ul>
      </nav>
    </form>
  </div>
</div>

<!-- Tambah -->
<div class="modal fade" id="tambahalumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLarge">TAMBAH DATA ALUMNI</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method="POST" action="alumni/function_alumni.php" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lblnis">NIS</label>
                  <input type="number" name="nis" class="form-control" id="lblnis" placeholder="NIS/Nomor Induk Siswa" required>
                </div>
                <div class="form-group">
                  <label for="lblnama">Nama Siswa</label>
                  <input type="text" name="nama" class="form-control" id="lblnama" placeholder="Nama Siswa" required>
                </div>
                <div class="row">
                <div class="col-8 col-sm-6">
                  <div class="form-group">
                    <label for="lbltmptlahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" id="lblnis" placeholder="Tempat Lahir" required>
                  </div>
                </div>
                <div class="col-4 col-sm-6">
                  <div class="form-group">
                    <label for="lbltgllahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="lbltgllahir" placeholder="dd/mm/yy" required>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="lbljnskelamin">Jenis Kelamin</label>
                  <select name="jns_kelamin" class="form-control" id="lbljnskelamin" required>
                    <option> - </option>
                    <option value="Laki - Laki">Laki - Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="lblagama">Agama</label>
                  <select name="agama" class="form-control" id="lblagama" required>
                    <option> - </option>
                    <option value="Islam" >Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Jhonghucu">Khonghucu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="lblalamat">Alamat</label>
                  <textarea name="alamat" class="form-control" placeholder="Alamat" id="lblalamat" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lblnotlpn">No Telepon</label>
                  <input type="text" name="notlpn" class="form-control" id="lblnotlpn" placeholder="081234567890" maxlength="14" required>
                </div>
                <div class="form-group">
                  <label for="lblemail">Email</label>
                  <input type="email" name="email" class="form-control" id="lblemail" placeholder="NamaEmail@email.com" required>
                </div>
                <div class="form-group">
                  <label for="lbljurusan">Jurusan</label>
                  <select name="nama_jurusan" class="form-control" id="lbljurusan">
                    <option> - </option>
                  <?php
                   include '../config/database.php';
                   $data_jurusan = mysqli_query($kon,"SELECT * FROM tbl_jurusan");
                   $jumlah_jurusan = mysqli_num_rows($data_jurusan);
                   while ($d = mysqli_fetch_array($data_jurusan)){
                  ?>
                    <option value="<?php echo $d['nama_jurusan']; ?>"><?php echo $d['nama_jurusan']; ?></option>
                  <?php
                   }
                  ?>
                  </select>
                </div>
                <div class="row">
                <div class="col-8 col-sm-6">
                  <div class="form-group">
                    <label for="lblthnlulus">Tahun Lulus</label>
                    <input type="text" name="thn_lulus" class="form-control" id="lblthnlulus" placeholder="Tahun Lulus" required>
                  </div>
                </div>
                <div class="col-4 col-sm-6">
                  <div class="form-group">
                    <label for="cmbstatus">Status</label>
                    <select name="status" class="form-control" id="cmbstatus" required>
                      <option selected> - </option>
                      <option value="Bekerja">Bekerja</option>
                      <option value="Kuliah">Kuliah</option>
                      <option value="WiraUsaha">Wirausaha</option>
                    </select>
                  </div>
                </div>
                </div>
                <div class="form-group">
                  <label for="lblnmakerjakuliah">Nama Kampus / Nama Perusahaan</label>
                  <input type="text" name="nama_instansi" class="form-control" id="lblnmakerjakuliah" placeholder="Nama Kampus / Nama Perusahaan" required>
                </div>
                <div class="form-group">
                <label for="foto">Pilih Gambar</label>
                <input type="file" name="foto" class="form-control-file" required>
              </div>
              </div>
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
