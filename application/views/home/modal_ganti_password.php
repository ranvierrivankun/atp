<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-body-modal-password{
    height: 120;
    overflow-y: auto;
}
</style>

<form method="POST" id="form_gantipassword" enctype="multipart/form-data">

    <div class="modal-body edit-body-modal-password">

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Masukan Password Lama</label>
            <div class="col-sm-7">
                <input type="password" name="password_lama" class="form-control form-control-sm" id="password_lama" placeholder="Masukan Password Lama" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Masukan Password Baru</label>
            <div class="col-sm-7">
                <input type="password" name="password_baru_1" class="form-control form-control-sm" id="password_baru_1" placeholder="Masukan Password Baru" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm">Masukan Ulang Password Baru</label>
            <div class="col-sm-7">
                <input type="password" name="password_baru_2" class="form-control form-control-sm" id="password_baru_2" placeholder="Masukan Ulang Password Baru" required>
                <small id="status_password_baru"></small>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving">Perbaharui</button>
    </div>
</form>

<!-- Proses Ganti Password -->
<script type="text/javascript">
    $('#form_gantipassword').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Password?`,
            icon: 'question',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('home/proses_ganti_password') ?>",
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

                        if(data.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: "Password Diperbaharui!",
                                timer: 1500,
                            }).then((e)=> {
                                $('#modal_ganti_password').modal('hide');
                                window.location = "<?= base_url('auth'); ?>";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: data.keterangan,
                                timer: 1500,
                            }).then((e)=> {
                                $('#modal_ganti_password').modal('hide');
                            });
                        }

                        
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
            }
        })
    })
</script>

<!-- Validasi -->
<script type="text/javascript">
    $('#password_baru_2').on('keyup', function(e) {
        e.preventDefault();

        var pass1 = $('#password_baru_1').val();
        var pass2 = $('#password_baru_2').val();

        if(pass2 == "") {
            $('#status_password_baru').html('');
            $('#password_baru_2').removeClass('border-danger');
            $('#saving').attr('disabled', false);
        } else if(pass1 != pass2) {
            $('#status_password_baru').html(`<span class='text-danger'>Password Tidak Sama!, Ketik Ulang</span>`);
            $('#password_baru_2').addClass('border-danger');
            $('#saving').attr('disabled', true);
        } else {
            $('#status_password_baru').html('');
            $('#password_baru_2').removeClass('border-danger');
            $('#saving').attr('disabled', false);
        }
    })
</script>