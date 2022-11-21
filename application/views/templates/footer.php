        <!-- Modal Ganti Password -->
        <div class="modal fade show" id="modal_ganti_password" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
              <div id="isimodal"></div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          /*Modal Ganti Password*/
          $('#nav-user-link').on('click', '.ganti_password', function(e) {
            e.preventDefault();

            var id_user = $(this).data('id_user');

            $.ajax({
              url: "<?= site_url('home/modal_ganti_password')?>",
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
                $('#modal_ganti_password').modal('show');
                $('#isimodal').html(data);
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

        <!-- Required Js -->
        <script src="<?= base_url(''); ?>assets/plugins/js/vendor-all.min.js"></script>
        <script src="<?= base_url(''); ?>assets/plugins/js/plugins/bootstrap.min.js"></script>
        <script src="<?= base_url(''); ?>assets/plugins/js/pcoded.min.js"></script>

        <!-- Select2 -->
        <script src="<?= base_url('') ?>assets/plugins/select2/js/select2.full.min.js"></script>

        <!-- Fontawesome 6 -->
        <script src="<?= base_url(''); ?>assets/plugins/fontawesome-free-6.2.0-web/js/all.min.js"></script>

        <!-- Datatables -->
        <script src="<?= base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/jszip/jszip.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/buttons/js/buttons.colVis.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url(); ?>assets/plugins/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

        <!-- Sweetalert2 -->
        <script src="<?= base_url(''); ?>assets/plugins/sweetalert2/package/dist/sweetalert2.all.min.js"></script>

        <!-- ekko-lightbox -->
        <script src="<?= base_url(''); ?>assets/plugins/ekko-lightbox/ekko-lightbox.js"></script>

        <!-- gijgo datepicker -->
        <script src="<?= base_url('') ?>assets/plugins/gijgo/gijgo.min.js"></script>

        <!-- Filepond -->
        <script src="<?= base_url('') ?>assets/plugins/filepond/filepond.min.js"></script>
        <script src="<?= base_url('') ?>assets/plugins/filepond/filepond.jquery.js"></script>
        <script src="<?= base_url('') ?>assets/plugins/filepond/filepond-plugin-file-validate-type.min.js"></script>
        <script src="<?= base_url('') ?>assets/plugins/filepond/filepond-plugin-image-preview.js"></script>
        <script src="<?= base_url('') ?>assets/plugins/filepond/filepond-plugin-file-validate-size.js"></script>

      </body>

      </html>

      <!-- DISABLE CLICK RIGHT -->
      <script type="text/javascript">
  /*  $(document).bind("contextmenu",function(e) {
      e.preventDefault();
    });*/
  </script>

  <!-- GET FILE NAME -->
  <script>
    $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').html(fileName)
    });
  </script>

  <!-- REMOVE ALERT -->
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 2000);
  </script>

  <!-- Ekko-lightbox -->
  <script type="text/javascript">
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });
  </script>