<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>export jawaban</title>
  </head>
  <body>
    <?php
    	header("Content-type: application/vnd-ms-excel");
    	header("Content-Disposition: attachment; filename=Data siswa.xls");
    	?>
      <table border="1">
		<tr>
			<th>No</th>
			<th>pertanyaan</th>
      <th>jawaban</th>
		</tr>
    <?php
    include "config/koneksi.php";


		// menampilkan data pegawai
		$data = mysqli_query($konek,"SELECT * FROM jawaban WHERE id_kategori =  $id_kategori AND id_user =$nama");
		$no = 1;
		while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['pertanyaan']; ?></td>
      <td><?php echo $d['jawaban_benar']; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
  </body>
</html>
