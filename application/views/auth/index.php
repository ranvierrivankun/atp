<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">

		<center><img src="<?= base_url('assets/') ?>img/klhk.png" style="width: 70px;height: 70px">
			<h2 class="text-dark h1">APLIKASI - <strong class="text-primary">TP</strong></h2></center>

			<div class="card borderless shadow p-3 mb-5 bg-white rounded">
				<div class="row align-items-center ">
					<div class="col-md-12">

						<div class="card-body">
							<div class="text-center">
								<h5 class="text-dark-50 text-center fw-bold">Aplikasi Teknik Pemeliharaan</h5>
								<h5 class="text-success font-bold">
									Versi 2.0 2022
								</h5>
								<p class="text-muted mb-2">Silahkan Login untuk Melanjutkan</p>
							</div>
							<hr>

							<?= $this->session->flashdata('pesan'); ?>

							<?= form_open('', ['class' => 'user']); ?>

							<div class="form-group mb-3">
								<label class="floating-label" >Username</label>
								<input class="form-control" type="text" id="username" name="username"placeholder="Masukan Username">
								<?= form_error('username', '<small class="valid text-danger pl-1">', '</small>'); ?>
							</div>

							<div class="form-group mb-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password">
								<?= form_error('password', '<small class="valid text-danger pl-1">', '</small>'); ?>
							</div>

							<button class="btn btn-block btn-primary mb-4" type="submit">Login</button>

							<center><strong>&copy; 2021 - <?= date('Y'); ?> Ranvier Rivan</strong>
								<p class="text-muted mb-2">Aplikasi-TP V.2.0</p> </center>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
<!-- [ auth-signin ] end -->