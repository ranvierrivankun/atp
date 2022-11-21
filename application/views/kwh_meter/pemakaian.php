<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">kWh Meter Pemakaian - <?= $where->nama_kmj ?></h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a>Teknik Listrik</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_meter'); ?>">kWh Meter</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('kwh_meter/pemakaian/'.$where->id_kmj.''); ?>">kWh Meter Pemakaian - <?= $where->nama_kmj ?></a></li>
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

                            <?php if (empty($reset->v_kml)) { ?>

                                <div class="btn-group col-lg-3">
                                   <button class="btn btn-info" onclick="modal_tambah()">
                                      <i class="fa-solid fa-square-plus"></i>
                                      Tambah Pemakaian kWh
                                  </button>
                              </div>

                          <?php } else if($reset->v_kml >= 100000) { ?>

                              <div class="btn-group col-lg-3">
                               <button class="btn btn-danger" disabled>
                                  <i class="fa-solid fa-square-plus"></i>
                                  Tambah Pemakaian kWh
                              </button>
                          </div>

                      <?php } else { ?>

                        <div class="btn-group col-lg-3">
                           <button class="btn btn-info" onclick="modal_tambah()">
                              <i class="fa-solid fa-square-plus"></i>
                              Tambah Pemakaian kWh
                          </button>
                      </div>

                  <?php } ?>

                  <div class="col-lg-3">
                  </div>

                  <div class="col-lg-3">
                    <select class="form-control" id="tahun">
                    </select>
                </div>

                <input type="hidden" id="id_kmj" value="<?= $where->id_kmj; ?>"></input>

                <div class="btn-group col-lg-3">
                   <button type="button" class="btn btn-sm btn-secondary" onclick="table_km_pemakaian()">
                      <i class="fa-solid fa-filter"></i>
                      Filter
                  </button>
                  <button type="button" class="btn btn-sm btn-dark" onclick="reload_table_km_pemakaian()">
                      <i class="fa-solid fa-arrows-rotate" style="color:#DDDDDD;"></i>
                      Refresh
                  </button>
              </div>

          </div>
      </div>

      <div class="card-body table-border-style">
        <div class="table-responsive">
            <table id="table_km_pemakaian" class="table table-bordered table-hover">
                <thead>
                    <tr>
                     <th width="10%">Action</th>
                     <th>Bulan / Tahun</th>
                     <th>Lalu</th>
                     <th>Sekarang</th>
                     <th>Selisih</th>
                     <th>Faktor Kali</th>
                     <th>Jumlah kWh</th>
                     <th>Biaya / kWh</th>
                     <th>Beban Bulanan</th>
                     <th>Biaya Tetap</th>
                     <th>Jumlah</th>
                     <th>Pelaksana</th>
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

<!-- Modal Tambah kWh Pemakaian -->
<div class="modal fade show" id="tambah" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah kWh Pemakaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaltambah"></div>
        </div>
    </div>
</div>

<!-- Modal Reset kWh Pemakaian -->
<div class="modal fade show" id="reset" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset kWh Pemakaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodalreset"></div>
        </div>
    </div>
</div>

<!-- Modal Edit kWh Pemakaian -->
<div class="modal fade show" id="edit" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit kWh Pemakaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div id="isimodaledit"></div>
        </div>
    </div>
</div>

<!-- Filter Tahun -->
<script type="text/javascript">
  var i;
  var text = `<option value="" disabled>-- Pilih Tahun --</option>`;
  var sekarang = new Date().getFullYear();
  var selected = "selected";

  for(i = 2021; i <= sekarang; i++) {
    text += `
    <option
    value="${i}"
    ${i === sekarang ? 'selected' : ''}
    >
    ${i}
    </option>
    `;
}

document.getElementById('tahun').innerHTML = text;
</script>

<script type="text/javascript">
    /*Table Pemakaian kWh Meter*/
    function table_km_pemakaian() {
        $(document).ready(function() {
            var tahun = $('#tahun').val();
            var id_kmj = $('#id_kmj').val();
            var table_km_pemakaian = $('#table_km_pemakaian').DataTable({ 
                dom: 'lfBrtip',
                destroy: true,
                ordering: false,
                processing: true,
                serverSide: true,
                bPaginate: false,
                pageLength: 12,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

                buttons: [
                {
                  text: '<i class="fas fa-file-excel"></i>&nbsp; EXPORT EXCEL',
                  extend: "excelHtml5",
                  pageSize: 'A4',
                  className: 'btn btn-success btn-sm assets-select-btn',
                  title: 'kWh Pemakaian <?= $where->nama_kmj ?>',
                  exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ]
                },
            },
            ],

            ajax: {
                url: "<?= site_url('kwh_meter/table_km_pemakaian')?>",
                method: "POST",
                data: {
                   tahun: tahun,
                   id_kmj: id_kmj,
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
    }table_km_pemakaian();

    /*Reload Table*/
    function reload_table_km_pemakaian()
    {
        table_km_pemakaian();
    }
</script>

<script type="text/javascript">
    /*Modal Tambah kWh Pemakaian*/
    function modal_tambah() {
        var id_kmj = $('#id_kmj').val();
        $.ajax({
            url: "<?= site_url('kwh_meter/modal_tambah') ?>",
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
            success: function(data) {
                Swal.close();
                $('#tambah').modal('show');
                $('#isimodaltambah').html(data);
            }
        });
    }

    /*Modal Reset kWh Pemakaian*/
    $('#table_km_pemakaian').on('click', '.reset', function(e) {
        e.preventDefault();

        var id_kmpk = $(this).data('id_kmpk');

        $.ajax({
            url: "<?= site_url('kwh_meter/modal_reset')?>",
            method: "POST",
            data: {id_kmpk: id_kmpk},

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
                $('#reset').modal('show');
                $('#isimodalreset').html(data);
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

    /*Modal Edit kWh Pemakaian*/
    $('#table_km_pemakaian').on('click', '.edit', function(e) {
        e.preventDefault();

        var id_kmpk = $(this).data('id_kmpk');

        $.ajax({
            url: "<?= site_url('kwh_meter/modal_edit')?>",
            method: "POST",
            data: {id_kmpk: id_kmpk},

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
</script>