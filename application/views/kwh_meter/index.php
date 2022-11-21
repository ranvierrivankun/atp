<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">kWh Meter</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Teknik Listrik</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_meter'); ?>">kWh Meter</a></li>
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

                          <div class="col-lg-6">
                          </div>

                          <div class="col-lg-3">
                            <select class="form-control" id="status" >
                                <option value="">-- Filter Status --</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>

                        <div class="btn-group col-lg-3">
                         <button type="button" class="btn btn-sm btn-secondary" onclick="table_km()">
                          <i class="fa-solid fa-filter"></i>
                          Filter
                      </button>
                      <button type="button" class="btn btn-sm btn-dark" onclick="reload_table_km()">
                          <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                          Refresh
                      </button>
                  </div>

              </div>
          </div>

          <div class="card-body table-border-style">
            <div class="table-responsive">
                <table id="table_km" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                           <th width="10%">Action</th>
                           <th width="10%">Status</th>
                           <th>Nama Pengguna kWh</th>
                           <th>Nama Jenis kWh</th>
                           <th>Lokasi</th>
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

<!-- Modal Detail Jenis kWh -->
<div class="modal fade show" id="detail" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div id="isimodaldetail"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /*Table kWh Meter*/
    function table_km() {
        $(document).ready(function() {
            var status = $('#status').val();
            var table_km = $('#table_km').DataTable({ 
                destroy: true,
                ordering: false,
                processing: true,
                serverSide: true,
                pageLength: 10,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                ajax: {
                    url: "<?= site_url('kwh_meter/table_km')?>",
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
    }table_km();

    /*Reload Table*/
    function reload_table_km()
    {
        table_km();
    }
</script>

<script type="text/javascript">
    /*Modal Detail kWh Jenis*/
    $('#table_km').on('click', '.detail', function(e) {
        e.preventDefault();

        var id_kmj = $(this).data('id_kmj');

        $.ajax({
            url: "<?= site_url('kwh_meter/modal_detail')?>",
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