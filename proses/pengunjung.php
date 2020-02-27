<?php
session_start();
include ('../config/connection.php');
if(isset($_POST['scan'])){
    $val = $_POST['scan'];
    $mhs = mysqli_query($con,"SELECT idmahasiswa,nim,nama_lengkap FROM mahasiswa WHERE nim='$val'");
    if(mysqli_num_rows($mhs)==0){
        $dsn = mysqli_query($con,"SELECT iddosen,nip,nama_lengkap FROM dosen WHERE nip='$val'");
        $row = mysqli_fetch_array($dsn);
        $sts = 'Dosen';
        echo json_encode($row);
    }else{
        $row = mysqli_fetch_array($mhs);
        $sts = 'Mahasiswa';
        echo json_encode($row);
    }
    $_SESSION['sts'] = $sts;
}
if(isset($_POST['add_pengunjung'])){
    $tanggal = date('Y-m-d');
    $pengunjung_kode = $_POST['pengunjung_id'];
    $pengunjung_nama = $_POST['nama_lengkap'];
    $pengunjung_sts = $_SESSION['sts'];
    $pengunjung_ket = $_POST['ket'];
    $petugas_id = $_SESSION['iduser'];

    $insert = mysqli_query($con,"INSERT INTO pengunjung (idpengunjung,tanggal,pengunjung_kode,pengunjung_nama,pengunjung_status,pengunjung_ket,petugas_id) VALUES ('','$tanggal','$pengunjung_kode','$pengunjung_nama','$pengunjung_sts','$pengunjung_ket','$petugas_id')")or die(mysqli_error($con));
    if($insert){
        $msg = 'Berhasil menambah pengunjung baru';
    }else{
        $msg = 'Gagal menambah pengunjung baru';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?dashboard');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    mysqli_query($con, "DELETE FROM pengunjung WHERE idpengunjung='$id'")or die(mysqli_error($con));
    header('Location:../?pengunjung');
}
?>