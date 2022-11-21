<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Pengguna</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Administration</a></li>
                            <li class="breadcrumb-item"><a>Pengaturan Akun</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('data_pengguna'); ?>">Data Pengguna</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">

            <!-- [ Hover-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">

                            <div class="btn-group col-lg-3">
                                <button class="btn btn-md btn-info" onclick="modal_tambah()">
                                  <i class="fa-solid fa-square-plus"></i>
                                  Tambah Data Pengguna
                              </button>
                          </div>

                          <div class="col-lg-7">
                          </div>

                          <div class="btn-group col-lg-2">
                              <button type="button" class="btn btn-md btn-dark" onclick="reload_table_datapengguna()">
                                  <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                                  Refresh
                              </button>
                          </div>

                      </div>
                  </div>
                  <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="table_datapengguna" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                 <th width="10%">Action</th>
                                 <th width="8%">Foto</th>
                                 <th>Nama</th>
                                 <th>Username</th>
                                 <th width="15%">Role</th>
                                 <th width="10%">Status</th>
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

<!-- Modal Tambah Data Pengguna -->
<div class="modal fade show" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah"></div>
        </div>
    </div>
</div>

<!-- Modal Edit Data Pengguna -->
<div class="modal fade show" id="edit" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit"></div>
        </div>
    </div>
</div>

<!-- Modal Detail Data Pengguna -->
<div class="modal fade show" id="detail" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="isimodaldetail"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table Data Pengguna*/
    function table_datapengguna() {
        $(document).ready(function() {
          var table_datapengguna = $('#table_datapengguna').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('data_pengguna/table_datapengguna')?>",
                method: "POST",
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
    }table_datapengguna();

    /*Reload Table*/
    function reload_table_datapengguna()
    {
        table_datapengguna();
    }
</script>

<script type="text/javascript">
    /*Modal Tambah Data Pengguna*/
    function modal_tambah() {
        $.ajax({
            url: "<?= site_url('data_pengguna/modal_tambah') ?>",
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

    /*Modal Edit Data Pengguna*/
    $('#table_datapengguna').on('click', '.edit', function(e) {
        e.preventDefault();

        var id_userdata = $(this).data('id_userdata');

        $.ajax({
            url: "<?= site_url('data_pengguna/modal_edit')?>",
            method: "POST",
            data: {id_userdata: id_userdata},

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

    /*Modal Detail Data Pengguna*/
    $('#table_datapengguna').on('click', '.detail', function(e) {
        e.preventDefault();

        var id_userdata = $(this).data('id_userdata');

        $.ajax({
            url: "<?= site_url('data_pengguna/modal_detail')?>",
            method: "POST",
            data: {id_userdata: id_userdata},

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