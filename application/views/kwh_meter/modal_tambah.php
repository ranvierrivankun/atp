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

<?php if ($where->status_kmpkj=="0") { ?>

    <form method="POST" id="form_tambah" enctype="multipart/form-data">

        <input type="hidden" name="tahun_kmpk" value="<?php echo date('Y'); ?>">
        <input type="hidden" name="jenis_kmpk" value="<?= $where->id_kmj ?>">
        <input type="hidden" name="pengguna_kmpk" value="<?= $where->id_kmp ?>">
        <input type="hidden" name="user_kmpk" value="<?= userdata('id_user'); ?>">
        <input type="hidden" name="nama_kmj" value="<?= $where->nama_kmj ?>">

        <div class="modal-body kwh_meter">

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
                      <input class="form-control pengguna_kwh" name="btahun_kmpk" value="<?php echo date('M-Y'); ?>" required readonly>
                  </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Lalu</label>
                    <input type="number" id="l_kmpk" name="l_kmpk" class="form-control" placeholder="Masukan kWh Lalu" required>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Sekarang</label>
                    <input type="number" id="s_kmpk" name="s_kmpk" class="form-control" placeholder="Masukan kWh Sekarang" required>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Selisih</label>
                    <input type="number" id="se_kmpk" name="se_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Faktor Kali</label>
                    <input type="number" id="fx_kmpk" name="fx_kmpk" class="form-control" value="<?= $where->v_kmfx ?>" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Jumlah kWh</label>
                    <input type="number" id="jk_kmpk" name="jk_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Biaya / kWh (Rp)</label>
                    <input type="number" id="bk_kmpk" name="bk_kmpk" class="form-control" value="<?= $getBiaya->biaya_kmb ?>" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Beban Bulan ini (Rp)</label>
                    <input type="number" id="bb_kmpk" name="bb_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Biaya Tetap (Rp)</label>
                    <input type="number" id="bt_kmpk" name="bt_kmpk" class="form-control" value="<?= $where->bb_kmbb ?>" required readonly>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="floating-label">Jumlah (Rp)</label>
                    <input type="number" id="j_kmpk" name="j_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving_tambah">Tambah Pemakaian</button>
    </div>

</form>

<?php } else { ?>

    <form method="POST" id="form_tambah_2" enctype="multipart/form-data">

        <input type="hidden" name="tahun_kmpk" value="<?php echo date('Y'); ?>">
        <input type="hidden" name="jenis_kmpk" value="<?= $where->id_kmj ?>">
        <input type="hidden" name="pengguna_kmpk" value="<?= $where->id_kmp ?>">
        <input type="hidden" name="user_kmpk" value="<?= userdata('id_user'); ?>">
        <input type="hidden" name="limit_kmpkj" value="<?= $where->limit_kmpkj ?>">
        <input type="hidden" name="nama_kmj" value="<?= $where->nama_kmj ?>">

        <div class="modal-body kwh_meter">

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
                      <input class="form-control pengguna_kwh" name="btahun_kmpk" value="<?php echo date('M-Y'); ?>" required readonly>
                  </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Lalu</label>
                    <input type="number" id="l_kmpk" name="l_kmpk" class="form-control" value="<?= $getLalu->v_kml ?>" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Sekarang</label>
                    <input type="number" id="s_kmpk" name="s_kmpk" class="form-control" placeholder="Masukan kWh Sekarang" required>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Selisih</label>
                    <input type="number" id="se_kmpk" name="se_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Faktor Kali</label>
                    <input type="number" id="fx_kmpk" name="fx_kmpk" class="form-control" value="<?= $where->v_kmfx ?>" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Jumlah kWh</label>
                    <input type="number" id="jk_kmpk" name="jk_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Biaya / kWh (Rp)</label>
                    <input type="number" id="bk_kmpk" name="bk_kmpk" class="form-control" value="<?= $getBiaya->biaya_kmb ?>" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Beban Bulan ini (Rp)</label>
                    <input type="number" id="bb_kmpk" name="bb_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label">Biaya Tetap (Rp)</label>
                    <input type="number" id="bt_kmpk" name="bt_kmpk" class="form-control" value="<?= $where->bb_kmbb ?>" required readonly>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">
                <div class="form-group">
                    <label class="floating-label">Jumlah (Rp)</label>
                    <input type="number" id="j_kmpk" name="j_kmpk" class="form-control" placeholder="Auto" required readonly>
                </div>
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving_tambah">Tambah Pemakaian</button>
    </div>

</form>

<?php } ?>

<!-- Penghitungan Pemakaian kWh -->
<script type="text/javascript">

  $(".kwh_meter").keyup(function(){
    var l_kmpk = parseInt($("#l_kmpk").val())
    var s_kmpk = parseInt($("#s_kmpk").val())

    var se_kmpk = s_kmpk - l_kmpk;
    $("#se_kmpk").attr("value",se_kmpk)
});

  $(".kwh_meter").keyup(function(){
    var se_kmpk = parseInt($("#se_kmpk").val())
    if(se_kmpk == 0){
      var jk_kmpk_1 = 0;
      $("#jk_kmpk").attr("value",jk_kmpk_1);
  }else {
      var se_kmpk = parseInt($("#se_kmpk").val())
      var fx_kmpk = parseInt($("#fx_kmpk").val())

      var jk_kmpk_2 = se_kmpk * fx_kmpk;
      $("#jk_kmpk").attr("value",jk_kmpk_2)
  }
});

  $(".kwh_meter").keyup(function(){
    var se_kmpk = parseInt($("#se_kmpk").val())
    if(se_kmpk == 0){
      var bb_kmpk_1 = 0;
      $("#bb_kmpk").attr("value",bb_kmpk_1);
  }else {
      var jk_kmpk = parseInt($("#jk_kmpk").val())
      var bk_kmpk = parseInt($("#bk_kmpk").val())

      var bb_kmpk_2 = jk_kmpk * bk_kmpk;
      $("#bb_kmpk").attr("value",bb_kmpk_2);
  }
});

  $(".kwh_meter").keyup(function(){
    var bb_kmpk = parseInt($("#bb_kmpk").val())
    var bt_kmpk = parseInt($("#bt_kmpk").val())

    var j_kmpk = bb_kmpk + bt_kmpk;
    $("#j_kmpk").attr("value",j_kmpk)
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

<!-- Proses Tambah -->
<script type="text/javascript">
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Pemakaian kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_meter/tambah_pemakaian_kwh')?>",
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
                            text: "Pemakaian kWh berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_km_pemakaian').DataTable().ajax.reload(null, false);
                            $('#tambah').modal('hide');
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

<!-- Proses Tambah 2 -->
<script type="text/javascript">
    $('#form_tambah_2').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Pemakaian kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_meter/tambah_pemakaian_kwh_2')?>",
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
                            text: "Pemakaian kWh berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_km_pemakaian').DataTable().ajax.reload(null, false);
                            $('#tambah').modal('hide');
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