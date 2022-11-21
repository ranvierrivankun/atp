<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Jenis kWh</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Administration</a></li>
                            <li class="breadcrumb-item"><a>kWh Meter</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_jenis'); ?>">Jenis kWh</a></li>
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
                                  Tambah Jenis kWh
                              </button>
                          </div>

                          <div class="col-lg-3">
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control" id="status" >
                                <option value="">-- Filter Status --</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>

                        <div class="btn-group col-lg-3">
                         <button type="button" class="btn btn-sm btn-secondary" onclick="table_kj()">
                          <i class="fa-solid fa-filter"></i>
                          Filter
                      </button>
                      <button type="button" class="btn btn-sm btn-dark" onclick="reload_table_kj()">
                          <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                          Refresh
                      </button>
                  </div>

              </div>
          </div>

          <div class="card-body table-border-style">
            <div class="table-responsive">
                <table id="table_kj" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                           <th width="10%">Action</th>
                           <th width="10%">Status</th>
                           <th>Nama Pengguna kWh</th>
                           <th>Nama Jenis kWh</th>
                           <th>Phase</th>
                           <th>Kapasitas kWh</th>
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

<!-- Modal Tambah Jenis kWh -->
<div class="modal fade show" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis kWh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah"></div>
        </div>
    </div>
</div>

<!-- Modal Edit Jenis kWh -->
<div class="modal fade show" id="edit" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="isimodaledit"></div>
        </div>
    </div>
</div>

<!-- Modal Detail Jenis kWh -->
<div class="modal fade show" id="detail" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="isimodaldetail"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table kWh Jenis*/
    function table_kj() {
        $(document).ready(function() {
            var status = $('#status').val();
            var table_kj = $('#table_kj').DataTable({ 
                destroy: true,
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                ajax: {
                    url: "<?= site_url('kwh_jenis/table_kj')?>",
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
    }table_kj();

    /*Reload Table*/
    function reload_table_kj()
    {
        table_kj();
    }
</script>

<script type="text/javascript">
    /*Modal Tambah kWh Jenis*/
    function modal_tambah() {
        $.ajax({
            url: "<?= site_url('kwh_jenis/modal_tambah') ?>",
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

    /*Modal Edit kWh Jenis*/
    $('#table_kj').on('click', '.edit', function(e) {
        e.preventDefault();

        var id_kmj = $(this).data('id_kmj');

        $.ajax({
            url: "<?= site_url('kwh_jenis/modal_edit')?>",
            method: "POST",
            data: {id_kmj: id_kmj},

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

    /*Modal Detail kWh Jenis*/
    $('#table_kj').on('click', '.detail', function(e) {
        e.preventDefault();

        var id_kmj = $(this).data('id_kmj');

        $.ajax({
            url: "<?= site_url('kwh_jenis/modal_detail')?>",
            method: "POST",
            data: {id_kmj: id_kmj},

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