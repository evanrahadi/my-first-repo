<?php
session_start();
if (isset($_SESSION['login'])) {
	include "koneksi.php";
	include "fungsi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Kehadiran Pegawai</title>
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
<p> Laporan DATA Kehadiran PEGAWAI</p>
<table>
	<tr>
		<td width="100px"> Bulan </td>
		<td width="4px"> :</td>
		<td> <?php echo bulanIndonesia($_GET['bulan']); ?> </td>
	</tr>
	<tr>
		<td width="100px"> Tahun </td>
		<td width="4px"> :</td>
		<td> <?php echo $_GET['tahun']; ?> </td>
	</tr>
</table>
<table border='1' cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th>No.</th>
		<th>NIP</th>
		<th>Nama Pegawai</th>
		<th>Jabatan</th>
		<th>Golongan</th>
		<th>Jml. Masuk (Hari)</th>
		<th>Uang Makan</th>
	</tr>
<?php
if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$bulantahun = $bulan.$tahun;
}else {
	    $bulan = date('m');
		$tahun = date('Y');
		$bulantahun = $bulan.$tahun;
}
	$sql =mysqli_query($konek, "SELECT pegawai.nip,pegawai.nama_pegawai,jabatan.nama_jabatan,golongan.nama_golongan,master_gaji.masuk,uang_makan,uang_makan*masuk AS total FROM pegawai INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip INNER JOIN jabatan ON jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan WHERE master_gaji.bulan='$bulantahun' ORDER BY pegawai.nip ASC");

	$no = 1;
while ($d=mysqli_fetch_array($sql)){
	echo "<tr>
		<td align='center' width='40px'>$no</td>
		<td align='center'> $d[nip]</td>
		<td>$d[nama_pegawai]</td>
		<td>$d[nama_jabatan]</td>
		<td>$d[nama_golongan]</td>
		<td>$d[masuk]</td>
		<td>".buatRP($d['uang_makan'])."</td>
		<td>".buatRP($d['total'])."</td>
		
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
		<P>___________________________</P>
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