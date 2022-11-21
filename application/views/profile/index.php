<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Profile Pengguna</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('profile'); ?>">Profile Pengguna</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-6">

            <div class="card">
              <div class="card-header">
                <h5>Detail Pengguna</h5>
              </div>

              <div class="card-body">

                <div class="table-responsive col-sm-12">
                  <table class="table table-borderless">
                    <tr>
                      <th width="15%">Nama Lengkap</th>
                      <th width="5%">:</th>
                      <td><?= $getUser->nama_user ?></td>
                    </tr>
                    <tr>
                      <th>Role</th>
                      <th width="5%">:</th>
                      <td><?= $getUser->nama_role ?></td>
                    </tr>
                    <tr>
                      <th>Username</th>
                      <th width="5%">:</th>
                      <td><?= $getUser->username ?></td>
                    </tr>
                    <tr>
                      <th>Status Akun</th>
                      <th width="5%">:</th>
                      <?php if ($getUser->status_user=="1") { ?>
                        <td><span class="badge badge-success">Active</span></td>
                      <?php } else { ?>
                        <td><span class="badge badge-danger">Inactive</span></td>
                      <?php } ?>
                    </tr>
                  </table>
                </div>

              </div>

              <div id="profile" class="modal-footer">
                <button class="ganti_password btn btn-secondary" data-id_user='<?= userdata('id_user'); ?>'><i class="feather icon-settings m-r-5"></i>Ganti Password</button>
                <button class="edit_profile btn btn-primary" data-id_user='<?= userdata('id_user'); ?>'><i class="feather fa fa-pen-to-square m-r-5"></i>Edit Profile</button>
              </div>

            </div>

          </div>

          <?php if ($getUser->role=="3") { ?>

            <div class="col-lg-6">

              <div class="card">
                <div class="card-header">
                  <h5>Aktivitas</h5>
                </div>

                <div class="card-body">

                  <div class="card-body">
                    <h5 class="mb-3">kWh Meter</h5>
                    <h2><?php echo $total_kwh_now ?><span class="text-muted m-l-10 f-14">Laporan kWh Bulan ini</span></h2>
                    <div class="row">
                      <div class="col col-auto">
                        <div class="map-area">
                          <h6 class="m-0 text-info"><span><?php echo $total_kwh ?></span></h6>
                          <p class="text-muted m-0">Total Keseluruhan</p>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>

            </div>

          <?php } else { ?>
          <?php } ?>

        </div>

        <div class="row">

          <?php if ($getUser->status_userdata=="1") { ?>

            <div class="col-lg-12">

              <div class="card">
                <div class="card-header">
                  <h5>Data Pengguna</h5>
                </div>

                <div class="card-body">

                  <div class="table-responsive col-sm-12">
                    <table class="table table-borderless">
                      <tr>
                        <th width="15%">NIK</th>
                        <th width="5%">:</th>
                        <td><?= $getUserData->nik ?></td>
                      </tr>
                      <tr>
                        <th>Tempat Lahir</th>
                        <th width="5%">:</th>
                        <td><?= $getUserData->tempat_lahir ?></td>
                      </tr>
                      <tr>
                        <th>Tanggal Lahir</th>
                        <th width="5%">:</th>
                        <td><?= $getUserData->tanggal_lahir ?></td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <th width="5%">:</th>
                        <td><?= $getUserData->email ?></td>
                      </tr>
                      <tr>
                        <th>No. HP</th>
                        <th width="5%">:</th>
                        <td><?= $getUserData->no_hp ?></td>
                      </tr>

                      <tr>
                        <th>KTP</th>
                        <th width="5%">:</th>
                        <td><a href="<?= base_url('assets/file/'.$getUserData->ktp) ?>" target="_blank">
                          <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $getUserData->ktp ?>
                        </a></td>
                      </tr>

                      <tr>
                        <th>Ijazah</th>
                        <th width="5%">:</th>
                        <td><a href="<?= base_url('assets/file/'.$getUserData->ijazah) ?>" target="_blank">
                          <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $getUserData->ijazah ?>
                        </a></td>
                      </tr>

                      <tr>
                        <th>Kartu Keluarga</th>
                        <th width="5%">:</th>
                        <td><a href="<?= base_url('assets/file/'.$getUserData->kk) ?>" target="_blank">
                          <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $getUserData->kk ?>
                        </a></td>
                      </tr>

                    </table>
                  </div>

                </div>
              </div>

            </div>

          <?php } else { ?>
          <?php } ?>

        </div>

      </section>


    </div>
  </div>

  <script type="text/javascript">
          /*Modal Ganti Password*/
    $('#profile').on('click', '.ganti_password', function(e) {
      e.preventDefault();

      var id_user = $(this).data('id_user');

      $.ajax({
        url: "<?= site_url('home/modal_ganti_password')?>",
        method: "POST",
        data: {id_user: id_user},

        beforeSend: ()=> {
          Swal.fire({
            title : 'Menunggu',
            html : 'Memproses data',
            didOpen: () => {
              Swal.showLoading()
            }
          })
        },

        success: (data)=> {
          Swal.close();
          $('#modal_ganti_password').modal('show');
          $('#isimodal').html(data);
        },

        error: (req, status, error)=> {
          Swal.fire({
            icon: 'error',
            title: `Gagal ${req.status}`,
            text: `Silahkan Coba Lagi`,
            timer: 1500
          })
        },
      })

    })
  </script>


  <!-- Modal Edit Profile -->
  <div class="modal fade show" id="modal_edit_profile" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div id="isimodaleditprofile"></div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
          /*Modal Edit Profile*/
    $('#profile').on('click', '.edit_profile', function(e) {
      e.preventDefault();

      var id_user = $(this).data('id_user');

      $.ajax({
        url: "<?= site_url('profile/modal_edit_profile')?>",
        method: "POST",
        data: {id_user: id_user},

        beforeSend: ()=> {
          Swal.fire({
            title : 'Menunggu',
            html : 'Memproses data',
            didOpen: () => {
              Swal.showLoading()
            }
          })
        },

        success: (data)=> {
          Swal.close();
          $('#modal_edit_profile').modal('show');
          $('#isimodaleditprofile').html(data);
        },

        error: (req, status, error)=> {
          Swal.fire({
            icon: 'error',
            title: `Gagal ${req.status}`,
            text: `Silahkan Coba Lagi`,
            timer: 1500
          })
        },
      })

    })
  </script>