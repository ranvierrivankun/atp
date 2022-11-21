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

    <div class="modal-body edit-body">

        <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                  <label>Pengguna</label>
                  <select class="form-control pengguna_kwh" name="pengguna_kmj" required>
                    <option value=""></option>
                </select>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <label class="floating-label">Nama Jenis</label>
                <input type="text" name="nama_kmj" class="form-control" value="" placeholder="Input Nama Jenis" id="nama_kmj_tambah" onkeyup="validasi()" required><small class="keterangan neon"></small>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label blok">Blok</label>
                <select class="form-control" name="b_kmj" required>
                    <option value="">-- Pilih Blok --</option>
                    <option value="BLOK 1">BLOK 1</option>
                    <option value="BLOK 2">BLOK 2</option>
                    <option value="BLOK 3">BLOK 3</option>
                    <option value="BLOK 2 / 3">BLOK 2 / 3</option>
                    <option value="BLOK 4">BLOK 4</option>
                    <option value="BLOK 5">BLOK 5</option>
                    <option value="BLOK 6">BLOK 6</option>
                    <option value="BLOK 7">BLOK 7</option>
                    <option value="LG">LG</option>
                </select>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Lantai</label>
                <input type="number" name="lt_kmj" class="form-control" value="" placeholder="Input Lantai" required>
            </div>
        </div>

        <div class="col-sm-2">
            <div class="form-group">
                <label class="floating-label">Ruang</label>
                <input type="text" name="r_kmj" class="form-control" value="" placeholder="Input Ruangan" required>
            </div>
        </div>
    </div>

    <div class="row">
        <h5 class="col-sm-8 mb-2">kWh Meter</h5>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
              <label>Kapasitas kWh</label>
              <select class="form-control beban_kmbb" name="k_kmj" required>
                <option value=""></option>
            </select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label class="floating-label">Merk</label>
            <input type="text" class="form-control" name="merk_kmj" placeholder="Input Merk" value="" required>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label class="floating-label">Type</label>
            <input type="text" class="form-control" name="type_kmj" placeholder="Input Type" value="" required>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
          <label>Phase</label>
          <select class="form-control" name="phasa_kmj" required>
            <option value="">-- Pilih Phase --</option>
            <option value="1 PHASE">1 PHASE</option>
            <option value="3 PHASE">3 PHASE</option>
        </select>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-2">
        <div class="form-group">
          <label>Kawat</label>
          <select class="form-control" name="kawat_kmj" required>
            <option value="">-- Pilih Kawat --</option>
            <option value="2 WIRE">2 WIRE</option>
            <option value="4 WIRE">4 WIRE</option>
        </select>
    </div>
</div>
<div class="col-sm-2">
    <div class="form-group">
      <label>Tegangan</label>
      <select class="form-control" name="t_kmj" required>
        <option value="">-- Pilih Tegangan --</option>
        <option value="220 VAC">220 VAC</option>
        <option value="220/380 VAC">220/380 VAC</option>
    </select>
</div>
</div>
<div class="col-sm-2">
    <div class="form-group">
        <label class="floating-label">Putaran</label>
        <input type="text" class="form-control" name="p_kmj" placeholder="Input Putaran" value="" required>
    </div>
</div>
<div class="col-sm-2">
    <div class="form-group">
        <label class="floating-label">Tahun</label>
        <input type="number" class="form-control" name="thn_kmj" placeholder="Input Tahun" value="" required>
    </div>
</div>
<div class="col-sm-2">
    <div class="form-group">
      <label>Faktor Kali</label>
      <select class="form-control fk_kmj" name="fk_kmj" required>
        <option value=""></option>
    </select>
</div>
</div>
<div class="col-sm-2">
    <div class="form-group">
        <label class="floating-label">Keterangan</label>
        <input type="text" class="form-control" name="ket_kmj" placeholder="Input Keterangan" value="" required>
    </div>
</div>
</div>

</div>

<div class="modal-footer">
    <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn  btn-primary" id="saving_tambah">Tambah Jenis kWh</button>
</div>

</form>

<!-- Proses Tambah -->
<script type="text/javascript">
    $('#form_tambah').on('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: `Konfirmasi`,
            text: `Tambah Jenis kWh?`,
            icon: 'warning',
            showCancelButton : true,
            confirmButtonText : 'Tambah',
            confirmButtonColor : '#d33',
            cancelButtonText : 'Tidak',
            reverseButtons : true
        }).then((result)=> {
            if(result.value) {
                $.ajax({
                    url: "<?= site_url('kwh_jenis/tambah_jenis_kwh')?>",
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
                            text: "Jenis kWh berhasil ditambah!",
                            timer: 1500,
                        }).then((e)=> {
                            $('#table_kj').DataTable().ajax.reload(null, false);
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

<script type="text/javascript">
    /*Select Pengguna kWh*/
    $(".pengguna_kwh").select2({
        theme: 'bootstrap4',
        dropdownParent: $(".modal-body"),
        placeholder: 'Pilih Pengguna kWh',
        ajax: { 
           url: "<?= site_url('kwh_jenis/getPengguna')?>",
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term
            };
        },
        processResults: function (response) {
          return {
             results: response
         };
     },
     cache: true
 }
});

    /*Select Biaya Beban kWh*/
    $(".beban_kmbb").select2({
        theme: 'bootstrap4',
        dropdownParent: $(".modal-body"),
        placeholder: 'Pilih Kapasitas kWh',
        ajax: { 
           url: "<?= site_url('kwh_jenis/getBiayaBeban')?>",
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term
            };
        },
        processResults: function (response) {
          return {
             results: response
         };
     },
     cache: true
 }
});

    /*Select Faktor X kWh*/
    $(".fk_kmj").select2({
        theme: 'bootstrap4',
        dropdownParent: $(".modal-body"),
        placeholder: 'Pilih Faktor Kali',
        ajax: { 
           url: "<?= site_url('kwh_jenis/getFaktorx')?>",
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term
            };
        },
        processResults: function (response) {
          return {
             results: response
         };
     },
     cache: true
 }
});
</script>

<!-- Validasi -->
<script type="text/javascript">
    function validasi() {
        var nama_kmj = $('#nama_kmj_tambah').val();

        $.ajax({
            url: "<?= site_url('validasi/nama_kmj') ?>",
            method: "POST",
            data: {
                nama_kmj: nama_kmj
            },
            success: (data)=> {
                if(nama_kmj == "" || nama_kmj == "-") {

                    $('.keterangan').text("");
                    $('#nama_kmj_tambah').removeClass('border-danger');

                } else {

                    if(data.status == "gagal") {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_tambah').attr('disabled', true);
                        $('#nama_kmj_tambah').addClass('border-danger');
                    }else {
                        $('.keterangan').text(data.keterangan);
                        $('#saving_tambah').removeAttr('disabled');
                        $('#nama_kmj_tambah').removeClass('border-danger');
                    }

                }
            }
        })
    }
</script>