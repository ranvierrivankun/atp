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

<form method="POST" id="form_edit_1" enctype="multipart/form-data" class="tarif1phase">
	<input type="hidden" name="id_kmbb" value="<?= $edit->id_kmbb ?>">

    <div class="modal-body edit-body">

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Tegangan (Volt)</label>
                    <input type="number" class="form-control" id="tegangan_e1" value="220" readonly>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Beban Terpasang (Ampere)</label>
                    <input type="number" class="form-control" name="beban_kmbb" id="beban_kmbb_e1" value="<?= $edit->beban_kmbb ?>" placeholder="Beban Terpasang (Ampere)" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Tarif Tetap (Rp)</label>
                    <input type="number" class="form-control" id="tarif_kmt_e1" value="<?= $getTarif['tarif_kmt']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="floating-label">Jumlah Biaya Beban (Rp)</label>
                    <input type="number" class="form-control" name="bb_kmbb" id="bb_kmbb_e1" placeholder="Jumlah Biaya Beban 1 Phase" readonly required>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving">Simpan Pembaharuan</button>
    </div>

</form>

<!-- Proses Edit -->
<script type="text/javascript">
    $('#form_edit_1').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Biaya Beban?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_biaya_tarif/update_modal_edit_1')?>",
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
                            text: "Biaya Beban Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_kbb').DataTable().ajax.reload(null, false);
                            $('#edit_1').modal('hide');
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

    /*Tarif 1 Phase*/
    $(".tarif1phase").bind('click keyup', function(){
      var tegangan_e1 = parseInt($("#tegangan_e1").val())
      var beban_kmbb_e1 = parseInt($("#beban_kmbb_e1").val())
      var tarif_kmt_e1 = parseInt($("#tarif_kmt_e1").val())

      var bb_kmbb_e1 = tegangan_e1 * beban_kmbb_e1 * tarif_kmt_e1 / 1000;
      $("#bb_kmbb_e1").attr("value",bb_kmbb_e1)
  });
</script>