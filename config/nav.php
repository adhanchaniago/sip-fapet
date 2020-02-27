<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal">
    <li class="xn-logo">
        <a href="index.html"><b>SIP</b> Fapet</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    <li class="<?=isset($home)?'active':'';?>">
        <a href="<?=$base_url;?>"><span class="fa fa-home"></span> Home</a>
    </li>
    <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'||$_SESSION['akses']=='user'):?>
    <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'):?>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-folder"></span> Master</a>
        <ul class="animated zoomIn">
            <li <?=isset($mahasiswa)?'class="active"':'';?>><a href="<?=$base_url;?>?mahasiswa"><span
                        class="fa fa-folder-o"></span>
                    Mahasiswa</a></li>
            <li <?=isset($dosen)?'class="active"':'';?>><a href="<?=$base_url;?>?dosen"><span
                        class="fa fa-folder-o"></span>
                    Dosen</a></li>
            <li <?=isset($buku)?'class="active"':'';?>><a href="<?=$base_url;?>?buku"><span
                        class="fa fa-folder-o"></span> Buku</a></li>
            <?php if($_SESSION['akses']!='user'):?>
            <li <?=isset($pengguna)?'class="active"':'';?>><a href="<?=$base_url;?>?pengguna"><span
                        class="fa fa-folder-o"></span> Pengguna</a></li>
            <?php endif;?>
        </ul>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-folder"></span> Manajemen</a>
        <ul class="animated zoomIn">
            <li <?=isset($peminjaman)?'class="active"':'';?>><a href="<?=$base_url;?>?peminjaman"><span
                        class="fa fa-edit"></span> Peminjaman</a></li>
            <li <?=isset($pengembalian)?'class="active"':'';?>><a href="<?=$base_url;?>?pengembalian"><span
                        class="fa fa-check"></span> Pengembalian</a></li>
            <li <?=isset($pengunjung)?'class="active"':'';?>><a href="<?=$base_url;?>?pengunjung"><span
                        class="fa fa-eye"></span> Pengunjung</a></li>
        </ul>
    </li>
    <?php endif;?>
    <li class="<?=isset($pinjam)?'active':'';?>">
        <a href="<?=$base_url;?>?pinjam"><span class="fa fa-edit"></span> Pinjam Buku</a>
    </li>
    <li class="<?=isset($kembalikan)?'active':'';?>">
        <a href="<?=$base_url;?>?kembalikan"><span class="fa fa-check-square-o"></span> Kembalikan Buku</a>
    </li>
    <?php endif;?>
    <li class="<?=isset($grafik)?'active':'';?>">
        <a href="<?=$base_url;?>?statistik_pengunjung"><span class="fa fa-bar-chart-o"></span> Pengunjung</a>
    </li>
    <li class="xn-openable">
        <a href="#"><span class="fa fa-cogs"></span> Pengaturan</a>
        <ul class="animated zoomIn">
            <li class="<?=isset($profil)?'active':'';?>"><a href="<?=$base_url;?>?profil"><span
                        class="fa fa-user"></span> Profile</a></li>
            <li class="<?=isset($change_password)?'active':'';?>"><a href="<?=$base_url;?>?change_password"><span
                        class="fa fa-key"></span> Change Password</a></li>
            <hr style="border:1px solid #ffffff;margin-bottom:0px;">
            <?php if($_SESSION['akses']=='super_user'):?>
            <li><a href="<?=$base_url;?>?backup_db"><span class="fa fa-hdd-o"></span> Backup Database</a></li>
            <hr style="border:1px solid #ffffff;margin-bottom:0px;">
            <li><a href="<?=$base_url;?>?backup_app"><span class="fa fa-hdd-o"></span> Backup App</a></li>
            <hr style="border:1px solid #ffffff;margin-bottom:0px;">
            <?php endif;?>
        </ul>
    </li>
    <!-- SIGN OUT -->
    <li class="pull-right" style="background-color:red;">
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span> KELUAR</a>
    </li>
    <!-- END SIGN OUT -->
</ul>
<!-- END X-NAVIGATION VERTICAL -->