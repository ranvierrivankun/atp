<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible refresh" content="IE=edge 30" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="author" content="Phoenixcoded" />
        <!-- Favicon icon -->
        <link rel="icon" href="<?= base_url(''); ?>assets/img/klhk.png" type="image/x-icon">

        <!-- Jquery -->
        <script src="<?= base_url(''); ?>assets/plugins/jquery-3.5.1.js"></script>

        <!-- vendor css -->
        <link rel="stylesheet" href="<?= base_url(''); ?>assets/plugins/css/style.css">

        <!-- Fontawesome 6 -->
        <link href="<?= base_url(''); ?>assets/plugins/fontawesome-free-6.2.0-web/css/all.min.css" rel="stylesheet">

        <!-- Datatables -->
        <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

        <!-- Sweetalert2 -->
        <ilnk href="<?= base_url(''); ?>assets/plugins/sweetalert2/package/dist/sweetalert2.min.css" rel="stylesheet">

            <!-- ekko-lightbox -->
            <ilnk href="<?= base_url(''); ?>assets/plugins/ekko-lightbox/ekko-lightbox.css" rel="stylesheet">

                <!-- Select2 -->
                <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/select2/css/select2.min.css">
                <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

                <!-- gijgo datepicker -->
                <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/gijgo/gijgo.min.css">

                <!-- Filepond -->
                <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/filepond/filepond.min.css">
                <link rel="stylesheet" href="<?= base_url('') ?>assets/plugins/filepond/filepond-plugin-image-preview.css">

            </head>

            <body class="">
                <!-- [ Pre-loader ] start -->
                <div class="loader-bg">
                    <div class="loader-track">
                        <div class="loader-fill"></div>
                    </div>
                </div>
                <!-- [ Pre-loader ] End -->
                <!-- [ navigation menu ] start -->
                <nav class="pcoded-navbar  ">
                    <div class="navbar-wrapper  ">
                        <div class="navbar-content scroll-div " >

                            <div id="menu_user" class="">
                                <div class="main-menu-header">
                                    <img class="img-radius" src="<?= base_url('assets/img/users/') . userdata('foto'); ?>?dummy=TEST" alt="User-Profile-Image" height="50px" width="40px">

                                    <div class="user-details">
                                        <span><?= userdata('nama_user'); ?></span>

                                        <!-- Query Role -->
                                        <?php 
                                        $id_user =  userdata('id_user');

                                        $role = $this->db->select('*')->from('user')->where('id_user', $id_user)->join('user_role', 'id_role=role')->get()->row();

                                        ?>

                                        <div id="more-details"><strong><?php echo $role->nama_role ?></strong><i class="fa fa-chevron-down m-l-5"></i></div>
                                    </div>

                                </div>
                                <div class="collapse" id="nav-user-link">
                                    <ul class="list-unstyled">
                                        <li class="list-group-item"><a href="<?= base_url('profile'); ?>"><i class="feather icon-user m-r-5"></i>Profile</a></li>

                                        <li class="list-group-item"><a class="ganti_password" data-id_user="<?= userdata('id_user'); ?>"><i class="feather icon-settings m-r-5"></i>Ganti Password</a></li>
                                        
                                        <li class="list-group-item"><a href="<?= base_url('auth/logout') ?>"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                                    </ul>
                                </div>
                            </div>