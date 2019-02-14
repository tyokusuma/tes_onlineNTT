<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input kategori
if ($module=='kategori' AND $act=='input'){
  mysqli_query($konek,"INSERT INTO kategori(nama_kategori,id_user) VALUES('$_POST[nama_kategori]', '$_POST[username]')");
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='kategori' AND $act=='update'){
  mysqli_query($konek,"UPDATE kategori SET nama_kategori='$_POST[nama_kategori]', 
  										   id_user = '$_POST[id_user]',
										   aktif = '$_POST[aktif]' 
							               WHERE id_kategori = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
