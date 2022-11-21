<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Teknik Listrik</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('home/dashboard'); ?>">Dashboard Teknik Listrik</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <section class="content">
          <div class="container-fluid">
            <div class="row">

                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Info kWh Meter</h5>
                            <h2><?php echo $total_kwh ?><span class="text-muted m-l-10 f-14">Laporan kWh</span></h2>
                            <div class="row">
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-info"><?php echo rupiah($total_jumlah_kwh) ?><span></span></h6>
                                        <p class="text-muted m-0">Total Keseluruhan</p>
                                    </div>
                                </div>
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-success"><?php echo rupiah($total_jumlah_kwh_now) ?><span></span></h6>
                                        <p class="text-muted m-0">Total Bulan ini</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h2><?php echo $total_jenis_kwh ?><span class="text-muted m-l-10 f-14">Jenis kWh</span></h2>
                            <div class="row">
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-success"><?php echo $total_kwh_active ?><span></span></h6>
                                        <p class="text-muted m-0">Active</p>
                                    </div>
                                </div>
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-danger"><?php echo $total_kwh_inactive ?><span></span></h6>
                                        <p class="text-muted m-0">Inactive</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header">
                            <h5>kWh Meter <?= date('F Y') ?></h5>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table id="table_kwh_now" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="15%">Action</th>
                                            <th>Nama Jenis</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>


    </div>
</div>

<script type="text/javascript">
    /*Table kWh Now*/
    function table_kwh_now() {
        $(document).ready(function() {
          var table_kwh_now = $('#table_kwh_now').DataTable({ 
            destroy: true,
            ordering: false,
            processing: true,
            serverSide: true,
            bLengthChange: false,
            pageLength: 5,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

            ajax: {
                url: "<?= site_url('home/table_kwh_now')?>",
                method: "POST"
            },
            "language": {
              processing: 'Sedang diproses',
              emptyTable: 'kWh bulan <?php echo date('F') ?> belum diinput.'
          },
          columnDefs: [
          { 
              visible: false,
              orderable: false,
          },
          ],

      });
      });
    }table_kwh_now();
</script>