<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pengguna kWh</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Administration</a></li>
                            <li class="breadcrumb-item"><a>kWh Meter</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_pengguna'); ?>">Pengguna kWh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <!-- Table kWh Pengguna -->
        <div class="row">

            <!-- [ Hover-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            <div class="btn-group col-lg-3">
                             <button class="btn btn-info" onclick="modal_tambah()">
                              <i class="fa-solid fa-square-plus"></i>
                              Tambah Pengguna kWh
                          </button>
                      </div>

                      <div class="col-lg-3">
                      </div>

                      <div class="col-lg-3">
                        <select class="form-control" id="status_kp" >
                            <option value="">-- Filter Status --</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <div class="btn-group col-lg-3">
                     <button type="button" class="btn btn-sm btn-secondary" onclick="table_kp()">
                      <i class="fa-solid fa-filter"></i>
                      Filter
                  </button>
                  <button type="button" class="btn btn-sm btn-dark" onclick="reload_table_kp()">
                      <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                      Refresh
                  </button>
              </div>

          </div>
      </div>
      <div class="card-body table-border-style">
        <div class="table-responsive">
            <table id="table_kp" class="table table-bordered table-hover">
                <thead>
                    <tr>
                     <th width="10%">Action</th>
                     <th>Nama Pengguna kWh</th>
                     <th width="10%">Status</th>
                     <th>Jenis kWh</th>
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

<!-- Modal Tambah Pengguna kWh -->
<div class="modal fade show" id="tambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah"></div>
        </div>
    </div>
</div>

<!-- Modal Edit Pengguna kWh -->
<div class="modal fade show" id="edit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit"></div>
        </div>
    </div>
</div>

<!-- Modal Detail Pengguna kWh -->
<div class="modal fade show" id="detail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Jenis kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaldetail"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table kWh Pengguna*/
    function table_kp() {
        $(document).ready(function() {
          var status = $('#status_kp').val();
          var table_kp = $('#table_kp').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('kwh_pengguna/table_kp')?>",
                method: "POST",
                data: {
                    status: status,
                }
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
    }table_kp();

    /*Reload Table*/
    function reload_table_kp()
    {
        $('#status_kp').val('');
        table_kp();

    }
</script>

<script type="text/javascript">
    /*Modal Tambah kWh Pengguna*/
    function modal_tambah() {
        $.ajax({
            url: "<?= site_url('kwh_pengguna/modal_tambah') ?>",
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
                $('#tambah').modal('show');
                $('#isimodaltambah').html(data);
            }
        });
    }

    /*Modal Edit kWh Pengguna*/
    $('#table_kp').on('click', '.edit', function(e) {
        e.preventDefault();

        var id_kmp = $(this).data('id_kmp');

        $.ajax({
            url: "<?= site_url('kwh_pengguna/modal_edit')?>",
            method: "POST",
            data: {id_kmp: id_kmp},

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
                $('#edit').modal('show');
                $('#isimodaledit').html(data);
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

    /*Modal Detail kWh Pengguna*/
    $('#table_kp').on('click', '.detail', function(e) {
        e.preventDefault();

        var id_kmp = $(this).data('id_kmp');

        $.ajax({
            url: "<?= site_url('kwh_pengguna/modal_detail')?>",
            method: "POST",
            data: {id_kmp: id_kmp},

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
                $('#detail').modal('show');
                $('#isimodaldetail').html(data);
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