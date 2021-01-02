<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Penduduk Indonesia</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-print-1.6.5/r-2.2.6/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
 

</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
	<div class="container">
		<a class="navbar-brand" href="#">JMC</a>
		<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavId">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url('Penduduk')?>">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('Penduduk/laporan')?>">Laporan</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="container mt-4">
	<?= $this->session->flashdata('pesanSP'); ?>
	<div class="row">
		<h4>Input Provinsi</h4>
		<div class="col-sm-6">
			<?= $this->session->flashdata('pesanP'); ?>
			<form action="<?= base_url('Penduduk/input_prov')?>" method="post">
				<div class="form-group">
					<label for="">Provinsi</label>
					<input type="text"
						class="form-control" name="provinsi" id="" aria-describedby="helpId" placeholder="Nama Provinsi" value="<?= set_value('provinsi')?>" required>
					<?= form_error('provinsi', '<small class="text-danger form-text text-muted">', '</small>'); ?>
				</div>
				<button type="submit" class="btn btn-success mt-2">Submit</button>
			</form>			
		</div>
		<div class="col-sm-6">
			<?= $this->session->flashdata('pesanHP'); ?>
			<table class="table"  id="tableProv" class="display" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th style="display:none;">No</th>
						<th>Provinsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 0;
						foreach ($provinsi as $row ):
						 $i++;
					?>
					<tr>
						<td scope="row"><?= $i?></td>
						<td style="display:none;"><?= $row['id'] ?></td>
						<td><?= $row['nama_provinsi'] ?></td>
						<td>
							<div class="d-grid gap-2 d-md-block">
								<button class="btn btn-sm btn-primary Psunting" type="button" data-bs-toggle="modal" data-bs-target="#modalSuntingP">Sunting</button>
								<button class="btn btn-sm btn-danger Phapus" type="button" data-bs-toggle="modal" data-bs-target="#hapusModalP">Hapus</button>
							</div>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="container mt-4">
	<?= $this->session->flashdata('pesanSK'); ?>
	<div class="row">
		<h4>Input Kabupaten dan Penduduk</h4>
		<div class="col-sm-6">
			<?= $this->session->flashdata('pesanK'); ?>
			<form action="<?= base_url('Penduduk/input_kab')?>" method="post">
				<div class="form-group">
					<label for="">Kabupaten</label>
					<input type="text"
						class="form-control" name="kabupaten" id="" aria-describedby="helpId" placeholder="Nama Kabupaten" required  value="<?= set_value('kabupaten')?>">
				</div>
				<div class="form-group">
					<label for="">Provinsi</label>
					<select name="provinsi" class="form-select" aria-label="Default select example" required>
						<option value="" selected>Pilih Provinsi</option>
						<?php foreach ($provinsi as $row ):?>
						<option value="<?= $row['id'] ?>" <?php echo  set_select('pilih_prov', $row['id']); ?>><?= $row['nama_provinsi'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Penduduk</label>
					<input type="text"
						class="form-control" name="penduduk" id="penduduk" aria-describedby="helpId" placeholder="masukkan jumlah penduduk" required  value="<?= set_value('penduduk')?>">
					<?= form_error('penduduk', '<small class="text-danger form-text text-muted">', '</small>'); ?>
				</div>
				<button type="submit" class="btn btn-success mt-2">Submit</button>
			</form>			
		</div>
		<div class="col-sm-6">
			<?= $this->session->flashdata('pesanH'); ?>
			<table class="table" id="tableKab" class="display" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Provinsi</th>
						<th style="display:none;">Provinsi</th>
						<th style="display:none;">Provinsi</th>
						<th>Kabupaten</th>
						<th>Penduduk</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 0;
						foreach ($kabupaten as $row ):
						 $i++;
					?>
					<tr>
						<td scope="row"><?= $i ?></td>
						<td><?= $row['nama_provinsi'] ?></td>
						<td style="display:none;"><?= $row['id'] ?></td>
						<td style="display:none;"><?= $row['idKab'] ?></td>
						<td><?= $row['nama_kabupaten'] ?></td>
						<td><?= $row['jumlah_penduduk'] ?></td>
						<td>
							<div class="d-grid gap-2 d-md-block">
								<button class="btn btn-sm btn-primary Ksunting" type="button" data-bs-toggle="modal" data-bs-target="#modalSuntingK">Sunting</button>
								<button class="btn btn-sm btn-danger Khapus" type="button" data-bs-toggle="modal" data-bs-target="#hapusModal">Hapus</button>
							</div>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Hapus Prov -->
<div class="modal fade" id="hapusModalP" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusModalLabel">Hapus Provinsi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
				<tbody>
					<tr>
						<td id="Hprovinsi"></td>
					</tr>
				</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="" id="hapusB"  type="button" class="btn btn-primary">Save changes</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Hapus Kab -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusModalLabel">Hapus Kabupaten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
				<tbody>
					<tr>
						<td id="Skabupaten"></td>
						<td id="Sprovinsi"></td>
						<td id="Spenduduk"></td>
					</tr>
				</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="" id="hapusBK"  type="button" class="btn btn-primary">Save changes</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Sunting Penduduk-->
<div class="modal fade" id="modalSuntingK" tabindex="-1" aria-labelledby="modalSuntingK" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSuntingKtitle">Sunting Penduduk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form id="formSuntingPenduduk" action="<?= base_url('Penduduk/sunting_kab')?>" method="post">
		<input class="form-control" type="hidden" id="Kid" name="Kid" value="<?= set_value('Kid')?>">
			<div class="form-group">
				<label for="">Kabupaten</label>
				<input type="text"
					class="form-control" name="Kkabupaten" id="Kkabupaten" aria-describedby="helpId" placeholder="Nama Kabupaten" required  value="<?= set_value('Kkabupaten')?>">
			</div>
			<div class="form-group">
				<label for="">Provinsi</label>
				<select id="Kprovinsi" name="Kprovinsi" class="form-select" aria-label="Default select example" required>
					<option value="0" selected="selected">Pilih Provinsi</option>
					<?php foreach ($provinsi as $row ):?>
					<option value="<?= $row['id'] ?>" <?php echo  set_select('pilih_prov', $row['id']); ?>><?= $row['nama_provinsi'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label for="">Penduduk</label>
				<input  type="text"
					class="form-control" name="Kpenduduk" id="Kpenduduk" aria-describedby="helpId" placeholder="masukkan jumlah penduduk" required  value="<?= set_value('Kpenduduk')?>">
				<?= form_error('penduduk', '<small class="text-danger form-text text-muted">', '</small>'); ?>
			</div>
			<!-- <button type="submit" class="btn btn-success mt-2">Submit</button> -->
		</form>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="formSuntingPenduduk">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Sunting Provinsi-->
<div class="modal fade" id="modalSuntingP" tabindex="-1" aria-labelledby="modalSuntingP" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSuntingPtitle">Sunting Provinsi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		<form id="formSuntingProvinsi" action="<?= base_url('Penduduk/sunting_prov')?>" method="post">
		<input class="form-control" type="hidden" id="Pid" name="Pid" value="<?= set_value('Pid')?>">
			<div class="form-group">
				<label for="">Provinsi</label>
				<input type="text"
					class="form-control" name="Pprovinsi" id="Pprovinsi" aria-describedby="helpId" placeholder="Nama provinsi" required  value="<?= set_value('Pprovinsi')?>">
			</div>			
		</form>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="formSuntingProvinsi">Save changes</button>
      </div>
    </div>
  </div>
</div>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/r-2.2.6/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>	
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script> -->

<script>
	$('#tableKab').DataTable({
		dom: 'Bfrtip',
		buttons: [
        'copy','pdf','csv'
    ]
	});
	$('#tableProv').DataTable();
	// aksi penduduk
	$('.Ksunting').on("click",  function () {

		$tr = $(this).closest('tr');
		var data = $tr.children('td').map(function(){
			return $(this).text();
		});
		console.log(data);
		$('#Kid').val(data[3]);
		$('#Kkabupaten').val(data[4]);
		$('#Kprovinsi').val(data[2]);
		$('#Kpenduduk').val(data[5]);
	});

	$('.Khapus').on("click",  function () {

		$tr = $(this).closest('tr');
		var data = $tr.children('td').map(function(){
			return $(this).text();
		});
		console.log("cek hapus");
		$('#Skabupaten').text(data[4]);
		$('#Sprovinsi').text(data[2]);
		$('#Spenduduk').text(data[5]);
		$("#hapusBK").attr('href', '<?= base_url('penduduk/hapus_kab/') ?>' + data[3]);
	});

	// aksi provinsi
	$('.Psunting').on("click",  function () {

		$tr = $(this).closest('tr');
		var data = $tr.children('td').map(function(){
			return $(this).text();
		});
		// console.log(data);
		$('#Pid').val(data[1]);
		$('#Pprovinsi').val(data[2]);
	});

	$('.Phapus').on("click",  function () {

		$tr = $(this).closest('tr');
		var data = $tr.children('td').map(function(){
			return $(this).text();
		});
		console.log(data);
		$('#Pid').val(data[1]);
		$('#Hprovinsi').text(data[2]);
		$("#hapusB").attr('href', '<?= base_url('penduduk/hapus_prov/') ?>' + data[1]);
	});
</script>
<script>
	
</script>
</body>
</html>