<?php
session_start();
include ('../config/connection.php');
include ('../config/fungsi.php');
if(isset($_POST['kembalikan'])){
    $peminjamID = $_POST['peminjamID'];
    $kodeBuku = $_POST['kodeBuku'];
    $sql = "SELECT peminjaman.idpeminjaman,mahasiswa.idmahasiswa as mhs_id,mahasiswa.nim,mahasiswa.nama_lengkap as mhs,dosen.iddosen as dsn_id,dosen.nip,dosen.nama_lengkap as dsn,buku.idbuku,buku.cover_buku,buku.kode_buku,buku.judul_buku,peminjaman.tgl_kembali,peminjaman.jml_pinjam FROM peminjaman
    LEFT JOIN mahasiswa ON mahasiswa.nim=peminjaman.peminjam_kode
    LEFT JOIN dosen ON dosen.nip=peminjaman.peminjam_kode
    LEFT JOIN buku ON buku.idbuku=peminjaman.buku_id 
    WHERE peminjaman.peminjam_kode='$peminjamID' AND peminjaman.buku_kode='$kodeBuku'
    ORDER BY peminjaman.idpeminjaman DESC";
    
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    
    $tgl_kembali = date('Y-m-d');
    $peminjam_id = $data['mhs_id']==null?$data['dsn_id']:$data['mhs_id'];
    $peminjam_kode = $data['nim']==null?$data['nip']:$data['nim'];
    $buku_id = $data['idbuku'];
    $buku_kode = $data['kode_buku'];
    $jml_kembali = $data['jml_pinjam'];
    $peminjaman_id = $data['idpeminjaman'];
    $petugas_id = $_SESSION['iduser'];
    $telat = hitungHari($data['tgl_kembali'],$tgl_kembali)<0?0:hitungHari($data['tgl_kembali'],$tgl_kembali);
    $denda = $telat*1000;
    // var_dump($telat);
    // var_dump($denda);die;
    $insert = mysqli_query($con,"INSERT INTO pengembalian (idpengembalian, tgl_kembali, telat, denda, peminjam_id, peminjam_kode, buku_id, buku_kode, jml_kembali, peminjaman_id, petugas_id) VALUES ('','$tgl_kembali','$telat','$denda','$peminjam_id','$peminjam_kode','$buku_id','$buku_kode','$jml_kembali','$peminjaman_id','$petugas_id')");
    if($insert){
    
        $msg = 'Berhasil mengembalikan buku';
    }else{
    
        $msg = 'Gagal mengembalikan buku';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?kembalikan');
}
if (isset($_GET['id'])!="") {
    $idpengembalian = $_GET['id'];
    $sqlDel = "DELETE FROM pengembalian WHERE idpengembalian='$idpengembalian'";
    $query = mysqli_query($con,$sqlDel)or die(mysqli_error($con));
    if ($query) {
        $msg = "Data pengembalian berhasil dihapus";
    }else{
        $msg = "Data pengembalian gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pengembalian');
}
?>