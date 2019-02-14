<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_menuutama/aksi_menuutama.php";
switch($_GET[act]){
  // Tampil Menu Utama Khusus Untuk Level User Admin.
  default:
  if ($_SESSION[leveluser]=='admin'){
  echo "<div class='page-header'>
        <h1>Menu Utama</h1>
      	</div>
	  	<div class='row'>
        <div class='col-md-10'>
         <p><input type=button class='btn btn-sm btn-primary' value='Tambah Menu Utama' 	
		 onclick=\"window.location.href='?module=menuutama&act=tambahmenuutama';\"></p>
         <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
          <th>Menu Utama</th>
          <th>Link</th>
         <th>Aktif</th>
         <th>Level menu</th>
		 <th>Aksi</th></tr></thead><tbody>";
          
    $tampil=mysqli_query($konek, "SELECT * FROM mainmenu");
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td class='center'>$r[nama_menu]</td>
             <td class='center'>$r[link]</td>
             <td class='center'>$r[aktif]</td>
             <td class='center'>$r[levelmenu]</td>
			 <td width=130px><a href='?module=menuutama&act=editmenuutama&id=$r[id_main]' class='btn btn-sm btn-info'>Edit</a> | <a href='$aksi?module=menuutama&act=hapus&id=$r[id_main]' class='btn btn-sm btn-info'></span>Hapus</a></td></tr>";
      $no++;
    }
    echo "</tbody></table>";
	echo "</div></div></div>";
    }
    else{
	//Jika Level User Bukan Admin Tampilkan Halaman Ini
      echo "<header><h2>Anda Tidak Berhak Mengakses Halaman Ini !</h2></header>";
    }
    
	break;
  
  // Form Tambah Menu Utama
  case "tambahmenuutama":
  echo"<div class='page-header'>
       	<h1>Tambah Menu Utama</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action='$aksi?module=menuutama&act=input'>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='nama_menu'  class='form-control'  placeholder='Masukkan Nama Menu'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Link Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='link' class='form-control'  placeholder='Masukkan Nama Menu'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Aktif</label>
              <div class='col-sm-2'>
			  <select class='form-control' name='aktif' id='exampleSelect2'><option value='Y'/>Aktif<option value='N'/>Non Aktif</select>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilih Level Menu</label>
              <div class='col-sm-2'>
			  <select  class='form-control' name='levelmenu'>
									<option value='A'>Admin
									<option value='G'>Guru
									<option value='S'> Siswa</select>
              </div>
            </div>            
            <div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form>
        </div>  		
		</div>";
	  

     break;
  
  // Form Edit Menu Utama
  case "editmenuutama":
    $edit=mysqli_query($konek,"SELECT * FROM mainmenu WHERE id_main='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	echo"<div class='page-header'>
       	<h1>Edit Menu Utama</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action=$aksi?module=menuutama&act=update>
		  <input type=hidden name=id value=$r[id_main]>
            <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='nama_menu'  class='form-control' value='$r[nama_menu]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Link Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='link' class='form-control'  value='$r[link]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Aktif</label>
              <div class='col-sm-2'>";
			if ($r[aktif]=='Y'){
			echo"<select class='form-control' name='aktif'><option value='Y'/>Aktif<option value='N'/>Non Aktif</select>";
			}else{
			echo"<select class='form-control' name='aktif'><option value='N'/>Non Aktif<option value='Y'/>Aktif</select>";
			}
          echo"</div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilih Level Menu</label>
              <div class='col-sm-2'>";
			if ($r[levelmenu]=='A'){
			echo"<select class='form-control' name='levelmenu'><option value='A'/>Admin<option value='G'/>Guru<option value='S'/>Siswa</select>";
			}
			elseif ($r[levelmenu]=='G'){
			echo"<select class='form-control' name='levelmenu'><option value='G'/>Guru<option value='A'/>Admin<option value='S'/>Siswa</select>";
			}
			else{
			echo"<select class='form-control' name='levelmenu'><option value='S'/>Siswa<option value='A'/>Admin<option value='G'/>Guru</select>";
			}
          echo"</div>
            </div>            
            <div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form>
        </div>  		
		</div>";

    
    break;  
}
}
?>
