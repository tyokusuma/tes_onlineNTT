<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>export</title>
  </head>
  <body>
    <?php
    	header("Content-type: application/vnd-ms-excel");
    	header("Content-Disposition: attachment; filename=Data siswa.xls");
    	?>
      <table border="1">
		<tr>
			<th>No</th>
			<th>username</th>
      <th>nama lengkap</th>
			<th>jabatan</th>
			<th>email</th>
      <th>level</th>
		</tr>
    <?php
    include "config/koneksi.php";


		// menampilkan data pegawai
		$data = mysqli_query($konek,"select * from users");
		$no = 1;
		while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['username']; ?></td>
      <td><?php echo $d['nama_lengkap']; ?></td>
      <td><?php echo $d['jabatan']; ?></td>
      <td><?php echo $d['email']; ?></td>
      <td><?php echo $d['level']; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
  </body>
</html>
