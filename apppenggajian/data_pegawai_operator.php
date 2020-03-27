<?php include "header_operator.php"; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view) {
	default:
		//kode
	?>
		<!-- menampillan pesan -->

		<?php 
		if (isset($_GET['e']) && $_GET['e']=='sukses'){
			?>
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Selamat</strong> Proses berhasil.
					</div>
				</div>
			</div>
			<?php
		}elseif(isset($_GET['e']) && $_GET['e']=='gagal'){
		?>
		<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Erorr</strong> Proses Gagal.
					</div>
				</div>
			</div>
<?php
		}
		?>

		<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<br>
					<br>		
						<h2 class="panel-title">
							Data Pegawai
						</h2>
					</div>

					<div class="panel-body">
						<a href="data_pegawai_operator.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;">Tambah data</a>
						<table class="table table-bordered table-striped">
							 <tr>
							 	<th>NO</th>
							 	<th>NIP</th>
							 	<th>Nama Pegawai</th>
							 	<th>Jabatan</th>
							 	<th>Golongan</th>
							 	<th>Status</th>
							 	<th>Jumlah anak</th>
							 	<th>Aksi </th>
							 </tr>
							 <?php
							 $sql = mysqli_query($konek, "SELECT pegawai.*,jabatan.nama_jabatan,golongan.nama_golongan from pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan ORDER BY pegawai.nip ASC");
							 $no=1;

							 while($d=mysqli_fetch_array($sql)){
							 	echo "<tr>
							 	<td width='40px' align='center'>$no </td>
							 	<td>$d[nip]</td>
							 	<td>$d[nama_pegawai]</td>
							 	<td>$d[nama_jabatan]</td>
							 	<td>$d[nama_golongan]</td>
							 	<td>$d[status]</td>
							 	<td>$d[jumlah_anak]</td>
							 	<td width='160px' align='center'>
							 	<a class='btn btn-warning btn-sm'
							 	href='data_pegawai_operator.php?view=edit&id=$d[nip]'>Edit</a>
							 	<a class='btn btn-danger btn-sm' href='aksi_pegawai_operator.php?act=del&id=$d[nip]'>hapus</a>
							 	</td>
							 	</tr>";
							 	$no++;
							 }
							 ?>
						</table>
					</div>
				</div>
			</div>

<?php

	break;
	case "tambah":
	?>
<?php 
		if (isset($_GET['e']) && $_GET['e']=='bl'){
			?>
			<div class="row">
				<div class="col-md-6 col-md-offset-4 col-center" align="center" colom="center">
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Peringantan</strong> form anda belum lengkap, silahkan coba lagi
					</div>
				</div>
			</div>
			<?php
		}
		?>

<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<br>
					<br>
				<h3 class="panel-title">
					Tambah data Pegawai
				</h3>
			</div>
			<div class="panel-body">
				<form method="post" action="aksi_pegawai_operator.php?act=insert">
				<table class="table">
					<tr>
						<td width="160px">NIP</td>
				<td>
					<input type="text" name="nip" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td>Nama Pegawai</td>
						<td> <input class="form-control" type="text" name="namapegawai"></td>
					</tr>
					<tr>
						<td>jabatan</td>
						<td><select name="jabatan" class="form-control">
								<option value="">--Pilih--</option>
								<?php
								$sqlJabatan=mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
								while($j=mysqli_fetch_array($sqlJabatan)){
									echo "<option value='$j[kode_jabatan]'>$j[kode_jabatan] - $j[nama_jabatan]</option>";
								}
								?>
						</select></td>
					</tr>
					<tr>
						<td>Golongan</td>
						<td><select name="golongan" class="form-control">
								<option value="">--Pilih--</option>
								<?php
								$sqlGolongan=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
								while($g=mysqli_fetch_array($sqlGolongan)){
									echo "<option value='$g[kode_golongan]'>$g[kode_golongan] - $g[nama_golongan]</option>";
								}
								?>
						</select></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><select name="status"  id="status" class="form-control" onChange="autoAnak()">
							<option value="">--Pilih--</option>
							<option value="Menikah"> Menikah</option>
							<option value="Belum Menikah">Belum Menikah</option>
						</select></td>
					</tr>
					<tr>
						<td>Jumlah anak</td>
						<td> <input type="number" id="jumlahanak" name="jumlahanak" class="form-control"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="btn btn-primary" value="simpan">
							<a class="btn btn-danger" href="data_pegawai_operator.php"> kembali</td>
					</tr>
				</table>
			</form>
			<script type="text/javascript">
								function autoAnak(){
									var status = $('#status').val();
									if(status=='Belum Menikah'){
										$('#jumlahanak').val('0');
										$('#jumlahanak').prop('readonly',true);
									}else{
										$('#jumlahanak').val('');
										$('#jumlahanak').prop('readonly',false)
									}
								}
						</script>
		</div>
	</div>
</div>
<?php 
	break;
	case  "edit":

		$sqlEdit = mysqli_query($konek, "SELECT * FROM pegawai WHERE nip='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
		?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<br>
					<br>
				<h3 class="panel-title"> Edit data pegawai</h3>
				</div>
				<div class="panel-body">
						<form method="post" action="aksi_pegawai_operator.php?act=update">
							<table class="table">
								<tr>
						<td width="160px">NIP</td>
				<td>
					<input type="text" name="nip"  value="<?php echo $e['nip'];?>" class="form-control" required>
						</td>
					</tr>
					<tr>
						<td>Nama Pegawai</td>
						<td> <input class="form-control" type="text" name="namapegawai" value="<?php echo $e['nama_pegawai'];?>"></td>
					</tr>
					<tr>
						<td>jabatan</td>
						<td><select name="jabatan" class="form-control">
								<option value="">--Pilih--</option>
								<?php
								$sqlJabatan=mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
								while($j=mysqli_fetch_array($sqlJabatan)){
									$selected =($j['kode_jabatan']==$e['kode_jabatan']) ? 'selected="selected"' : "";
									echo "<option value='$j[kode_jabatan]' $selected>$j[kode_jabatan] - $j[nama_jabatan]</option>";
								}
								?>
						</select></td>
					</tr>
					<tr>
						<td>Golongan</td>
						<td><select name="golongan" class="form-control">
								<option value="">--Pilih--</option>
								<?php
								$sqlGolongan=mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
								while($g=mysqli_fetch_array($sqlGolongan)){
									$selected =($g['kode_golongan']==$e['kode_golongan']) ? 'selected="selected"' : "";

									echo "<option value='$g[kode_golongan]' $selected>$g[kode_golongan] - $g[nama_golongan]</option>";
								}
								?>
						</select></td>
					</tr>
					<tr>
						<td>Status</td>
						<td><select name="status" id="status" onChange="autoAnak()" class="form-control">
							<option value="<?php echo $e['status']; ?>" selected><?php echo $e['status']; ?></option>
							<option value="Menikah"> Menikah</option>
							<option value="Belum Menikah">Belum Menikah</option>
						</select></td>
					</tr>
					<tr>
						<td>Jumlah anak</td>
						<td> <input type="number" id="jumlahanak" name="jumlahanak" class="form-control" value="<?php echo $e['jumlah_anak']; ?>" required></td>
					</tr>
								<tr>
									<td></td>
							<td> <input type="submit" value="Update data" class="btn btn-primary"> <a href="data_pegawai_operator.php" class="btn btn-danger">Kembali</td>
								</tr>
							</table>
						</form>
						<script type="text/javascript">
								function autoAnak(){
									var status = $('#status').val();
									if(status=='Belum Menikah'){
										$('#jumlahanak').val('0');
										$('#jumlahanak').prop('readonly',true);
									}else{
										$('#jumlahanak').val('');
										$('#jumlahanak').prop('readonly',false)
									}
								}
						</script>
						</div>
					</div>
				</div>
		<?php
	break ;

}
?>

</div>
<?php include "footer.php"; ?>