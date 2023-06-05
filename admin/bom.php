<?php 
include 'header.php';
$kode = $_GET['kode'];
$pr = mysqli_query($conn, "SELECT * FROM produk where kode_produk = '$kode'");
$tam = mysqli_fetch_assoc($pr);
?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Master Produk</b></h2>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Kode Poroduk</th>
					<th scope="col">Nama Produk</th>
					<th scope="col">Image</th>
					<th scope="col">Harga</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$result = mysqli_query($conn, "SELECT * FROM produk");
				$no =1;
				while ($row = mysqli_fetch_assoc($result)) {
				?>
					<tr>
						<td ><?= $no; ?></td>
						<td><?= $row['kode_produk']; ?></td>
						<td><?= $row['nama'];  ?></td>
						<td><img src="../image/produk/<?= $row['image']; ?>" width="100"></td>
						<td>Rp.<?= number_format($row['harga' ]);  ?></td>
						<td><a href="edit_produk.php?kode=<?= $row['kode_produk']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a> <a href="proses/del_produk.php?kode=<?= $row['kode_produk']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> </a></button></td>
					</tr>
				<?php
					$no++; 
					}
				 ?>

				</tbody>
			</table>
		<a href="tm_produk.php" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Produk</a>
	</div>
	<!-- Button trigger modal -->
<button type="hidden" data-toggle="modal" data-target="#myModal" id="btn" style="background-color: #fff; border: #fff;">
</button>
	<!-- Modal -->