<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Login Pengguna</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Administration</a></li>
                            <li class="breadcrumb-item"><a>Pengaturan Akun</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('login_pengguna'); ?>">Login Pengguna</a></li>
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
                               <button class="btn btn-sm btn-info" onclick="modal_tambah()">
                                  <i class="fa-solid fa-square-plus"></i>
                                  Tambah Pengguna
                              </button>
                          </div>

                          <div class="col-lg-3">
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control" id="status_user" >
                                <option value="">-- Filter Status --</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>

                        <div class="btn-group col-lg-3">
                           <button type="button" class="btn btn-sm btn-secondary" onclick="table_pengguna()">
                              <i class="fa-solid fa-filter"></i>
                              Filter
                          </button>
                          <button type="button" class="btn btn-sm btn-dark" onclick="reload_table_pengguna()">
                              <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                              Refresh
                          </button>
                      </div>

                  </div>
              </div>
              <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table id="table_pengguna" class="table table-bordered table-hover">
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

<!-- Modal Tambah Pengguna -->
<div class="modal fade show" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah"></div>
        </div>
    </div>
</div>

<!-- Modal Edit Pengguna -->
<div class="modal fade show" id="edit" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table Pengguna*/
    function table_pengguna() {
        $(document).ready(function() {
          var status = $('#status_user').val();
          var table_pengguna = $('#table_pengguna').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            pageLength: 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('login_pengguna/table_pengguna')?>",
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
    }table_pengguna();

    /*Reload Table*/
    function reload_table_pengguna()
    {
        $('#status_user').val('');
        table_pengguna();
    }
</script>

<script type="text/javascript">
    /*Modal Tambah*/
    function modal_tambah() {
        $.ajax({
            url: "<?= site_url('login_pengguna/modal_tambah') ?>",
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

    /*Modal Edit*/
    $('#table_pengguna').on('click', '.edit', function(e) {
        e.preventDefault();

        var id_user = $(this).data('id_user');

        $.ajax({
            url: "<?= site_url('login_pengguna/modal_edit')?>",
            method: "POST",
            data: {id_user: id_user},

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

    /*Reset Password*/
    function reset_password(id)
    {
      Swal.fire({
        title: 'Reset Password',
        text: "Password akan menjadi Default, Anda yakin ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya, Reset Password',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
          $.ajax({
            type: "post",
            url: "<?= site_url('login_pengguna/reset_password') ?>",
            data : {
              id: id,
          },
          dataType: "json",
          success: function(response) {
              if(response.sukses){
                Swal.fire({
                    confirmButtonColor: '#20c997',
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.sukses
                });
                reload_table_pengguna();
            }
        }
    })
      }
  })
}
</script>