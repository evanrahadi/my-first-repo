<?php include "header.php"; ?>
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
							Data jabatan
						</h2>
					</div>

					<div class="panel-body">
						<a href="data_jabatan.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;">Tambah data</a>
						<table class="table table-bordered table-striped">
							 <tr>
							 	<th>NO</th>
							 	<th>Kode Jabatan</th>
							 	<th>Nama Jabatan</th>
							 	<th>Gaji Pokok</th>
							 	<th>Tunjangan Jabatan</th>
							 	<th>Aksi </th>
							 </tr>
							 <?php
							 $sql = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
							 $no=1;

							 while($d=mysqli_fetch_array($sql)){
							 	echo "<tr>
							 	<td width='40px' align='center'>$no </td>
							 	<td>$d[kode_jabatan]</td>
							 	<td>$d[nama_jabatan]</td>
							 	<td>".buatRp($d['gapok'])."</td>
							 	<td>".buatRp($d['tunjangan_jabatan'])."</td>
							 	<td width='160px' align='center'>
							 	<a class='btn btn-warning btn-sm'
							 	href='data_jabatan.php?view=edit&id=$d[kode_jabatan]'>Edit</a>
							 	<a class='btn btn-danger btn-sm' href='aksi_jabatan.php?act=del&id=$d[kode_jabatan]'>hapus</a>
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
	$simbol = "J";
	$query = mysqli_query($konek, "SELECT max(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'");
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
					Tambah data Jabatan
				</h3>
			</div>
			<div class="panel-body">
				<form method="post" action="aksi_jabatan.php?act=insert">
				<table class="table">
					<tr>
						<td width="160px"> Kode jabatan </td>
				<td>
					<input type="text" name="kodejabatan" value="<?php echo $nextKode; ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>Nama jabatan</td>
						<td> <input class="form-control" type="text" name="namajabatan"></td>
					</tr>
					<tr>
						<td>Gaji Pokok</td>
						<td><input class="form-control" type="text" name="gapok" required></td>
					</tr>
					<tr>
						<td>tunjangan jabatan</td>
						<td> <input class="form-control" type="number" name="tunjanganjabatan" required></td>
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

		$sqlEdit = mysqli_query($konek, "SELECT * FROM jabatan WHERE kode_jabatan='$_GET[id]'");
		$e = mysqli_fetch_array($sqlEdit);
		?>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					<br>
      <br>
				<h3 class="panel-title"> Edit data databases</h3>
				</div>
				<div class="panel-body">
						<form method="post" action="aksi_jabatan.php?act=update">
							<table class="table">
								<tr>
									<td width="160"> kode jabatan</td>
									<td><input type="text" name="kodejabatan" class="form-control" value="<?php echo $e['kode_jabatan']; ?>" readonly></td>
								</tr>
								<tr>
									<td> Nama jabatan</td>
							<td> <input type="text" name="namajabatan" class="form-control" value="<?php echo $e['nama_jabatan']; ?>" required></td>
								</tr>
							<tr>
									<td>Gaji Pokok</td>
							<td> <input type="number" name="gapok" class="form-control" value="<?php echo $e['gapok']; ?>" required></td>
							</tr>
							<tr>
									<td> Tunjangan jabatan</td>
							<td> <input type="number" name="tunjanganjabatan" class="form-control" value="<?php echo $e['tunjangan_jabatan']; ?>" required></td>
								</tr>
								<tr>
									<td></td>
							<td> <input type="submit" value="Update data" class="btn btn-primary"> <a href="data_jabatan.php" class="btn btn-danger">Kembali</td>
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