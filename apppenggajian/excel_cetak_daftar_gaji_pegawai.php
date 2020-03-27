<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=daftar_gaji_pegawai.xls");
	include "koneksi.php";
	include "fungsi.php";
	$bulantahun = $_GET['bulan'].$_GET['tahun'];
?>
<h3> PT Artapala <br>DAFTAR GAJI PEGAWAI</h3>
<P>Bulan : <?php echo bulanIndonesia($_GET['bulan'])." tahun : ".$_GET['tahun']; ?> </P>
<div class="table-responsive">
<table border='1' cellpadding="4" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>NIP</th>
						<th>Nama Pegawai</th>
						<th>Jabatan</th>
						<th>Gol</th>
						<th>Status</th>
						<th>Jumlah Anak</th>
						<th>Gapok</th>
						<th>TJ. Jabatan</th>
						<th>TJ. S/I</th>
						<th>TJ. Anak</th>
						<th>Uang makan</th>
						<th>Uang Lembur</th>
						<th>Askes</th>
						<th>Pendapatan</th>
						<th>Potongan</th>
						<th>Total Gaji</th>
					</tr>
				</thead>
		<tbody>
			<?php
			$sql = mysqli_query($konek, "SELECT pegawai.nip, pegawai.nama_pegawai, jabatan.nama_jabatan, golongan.nama_golongan,pegawai.status,pegawai.jumlah_anak,jabatan.gapok,jabatan.tunjangan_jabatan,
				if(pegawai.status='Menikah',tunjangan_suami_istri,0) AS tjsi, if(pegawai.status='Menikah',tunjangan_anak,0) AS tjanak, uang_makan*masuk AS uangmakan, master_gaji.lembur*uang_lembur as uanglembur, askes, (gapok+tunjangan_jabatan+(SELECT tjsi)+(SELECT tjanak)+(SELECT uangmakan)+(SELECT uanglembur)+askes) AS pendapatan, potongan, (SELECT pendapatan)- potongan AS totalgaji From pegawai INNER JOIN master_gaji ON master_gaji.nip=pegawai.nip
					INNER JOIN golongan ON golongan.kode_golongan=pegawai.kode_golongan
					INNER JOIN jabatan ON jabatan.kode_jabatan=pegawai.kode_jabatan
					WHERE master_gaji.bulan='$bulantahun' ORDER BY pegawai.nip ASC");

			$no=1;

			while($d=mysqli_fetch_array($sql)){
				echo "<tr> <td width='40px' align='center'>$no</td>
				<td>$d[nip]</td>
				<td>$d[nama_pegawai]</td>
				<td>$d[nama_jabatan]</td>
				<td>$d[nama_golongan]</td>
				<td>$d[status]</td>
				<td>$d[jumlah_anak]</td>
				<td>".buatRp($d['gapok'])."</td>
				<td>".buatRp($d['tunjangan_jabatan'])."</td>
				<td>".buatRp($d['tjsi'])."</td>
				<td>".buatRp($d['tjanak'])."</td>
				<td>".buatRp($d['uangmakan'])."</td>
				<td>".buatRp($d['uanglembur'])."</td>
				<td>".buatRp($d['askes'])."</td>
				<td>".buatRp($d['pendapatan'])."</td>
				<td>".buatRp($d['potongan'])."</td>
				<td>".buatRp($d['totalgaji'])."</td>



				</tr>";
				$no++;
			}

			?>
		</tbody>
			</table>
