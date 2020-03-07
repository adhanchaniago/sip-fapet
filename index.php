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
    <div class="page-container page-navigation-top">
        <!-- PAGE CONTENT -->
        <div class="page-content">
            <?php
                if(isset($_GET['backup_app'])){
                    $hal = 'proses/backup_app.php';
                }
                else if(isset($_GET['backup_db'])){
                    $hal = 'proses/backup_db.php';
                }
                else if(isset($_GET['mahasiswa'])){
                    $mahasiswa = true;
                    $hal = 'hal/data/mahasiswa.php';
                }
                else if(isset($_GET['dosen'])){
                    $dosen = true;
                    $hal = 'hal/data/dosen.php';
                }
                else if(isset($_GET['buku'])){
                    $buku = true;
                    $hal = 'hal/data/buku.php';
                }
                else if(isset($_GET['pengguna'])){
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
                    $profil = true;
                    $hal = 'hal/form/profil.php';
                }
                else if(isset($_GET['change_password'])){
                    $change_password = true;
                    $hal = 'hal/form/change_password.php';
                }
                else if(isset($_GET['peminjaman'])){
                    $peminjaman = true;
                    $hal = 'hal/data/peminjaman.php';
                }
                else if(isset($_GET['pengembalian'])){
                    $pengembalian = true;
                    $hal = 'hal/data/pengembalian.php';
                }
                else if(isset($_GET['pengunjung'])){
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
                include('config/nav.php');
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