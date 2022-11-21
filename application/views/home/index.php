                        <?php
                        date_default_timezone_set("Asia/Jakarta");

                        $jam = date('H:i');

                        if ($jam > '00:00' && $jam < '10:00') {
                          $salam = 'Pagi';
                      } elseif ($jam >= '10:00' && $jam < '15:00') {
                          $salam = 'Siang';
                      } elseif ($jam < '18:00') {
                          $salam = 'Sore';
                      } else {
                          $salam = 'Malam';
                      }
                      ?>

                      <div class="pcoded-main-container">
                        <div class="pcoded-content">

                            <!-- [ Main Content ] start -->
                            <section class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="jumbotron">
                                              <h1 ><?php echo 'Selamat ' . $salam.' ' ?><?= userdata('nama_user'); ?> </h1>
                                              <a >Selamat datang di. </a>
                                              <h3><strong>Aplikasi-TP Versi 2.0</strong></h3>
                                              <h5><i>Aplikasi Teknik Pemeliharaan Kementerian Lingkungan Hidup dan Kehutanan <span id="tahun_utama"></span> </i></h5>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                          <!-- [ Main Content ] end -->
                      </div>
                  </div>