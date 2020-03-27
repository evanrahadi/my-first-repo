
<?php include "header.php"; ?>
    <!-- Begin page content -->
    <div class="container">
      <?php
      $view = isset($_GET['view']) ? $_GET['view'] : null;
      switch ($view) {
       default:

       if(isset($_GET['e']) && $_GET['e']== 'sukses'){
        echo "<center> proses berhasil </center>";
       }elseif (isset($_GET['e']) && $_GET['e']=='gagal'){
        echo "<center> proses gagal </center>";
       }
?>
<div class="panel panel-primary">
    <div class="panel-heading">
      <br>
      <br>
      <h3 class="panel-title"> Data Administrator</h3>
    </div>
    <div class="panel-body">
      <a href="data_admin.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;"> Tambah Data</a>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Username</th>
            <th> nama lengkap </th>
            <th> Level </th>
            <th> Aksi </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sqlAdmin = mysqli_query($konek, "SELECT * FROM admin ORDER BY username ASC");
          while ($data=mysqli_fetch_array($sqlAdmin)) {
            echo "<tr>
            <td class='text-center'>$no</td>
            <td>$data[username]</td>
            <td>$data[namalengkap]</td>
            <td>$data[level]</td>
            <td class='text-center'>
              <a href='data_admin.php?view=edit&id=$data[idadmin]' class='btn btn-warning btn-sm'>Edit</a>
              <a href='aksi_admin.php?act=delete&id=$data[idadmin]' class='btn btn-danger btn-sm'>Hapus </a>
              </td>
            </tr>";
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
      <?php
       break;

       case "tambah";
?>
<div class="panel panel-primary">
    <div class="panel-heading">
      <br>
      <br>
      <h3 class="panel-title"> Tambah Administrator</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" action="aksi_admin.php?act=insert">
          <div class="from-group">
            <label class="col-md-2">Username</label>
              <div class="col-md-2">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
              </div>
            </div>

      <div class="from-group">
            <label class="col-md-2">Password </label>
              <div class="col-md-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
              </div>
            </div>

      <div class="from-group">
            <label class="col-md-2">Nama Lengkap</label>
              <div class="col-md-2">
                <input type="text" name="namalengkap" class="form-control" placeholder="nama lengkap" required>
              </div>
            </div>
      <div class="from-group">
            <label class="col-md-2">Level</label>
              <div class="col-md-2">
               <select name="level" class="form-control">
                <option value="">--Pilih--</option>
                <?php
                $sqllevel=mysqli_query($konek, "SELECT DISTINCT level from admin");
                while($j=mysqli_fetch_array($sqllevel)){
                  echo "<option value='$j[level]'>$j[level]</option>";
                }
                ?>
            </select>
              </div>
            </div>

<div class="from-group">
            <label class="col-md-2"></label>
              <div class="col-md-4">
                <br>
                <input type="submit" class="btn btn-primary" value="Simpan">
                <a href="data_admin.php" class="btn btn-danger"> Batal </a>
              </div>
            </div>

      </form>
    </div>
  </div>
</div>
      <?php
       break;

       case "edit":
       $sqlEdit = mysqli_query($konek, "SELECT * FROM admin WHERE idadmin='$_GET[id]'");
       $e = mysqli_fetch_array($sqlEdit);
?>
<div class="panel panel-primary">
    <div class="panel-heading">
      <br>
      <br>
      <h3 class="panel-title"> Edit Data Administrator</h3>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="POST" action="aksi_admin.php?act=update">
        <input type="hidden" name="idadmin" value="<?php echo $e['idadmin']; ?>">
          <div class="from-group">
            <label class="col-md-2">Username</label>
              <div class="col-md-2">
                <input type="text" name="username" class="form-control" value="<?php echo $e['username']; ?>" required>
              </div>
            </div>

      <div class="from-group">
            <label class="col-md-2">Password </label>
              <div class="col-md-2">
                <input type="password" name="password" class="form-control" placeholder="kosongkan jika tidak di ganti">
              </div>
            </div>

      <div class="from-group">
            <label class="col-md-2">Nama Lengkap</label>
              <div class="col-md-2">
                <input type="text" name="namalengkap" class="form-control" value="<?php echo $e['namalengkap']; ?>" required>
              </div>
            </div>
        <div class="from-group">
            <label class="col-md-2">Level</label>
              <div class="col-md-2">
               <select name="level" class="form-control">
                <option value="">--Pilih--</option>
                <?php
                $sqllevel=mysqli_query($konek, "SELECT DISTINCT level from admin");
                while($j=mysqli_fetch_array($sqllevel)){
                  echo "<option value='$j[level]'>$j[level]</option>";
                }
                ?>
              </select>
            </div>
          </div>

<div class="from-group">
            <label class="col-md-2"></label>
              <div class="col-md-4">
                <input type="submit" class="btn btn-primary" value="Update Data">
                <a href="data_admin.php" class="btn btn-danger"> Batal </a>
              </div>
            </div>

      </form>
    </div>
  </div>
</div>
      <?php
       break;
      }
      ?>
    </div>
<?php include "footer.php"; ?>
   