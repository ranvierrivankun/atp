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

<form method="POST" id="form_edit" enctype="multipart/form-data">
	<input type="hidden" name="id_user" value="<?= $edit->id_user ?>">

	<div class="modal-body edit-body">

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
            <div class="col-sm-9">
                <input type="text" name="nama_user" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Input Nama Pengguna" value="<?= $edit->nama_user ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Username</label>
            <div class="col-sm-9">
                <input type="text" name="username" class="form-control form-control-sm" onkeyup="validasi()" id="username_edit" placeholder="Input Username" value="<?= $edit->username ?>">
                <small class="keterangan neon"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Foto <strong class="text-danger">(MAX 3MB)</strong></label>
            <div class="col-sm-9">
                <input type="file" name="foto" id="foto" class="foto">
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="saving_edit">Simpan Pembaharuan</button>
    </div>

</form>

<!-- Filepond -->
<script type="text/javascript">
    $(function(){

        // First register any plugins
        FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize, FilePondPluginImagePreview);

        $('.foto').filepond({
            maxFileSize: '3MB',
            acceptedFileTypes: 'image/jpeg',
            required: false,
            labelFileProcessingComplete: 'Selesai',
            labelIdle: 'Tarik / Klik Disini Untuk Upload Foto',
        });

        // Listen for addfile event
        $('.foto').on('FilePond:addfile', function(e) {
            console.log('file added event', e);
        });

        FilePond.create(
            $([
                '#foto',
                ]),

            FilePond.setOptions({
                server: {
                    url: "<?= site_url('upload/ganti_foto_user') ?>",
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
            text: `Perbaharui Profile?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('profile/update_profile')?>",
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
                            text: "Pengguna Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#modal_edit_profile').modal('hide');
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

<!-- Validasi -->
<script type="text/javascript">
    function validasi() {
        var username = $('#username_edit').val();

        $.ajax({
            url: "<?= site_url('validasi/username') ?>",
            method: "POST",
            data: {
                username: username
            },
            success: (data)=> {
                if(username == "" || username == "-") {

                    $('.keterangan').text("");
                    $('#username_edit').removeClass('border-danger');

                } else {

                    if(data.status == "gagal") {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_edit').attr('disabled', true);
                        $('#username_edit').addClass('border-danger');
                    }else {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_edit').removeAttr('disabled');
                        $('#username_edit').removeClass('border-danger');
                    }

                }
            }
        })
    }
</script>

<!-- GET FILE NAME -->
<script>
    $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').html(fileName)
  });
</script>