<?php
$konek = mysqli_connect("localhost", "root", "","penggajiandb");

if (!$konek){
	echo "koneksi ke mysql gagal";
}
?>