<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-bodys{
    height: 130px;
    overflow-y: auto;
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

<form method="POST" id="form_edit_biayaperkwh" enctype="multipart/form-data">
	<input type="hidden" name="id_kmb" value="<?= $edit->id_kmb ?>">

    <div class="modal-body edit-bodys">

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="floating-label">Biaya / kWh (Rp)</label>
                    <input type="number" class="form-control" name="biaya_kmb" placeholder="Input Biaya / kWh" value="<?= $edit->biaya_kmb ?>" required>
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
    $('#form_edit_biayaperkwh').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Biaya / kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_biaya_tarif/update_modal_edit_biayaperkwh')?>",
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
                            text: "Biaya / kWh Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_perkwh').DataTable().ajax.reload(null, false);
                            $('#edit_biayaperkwh').modal('hide');
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