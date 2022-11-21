<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-body{
    height: 140;
    overflow-y: auto;
}
</style>

<form method="POST" id="form_edit" enctype="multipart/form-data">
    <input type="hidden" name="id_userdata" value="<?= $where->id_userdata ?>">
    <input type="hidden" name="id_user" value="<?= $where->id_user ?>">

    <div class="modal-body edit-body">

        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">NIK</label>
                    <input type="number" name="nik" id="nik_edit" class="form-control" onkeyup="validasi_nik()" value="<?= $where->nik ?>" placeholder="Masukan NIK" required>
                    <small class="keterangan_nik neon"></small>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?= $where->tempat_lahir ?>" placeholder="Masukan Tempat Lahir" required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" class="form-control" id="datepicker" value="<?= $where->tanggal_lahir ?>" placeholder="Masukan Tanggal Lahir" readonly required>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $where->email ?>" placeholder="Masukan Email">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">No Telepon</label>
                    <input type="number" name="no_hp" class="form-control" value="<?= $where->no_hp ?>" placeholder="Masukan No.Tp">
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Kartu Tanda Penduduk <strong class="text-danger">(MAX 3MB)</strong></label>
                    <?php if($where->ktp != ""  || $where->ktp != null) { ?>
                        <p><a href="<?= base_url('assets/file/'.$where->ktp) ?>" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->ktp ?>
                        </a>
                    <?php } ?>
                    <div class="custom-file">
                        <input type="file" name="ktp" id="ktp" class="ktp">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Ijazah Terakhir <strong class="text-danger">(MAX 3MB)</strong></label>
                    <?php if($where->ijazah != ""  || $where->ijazah != null) { ?>
                        <p><a href="<?= base_url('assets/file/'.$where->ijazah) ?>" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->ijazah ?>
                        </a>
                    <?php } ?>
                    <div class="custom-file">
                        <input type="file" name="ijazah" id="ijazah" class="ijazah">
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <label class="floating-label font-weight-bold">Kartu Keluarga <strong class="text-danger">(MAX 3MB)</strong></label>
                    <?php if($where->kk != ""  || $where->kk != null) { ?>
                        <p><a href="<?= base_url('assets/file/'.$where->kk) ?>" target="_blank">
                            <i class="fa-solid fa-file-pdf"></i>&nbsp; <?= $where->kk ?>
                        </a>
                    <?php } ?>
                    <div class="custom-file">
                        <input type="file" name="kk" id="kk" class="kk">
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving_edit">Edit Data Pengguna</button>
    </div>

</form>

<!-- Filepond Global -->
<script type="text/javascript">
// First register any plugins
FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);

FilePond.setOptions({
    server: {
        url: "<?= site_url('upload/file') ?>",
    },
});
</script>

<!-- Filepond KTP -->
<script type="text/javascript">
    $(function(){

        $('.ktp').filepond({
            maxFileSize: '3MB',
            acceptedFileTypes: 'application/pdf',
            required: false,
            labelFileProcessingComplete: 'Selesai',
            labelIdle: 'Tarik / Klik Disini Untuk Upload KTP',
        });

  // Listen for addfile event
  $('.ktp').on('FilePond:addfile', function(e) {
    console.log('file added event', e);
});

  FilePond.create(
    $(['#ktp',]),
    );

});
</script>

<!-- Filepond Ijazah -->
<script type="text/javascript">
    $(function(){

        $('.ijazah').filepond({
            maxFileSize: '3MB',
            acceptedFileTypes: 'application/pdf',
            required: false,
            labelFileProcessingComplete: 'Selesai',
            labelIdle: 'Tarik / Klik Disini Untuk Upload Ijazah',
        });

  // Listen for addfile event
  $('.ijazah').on('FilePond:addfile', function(e) {
    console.log('file added event', e);
});

  FilePond.create(
    $(['#ijazah',]),
    );

});
</script>

<!-- Filepond KK -->
<script type="text/javascript">
    $(function(){

        $('.kk').filepond({
            maxFileSize: '3MB',
            acceptedFileTypes: 'application/pdf',
            required: false,
            labelFileProcessingComplete: 'Selesai',
            labelIdle: 'Tarik / Klik Disini Untuk Upload KK',
        });

  // Listen for addfile event
  $('.kk').on('FilePond:addfile', function(e) {
    console.log('file added event', e);
});

  FilePond.create(
    $(['#kk',]),
    );

});
</script>

<!-- Proses Edit -->
<script type="text/javascript">
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Data Pengguna ?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('data_pengguna/update_data_pengguna')?>",
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
                            text: "Data Pengguna Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_datapengguna').DataTable().ajax.reload(null, false);
                            $('#edit').modal('hide');
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

<!-- DatePicker -->
<script type="text/javascript">
    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4', iconsLibrary: 'fontawesome', format: 'dd/mm/yyyy',
    });
</script>

<!-- Validasi -->
<script type="text/javascript">
    function validasi_nik() {
        var nik = $('#nik_edit').val();

        $.ajax({
            url: "<?= site_url('validasi/nik') ?>",
            method: "POST",
            data: {
                nik: nik
            },
            success: (data)=> {
                if(nik == "" || nik == "-") {

                    $('.keterangan_nik').text("");
                    $('#nik_edit').removeClass('border-danger');

                } else {

                    if(data.status == "gagal") {
                        $('.keterangan_nik').text(data.keterangan);
                        $('#saving_edit').attr('disabled', true);
                        $('#nik_edit').addClass('border-danger');
                    }else {
                        $('.keterangan_nik').text(data.keterangan);
                        $('#saving_edit').removeAttr('disabled');
                        $('#nik_edit').removeClass('border-danger');
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