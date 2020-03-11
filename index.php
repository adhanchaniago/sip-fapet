<?php
    ob_start();
    session_start();
    include ('config/connection.php');
    include ('config/fungsi.php');
    $base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url.= "://".$_SERVER['HTTP_HOST'];
    $base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    if($_SESSION['username']=="" && $_SESSION['akses']==""):
        header("Location:".$base_url."login.php");
    else:
        session_timeout();
        include('config/header.php');
?>

<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container page-navigation-top-fixed">
        <!-- sidebar disini -->
        <?php
            if(isset($_GET['backup_app'])){
                $hal = 'proses/backup_app.php';
            }
            else if(isset($_GET['backup_db'])){
                $hal = 'proses/backup_db.php';
            }
            else if(isset($_GET['mahasiswa'])){
                $master = true;
                $mahasiswa = true;
                $hal = 'hal/data/mahasiswa.php';
            }
            else if(isset($_GET['dosen'])){
                $master = true;
                $dosen = true;
                $hal = 'hal/data/dosen.php';
            }
            else if(isset($_GET['buku'])){
                $master = true;
                $buku = true;
                $hal = 'hal/data/buku.php';
            }
            else if(isset($_GET['pengguna'])){
                $master = true;
                $pengguna = true;
                $hal = 'hal/data/pengguna.php';
            }
            else if(isset($_GET['pinjam'])){
                $pinjam = true;
                $hal = 'hal/form/pinjam.php';
            }
            else if(isset($_GET['kembalikan'])){
                $kembalikan = true;
                $hal = 'hal/form/kembalikan.php';
            }
            else if(isset($_GET['statistik_pengunjung'])){
                $grafik = true;
                $hal = 'hal/data/statistik_pengunjung.php';
            }
            else if(isset($_GET['profil'])){
                $setting = true;
                $profil = true;
                $hal = 'hal/form/profil.php';
            }
            else if(isset($_GET['change_password'])){
                $setting = true;
                $change_password = true;
                $hal = 'hal/form/change_password.php';
            }
            else if(isset($_GET['peminjaman'])){
                $manajemen = true;
                $peminjaman = true;
                $hal = 'hal/data/peminjaman.php';
            }
            else if(isset($_GET['pengembalian'])){
                $manajemen = true;
                $pengembalian = true;
                $hal = 'hal/data/pengembalian.php';
            }
            else if(isset($_GET['pengunjung'])){
                $manajemen = true;
                $pengunjung = true;
                $hal = 'hal/data/pengunjung.php';
            }
            else if(isset($_GET['aktifkan_keys'])){
                $hal = 'proses/aktifkan_key.php';
            }
            else{
                $home = true;
                $hal = 'hal/data/dashboard.php';
            }
            include ('config/sidebar.php');
        ?>
        <!-- PAGE CONTENT -->
        <div class="page-content">
            <!-- START X-NAVIGATION VERTICAL -->
            <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                <!-- TOGGLE NAVIGATION -->
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                </li>
                <li style="color:white;font-size:12pt;padding:15px 0px 0px 5px;min-width:640px;margin-bottom:-50px;">
                    <marquee behavior="scroll" direction="left">
                        SISTEM INFORMASI PERPUSTAKAAN FAKULTAS PETERNAKAN
                    </marquee>
                </li>
                <!-- END TOGGLE NAVIGATION -->
                <!-- SIGN OUT -->
                <li class="pull-right" style="background-color:red;">
                    <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span>
                        KELUAR</a>
                </li>
                <!-- END SIGN OUT -->
            </ul>
            <!-- END X-NAVIGATION VERTICAL -->
            <?php
                // include('config/nav.php');
                include ($hal);
            ?>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->
    <?php include('config/footer.php');?>
</body>

</html>
<?php endif;?>