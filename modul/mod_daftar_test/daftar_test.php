<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
switch($_GET[act]){
  // Tampil Menu Utama Khusus Untuk Level User Admin.
  default:
  echo "<div class='page-header'>
        <h1>Daftar Test</h1>
		<p>Daftar Test Yang Tersedia Antuk <b>$_SESSION[jabatan]</b></p>
      	</div><div class='row'>";
		$daftar=mysqli_query($konek,"SELECT * FROM kategori ORDER BY id_kategori");
    	while($d=mysqli_fetch_array($daftar)){
        echo"<div class='col-md-3'><button type='button' onclick=\"window.location.href='?module=test&id_kategori=$d[id_kategori]&halaman=1';\" class='btn btn-info btn-lg'>
  		<span class='glyphicon glyphicon-th-large' aria-hidden='true'></span> $d[nama_kategori]</div>";
        }
  echo"</div>";
  
break;
case "recent":  
}
}
?>
