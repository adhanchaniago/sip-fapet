<?php
session_start();
include ('../config/connection.php');
$query = mysqli_query($con,"SELECT peminjam_kode FROM tmp_peminjaman");
$data = mysqli_fetch_array($query);
if($data['peminjam_kode']!=''&&$data['peminjam_kode']!=null&&$data['peminjam_kode']!='0'){
    $query2 = mysqli_query($con,"SELECT * FROM tmp_peminjaman");
    while ($row = mysqli_fetch_array($query2)) {
        $id = $row['idtmp'];
        $tgl_pinjam = $row['tanggal'];
        $tgl_kembali = date('Y-m-d',strtotime('+1 week',strtotime($tgl_pinjam)));
        $peminjam_id = $row['peminjam_id'];
        $peminjam_kode = $row['peminjam_kode'];
        $buku_id = $row['buku_id'];
        $buku_kode = $row['kode_buku'];
        $jml_pinjam = $row['jml_pinjam'];
        $petugas_id = $_SESSION['iduser'];
        mysqli_query($con,"INSERT INTO peminjaman (idpeminjaman, tgl_pinjam, tgl_kembali, peminjam_id, peminjam_kode, buku_id, buku_kode, jml_pinjam, petugas_id) VALUES ('','$tgl_pinjam','$tgl_kembali','$peminjam_id','$peminjam_kode','$buku_id','$buku_kode','$jml_pinjam','$petugas_id')");
        mysqli_query($con,"DELETE FROM tmp_peminjaman WHERE idtmp='$id'");
    }
    $msg = 'Berhasil menambah peminjaman baru';
}else{
    $msg = 'Maaf data peminjam belum ada';
}
$_SESSION['msg'] = $msg;
header('Location:../?pinjam');

if(isset($_POST['edit'])){
    $id = $_POST['idpeminjaman'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $query = mysqli_query($con,"UPDATE peminjaman SET tgl_kembali='$tgl_kembali' WHERE idpeminjaman='$id'");
    if ($query) {
        $msg = "Data peminjaman berhasil di perpanjang";
    }else{
        $msg = "Data peminjaman gagal di perpanjang";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?peminjaman');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM peminjaman WHERE idpeminjaman='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data peminjaman berhasil dihapus";
    }else{
        $msg = "Data peminjaman gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?peminjaman');
}
//syntax menggunakan table detail_pinjam dan pinjam
// $query = mysqli_query($con,"SELECT peminjam_kode FROM tmp_peminjaman");
// $data = mysqli_fetch_array($query);
// if($data['peminjam_id']!=''&&$data['peminjam_id']!=null&&$data['peminjam_id']!='0'){
//     $tanggal = $data['tanggal'];
//     $peminjam_id = $data['peminjam_id'];
//     $order = "INSERT INTO peminjaman (idpeminjaman, tanggal, peminjam_id) VALUES ('','$tanggal','$peminjam_id')";
//     mysqli_query($con,$order);
//     $order_id = mysqli_insert_id($con);
//     $query2 = mysqli_query($con,"SELECT * FROM tmp_peminjaman");
//     while ($row = mysqli_fetch_array($query2)) {
//         $pinjam_id = $order_id;
//         $id = $row['idtmp'];
//         $buku_id = $row['buku_id'];
//         $kode_buku = $row['kode_buku'];
//         $judul_buku = $row['judul_buku'];
//         $jml_hal = $row['jml_hal'];
//         $jml_buku = $row['jml_buku'];
//         $jml_pinjam = $row['jml_pinjam'];
//         // var_dump($buku_id);
//         mysqli_query($con,"INSERT INTO detail_peminjaman (iddetail_pinjam, pinjam_id, buku_id, kode_buku, judul_buku, jml_hal, jml_buku, jml_pinjam) VALUES ('','$pinjam_id','$buku_id','$kode_buku','$judul_buku','$jml_hal','$jml_buku','$jml_pinjam')");
//         mysqli_query($con,"DELETE FROM tmp_peminjaman WHERE idtmp='$id'");
//     }
//     $msg = 'Berhasil menambah peminjaman baru';
// }else{
//     $msg = 'Maaf data peminjam belum ada';
// }
// die;

?>