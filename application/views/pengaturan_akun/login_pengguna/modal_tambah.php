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

<form method="POST" id="form_tambah" enctype="multipart/form-data">
    <input type="hidden" name="foto" value="default.png">

    <div class="modal-body edit-body">

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
            <div class="col-sm-9">
                <input type="text" name="nama_user" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Masukan Nama" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Username</label>
            <div class="col-sm-9">
                <input type="text" name="username" class="form-control form-control-sm" placeholder="Masukan Username untuk Login" onkeyup="validasi()" id="username" required>
                <small class="keterangan neon"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Password</label>
            <div class="col-sm-9">
                <input type="text" name="password" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Masukan Password untuk Login" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Role</label>
            <div class="col-sm-9">
                <select class="form-control form-control-sm" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <?php foreach ($getRole as $gr) : ?>
                        <option 
                        value="<?= $gr->id_role; ?>"
                        <?php echo $gr->id_role?>
                        >
                        <?= $gr->nama_role; ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Status</label>
        <div class="col-sm-9">
            <select class="form-control form-control-sm" name="status_user" required>
                <option value="">-- Pilih Status --</option>
                <?php foreach ($getStatus as $gs) : ?>
                    <option 
                    value="<?= $gs->id_status; ?>"
                    <?php echo $gs->id_status?>
                    >
                    <?= $gs->nama_status; ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn  btn-primary" id="saving">Tambah Pengguna</button>
</div>


</form>

<!-- Proses Tambah -->
<script type="text/javascript">
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Pengguna?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('login_pengguna/tambah_pengguna')?>",
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
                            text: "Pengguna berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_pengguna').DataTable().ajax.reload(null, false);
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

<!-- Validasi -->
<script type="text/javascript">
    function validasi() {
        var username = $('#username').val();

        $.ajax({
            url: "<?= site_url('validasi/username') ?>",
            method: "POST",
            data: {
                username: username
            },
            success: (data)=> {
                if(username == "" || username == "-") {

                    $('.keterangan').text("");
                    $('#username').removeClass('border-danger');

                } else {

                    if(data.status == "gagal") {
                        $('.keterangan').text(data.keterangan);
                        $('#saving').attr('disabled', true);
                        $('#username').addClass('border-danger');
                    }else {
                        $('.keterangan').text(data.keterangan);
                        $('#saving').removeAttr('disabled');
                        $('#username').removeClass('border-danger');
                    }

                }
            }
        })
    }
</script>