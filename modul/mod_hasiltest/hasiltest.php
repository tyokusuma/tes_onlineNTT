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
        <h1>Hasil Test</h1>
		<p>Untuk <b>$_SESSION[jabatan]</p>
      	</div>";
		//Ambil Kategori Dari Id User
		$user = $_SESSION['kategori'];
		//Cari Kategori Pelajaran Dari User INi
		$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
		$k    = mysqli_fetch_array($kategori);
		$id_kategori = $k['id_kategori'];
		//Ta,pilkan Daftar TEs Dari MKategori User
		$daftar=mysqli_query($konek,"SELECT users.nama_lengkap, jawaban.id_user, count(jawaban.id_soal) as jml FROM jawaban, users WHERE jawaban.id_user=users.id_user AND jawaban.id_kategori = $id_kategori GROUP BY users.id_user ORDER BY users.nama_lengkap");
		echo "<table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
          <th width='300'>Nama Lengkap</th>
          <th>Jumlah Jawaban</th>
		  <th>Jawaban Benar</th>
		  <th class='center'>aksi</th> </tr></thead> ";
		$no=1;
    	while($d=mysqli_fetch_array($daftar)){
		//Hitung Jawaban Benar
		$jawab= mysqli_query($konek,"SELECT count(jawaban.jawaban) as jml FROM tabel_soal, jawaban WHERE jawaban.id_kategori =  $id_kategori AND jawaban.id_soal=tabel_soal.id_soal AND jawaban.jawaban=tabel_soal.jawaban_benar AND jawaban.id_user =$d[id_user]");
		$b    = mysqli_fetch_array($jawab);
       	echo "<tr>
	   		 <td width='25'>$no </td>
             <td width='250'>$d[nama_lengkap]</td>
             <td class='left'>$d[jml]</td>
			 <td width='250'>$b[jml]</td>
			 <td><a href='$aksi?module=hasiltest&act=detail&id_user=$d[id_user]' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Detail</a></td></tr>";
      $no++;
    }
    echo "</table>";

break;
case "detail":
//Ambil Kategori Dari Id User
		$user = $_SESSION[kategori];
		//Cari Kategori Pelajaran Dari User INi
		$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
		$k    = mysqli_fetch_array($kategori);
		$id_kategori = $k[id_kategori];
//Ambil Data Untuk Peserta Tes
$nama = $_GET['id_user'];
//Cari Nama Dengan Id User
$peserta=mysqli_query($konek,"SELECT * FROM users WHERE id_user = $nama");
$n    = mysqli_fetch_array($peserta);
  echo "<div class='page-header'>
        <h1>Detail Hasil Test</h1>
		<p>Data Hasil Test Atas Nama <b>$n[nama_lengkap]</b></p>
      	</div>";

//Tampilkan Data Hasil Test
$detail=mysqli_query($konek,"SELECT * FROM tabel_soal, jawaban, users WHERE jawaban.id_user=users.id_user AND jawaban.id_soal=tabel_soal.id_soal AND jawaban.id_kategori = $id_kategori AND jawaban.id_user = $nama ORDER BY jawaban.id_soal");
	echo "<table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
		  <th>Pertanyaan</th>
		  <th>Jawaban Peserta</th>
		  <th>Jawaban Benar</th></tr>
		  </thead><tbody>";
	$no=1;
    while($d=mysqli_fetch_array($detail)){
    echo "<tr>
	   		 <td width='25'>$no </td>
             <td width='550'>$d[pertanyaan]</td>
             <td>$d[jawaban]</td>
			<td>$d[jawaban_benar]</td></tr>";
    $no++;
    }
    echo "</table>";
//Hitung Jumlah Jawaban Benar
$user = $_SESSION[kategori];
		//Cari Kategori Pelajaran Dari User INi
		$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
		$k    = mysqli_fetch_array($kategori);
		$id_kategori = $k[id_kategori];
$nama = $_GET['id_user'];
$jawab= mysqli_query($konek,"SELECT count(jawaban.jawaban) as jml FROM tabel_soal, jawaban WHERE jawaban.id_kategori =  $id_kategori AND jawaban.id_soal=tabel_soal.id_soal AND jawaban.jawaban=tabel_soal.jawaban_benar AND jawaban.id_user =$nama");
		while($b = mysqli_fetch_array($jawab))
		{
		//Hitung Pertanyaan Yang Di Jawab
		$terjawab=mysqli_query($konek,"SELECT * FROM jawaban WHERE id_kategori =  $id_kategori AND id_user =$nama");
		$t = mysqli_num_rows($terjawab);
		//Hitung Jumlah Jawaban Yang Salah
		$salah = $t - $b['jml'];
		//Tampilkan Jumlah Jawaban Benar
		echo "<div class='form-group row'>
			  <div class='col-sm-1'></div>
			  <div class='col-sm-2'> <h2>Benar : $b[jml]</h2></div>";
		//Tampilkan Jumlah PErtanyaan Yang Salah Menjawab
		echo "<div class='col-sm-2'> <h2>Salah: $salah</h2></div>";
    //Eksport ke excel
    echo "<p><input type=button class='btn btn-sm btn-primary'  value='Export Data Excel' onclick=\"window.location.href='cekcek.php';\"></p>";
		}
		echo"</div>";
	}
}
?>
