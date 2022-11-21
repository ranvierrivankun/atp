<style type="text/css" media="screen">
    .swal2-container {
      z-index: 1000000;
  }
  .edit-body{
    height: 140;
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

<form method="POST" id="form_edit" enctype="multipart/form-data" class="tarif1phase">
	<input type="hidden" name="id_kmp" value="<?= $edit->id_kmp ?>">

    <div class="modal-body edit-body">

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nama</label>
            <div class="col-sm-9">
                <input type="text" name="nama_kmp" class="form-control form-control-sm" id="nama_kmp_edit" onkeyup="validasi()" placeholder="Masukan Nama Pengguna kWh" value="<?= $edit->nama_kmp; ?>" required><small class="keterangan neon"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Status</label>
            <div class="col-sm-9">
                <select class="form-control form-control-sm" name="status_kmp" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" <?php echo '1' == $edit->status_kmp ? 'selected' : ''; ?>>Active</option>
                    <option value="2" <?php echo '2' == $edit->status_kmp ? 'selected' : ''; ?>>Inactive</option>
                </select>

            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-primary" id="saving_edit">Simpan Pembaharuan</button>
    </div>

</form>

<!-- Proses Edit -->
<script type="text/javascript">
    $('#form_edit').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Perbaharui Pengguna kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Perbaharui',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_pengguna/update_modal_edit')?>",
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
                            text: "Pengguna kWh Diperbaharui!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_kp').DataTable().ajax.reload(null, false);
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

<!-- Validasi -->
<script type="text/javascript">
    function validasi() {
        var nama_kmp = $('#nama_kmp_edit').val();

        $.ajax({
            url: "<?= site_url('validasi/nama_kmp') ?>",
            method: "POST",
            data: {
                nama_kmp: nama_kmp
            },
            success: (data)=> {
                if(nama_kmp == "" || nama_kmp == "-") {

                    $('.keterangan').text("");
                    $('#nama_kmp_edit').removeClass('border-danger');

                } else {

                    if(data.status == "gagal") {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_edit').attr('disabled', true);
                        $('#nama_kmp_edit').addClass('border-danger');
                    }else {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_edit').removeAttr('disabled');
                        $('#nama_kmp_edit').removeClass('border-danger');
                    }

                }
            }
        })
    }
</script>