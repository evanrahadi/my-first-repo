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
							Data Golongan
						</h2>
					</div>

					<div class="panel-body">
						<a href="data_golongan_operator.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;">Tambah data</a>
						<table class="table table-bordered table-striped">
							 <tr>
							 	<th>NO</th>
							 	<th>Kode</th>
							 	<th>Nama Golongan</th>
							 	<th>Tunjangan S/I</th>
							 	<th>Tunjangan Anak</th>
							 	<th>Uang makan </th>
							 	<th>uang lembur </th>
							 	<th>Askes</th>
							 	<th>Aksi </th>
							 </tr>
							 <?php
							 $sql = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
							 $no=1;

							 while($d=mysqli_fetch_array($sql)){
							 	echo "<tr>
							 	<td width='40px' align='center'>$no </td>
							 	<td>$d[kode_golongan]</td>
							 	<td>$d[nama_golongan]</td>
							 	<td>".buatRp($d['tunjangan_suami_istri'])."</td>
							 	<td>".buatRp($d['tunjangan_anak'])."</td>
							 	<td>".buatRp($d['uang_makan'])."</td>
							 	<td>".buatRp($d['uang_lembur'])."</td>
							 	<td>".buatRp($d['askes'])."</td>
							 	<td width='160px' align='center'>
							 	<a class='btn btn-warning btn-sm'
							 	href='data_golongan_operator.php?view=edit&id=$d[kode_golongan]'>Edit</a>
							 	<a class='btn btn-danger btn-sm' href='aksi_golongan_operator.php?act=del&id=$d[kode_golongan]'>hapus</a>
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
	$simbol = "G";
	$query = mysqli_query($konek, "SELECT max(kode_golongan) AS last FROM golongan WHERE kode_golongan LIKE '$simbol%'");
	$data = mysqli_fetch_array($query);

	$kodeterakhir = $data['last'];
	$nomorterakhir = substr($kodeterakhir, 1, 2);
	$nextNomor =  $nomorterakhir + 1;
	$nextKode = $simbol.sprintf('%02s',$nextNomor);

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
					Tambah data golongan
				</h3>
			</div>
			<div class="panel-body">
				<form method="post" action="aksi_golongan_operator.php?act=insert">
				<table class="table">
					<tr>
						<td width="160px"> Kode golongan </td>
				<td>
					<input type="text" name="kodegolongan" value="<?php echo $nextKode; ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>Nama golongan</td>
						<td> <input class="form-control" type="text" name="namagolongan"></td>
					</tr>
					<tr>
						<td>Tunjangan S/I</td>
						<td><input class="form-control" type="text" name="tunjangansi" required></td>
					</tr>
					<tr>
						<td>Tunjangan anak</td>
						<td> <input class="form-control" type="number" name="tunjangananak" required></td>
					</tr>
					<tr>
						<td>uang makan</td>
						<td> <input class="form-control" type="number" name="uangmakan" required></td>
					</tr>
					<tr>
						<td>uang lembur</td>
						<td> <input class="form-control" type="number" name="uanglembur" required></td>
					</tr>
					<tr>
						<td>askes</td>
						<td> <input class="form-control" type="number" name="askes" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" class="btn btn-primary" value="simpan">
							<a class="btn btn-danger" href="data_jabatan.php"> kembali</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php 
	break;
	case  "edit":

		$sqlEdit = mysqli_query($konek, "SELECT * FROM golongan WHERE kode_golongan='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
		?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<br>
      <br>
				<h3 class="panel-title"> Edit data golongan</h3>
				</div>
				<div class="panel-body">
						<form method="post" action="aksi_golongan_operator.php?act=update">
							<table class="table">
								<tr>
									<td width="160"> kode golongan</td>
									<td><input type="text" name="kodegolongan" class="form-control" value="<?php echo $e['kode_golongan']; ?>" readonly></td>
								</tr>
								<tr>
						<td>Nama golongan</td>
						<td> <input class="form-control" type="text" name="namagolongan" value="<?php echo $e['nama_golongan'];?>" required></td>
					</tr>
					<tr>
						<td>Tunjangan S/I</td>
						<td><input class="form-control" type="text" name="tunjangansi" value="<?php echo $e['tunjangan_suami_istri'];?>" required></td>
					</tr>
					<tr>
						<td>Tunjangan anak</td>
						<td> <input class="form-control" type="number" name="tunjangananak" value="<?php echo $e['tunjangan_anak'];?>" required></td>
					</tr>
					<tr>
						<td>uang makan</td>
						<td> <input class="form-control" type="number" name="uangmakan" value="<?php echo $e['uang_makan'];?>" required></td>
					</tr>
					<tr>
						<td>uang lembur</td>
						<td> <input class="form-control" type="number" name="uanglembur" value="<?php echo $e['uang_lembur'];?>" required></td>
					</tr>
					<tr>
						<td>askes</td>
						<td> <input class="form-control" type="number" name="askes"value="<?php echo $e['askes'];?>" required></td>
					</tr>
								<tr>
									<td></td>
							<td> <input type="submit" value="Update data" class="btn btn-primary"> <a href="data_golongan_operator.php" class="btn btn-danger">Kembali</td>
								</tr>
							</table>
						</form>
						</div>
					</div>
				</div>
		<?php
	break ;

}
?>

</div>
<?php include "footer.php"; ?>