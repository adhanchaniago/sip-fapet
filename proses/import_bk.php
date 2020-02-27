<?php
session_start();
include ('../config/connection.php');
$rows = explode("\n",$_POST['bk']);
$success = 0;
$failed = 0;
$exist = 0;
foreach ($rows as $row) {
    $exp = explode("\t", $row);
    if (count($exp) != 7) continue;
    $kode_buku = 'BOOK'.rand();
    $judul_buku = trim($exp[0]);
    $pengarang = trim($exp[1]);
    $kota_terbit = trim($exp[2]);
    $penerbit = trim($exp[3]);
    $tahun_buku = trim($exp[4]);
    $jml_hal = trim($exp[5]);
    $jml_buku = trim($exp[6]);
    $stok = trim($exp[6]);
    $cek = mysqli_query($con,"SELECT * FROM buku WHERE kode_buku='$kode_buku'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con,"INSERT INTO buku (idbuku, kode_buku, judul_buku, pengarang, kota_terbit, penerbit, tahun_buku, jml_hal, jml_buku, stok) VALUES ('','$kode_buku','$judul_buku','$pengarang','$kota_terbit','$penerbit','$tahun_buku','$jml_hal','$jml_buku','$stok')") or die (mysqli_error($con));
        $insert?$success++:$failed;
    }else{
        $exist++;
    }
}
$_SESSION['msg'] = $success." Success. ".$failed." Failed. ".$exist." Exist.";
header('Location:../?buku');
?>