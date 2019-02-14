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

// Hapus menu utama
if ($module=='menuutama' AND $act=='hapus'){
  mysqli_query($konek, "DELETE FROM mainmenu WHERE id_main = '$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input menu utama
elseif ($module=='menuutama' AND $act=='input'){
  mysqli_query($konek,"INSERT INTO mainmenu(nama_menu,link,aktif,levelmenu) VALUES('$_POST[nama_menu]','$_POST[link]','$_POST[aktif]','$_POST[levelmenu]')");
  header('location:../../media.php?module='.$module);
}

// Update menu utama
elseif ($module=='menuutama' AND $act=='update'){
  mysqli_query($konek,"UPDATE mainmenu SET nama_menu='$_POST[nama_menu]', link='$_POST[link]', aktif='$_POST[aktif]', levelmenu='$_POST[levelmenu]' 
               WHERE id_main = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
