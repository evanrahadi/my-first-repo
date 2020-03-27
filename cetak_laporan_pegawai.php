<?php
session_start();
if (isset($_SESSION['login'])) {
	include "koneksi.php";
	include "fungsi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Pegawai</title>
	<style type="text/css">
		body{
			font-family: arial;
		}
		table{
			border-collapse: collapse;
		}
		
		@media print{
			.no-print{
				display: none;
			}
		}
	</style>
</head>
<body>
<h3>PT Artapala</h3>
<hr>
<p> Laporan DATA PEGAWAI</p>
<table border='1' cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th>No.</th>
		<th>NIP</th>
		<th>Nama Pegawai</th>
		<th>Jabatan</th>
		<th>Golongan</th>
		<th>Status</th>
		<th>Jumlah anak</th>
	</tr>
<?php
	$sql =mysqli_query($konek, "SELECT pegawai.*, golongan.nama_golongan, jabatan.nama_jabatan FROM pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan ORDER BY golongan.nama_golongan DESC");

	$no = 1;
while ($d=mysqli_fetch_array($sql)){
	echo "<tr>
		<td align='center' width='40px'>$no</td>
		<td align='center'> $d[nip]</td>
		<td>$d[nama_pegawai]</td>
		<td>$d[nama_jabatan]</td>
		<td>$d[nama_golongan]</td>
		<td>$d[status]</td>
		<td align='center'>$d[jumlah_anak] orang</td>

	</tr>";
	$no++;
}
if(mysqli_num_rows($sql) < 1){
	echo "<tr> <tdcolspan='7'> Belum Ada data... </td> </tr>";
}
?>
</table>
<table width="100%">
	<tr>
		<td></td>
		<td width="200px">
			<p> PT Artapala, <?php echo tglIndonesia(date('Y-m-d')); ?>
			<br>
			Administrator,
		</p>
		<br>
		<br>
		<br>
		<P>___________________________________</P>
	</td>
	</tr>
</table>
<a href="#" class="no-print" onclick="window.print();"> Cetak / Print </a>
</body>
</html>

<?php
}else{
	header('location:login.php');
}