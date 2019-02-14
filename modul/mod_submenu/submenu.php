<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
        <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_submenu/aksi_submenu.php";
switch($_GET[act]){
  // Tampil Sub Menu
  default:
    echo "<div class='page-header'>
       	 <h1>Sub Menu</h1>
      		</div>
	  		<div class='row'>
        	<div class='col-md-10'>
         	<input type=button class='btn btn-sm btn-primary' value='Tambah Sub Menu' onclick=\"window.location.href='?module=submenu&act=tambahsubmenu';\"></p>
         <table class='table table-bordered'><thead class='thead-inverse'>
		 <tr>          
		  <th>No</th>
          <th>Sub Menu</th>
          <th>Menu Utama</th>
          <th>Link Submenu</th>
          <th>Aktif</th>
		  <th>Aksi</th></tr></thead><tbody>";          

    $tampil = mysqli_query($konek,"SELECT * FROM submenu,mainmenu WHERE submenu.id_main=mainmenu.id_main");
  
    $no = 1;
    while($r=mysqli_fetch_array($tampil)){
	if($r[id_submain]!=0){
		$sub = mysqli_fetch_array(mysqli_query($konek,"SELECT * FROM submenu WHERE id_sub=$r[id_submain]"));
		$mainmenu = $r[nama_menu]." &gt; ".$sub[nama_sub];
	} else {
		$mainmenu = $r[nama_menu];
	}
      echo "<tr><td class='left' width='25'>$no</td>
                <td class='left'>$r[nama_sub]</td>
                <td class='left'>$mainmenu</td>
                <td class='left'>$r[link_sub]</td>
                <td class='center'>$r[aktif]</td>
		        <td><a href=?module=submenu&act=editsubmenu&id=$r[id_sub] class='btn btn-sm btn-info'><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span> Edit</a></a> |
				<a href=$aksi?module=submenu&act=hapus&id=$r[id_sub] class='btn btn-sm btn-warning'><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span> Hapus</a></td>		
		        </tr>";
      $no++;
    }
    echo "</tbody></table>
	</div></div>";
    break;
  
  case "tambahsubmenu":
  echo"<div class='page-header'>
       	<h1>Tambah Sub Menu</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action='$aksi?module=submenu&act=input'>
              <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>NamaSub Menu</label>
              <div class='col-sm-6'>
			   	<input type='text' class='form-control' name='nama_sub'  placeholder='Nama Sub Menu'>
				</div>
			 </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Link Menu</label>
              <div class='col-sm-6'>
                <input type='text' name='link_sub' class='form-control'  placeholder='Masukkan Link Menu'>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Aktif</label>
              <div class='col-sm-2'>
			  <select class='form-control' name='aktif' id='exampleSelect2'><option value='Y'/>Aktif<option value='N'/>Non Aktif</select>
              </div>
            </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Menu Utama</label>
              <div class='col-sm-2'>
			  <select class='form-control' name='menu_utama'><option value=0 selected>- Pilih Menu Utama -</option>";
									 $tampil=mysqli_query($konek,"SELECT * FROM mainmenu WHERE aktif='Y' ORDER BY nama_menu");
									 while($r=mysqli_fetch_array($tampil)){
									  echo "<option value=$r[id_main]>$r[nama_menu]</option>";
									}
									echo "</select>
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
		</div>"; 
    break;
    
  	case "editsubmenu":
    $edit = mysqli_query($konek,"SELECT * FROM submenu WHERE id_sub='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);
	echo"<div class='page-header'>
       	<h1>Tambah Sub Menu</h1>
      	</div>
	  	<div class='container'>
          <form method=POST action=$aksi?module=submenu&act=update>
		  <input type=hidden name=id value=$r[id_sub]>
              <div class='form-group row'>
              <label class='col-sm-2 col-form-label'>NamaSub Menu</label>
              <div class='col-sm-6'>
			   	<input type='text' class='form-control' name='nama_sub' value='$r[nama_sub]'>
				</div>
			 </div>
			<div class='form-group row'>
              <label class='col-sm-2 col-form-label'>Link Menu</label>
              <div class='col-sm-6'>
                <input type='text' class='form-control'  name='link_sub' value='$r[link_sub]''>
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
              <label class='col-sm-2 col-form-label'>Menu Utama</label>
              <div class='col-sm-2'><select class='form-control' name='menu_utama'><option value=0 selected>- Pilih Menu Utama -</option>"; 
          					$tampil=mysqli_query($konek,"SELECT * FROM mainmenu WHERE aktif='Y' ORDER BY nama_menu");
          					if ($r[id_main]==0){
            				echo "<option value=0 selected>- Pilih Menu Utama -</option>";
          					}   
          					while($w=mysqli_fetch_array($tampil)){
             				if ($r[id_main]==$w[id_main]){
              				echo "<option value=$w[id_main] selected>$w[nama_menu]</option>";
            				}
           					 else{
              				echo "<option value=$w[id_main]>$w[nama_menu]</option>";
            				}
          					}
    						echo "</select>
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
		</div>"; 
		
	  
	  break;  
}
}
?>
