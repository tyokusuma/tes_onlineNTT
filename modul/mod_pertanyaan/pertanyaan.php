<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_pertanyaan/aksi_pertanyaan.php";
switch($_GET[act]){
  // Tampil Pertanyaan Khusus Untuk Level User Admin.
  default:
  if ($_SESSION[leveluser]=='guru'){
  echo "<div class='page-header'>
        <h1>Daftar Pertanyaan</h1>
		<p>Tampilkan Semua Pertanyaan Untuk <b>$_SESSION[jabatan]</p>
      	</div>
		<div class='row'>
        <div class='col-md-10'>
        <p><button type='reset' onclick=\"window.location.href='?module=pertanyaan&act=tambahpertanyaan';\" class='btn btn-primary'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Tambah Soal</button></p>
		</div>
		<div class='col-md-2'>
		<p><button type='reset' onclick=\"window.location.href='?module=pertanyaan&act=importpertanyaan';\" class='btn btn-info'><span class='glyphicon glyphicon-import' aria-hidden='true'></span> Import Soal</button></p>
        </div>
         <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th width = 50>No</th>
          <th>Pertanyaan</th>
		  <th width = 130>Jawaban Benar</th>
          <th width = 170>Aksi</th></tr></thead><tbody>";
      //Membuat Btasan Tampilan Per Halaman
  	$batas   = 10; //Batasan Berapa Record Yang Akan Ditampilkan Per Halaman
	$halaman = $_GET['halaman'];
	if(empty($halaman)){
		$posisi=0;
		$halaman=1;
	}
	else{
	$posisi = ($halaman-1) * $batas;
	}
	$user = $_SESSION[kategori];
	$kategori=mysqli_query($konek, "SELECT * FROM kategori WHERE id_user = $user");
	$k    = mysqli_fetch_array($kategori);
	$id_kategori = $k[id_kategori];
	//Ambil Data Dari Data Soal      
    $tampil=mysqli_query($konek,"SELECT * FROM tabel_soal WHERE id_kategori = $id_kategori ORDER BY id_soal ASC LIMIT $posisi, $batas");
    $no=$posisi+1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[pertanyaan]</td>
			 <td>$r[jawaban_benar]</td>
			 <td><a href='?module=pertanyaan&act=editpertanyaan&id=$r[id_soal]' class='btn btn-sm btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Edit</a> | 
			 <a href='$aksi?module=pertanyaan&act=hapus&id=$r[id_soal]' class='btn btn-sm btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus</a></td>
			 </tr>";
      $no++;
    }
    echo "</tbody></table>";
 //Hitung total data dan halaman serta link 1,2,3 ...
		echo "<br>Halaman : ";
		$tampil2="select * from tabel_soal WHERE id_kategori = $id_kategori";
		$hasil2=mysqli_query($tampil2);
		$jmldata=mysqli_num_rows($hasil2);
		$jmlhalaman=ceil($jmldata/$batas);		
		for($i=1;$i<=$jmlhalaman;$i++)
		if ($i != $halaman)
		{
		echo " <a href=$_SERVER[PHP_SELF]?module=pertanyaan&halaman=$i>$i</a> | ";
		}
		else
		{
		echo " <b>$i</b> | ";
		}
		echo"</div></div></br>";
    }
    else{
	//Jika Level User Bukan Admin Tampilkan Halaman Ini
      echo "<header><h2>Anda Tidak Berhak Mengakses Halaman Ini !</h2></header>";
    }
    
	break;
  
  // Form Tambah Pertanyaan
  case "tambahpertanyaan":
  	$user = $_SESSION[kategori];
	$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
	$k    = mysqli_fetch_array($kategori);
	$id_kategori = $k[id_kategori];
	echo "<div class='page-header'>
       	<h1>Tambah Pertanyaan</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action=$aksi?module=pertanyaan&act=input>
		  <input type=hidden name=id_kategori value='$id_kategori'>
           <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pertanyaan</label>
              <div class='col-sm-6'>
                <textarea name='pertanyaan'  class='form-control'></textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan A </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_a' placeholder='Jawaban Untuk Pilihan A'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan B </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_b' placeholder='Jawaban Untuk Pilihan B'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan C </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_c' placeholder='Jawaban Untuk Pilihan C'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan D </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_d' placeholder='Jawaban Untuk Pilihan D'>
              </div>
            </div>
				

		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Jawaban Benar</label>
              <div class='col-sm-2'>
          <select class='form-control' name='jawaban_benar'>";		  
		  echo"<option value=0 selected>- Pilih Jawaban -</option>
		        <option value=A> A </option>
				<option value=B> B </option>
				<option value=C> C </option>
				<option value=D> D </option>";
	
		  echo"</select>
          </div> </div>
		 <div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form></div>";
     break;
  
  // Form Edit Pertanyaan
  case "editpertanyaan":
    $edit=mysqli_query($konek,"SELECT * FROM tabel_soal WHERE id_soal='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	
	$user = $_SESSION['kategori'];
	$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
	$k    = mysqli_fetch_array($kategori);
	$id_kategori = $k['id_kategori'];
	echo "<div class='page-header'>
       	<h1>Edit Pertanyaan</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action=$aksi?module=pertanyaan&act=update>
          <input type=hidden name=id value='$r[id_soal]'>
		  <input type=hidden name=id_kategori value='$id_kategori'>
           <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pertanyaan</label>
              <div class='col-sm-6'>
                <textarea name='pertanyaan'  class='form-control'>$r[pertanyaan]</textarea>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan A </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_a' value='$r[pilihan_a]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan B </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_b' value='$r[pilihan_b]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan C </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_c' value='$r[pilihan_c]''>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilihan D </label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='pilihan_d' value='$r[pilihan_d]'>
              </div>
            </div>
				

		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Jawaban Benar</label>
              <div class='col-sm-2'>
			  <select class='form-control' name='jawaban_benar'>";
		  if ($r['jawaban_benar']==''){
		  echo"<option value=0 selected>- Pilih Jawaban -</option>
		        <option value=A> A </option>
				<option value=B> B </option>
				<option value=C> C </option>
				<option value=D> D </option>";
		  }
          else{
          echo "<option value=$r[jawaban_benar]>$r[jawaban_benar]</option>
		  		<option value=A> A </option>
				<option value=B> B </option>
				<option value=C> C </option>
				<option value=D> D </option>";
          }
		  echo"
		  </select>
          
          </div> </div>
		 <div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form></div>";
	
	

    
    break;  
	
	 // Form Tambah Pertanyaan
  case "importpertanyaan":
  	$user = $_SESSION[kategori];
	$kategori=mysqli_query($konek,"SELECT * FROM kategori WHERE id_user = $user");
	$k    = mysqli_fetch_array($kategori);
	$id_kategori = $k[id_kategori];
	echo "<div class='page-header'>
       	<h1>Import Pertanyaan</h1><p>Import Pertanyaan Dari <b>Data Eksternal</b>
      	</div>
	  	<div class='container'>
		<form  method='post' enctype='multipart/form-data' action='$aksi?module=pertanyaan&act=import'>
	<input type=hidden name=id_kategori value='$id_kategori'>
    <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Upload Data</label>
              <div class='col-sm-2'>
		  		<input name='userfile' type='file' />
              </div>  
	</div>
	<div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form></div> ";
     break;
}
}
?>
