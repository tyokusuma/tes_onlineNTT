<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='page-header'>
        <h1>Kategori</h1>
      	</div>
	  	<div class='row'>
        <div class='col-md-10'>
         <p> <input type=button class='btn btn-sm btn-primary' value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\"></p>
         <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
		  <th>Nama Kategori</th>
		  <th>Nama User Hak Akses</th>
		  <th>Aktif</th>
		  <th>Aksi</th></tr></thead><tbody>";
    $tampil=mysqli_query($konek, "SELECT * FROM kategori,users WHERE kategori.id_user = users.id_user ORDER BY kategori.id_kategori DESC");
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nama_kategori]</td>
			 <td>$r[nama_lengkap]</td>
			 <td>$r[aktif]</td>
             <td><a href='?module=kategori&act=editkategori&id=$r[id_kategori]' class='btn btn-sm btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Edit</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    echo "<div id=paging>*) Data pada Kategori tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kategori.</div><br></div></div>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<div class='page-header'>
       	<h1>Tambah Kategori</h1>
      	</div>
	  	<div class='container'>
		  <form method=POST class='form' action='$aksi?module=kategori&act=input'>
		  <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='nama_kategori'  class='form-control'  placeholder='Masukkan Nama Kategori'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Username</label>
              <div class='col-sm-2'><select class='form-control' name='username'>"; 
         	 $tampil=mysqli_query($konek,"SELECT * FROM users WHERE level ='guru' ORDER BY username");
          	if ($r[username]==0){
           	 echo "<option value=0 selected>- Pilih Username -</option>";
          	}   
          	while($w=mysqli_fetch_array($tampil)){
             if ($r[username]==$w[username]){
              echo "<option value=$w[id_user] selected>$w[nama_lengkap]</option>";
            }
            else{
              echo "<option value=$w[id_user]>$w[nama_lengkap]</option>";
            }
          }
    echo "</select></div></div>
            <div class='form-group row'>
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form>
          </div></div>";
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysqli_query($konek,"SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
	 echo "<div class='page-header'>
       	<h1>Edit Kategori</h1>
      	</div>
	  	<div class='container'>
		  <form method=POST action='$aksi?module=kategori&act=update'>
		  <input type=hidden name=id value='$r[id_kategori]'>
		  <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Menu</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_kategori' value='$r[nama_kategori]'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Username</label>
              <div class='col-sm-2'><select class='form-control'name='id_user'>"; 
          $tampil=mysqli_query($konek,"SELECT * FROM users WHERE level ='guru' ORDER BY username");
          if ($r[username]==0){
            echo "<option value=0 selected>- Pilih Username -</option>";
          }   
          	while($w=mysqli_fetch_array($tampil)){
             if ($r[id_user]==$w[id_user]){
              echo "<option value=$w[id_user] selected>$w[nama_lengkap]</option>";
            }
            else{
              echo "<option value=$w[id_user]>$w[nama_lengkap]</option>";
            }
          }
    echo "</select></div></div>
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
			 <label class='col-sm-2 col-form-label'></label>
				              <div class='offset-sm-2 col-sm-4'>
                <button type='submit' class='btn btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Simpan</button> | 
				<button type='reset' onclick=self.history.back() class='btn btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Batal</button>
              </div>
            </div>
          </form>
          </div>";

    break;  
}
}
?>
