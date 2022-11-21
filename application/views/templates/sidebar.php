<ul class="nav pcoded-inner-navbar ">
    <li class="nav-item pcoded-menu-caption">
        <label>Home</label>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('home/dashboard'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-gauge-high"></i></span><span class="pcoded-mtext">Dashboard</span></a>
    </li>

    <!-- Query Role -->
    <?php 
    $id_user =  userdata('id_user');

    $role = $this->db->select('*')->from('user')->where('id_user', $id_user)->join('user_role', 'id_role=role')->get()->row();

    ?>

    <li class="nav-item pcoded-menu-caption">
        <label><?php echo $role->nama_role ?></label>
    </li>

    <!-- Administrator -->
    <?php if (userdata('role')=="1") { ?>

        <li class="nav-item <?php if($this->uri->segment(1)=="kwh_meter"){echo "active";}?>">
            <a href="<?= base_url('kwh_meter'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-circle-nodes"></i></span><span class="pcoded-mtext">kWh Meter</span></a>
        </li>

        <p>

            <li class="nav-item pcoded-hasmenu">
                <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-users-gear"></i></span><span class="pcoded-mtext">Pengaturan Akun</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="<?= base_url('login_pengguna'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-right-to-bracket"></i></span>Login Pengguna</a></li>
                    <li><a href="<?= base_url('data_pengguna'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-database"></i></span>Data Pengguna</a></li>
                </ul>
            </li>

            <li class="nav-item pcoded-hasmenu">
                <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-list-check"></i></span><span class="pcoded-mtext">Pengaturan kWh Meter</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="<?= base_url('kwh_biaya_tarif'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-money-check-dollar"></i></span>Biaya Tarif / kWh</a></li>
                    <li><a href="<?= base_url('kwh_pengguna'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-user-tag"></i></span>Pengguna kWh</a></li>
                    <li><a href="<?= base_url('kwh_jenis'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-users-rectangle"></i></span>Jenis kWh</a></li>
                </ul>
            </li>

            <!-- Pengawas TP -->
        <?php } else if (userdata('role')=="2") { ?>

            <li class="nav-item <?php if($this->uri->segment(1)=="data_pengguna"){echo "active";}?>">
                <a href="<?= base_url('data_pengguna'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-database"></i></span><span class="pcoded-mtext">Data Pengguna</span></a>
            </li>

            <li class="nav-item <?php if($this->uri->segment(1)=="kwh_meter"){echo "active";}?>">
                <a href="<?= base_url('kwh_meter'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-circle-nodes"></i></span><span class="pcoded-mtext">kWh Meter</span></a>
            </li>

            <li class="nav-item pcoded-hasmenu">
                <a href="#" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-list-check"></i></span><span class="pcoded-mtext">Pengaturan kWh Meter</span></a>
                <ul class="pcoded-submenu">
                    <li><a href="<?= base_url('kwh_biaya_tarif'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-money-check-dollar"></i></span>Biaya Tarif / kWh</a></li>
                    <li><a href="<?= base_url('kwh_pengguna'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-user-tag"></i></span>Pengguna kWh</a></li>
                    <li><a href="<?= base_url('kwh_jenis'); ?>"><span class="pcoded-micon"><i class="fa-solid fa-users-rectangle"></i></span>Jenis kWh</a></li>
                </ul>
            </li>

            <!-- Admin TP -->
        <?php } else if (userdata('role')=="5") { ?>

            <li class="nav-item <?php if($this->uri->segment(1)=="data_pengguna"){echo "active";}?>">
                <a href="<?= base_url('data_pengguna'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-database"></i></span><span class="pcoded-mtext">Data Pengguna</span></a>
            </li>

            <!-- Teknik Listrik -->
        <?php } else if (userdata('role')=="3") { ?>

            <li class="nav-item <?php if($this->uri->segment(1)=="kwh_meter"){echo "active";}?>">
                <a href="<?= base_url('kwh_meter'); ?>" class="nav-link "><span class="pcoded-micon"><i class="fa-solid fa-circle-nodes"></i></span><span class="pcoded-mtext">kWh Meter</span></a>
            </li>

        <?php } ?>

    </ul>

</div>
</div>
</nav>