<?php
error_reporting(1);

include 'config/database.php';

$data = $_POST['data'];
$nama = $_POST['nama_alumni'];

?>
<?php
if($data == "nis"){
  ?>

  <div id="nis">
    <?php
    $daerah =mysqli_query($kon,"SELECT * FROM `tbl_alumni` WHERE `nis`='$nama'") or die(mysqli_error($kon));
    while($a = mysqli_fetch_array($daerah)){
      ?>
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
      <button type="submit" class="btn btn-primary">Save changes</button>
    <?php } ?>
  </div>
  <?php
}
?>