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

    <h5 class="modal-title" id="exampleModalLabel">Detail Jenis kWh - <?= $where->nama_kmj ?> 
    <?php if ($where->status_kmp=="1") { ?>
        <span class="badge badge-success">Active</span></h5>
    <?php } else { ?>
        <span class="badge badge-danger">Inactive</span></h5>
    <?php } ?>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>

<div class="modal-body edit-body">

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label class="floating-label">Lokasi</label>
                <input type="text" class="form-control" value="<?= $where->b_kmj ?> Lt.<?= $where->lt_kmj ?> <?= $where->r_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="floating-label">Kapasitas kWh</label>
                <input type="text" class="form-control" value="<?= $where->beban_kmbb ?> Ampere - <?= $where->phasa_kmbb ?> Phase" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Merk</label>
                <input type="text" class="form-control" value="<?= $where->merk_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Type</label>
                <input type="text" class="form-control" value="<?= $where->type_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Phase</label>
                <input type="text" class="form-control" value="<?= $where->phasa_kmj ?>" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Kawat</label>
                <input type="text" class="form-control" value="<?= $where->kawat_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Tegangan</label>
                <input type="text" class="form-control" value="<?= $where->t_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Putaran</label>
                <input type="text" class="form-control" value="<?= $where->p_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Tahun</label>
                <input type="text" class="form-control" value="<?= $where->thn_kmj ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Faktor Kali</label>
                <input type="text" class="form-control" value="<?= $where->fx_kmfx ?>" readonly>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Keterangan</label>
                <input type="text" class="form-control" value="<?= $where->ket_kmj ?>" readonly>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="floating-label">Pengguna kWh</label>
                <input type="text" class="form-control" value="<?= $where->nama_kmp ?>" readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="floating-label">Tarif Tetap</label>
                <input type="text" class="form-control" value="<?= rupiah($where->bb_kmbb) ?>" readonly>
            </div>
        </div>
    </div>

</div>