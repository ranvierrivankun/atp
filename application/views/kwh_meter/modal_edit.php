<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }

  .neon {
    animation: neon 1s ease infinite;
    -moz-animation: neon 1s ease infinite;
    -webkit-animation: neon 1s ease infinite;
}

@keyframes neon {
    0%,
    100% {
        color: red;
    }
    50% {
        color: #806914;
    }
}
</style>

<form class="kwh_meter" method="POST" id="form_edit" enctype="multipart/form-data">

    <input type="hidden" name="id_kmpk" value="<?= $edit->id_kmpk ?>">
    <input type="hidden" name="jenis_kmpk" value="<?= $edit->jenis_kmpk ?>">
    <input type="hidden" name="nama_kmj" value="<?= $edit->nama_kmj ?>">

    <div class="modal-body">

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Foto kWh Meter <strong class="text-danger">(MAX 5MB)</strong></label>
                    <div class="col-sm-9">
                        <input type="file" name="foto_kmpk" id="foto_kmpk" class="foto_kmpk">
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                  <label>Bulan / Tahun</label>
                  <input class="form-control pengguna_kwh" name="btahun_kmpk" value="<?= $edit->btahun_kmpk ?>" required readonly>
              </div>
          </div>

          <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Lalu</label>
                <input type="number" id="l_kmpk_edit" name="l_kmpk" class="form-control" value="<?= $edit->l_kmpk ?>" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Sekarang</label>
                <input type="number" id="s_kmpk_edit" name="s_kmpk" class="form-control" value="<?= $edit->s_kmpk ?>" placeholder="Masukan kWh Sekarang"required>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Selisih</label>
                <input type="number" id="se_kmpk_edit" name="se_kmpk" class="form-control" placeholder="Auto" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Faktor Kali</label>
                <input type="number" id="fx_kmpk_edit" name="fx_kmpk" class="form-control" value="<?= $edit->fx_kmpk ?>" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Jumlah kWh</label>
                <input type="number" id="jk_kmpk_edit" name="jk_kmpk" class="form-control" placeholder="Auto" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Biaya / kWh (Rp)</label>
                <input type="number" id="bk_kmpk_edit" name="bk_kmpk" class="form-control" value="<?= $edit->bk_kmpk ?>" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Beban Bulan ini (Rp)</label>
                <input type="number" id="bb_kmpk_edit" name="bb_kmpk" class="form-control" placeholder="Auto" required readonly>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Biaya Tetap (Rp)</label>
                <input type="number" id="bt_kmpk_edit" name="bt_kmpk" class="form-control" value="<?= $edit->bt_kmpk ?>" required readonly>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="form-group">
                <label class="floating-label">Jumlah (Rp)</label>
                <input type="number" id="j_kmpk_edit" name="j_kmpk" class="form-control" placeholder="Auto" required readonly>
            </div>
        </div>

    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn  btn-primary" id="saving_edit">Edit Pemakaian</button>
</div>

</form>

<!-- Penghitungan Pemakaian kWh -->
<script type="text/javascript">

  $(".kwh_meter").bind('click keyup', function(){
    var l_kmpk = parseInt($("#l_kmpk_edit").val())
    var s_kmpk = parseInt($("#s_kmpk_edit").val())

    var se_kmpk = s_kmpk - l_kmpk;
    $("#se_kmpk_edit").attr("value",se_kmpk)
});

  $(".kwh_meter").bind('click keyup', function(){
    var se_kmpk = parseInt($("#se_kmpk_edit").val())
    if(se_kmpk == 0){
      var jk_kmpk_1 = 0;
      $("#jk_kmpk_edit").attr("value",jk_kmpk_1);
  }else {
      var se_kmpk = parseInt($("#se_kmpk_edit").val())
      var fx_kmpk = parseInt($("#fx_kmpk_edit").val())

      var jk_kmpk_2 = se_kmpk * fx_kmpk;
      $("#jk_kmpk_edit").attr("value",jk_kmpk_2)
  }
});

  $(".kwh_meter").bind('click keyup', function(){
    var se_kmpk = parseInt($("#se_kmpk_edit").val())
    if(se_kmpk == 0){
      var bb_kmpk_1 = 0;
      $("#bb_kmpk_edit").attr("value",bb_kmpk_1);
  }else {
      var jk_kmpk = parseInt($("#jk_kmpk_edit").val())
      var bk_kmpk = parseInt($("#bk_kmpk_edit").val())

      var bb_kmpk_2 = jk_kmpk * bk_kmpk;
      $("#bb_kmpk_edit").attr("value",bb_kmpk_2);
  }
});

  $(".kwh_meter").bind('click keyup', function(){
    var bb_kmpk = parseInt($("#bb_kmpk_edit").val())
    var bt_kmpk = parseInt($("#bt_kmpk_edit").val())

    var j_kmpk = bb_kmpk + bt_kmpk;
    $("#j_kmpk_edit").attr("value",j_kmpk)
});

</script>

<!-- Filepond -->
<script type="text/javascript">
    $(function(){

        // First register any plugins
        FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize, FilePondPluginImagePreview);

        $('.foto_kmpk').filepond({
            maxFileSize: '5MB',
            acceptedFileTypes: 'image/jpeg',
            required: false,
            labelFileProcessingComplete: 'Selesai',
            labelIdle: 'Tarik / Klik Disini Untuk Upload Foto',
        });

        // Listen for addfile event
        $('.foto_kmpk').on('FilePond:addfile', function(e) {
            console.log('file added event', e);
        });

        FilePond.create(
            $([
                '#foto_kmpk',
                ]),

            FilePond.setOptions({
                server: {
                    url: "<?= site_url('upload/kwh_pemakaian') ?>",
                },
            })

            );

    });
</script>

<!-- Proses Edit -->
<script type="text/javascript">
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Pemakaian kWh <?= $edit->nama_kmj ?>?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_meter/update_modal_edit')?>",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    async: true,

                    beforeSend: function(){
                        Swal.fire({
                            title: "Menyimpan",
                            text: "Silahkan Tunggu, Proses Memakan Waktu",
                            didOpen: () => {
                                Swal.showLoading()
                            }
                        });
                    },

                    success: function(data){
                        Swal.fire({
                            confirmButtonColor: '#20c997',
                            icon: "success",
                            title: "Berhasil",
                            text: "Pemakaian kWh Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_km_pemakaian').DataTable().ajax.reload(null, false);
                            $('#edit').modal('hide');
                            location.reload();
                        });
                        
                    },

                    error: (req, status, error)=> {
                        Swal.fire({
                            icon: 'error',
                            title: `Gagal ${req.status}`,
                            text: `Silahkan Coba Lagi`,
                            timer: 1500
                        })
                    },

                });
                return false;
            }else if (result.dismiss === Swal.DismissReason.cancel){
                Swal.fire(
                    'Batal',
                    'Anda Membatalkan',
                    'Error'
                    )
            }
        })
    });
</script>