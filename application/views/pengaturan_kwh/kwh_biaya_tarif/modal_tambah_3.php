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

<form method="POST" id="form_tambah_3" enctype="multipart/form-data" class="tarif3phase">
    <input type="hidden" name="phasa_kmbb" value="3">

    <div class="modal-body edit-body">

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Tegangan (Volt)</label>
                    <input type="number" class="form-control" id="tegangan3" value="380" readonly>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Beban Terpasang (Ampere)</label>
                    <input type="number" class="form-control" name="beban_kmbb" id="beban_kmbb3" placeholder="Beban Terpasang (Ampere)" required>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label">Tarif Tetap (Rp)</label>
                    <input type="number" class="form-control" id="tarif_kmt3" value="<?= $getTarif['tarif_kmt']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="floating-label">Jumlah Biaya Beban (Rp)</label>
                    <input type="number" class="form-control" name="bb_kmbb" id="bb_kmbb3" placeholder="Jumlah Biaya Beban 3 Phase" readonly>
                </div>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving">Tambah Biaya Beban</button>
    </div>

</form>

<!-- Proses Tambah -->
<script type="text/javascript">
    $('#form_tambah_3').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Biaya Beban 3 Phase ?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_biaya_tarif/tambah_tarif_3')?>",
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
                            text: "Biaya Beban 3 Phase berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_kbb').DataTable().ajax.reload(null, false);
                            $('#tambah_3').modal('hide');
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

    /*Tarif 3 Phase*/
    $(".tarif3phase").bind('click keyup', function(){
      var tegangan3 = parseInt($("#tegangan3").val())
      var beban_kmbb3 = parseInt($("#beban_kmbb3").val())
      var tarif_kmt3 = parseInt($("#tarif_kmt3").val())

      var bb_kmbb3 = tegangan3 * beban_kmbb3 * tarif_kmt3 / 1000 * 1.732050808;
      $("#bb_kmbb3").attr("value",Math.round(bb_kmbb3))
  });
</script>