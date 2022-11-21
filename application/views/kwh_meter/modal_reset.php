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

<form method="POST" id="form_reset" enctype="multipart/form-data">
    <input type="hidden" name="id_kmpk" value="<?= $edit->id_kmpk ?>">
    <input type="hidden" name="jenis_kmpk" value="<?= $edit->jenis_kmpk ?>">

    <div class="modal-body edit-body">

        <div class="row">

            <div class="col-sm-12">
                <label>Pemakaian kWh lalu akan di <strong>Reset</strong>, karena sudah mencapai batas kWh.</label>
                <div class="form-group">
                    <input type="number" name="s_kmpk" class="form-control" placeholder="Input kWh Sekarang" required>
                </div>
            </div>
            
        </div>

        <div class="row">

        </div>

        <div class="row">


        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-danger">Reset</button>
    </div>

</form>

<!-- Proses Reset -->
<script type="text/javascript">
    $('#form_reset').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Reset Pemakaian kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Reset',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_meter/update_modal_reset')?>",
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
                            text: "Berhasil Reset Pemakaian kWh!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_km_pemakaian').DataTable().ajax.reload(null, false);
                            $('#reset').modal('hide');
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