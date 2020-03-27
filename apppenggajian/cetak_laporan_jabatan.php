<?php
session_start();
if (isset($_SESSION['login'])) {
	include "koneksi.php";
	include "fungsi.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Jabatan</title>
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
<p> Laporan DATA Jabatan</p>
<table border='1' cellpadding="4" cellspacing="0" width="100%">
	<tr>
		<th>No.</th>
		<th>Kode</th>
		<th>Nama Jabatan</th>
		<th>Gaji Pokok</th>
		<th>Tunj. Jabatan</th>
		
	</tr>
<?php
	$sql =mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
	$no=1;
while ($d=mysqli_fetch_array($sql)){
	echo "<tr>
		<td align='center' width='40px'>$no</td>
		<td align='center'>$d[kode_jabatan]</td>
		<td>$d[nama_jabatan]</td>
		<td>".buatRp($d['gapok'])."</td>
		<td>".buatRp($d['tunjangan_jabatan'])."</td>
		
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