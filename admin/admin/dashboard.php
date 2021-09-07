           <!-- Top Statistics -->
           <div class="row">
              <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="media widget-media p-4 bg-white border">
                <?php
                // menghubungkan dengan koneksi database
                include '../config/database.php';
                // mengambil data pada tabel
                $data_admin = mysqli_query($kon,"SELECT * FROM tbl_user");
                $data_loker = mysqli_query($kon,"SELECT * FROM tbl_loker");
                $data_jurusan = mysqli_query($kon,"SELECT * FROM tbl_jurusan");
                $data_alumni = mysqli_query($kon,"SELECT * FROM tbl_alumni");
                // menghitung data pada tabel
                $jumlah_admin = mysqli_num_rows($data_admin);
                $jumlah_loker = mysqli_num_rows($data_loker);
                $jumlah_jurusan = mysqli_num_rows($data_jurusan);
                $jumlah_alumni = mysqli_num_rows($data_alumni);
                ?>
                  <div class="icon rounded-circle mr-4 bg-primary">
                    <i class="mdi mdi-account-outline text-white "></i>
                  </div>
                  <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><?php echo $jumlah_admin; ?></h4>
                    <p>Admin</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="media widget-media p-4 bg-white border">
                  <div class="icon rounded-circle bg-warning mr-4">
                    <i class="mdi mdi-newspaper text-white "></i>
                  </div>
                  <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><?php echo $jumlah_loker; ?></h4>
                    <p>Lowongan Kerja</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="media widget-media p-4 bg-white border">
                  <div class="icon rounded-circle mr-4 bg-danger">
                    <i class="mdi mdi-account-group text-white "></i>
                  </div>
                  <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><?php echo $jumlah_alumni; ?></h4>
                    <p>Alumni</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="media widget-media p-4 bg-white border">
                  <div class="icon bg-success rounded-circle mr-4">
                    <i class="mdi mdi-briefcase text-white "></i>
                  </div>
                  <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><?php echo $jumlah_jurusan; ?></h4>
                    <p>Jurusan</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            <!-- Doughnut Chart -->
            <div class="card card-default" data-scroll-height="675">
              <div class="card-header justify-content-center">
                <h2>Orders Overview</h2>
              </div>
              <div class="card-body" >
                <canvas id="doChart" ></canvas>
              </div>
            </div>
						</div>