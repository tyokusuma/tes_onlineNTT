<?php

session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysqli_query($konek,"SELECT * FROM users ORDER BY username");
      echo "<div class='page-header'>
        <h1>Setting User Admin, Guru dan Siswa</h1>
      	</div>
		<div class='row'>
        <div class='col-md-10'>
         <p><input type=button class='btn btn-sm btn-primary'  value='Tambah User' onclick=\"window.location.href='?module=user&act=tambahuser';\"></p>
         <p><input type=button class='btn btn-sm btn-primary'  value='Export Data Excel' onclick=\"window.location.href='cekcek.php';\"></p>";

    }
    else{
      $tampil=mysqli_query($konek,"SELECT * FROM users WHERE username='$_SESSION[namauser]'");
      echo "<div class='page-header'>
        <h1>User</h1>
      	</div>
		<div class='row'>
        <div class='col-md-10'>";
    }

    echo " <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>
          <th>No</th>
          <th>username</th>
          <th>nama lengkap</th>
          <th>email</th>
          <th>Jabatan</th>
          <th>aksi</th>
          </tr></thead> ";
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
		         <td><a href=mailto:$r[email]>$r[email]</a></td>
		         <td class='center'>$r[jabatan]</td>
             <td class='center' width='150'><a href='?module=user&act=edituser&id=$r[id_user]' class='btn btn-sm btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Edit</a></td></tr>";
      $no++;
    }
    echo "</table>
	</div></div>";
    break;

  case "tambahuser":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='page-header'>
       	<h1>Tambah User Untuk Penguji dan Peserta Tes</h1>
      	</div>
	  	<div class='container'>
		<form method=POST action='$aksi?module=user&act=input'>
         <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Username</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='username' placeholder='Masukkan Username'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Password</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='password' placeholder='Masukkan Password'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Lengkap</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_lengkap' placeholder='Masukkan Nama Lengkap'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Email</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='email' placeholder='Masukkan Alamat Email'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Jabatan</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='jabatan' placeholder='Masukkan Jabatan User'>
              </div>
         </div>
		<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilih Level</label>
              <div class='col-sm-2'>
			  <select  class='form-control'  name='level'><option value='siswa'/>Siswa<option value='guru'/>Guru</select>              </div>
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
    }
    else{
      echo "Anda tidak berhak mengakses halaman ini.";
    }
     break;

  case "edituser":
    $edit=mysqli_query($konek,"SELECT * FROM users WHERE id_user='$_GET[id]'");
    $r=mysqli_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
	echo "<div class='page-header'>
       	<h1>Edit User</h1>
      	</div>
	  	<div class='container'>
		<form method=POST action=$aksi?module=user&act=update>
		<input type=hidden name=id value='$r[id_user]'>
         <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Username</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='username' value='$r[username]' disabled>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Password</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='password'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Lengkap</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_lengkap' value='$r[nama_lengkap]'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Email</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='email' value='$r[email]'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Jabatan</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='jabatan' value='$r[jabatan]'>
              </div>
         </div>
		<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Pilih Level</label>
              <div class='col-sm-2'>";
			if ($r[level]=='admin'){
			echo"<select class='form-control' name='level'><option value='admin'/>Admin<option value='guru'/>Guru<option value='siswa'/>Siswa</select>";
			}
			elseif ($r[level]=='guru'){
			echo"<select class='form-control' name='level'><option value='guru'/>Guru<option value='admin'/>Admin<option value='siswa'/>Siswa</select>";
			}
			else{
			echo"<select name='level'><option value='siswa'/>Siswa<option value='admin'/>Admin<option value='guru'/>Guru</select>";
			}
          echo"</select>              </div>
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
           }
		   else{
	echo "<div class='page-header'>
       	<h1>Edit User</h1>
      	</div>
	  	<div class='container'>
		<form method=POST action=$aksi?module=user&act=update>
		<input type=hidden name=id value='$r[id_user]'>
         <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Username</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='username' value='$r[username]' disabled>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Password</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='password'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Lengkap</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='nama_lengkap' value='$r[nama_lengkap]'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Email</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='email' value='$r[email]'>
              </div>
         </div>
		 <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Nama Jabatan</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control' name='jabatan' value='$r[jabatan]'>
              </div>
         </div>
		 		 <div class='form-group row'>
                 <div class='col-sm-6'>
                *) Apabila password tidak diubah, dikosongkan saja.<br />
                **) Username tidak bisa diubah.
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
    }
    break;
}
}
?>
