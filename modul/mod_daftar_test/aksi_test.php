<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/library.php";
$module=$_GET['module'];
$act=$_GET['act'];
$kategori = $_POST['id_kategori'];
$user = $_POST['id_user'];
$halaman = $_POST['halaman']+1;
// Input barang
if ($module=='test' AND $act=='input'){
  
  mysqli_query($konek,"INSERT INTO jawaban(id_soal,
  								   id_kategori,
  								  jawaban,
								  id_user,
								  hari,
								  tanggal) 
								  VALUES(
								  '$_POST[id_soal]',
								  '$kategori',
								  '$_POST[jawaban]',
								  '$user',
								  '$hari_ini',
								  '$tgl_sekarang'
								  )");
  echo "<script>window.location=('../../media.php?module=test&id_kategori=$kategori&halaman=$halaman')</script>";
}

// Update barang
elseif ($module=='test' AND $act=='update'){
 $user = $_POST['id_user'];
  mysqli_query($konek,"UPDATE jawaban SET id_kategori = '$kategori',
								jawaban =  '$_POST[jawaban]',
								hari = '$hari_ini',
								tanggal = '$tgl_sekarang'
               WHERE id_soal = '$_POST[id_soal]' AND id_user = '$user'");
  echo "<script>window.location=('../../media.php?module=test&id_kategori=$kategori&halaman=$halaman')</script>";
}
}
?>
