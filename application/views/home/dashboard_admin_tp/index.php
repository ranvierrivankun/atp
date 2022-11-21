<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Admin TP</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('home/dashboard'); ?>">Dashboard Admin TP</a></li>
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
                            <h5 class="mb-3">Info Pengguna</h5>
                            <h2><?php echo $total_pengguna ?><span class="text-muted m-l-10 f-14">Pengguna Terdaftar</span></h2>
                            <div class="row">
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-success"><?php echo $total_pengguna_active ?><span></span></h6>
                                        <p class="text-muted m-0">Active</p>
                                    </div>
                                </div>
                                <div class="col col-auto">
                                    <div class="map-area">
                                        <h6 class="m-0 text-danger"><?php echo $total_pengguna_inactive ?><span></span></h6>
                                        <p class="text-muted m-0">Inactive</p>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h2><?php echo $total_data_pengguna ?><span class="text-muted m-l-10 f-14">Data Pengguna</span></h2>

                        </div>
                    </div>

                </div>

            </div>
        </section>


    </div>
</div>