<?php
include "config.php";
$sqldata = 'SELECT * FROM tbl_jadwal';
?>
<html>

<head>
	<title>Input Data Masal</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<div class="col-lg-3">
		<h4>Form Data</h4>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="data">
			<input type="submit" name="input" value="INSERT" class="btn btn-primary mt-3">
		</form>
	</div>

	<div class="container">
		<div class="row mt-4">
			<div class="col-lg-12">
				<h4>Data</h4>
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Hari</th>
							<th>Waktu</th>
							<th>Dosen</th>
                            <th>Mata Kuliah</th>
							<th>Ruang</th>
							<th>JJ</th>
							<th>Tahun Ajaran</th>
                            <th>Semester</th>
							
						</tr>

					</thead>
					<tbody>
						<?php
						$run = mysqli_query($koneksi, $sqldata);
						while ($siswa = mysqli_fetch_array($run)) {
							@$no++;
						?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $siswa['hari'] ?></td>
								<td><?= $siswa['waktu'] ?></td>
								<td><?= $siswa['dosen'] ?></td>
                                <td><?= $siswa['mata_kuliah'] ?></td>
								<td><?= $siswa['ruang'] ?></td>
								<td><?= $siswa['jj'] ?></td>
                                <td><?= $siswa['tahun_ajaran'] ?></td>
								<td><?= $siswa['semester'] ?></td>

							</tr>
						<?php
						}
						$no = 1;
						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<script type="text/javascript" src="css/bootstrap.min.js"></script>
</body>

</html>

<?php
if (isset($_POST['input'])) {

	$datanama  =  $_FILES['data']['name'];
	$datatmp   =  $_FILES['data']['tmp_name'];
	$exe       =  pathinfo($datanama, PATHINFO_EXTENSION);
	$folder    = 'file/';

	if ($exe == 'csv') {
		$upload = move_uploaded_file($datatmp, $folder . $datanama);
		if ($upload) {
			$open = fopen($folder . $datanama, 'r');
			while (($row = fgetcsv($open, 1000, ',')) !== FALSE) {
				$sql = mysqli_query($koneksi, "INSERT INTO tbl_jadwal VALUES('','" . $row[0] . "','" . $row[1] . "','" . $row[2] . "')");
			}
		}
	} else {
		echo "Gagal diupload";
	}
} else {
	echo "Bukan File CSV";
}


?>