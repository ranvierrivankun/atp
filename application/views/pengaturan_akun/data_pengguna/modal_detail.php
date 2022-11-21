<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-body{
    height: 140;
    overflow-y: auto;
}
</style>

<div class="modal-header">

    <h5 class="modal-title" id="exampleModalLabel">Detail Data Pengguna</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>

<div class="modal-body edit-body">

    <div class="row">
        <div class="table-responsive col-sm-12">
            <table class="table table-borderless">
                <tr>
                    <th width="15%">Nama Lengkap</th>
                    <th width="5%">:</th>
                    <td><?= $where->nama_user ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <th width="5%">:</th>
                    <td><?= $where->nama_role ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <th width="5%">:</th>
                    <td><?= $where->username ?></td>
                </tr>
                <tr>
                    <th>Status Akun</th>
                    <th width="5%">:</th>
                    <?php if ($where->status_user=="1") { ?>
                        <td><span class="badge badge-success">Active</span></td>
                    <?php } else { ?>
                        <td><span class="badge badge-danger">Inactive</span></td>
                    <?php } ?>
                </tr>
            </table>
        </div>
        
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label class="floating-label font-weight-bold">NIK</label>
                <input type="number" class="form-control" value="<?= $where->nik ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Tempat Lahir</label>
                <input type="text" class="form-control" value="<?= $where->tempat_lahir ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Tanggal Lahir</label>
                <input type="text" class="form-control" value="<?= $where->tanggal_lahir ?>" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Email</label>
                <input type="text" class="form-control" value="<?= $where->email ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label font-weight-bold">No Telepon</label>
                <input type="number" class="form-control" value="<?= $where->no_hp ?>" readonly>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Kartu Tanda Penduduk (KTP)</label>
                <?php if($where->ktp != ""  || $where->ktp != null) { ?>
                    <p><a href="<?= base_url('assets/file/'.$where->ktp) ?>" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->ktp ?>
                    </a>
                <?php } else { ?>
                    <input type="text" class="form-control" value="KTP Tidak di Upload" readonly>
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Ijazah Terakhir</label>
                <?php if($where->ijazah != ""  || $where->ijazah != null) { ?>
                    <p><a href="<?= base_url('assets/file/'.$where->ijazah) ?>" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->ijazah ?>
                    </a>
                <?php } else { ?>
                    <input type="text" class="form-control" value="Ijazah Tidak di Upload" readonly>
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="floating-label font-weight-bold">Kartu Keluarga (KK)</label>
                <?php if($where->kk != ""  || $where->kk != null) { ?>
                    <p><a href="<?= base_url('assets/file/'.$where->kk) ?>" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->kk ?>
                    </a>
                <?php } else { ?>
                    <input type="text" class="form-control" value="KK Tidak di Upload" readonly>
                <?php } ?>
            </div>
        </div>

    </div>

    <div class="row">

    </div>

</div>