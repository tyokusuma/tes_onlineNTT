<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

	// Hapus Pertanyaan/Soal
	if ($module=='reset' AND $act=='delete'){
 	mysqli_query($konek,"DELETE FROM tabel_soal");
  	header('location:../../media.php?module='.$module);
	}
		// Hapus Pertanyaan/Soal
	elseif ($module=='reset' AND $act=='delete'){
 	mysqli_query($konek,"DELETE FROM jawaban");
  	header('location:../../media.php?module='.$module);
	}

}
?>
