<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<title>kWh Meter - ATP</title>
	<link rel="icon" href="<?= base_url('assets/'); ?>img/klhk.png" type="image/png">
</head>

<style type="text/css" media="print">

	@page 
	{
		size:  auto;   /* auto is the initial value */
		margin: 0mm;  /* this affects the margin in the printer settings */
	}

	html
	{
		background-color: #FFFFFF; 
		margin: 0px;  /* this affects the margin on the html before sending to printer */
	}

	body
	{
		margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
	}

</style>

<body>


	<div class="card-body">

		<h3><img height="50px" width="50px" src="<?= base_url('assets/') ?>img/klhk.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			style="opacity: .8">&nbsp;kWh Meter <?= $printPengguna->nama_kmp; ?></h3>
			<table id="table_kmpk" class="table align-items-center table-bordered table-hover">
				<thead>
					<tr>
						<th>Bulan / Tahun</th>
						<th>Lalu</th>
						<th>Sekarang</th>
						<th>Selisih</th>
						<th>Faktor X</th>
						<th>Jumlah KWH</th>
						<th>Biaya / KWH</th>
						<th>Beban Bulanan</th>
						<th>Biaya Tetap</th>
						<th>Jumlah</th>
					</tr>
				</thead>

				<tbody>

					<?php foreach ($getJenisPrint as $p) : ?>
						<tr>
							<td colspan="10"><?= $p['nama_kmj'] ?> - <?= $p['b_kmj']; ?> Lt.<?= $p['lt_kmj']; ?> <?= $p['r_kmj']; ?></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
							<td style="display: none;"></td>
						</tr>

						<tr>
							<td><?= $p['btahun_kmpk'] ?></td>
							<td><?= ($p['l_kmpk']); ?>
							<?php if ($p['limit_kmpk']>="1") { ?>
								- <span class="badge badge-danger badge-counter"><?= $p['limit_kmpk'] ?></span>
							<?php } else { ?>
							<?php } ?>
						</td>
						<!-- - <span class="badge badge-danger badge-counter"><?= $p['limit_kwh'] ?></span></td>-->
						<td><?= $p['s_kmpk']; ?></td>
						<td><?= $p['se_kmpk']; ?></td>
						<td><?= $p['fx_kmpk']; ?></td>
						<td><?= $p['jk_kmpk']; ?></td>
						<td><?= rupiah($p['bk_kmpk']); ?></td>
						<td><?= rupiah($p['bb_kmpk']); ?></td>
						<td><?= rupiah($p['bt_kmpk']); ?></td>
						<td><?= rupiah($p['j_kmpk']); ?></td>
					</tr>
				<?php endforeach ?>

			</tbody>

		</table>


	</div>

</body>
<label class="form-control-label" for="input-username">Total Jumlah</label>
<input class="form-control text-right" value="<?php echo rupiah($printJumlah); ?>" readonly>

<p>

	<?php if (!empty($printPengguna->foto_kmpk)) { ?>

		<center>
			<label class="form-control-label" for="input-username">Foto kWh Meter <?= $printPengguna->btahun_kmpk; ?></label>
			<div class="row">
				<?php foreach ($getJenisPrint as $p) : ?>
					<th>
						<img height="300px" width="300px" src="<?= base_url('assets/img/kwh/') . $p['foto_kmpk']; ?>" class="img-fluid" alt="Responsive image">
					</th>
				<?php endforeach ?>
			</div></center>

		<?php } else { ?>


		<?php } ?>
		</html>

		<script>
			window.onafterprint = window.close;
			window.print();
		</script>