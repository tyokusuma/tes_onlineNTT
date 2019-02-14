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

// Input user
if ($module=='user' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysqli_query($konek,"INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email,
								 jabatan,
								 level,
                                 id_user) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
								'$_POST[jabatan]',
								'$_POST[level]',
                                '$pass')");
  header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  if (empty($_POST[password])) {
    mysqli_query($konek,"UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  jabatan        = '$_POST[jabatan]',
								  level			 = '$_POST[level]'  
                           WHERE  id_user     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysqli_query($konek,"UPDATE users SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]', 
								 jabatan        = '$_POST[jabatan]',
								 level			 = '$_POST[level]'   
                           WHERE id_user      = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
}
?>
