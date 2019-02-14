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

// Input Pertanyaan
if ($module=='pertanyaan' AND $act=='input'){
$pertanyaan=addslashes($_POST['pertanyaan']);
  mysqli_query($konek, "INSERT INTO tabel_soal(id_kategori,
  									pertanyaan,
                                    pilihan_a,
									pilihan_b,
									pilihan_c,
									pilihan_d,
									jawaban_benar) 
                            VALUES('$_POST[id_kategori]',
	    							'$pertanyaan',
                                   '$_POST[pilihan_a]',
								   '$_POST[pilihan_b]',
								   '$_POST[pilihan_c]',
								   '$_POST[pilihan_d]',
								   '$_POST[jawaban_benar]'
								   )");
  header('location:../../media.php?module='.$module);
}

// Hapus Pertanyaan/Soal
elseif ($module=='pertanyaan' AND $act=='hapus'){
 mysqli_query($konek,"DELETE FROM tabel_soal WHERE id_soal = '$_GET[id]'");
  header('location:../../media.php?module='.$module);
}


// Update Pertanyaan/Soal
elseif ($module=='pertanyaan' AND $act=='update'){
 $pertanyaan=addslashes($_POST['pertanyaan']);
  mysqli_query($konek,"UPDATE tabel_soal SET id_kategori = '$_POST[id_kategori]',
	  								pertanyaan = '$pertanyaan',
									pilihan_a = '$_POST[pilihan_a]',
									pilihan_b = '$_POST[pilihan_b]',
									pilihan_c = '$_POST[pilihan_c]',
									pilihan_d = '$_POST[pilihan_d]',
									jawaban_benar = '$_POST[jawaban_benar]'
									WHERE id_soal = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}


// ImportPertanyaan
elseif ($module=='pertanyaan' AND $act=='import'){
// koneksi ke SQL Server
include "../../config/excel_reader.php";
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
 
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
// membaca data Pertanyaan Pada kolom ke-3)
$pertanyaan = $data->val($i, 3);

// membaca data Pilihan A Yang Ada Pada (kolom ke-4)
$pilihan_a = $data->val($i, 4);

// membaca data Pilihan B Yang Ada Pada (kolom ke-5)
$pilihan_b  = $data->val($i, 5);

// membaca data Pilihan C Yang Ada Pada (kolom ke-6)
$pilihan_c = $data->val($i, 6);

// membaca data Pilihan D Yang Ada Pada (kolom ke-7)
$pilihan_d  = $data->val($i, 7);

// membaca data Pilihan D Yang Ada Pada (kolom ke-8)
$jawaban_benar  = $data->val($i, 8);


  mysqli_query($konek,"INSERT INTO tabel_soal(id_kategori,
  									pertanyaan,
                                    pilihan_a,
									pilihan_b,
									pilihan_c,
									pilihan_d,
									jawaban_benar) 
                            VALUES('$_POST[id_kategori]',
	    							'$pertanyaan',
                                   '$pilihan_a',
								   '$pilihan_b',
								   '$pilihan_c',
								   '$pilihan_d',
								  '$jawaban_benar'
								   )");
  header('location:../../media.php?module='.$module);
}
}
}
?>
