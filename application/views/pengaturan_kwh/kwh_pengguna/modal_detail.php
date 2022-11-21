<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-body{
    height: 140;
    overflow-y: auto;
}
</style>

<div class="modal-body edit-body">

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th width="40%">Nama Jenis kWh</th>
                    <th>Lokasi Penggunaan</th>
                </tr>
            </thead>
            <tbody>
                <?php if($where)  { ?>

                    <?php $i = 1; ?>
                    <?php foreach ($where as $w) :  ?>
                        <tr>
                            <th><?= $i++; ?></th>
                            <td><?= $w['nama_kmj'] ?></td>
                            <td><strong><?= $w['b_kmj'] ?></strong>&nbsp;<a>lt.<?= $w['lt_kmj'] ?></a>&nbsp;<span><?= $w['r_kmj'] ?></span></td>
                        </tr>
                    <?php endforeach;?>

                <?php } else { ?>
                    <td colspan="3"><center>Tidak Ada Jenis kWh</center></td>
                <?php } ?>

            </tbody>
        </table>
    </div>

</div>