<?php  
error_reporting(0);
include 'library.php';

$go = new oop();

$link = "?menu=index";

if (isset($_POST['kode_barang'])) {
	$sql = "SELECT * FROM barang WHERE kode_barang = '$_POST[kode_barang]'";
	$data = mysqli_fetch_array(mysqli_query($con,$sql));

	$harga = $data['harga_awal'];
}

if (@$_POST['diskon']) {
	$sql = "SELECT * FROM barang WHERE kode_barang = '$_POST[kode_barang]'";
	$data = mysqli_fetch_array(mysqli_query($con,$sql));

	$harga = $data['harga_awal'];

	$diskon = @$_POST['hargaawal'] - ($_POST['diskon'] / 100 * @$_POST['hargaawal']);
}

if (isset($_GET['hapus'])) {
	$go->hapus("potongan","kode_potongan = '$_GET[no]'",$link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>UKK</title>
	<link rel="stylesheet" href="css/mains.css">
	<link rel="stylesheet" href="css/fa/css/font-awesome.min.css">

	<style>
		body{
			background: #853863;
			overflow-x: hidden;
		}
	</style>
</head>
<body>
	<form action="" method="post">
	<nav class="navbar-dark bg-dark" style="height: 55px;">
        </nav>
		<br>
		<h1 align="center" style="color: white;"> Form Input Dan Tampil Barang (PT. EINSCIGO)</h1>
		<br>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="tile">
					
					<hr>
					<?php  
					if (isset($_POST['hitung'])) {
						$kode     = $_POST['kode_potongan'];
						$kodeb    = $_POST['kode_barang'];
						$nama     = $_POST['nama_barang'];
						$perid1   = $_POST['peridawal'];
						$perid2   = $_POST['peridakhir'];
						$bdiskon  = $_POST['diskon'];
						$hargadis = $_POST['hardis'];
						$ket      = $_POST['ket'];

						$isi      = "kode_potongan = '$kode', kode_barang = '$kodeb', periode_diskon_mulai = '$perid1', periode_diskon_akhir = '$perid2', besar_diskon = '$bdiskon', harga_setelah_diskon = '$hargadis', keterangan = '$ket'";

						$go->simpan("potongan",$isi,$link);
					}
						
					?>

					<div class="form-group">
						<label for="">Kode Potongan</label>
						<input type="text" name="kode_potongan" class="form-control" readonly value="<?= $go->autokode("potongan","kode_potongan","P") ?>">
					</div>

					<div class="form-group">
						<label for="">Nama Barang</label>
						<select name="kode_barang" id="" class="form-control" onchange="submit()" required>
							<option value="<?= $data['kode_barang'] ?>"><?= @$data['nama_barang'] ?></option>
							<?php  
							$a = $go->tampil("barang");
							$no = 0;
							foreach ($a as $b) {$no++ ?>
							<option value="<?= $b['0']  ?>"><?= $b['1'] ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="form-group">
						<label for="">Harga Barang</label>
						<input type="number" readonly class="form-control" value="<?= $harga ?>" name="hargaawal">
					</div>

					<div class="form-group">
						<label for="">Besar Diskon (%)</label>
						<input type="number" name="diskon" class="form-control" onchange="submit()" value="<?= $_POST['diskon']  ?>" max="100">
					</div>

					<div class="form-group">
						<label for="">Harga Setelah Diskon</label>
						<input type="number" readonly class="form-control" name="hardis" value="<?= $diskon  ?>">
					</div>

					<div class="form-group">
						<label for="">Periode Diskon Awal</label>
						<input type="date" name="peridawal" class="form-control" required>
					</div>

					<div class="form-group">
						<label for="">Periode Diskon Akhir</label>
						<input type="date" name="peridakhir" class="form-control" required>
					</div>

					<div class="form-group">
						<label for="">Keterangan</label>
						<textarea name="ket" id="" cols="15" rows="5" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-danger" type="submit" name="hitung">Submit</button>
					</div>
					
		</div>

				</div>
			</div>

			<div class="col-md-11" style="margin-left: 5%;">
				<div class="tile">
					<h1>Data Barang</h1>
					<hr>

					<table class="table table-bordered" id="data">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Potongan</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Periode Diskon Awal</th>
								<th>Periode Diskon Akhir</th>
								<th>Harga Awal</th>
								<th>Harga Setelah Diskon</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						$no = 0;
						$a = $go->tampil("diskon");
						foreach ($a as $b) { $no++;?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $b['0'] ?></td>
								<td><?= $b['1'] ?></td>
								<td><?= $b['2'] ?></td>
								<td><?= $b['3'] ?></td>
								<td><?= $b['4'] ?></td>
								<td><?= $b['5'] ?></td>
								<td><?= $b['6'] ?></td>
								<td>
									<a onclick="return confirm('Are You Sure?')" href="?menu=index.php&hapus&no=<?= $b['0'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<nav class="navbar-dark bg-dark" style="height: 55px;"">
        </nav>
	</form>
</body>
<?php include 'js.php'; ?>
</html>
<script type="text/javascript">
	$(document).ready(function() {
    	    	$('#dmerek').DataTable();
    		} );
</script>
<script>
	setTimeout(function() {
    $("#alerts").slideToggle();
  }, 12000);
</script>
