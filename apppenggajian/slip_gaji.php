<?php include "header.php"; ?>

<div class="container">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"> Laporan Potongan Gaji Pegawai</h3>
</div>

<div class="panel-body">
		<form class="form-inline" method="GET" action="cetak_daftar_gaji_pegawai_sendiri_2.php" target="_blank">
<div class="form-group">
						
				<table class="table">
					<tr>
						<td width="160px">NIP</td>
			<td width="160px"><select name="nip" class="form-control" style="width:760px">
								<option value="">--Pilih--</option>
								<?php
								$sql=mysqli_query($konek, "SELECT pegawai.*,jabatan.nama_jabatan,golongan.nama_golongan from pegawai INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan ORDER BY pegawai.nip ASC ");
								while($j=mysqli_fetch_array($sql)){
									echo "<option value='$j[nip]' method='post'>$j[nip] - $j[nama_pegawai] - $j[nama_jabatan]</option>";
								}
								?>
						</select></td>
					</tr>
					</div>
					<button class="btn btn-primary" type="submit">Cetak SLIP</button>
		</form>
	</div>
</div>
		