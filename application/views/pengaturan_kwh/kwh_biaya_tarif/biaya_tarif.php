<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Biaya Tarif / kWh</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Administration</a></li>
                            <li class="breadcrumb-item"><a>kWh Meter</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_biaya_tarif'); ?>">Biaya Tarif / kWh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Biaya / kWh</h5>
                        <span class="d-block m-t-5">Harga dari <code>/ kWh</code> untuk penghitungan <strong>Beban Bulanan</strong> di Gedung Manggala Wanabakti KLHK</span>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table id="table_perkwh" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="15%">Action</th>
                                        <th>Biaya / kWh</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Tarif Tetap kWh</h5>
                        <span class="d-block m-t-5">Penggunaan <code>Tarif Tetap</code> untuk menentukan <strong>Biaya Beban kWh</strong> di Gedung Manggala Wanabakti KLHK</span>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table id="table_tariftetap" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="15%">Action</th>
                                        <th>Tarif Tetap</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- [ Main Content ] start -->
        <!-- Table Biaya Beban -->
        <div class="row">

            <!-- [ Hover-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            <div class="btn-group col-lg-4">
                               <button class="btn btn-info" onclick="modal_tambah_1()">
                                  <i class="fa-solid fa-square-plus"></i>
                                  Tambah Biaya Beban 1 Phase
                              </button>
                          </div>

                          <div class="btn-group col-lg-4">
                           <button class="btn btn-danger" onclick="modal_tambah_3()">
                              <i class="fa-solid fa-square-plus"></i>
                              Tambah Biaya Beban 3 Phase
                          </button>
                      </div>

                      <div class="col-lg-2">
                      </div>

                      <div class="btn-group col-lg-2">
                          <button type="button" class="btn btn-dark" onclick="reload_table_kbb()">
                              <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                              Refresh
                          </button>
                      </div>

                  </div>
              </div>
              <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table id="table_kbb" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                               <th width="10%">Action</th>
                               <th>Beban Terpasang</th>
                               <th width="10%">Phase</th>
                               <th>Biaya Beban</th>
                           </tr>
                       </thead>
                   </table>
               </div>
           </div>
       </div>
   </div>
   <!-- [ Hover-table ] end -->

</div>
<!-- [ Main Content ] end -->

</div>
</section>

<!-- Modal Edit Biaya per kWh -->
<div class="modal fade show" id="edit_biayaperkwh" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Biaya / kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit_biayaperkwh"></div>
        </div>
    </div>
</div>

<!-- Modal Edit Tarif Tetap kWh -->
<div class="modal fade show" id="edit_tariftetap" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tarif Tetap kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit_tariftetapkwh"></div>
        </div>
    </div>
</div>

<!-- Modal Tambah 1 -->
<div class="modal fade show" id="tambah_1" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Biaya Beban <span class="badge badge-info">1 Phase</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah_1"></div>
        </div>
    </div>
</div>

<!-- Modal Edit 1 -->
<div class="modal fade show" id="edit_1" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Biaya Beban <span class="badge badge-info">1 Phase</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit_1"></div>
        </div>
    </div>
</div>

<!-- Modal Tambah 3 -->
<div class="modal fade show" id="tambah_3" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Biaya Beban <span class="badge badge-danger">3 Phase</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah_3"></div>
        </div>
    </div>
</div>

<!-- Modal Edit 3 -->
<div class="modal fade show" id="edit_3" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Biaya Beban <span class="badge badge-danger">3 Phase</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit_3"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table per kWh*/
    function table_perkwh() {
        $(document).ready(function() {
          var table_perkwh = $('#table_perkwh').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bFilter: false,
            bLengthChange: false,
            bInfo: false,
            bPaginate: false,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('kwh_biaya_tarif/table_perkwh')?>",
                method: "POST"
            },
            "language": {
              processing: 'Sedang diproses'
          },
          columnDefs: [
          { 
              visible: false,
              orderable: false,
          },
          ],

      });
      });
    }table_perkwh();

    /*Modal Edit Biaya per kWh*/
    $('#table_perkwh').on('click', '.edit_biayaperkwh', function(e) {
        e.preventDefault();

        var id_kmb = $(this).data('id_kmb');

        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_edit_biayaperkwh')?>",
            method: "POST",
            data: {id_kmb: id_kmb},

            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },

            success: (data)=> {
                Swal.close();
                $('#edit_biayaperkwh').modal('show');
                $('#isimodaledit_biayaperkwh').html(data);
            },

            error: (req, status, error)=> {
                Swal.fire({
                    icon: 'error',
                    title: `Gagal ${req.status}`,
                    text: `Silahkan Coba Lagi`,
                    timer: 1500
                })
            },
        })

    })

    /*Table Tarif Tetap*/
    function table_tariftetap() {
        $(document).ready(function() {
          var table_tariftetap = $('#table_tariftetap').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bFilter: false,
            bLengthChange: false,
            bInfo: false,
            bPaginate: false,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('kwh_biaya_tarif/table_tariftetap')?>",
                method: "POST"
            },
            "language": {
              processing: 'Sedang diproses'
          },
          columnDefs: [
          { 
              visible: false,
              orderable: false,
          },
          ],

      });
      });
    }table_tariftetap();

    /*Modal Edit Tarif Tetap kWh*/
    $('#table_tariftetap').on('click', '.edit_tariftetap', function(e) {
        e.preventDefault();

        var id_kmt = $(this).data('id_kmt');

        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_edit_tariftetapkwh')?>",
            method: "POST",
            data: {id_kmt: id_kmt},

            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },

            success: (data)=> {
                Swal.close();
                $('#edit_tariftetap').modal('show');
                $('#isimodaledit_tariftetapkwh').html(data);
            },

            error: (req, status, error)=> {
                Swal.fire({
                    icon: 'error',
                    title: `Gagal ${req.status}`,
                    text: `Silahkan Coba Lagi`,
                    timer: 1500
                })
            },
        })

    })
</script>

<script type="text/javascript">
    /*Table kWh Biaya Beban*/
    function table_kbb() {
        $(document).ready(function() {
          var table_kbb = $('#table_kbb').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('kwh_biaya_tarif/table_kbb')?>",
                method: "POST"
            },
            "language": {
              processing: 'Sedang diproses'
          },
          columnDefs: [
          { 
              visible: false,
              orderable: false,
          },
          ],

      });
      });
    }table_kbb();

    /*Reload Table*/
    function reload_table_kbb()
    {
        table_kbb();
    }
</script>

<script type="text/javascript">
    /*Modal Tambah 1*/
    function modal_tambah_1() {
        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_tambah_1') ?>",
            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(data) {
                Swal.close();
                $('#tambah_1').modal('show');
                $('#isimodaltambah_1').html(data);
            }
        });
    }

    /*Modal Edit 1*/
    $('#table_kbb').on('click', '.edit_1', function(e) {
        e.preventDefault();

        var id_kmbb = $(this).data('id_kmbb');

        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_edit_1')?>",
            method: "POST",
            data: {id_kmbb: id_kmbb},

            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },

            success: (data)=> {
                Swal.close();
                $('#edit_1').modal('show');
                $('#isimodaledit_1').html(data);
            },

            error: (req, status, error)=> {
                Swal.fire({
                    icon: 'error',
                    title: `Gagal ${req.status}`,
                    text: `Silahkan Coba Lagi`,
                    timer: 1500
                })
            },
        })

    })
</script>

<script type="text/javascript">
    /*Modal Tambah 3*/
    function modal_tambah_3() {
        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_tambah_3') ?>",
            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },
            success: function(data) {
                Swal.close();
                $('#tambah_3').modal('show');
                $('#isimodaltambah_3').html(data);
            }
        });
    }

    /*Modal Edit 3*/
    $('#table_kbb').on('click', '.edit_3', function(e) {
        e.preventDefault();

        var id_kmbb = $(this).data('id_kmbb');

        $.ajax({
            url: "<?= site_url('kwh_biaya_tarif/modal_edit_3')?>",
            method: "POST",
            data: {id_kmbb: id_kmbb},

            beforeSend: ()=> {
                Swal.fire({
                    title : 'Menunggu',
                    html : 'Memproses data',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            },

            success: (data)=> {
                Swal.close();
                $('#edit_3').modal('show');
                $('#isimodaledit_3').html(data);
            },

            error: (req, status, error)=> {
                Swal.fire({
                    icon: 'error',
                    title: `Gagal ${req.status}`,
                    text: `Silahkan Coba Lagi`,
                    timer: 1500
                })
            },
        })

    })
</script>

<script type="text/javascript">
    /*Delete kWh Biaya Beban*/
    function delete_kmbb(id)
    {
        Swal.fire({
          title: 'Delete',
          text: "Yakin ingin menghapus Biaya Beban ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.value) {
            $.ajax({
              type: "post",
              url: "<?= site_url('kwh_biaya_tarif/delete_kmbb') ?>",
              data : {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                if(response.sukses){
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.sukses
                });
                  reload_table_kbb();
              }
          }
      })
        }
    })
  }
</script>