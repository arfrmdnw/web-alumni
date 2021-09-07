<div class="card card-default">
								<div class="card-header card-header-border-bottom">
									<h2>DATA ADMIN</h2>
								</div>
								<div class="card-body">
                <form method="post" action="index.php?halaman=list_admin">
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
                    <button type="button" class="mb-4 btn btn-primary btn-pill" data-toggle="modal" data-target="#tambahadmin">
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
														<th scope="col">Username</th>
														<th scope="col">Nama</th>
														<th scope="col">Status</th>
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

                        $data = mysqli_query($kon,"SELECT * FROM tbl_user");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        $nobaru = $halaman_awal+1;

                        if(isset($_POST['kata_cari'])) {
                          $kata_cari = $_POST['kata_cari'];
                          $query = "SELECT * FROM tbl_user WHERE nama like '%".$kata_cari."%' OR username like '%".$kata_cari."%' OR status like '%" .$kata_cari."%' OR id_user like '%".$kata_cari."%' ORDER BY id_user ASC";
                         } else {
                          $query = "SELECT * FROM tbl_user limit $halaman_awal, $batas";
                         }
                         $result = mysqli_query($kon, $query);

                         if(!$result) {
                          die("Query Error : ".mysqli_errno($kon)." - ".mysqli_error($kon));
                         }
                         while ($row = mysqli_fetch_array($result)) {
                        ?>
													<tr>
                          <td><?php echo $row['id_user']; ?></td>
                          <td><?php echo $row['username']; ?></td>
                          <td><?php echo $row['nama']; ?></td>
                          <td><?php echo $row['status'] == 'Admin' ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Admin</div>' : '<div class="mb-2 mr-2 badge-pill badge badge-info">Kepala Sekolah</div>'; ?></td>
                          <td><button type="button" class="mb-1 btn btn-primary" data-toggle="modal" data-target="#ubahadmin<?php echo $row['id_user']; ?>"><i class=" mdi mdi-account-edit"></i></button>
                            <button type="button" class="mb-1 btn btn-danger" data-toggle="modal" data-target="#deleteadmin<?php echo $row['id_user']; ?>"><i class=" mdi mdi-close-circle-outline"></i></button></td>
                          </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="deleteadmin<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Alumni</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Apakah anda ingin menghapus data dengan nama username : "<?php echo $row['username']; ?>" ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                                <a href="../admin/admin/function_admin.php?halaman=deleteadmin&id_user=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- tambah -->
                        <div class="modal fade" id="ubahadmin<?php echo $row['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                              <div class="card-body">
                                <form method="post" action="admin/function_admin.php">
                                  <div class="form-group">
                                    <label for="iduser">ID User</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $row['id_user']; ?>" id="iduser" placeholder="<?php echo $kodeuser; ?>" disabled>
                                    <input type="text" name="id_user" value="<?php echo $row['id_user']; ?>" class="form-control" hidden>
                                  </div>
                                  <div class="form-group">
                                    <label for="nuser">Nama User</label>
                                    <input type="Text" value="<?php echo $row['nama']; ?>" class="form-control" name="nama" id="nuser" placeholder="Nama User">
                                  </div>
                                  <div class="form-group">
                                    <label for="nalamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" placeholder="Alamat" id="nalamat" rows="3" required><?php echo $row['alamat']; ?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="ntlpn">Nomor Telepon</label>
                                    <input type="Text" value="<?php echo $row['notlpn']; ?>" class="form-control" name="notlpn" id="ntlpn" placeholder="081234567890" maxlength="14">
                                  </div>
                                  <div class="form-group">
                                    <label for="user">Username</label>
                                    <input type="Text" value="<?php echo $row['username']; ?>" class="form-control" name="username" id="user" placeholder="Username">
                                  </div>
                                  <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" value="<?php echo $row['password']; ?>" class="form-control" name="password" id="njurusan" placeholder="Password">
                                  </div>
                                  <div class="form-group">
                                    <label for="nstatus">Status</label>
                                    <select name="status" class="form-control" id="nstatus" required>
                                      <option> - </option>
                                      <option value="Admin" <?php if ($row['status']=='Admin') echo "selected"; ?>>Admin</option>
                                      <option value="Kepala Sekolah" <?php if ($row['status']=='Kepala Sekolah') echo "selected"; ?>>Kepala Sekolah</option>
                                    </select>
                                  </div>
                              </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                                <button type="submit" name="update_admin" class="btn btn-primary btn-pill">Simpan</button>
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
                        <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=list_admin&page=$previous'"; } ?> aria-label="Previous">
                          <span aria-hidden="true" class="mdi mdi-chevron-left"></span>
                        </a>
                      </li>
                      <?php
                      for($x=1;$x<=$total_halaman;$x++){
                      ?>
                      <li class="page-item">
                        <a class="page-link" href="?halaman=list_admin&page=<?php echo $x ?>"><?php echo $x; ?></a>
                      </li>
                      <?php
                    }
                    ?>
                      <li class="page-item active">
                        <a class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=list_admin&page=$next'"; } ?> aria-label="Next">
                          <span aria-hidden="true" class="mdi mdi-chevron-right"></span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                  </form>
                </div>
              </div>

              <!-- tambah -->
              <div class="modal fade" id="tambahadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <div class="card-body">
                      <form method="post" action="admin/function_admin.php">
                      <?php
                      // mengambil data admin dengan kode paling besar
                      include '../config/database.php';
                      $query = mysqli_query($kon, "SELECT max(id_user) as kodeTerbesar FROM tbl_user");
                      $data = mysqli_fetch_array($query);
                      $id_user = $data['kodeTerbesar'];
                      $id_userurut = (int) substr($id_user, 3, 3);
                      $id_userurut++;
                      $huruf = "A";
                      $kodeuser = $huruf . sprintf("%03s", $id_userurut);
                      ?>
												<div class="form-group">
													<label for="iduser">ID User</label>
                          <input type="text" class="form-control" placeholder="<?php echo $kodeuser; ?>" id="iduser" placeholder="<?php echo $kodeuser; ?>" disabled>
                          <input type="text" name="id_user" value="<?php echo $kodeuser; ?>" class="form-control" hidden>
												</div>
												<div class="form-group">
													<label for="nuser">Nama User</label>
													<input type="Text" class="form-control" name="nama" id="nuser" placeholder="Nama User">
												</div>
												<div class="form-group">
													<label for="nalamat">Alamat</label>
                          <textarea name="alamat" class="form-control" placeholder="Alamat" id="nalamat" rows="3" required></textarea>
												</div>
												<div class="form-group">
													<label for="ntlpn">Nomor Telepon</label>
													<input type="Text" class="form-control" name="notlpn" id="ntlpn" placeholder="081234567890" maxlength="14">
												</div>
												<div class="form-group">
													<label for="user">Username</label>
													<input type="Text" class="form-control" name="username" id="user" placeholder="Username">
												</div>
												<div class="form-group">
													<label for="pass">Password</label>
													<input type="password" class="form-control" name="password" id="njurusan" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="nstatus">Status</label>
                          <select name="status" class="form-control" id="nstatus" required>
                            <option> - </option>
                            <option value="Admin">Admin</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                          </select>
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