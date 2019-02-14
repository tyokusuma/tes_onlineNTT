<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_reset/aksi_reset.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='page-header'>
        <h1>Reset Aplikasi</h1>
      	</div>
	  	<div class='row'>
        <div class='col-md-10'>
          <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
		  <th>Nama Modul</th>
		  <th>Aksi</th></tr></thead><tbody>
		  <tr><td>1</td>
             <td>Modul Soal</td>
			 <td><a href='$aksi?module=reset&act=delete' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Reset</a>
             </td></tr>
			 <tr><td>2</td>
             <td>Modul Jawaban</td>
			 <td><a href='$aksi?module=reset&act=delete' class='btn btn-sm btn-danger'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Reset</a>
             </td></tr>";
    echo "</table>";
    echo "<div id=paging>*) Data pada Kategori tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kategori.</div><br></div></div>";
    break;
  

}
}
?>
