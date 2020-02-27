<?php
include ('../config/connection.php');
if(isset($_POST['scan'])){
    $val = $_POST['scan'];
    $buku = mysqli_query($con, "SELECT * FROM buku WHERE kode_buku='$val'");
    $data = mysqli_fetch_array($buku);
    if(mysqli_num_rows($buku)!=0){
        $peminjam_id = 0;
        $peminjam_kode = 0;
        $peminjam_nama = 0;
        $buku_id = $data['idbuku'];
        $cover_buku = $data['cover_buku'];
        $kode_buku = $data['kode_buku'];
        $judul_buku = $data['judul_buku'];
        $jml_buku = $data['jml_buku'];
        $stok = $data['stok'];
        $jml_pinjam = 1;
        $tanggal = date('Y-m-d');
        $cek = mysqli_query($con,"SELECT kode_buku FROM tmp_peminjaman WHERE kode_buku='$val'");
        if(mysqli_num_rows($cek)==0){
            mysqli_query($con,"INSERT INTO tmp_peminjaman (idtmp, peminjam_id, peminjam_kode, peminjam_nama, buku_id, cover_buku, kode_buku, judul_buku, jml_buku, stok, jml_pinjam, tanggal) VALUES ('','$peminjam_id','$peminjam_kode','$peminjam_nama','$buku_id','$cover_buku','$kode_buku','$judul_buku','$jml_buku','$stok','$jml_pinjam','$tanggal')");
            echo json_encode(true);
        }else{
            mysqli_query($con,"UPDATE tmp_peminjaman SET jml_pinjam=jml_pinjam+1 WHERE kode_buku='$val'");
            echo json_encode(true);
        }
    }else{
        $mhs = mysqli_query($con,"SELECT idmahasiswa,nim,nama_lengkap FROM mahasiswa WHERE nim='$val'");
        if(mysqli_num_rows($mhs)==0){
            $dsn = mysqli_query($con,"SELECT iddosen,nip,nama_lengkap FROM dosen WHERE nip='$val'");
            $row = mysqli_fetch_array($dsn);
            $peminjam_id=$row['iddosen'];
            $peminjam_kode=$row['nip'];
            $peminjam_nama=$row['nama_lengkap'];
            mysqli_query($con,"UPDATE tmp_peminjaman SET peminjam_id='$peminjam_id', peminjam_kode='$peminjam_kode', peminjam_nama='$peminjam_nama'");
            echo json_encode(true);
        }else{
            // echo json_encode($val);die;
            // echo json_encode($peminjam_nama);die;
            $row = mysqli_fetch_array($mhs);
            $peminjam_id=$row['idmahasiswa'];
            $peminjam_kode=$row['nim'];
            $peminjam_nama=$row['nama_lengkap'];
            mysqli_query($con,"UPDATE tmp_peminjaman SET peminjam_id='$peminjam_id', peminjam_kode='$peminjam_kode', peminjam_nama='$peminjam_nama'");
            echo json_encode(true);
        }
    }
}
if(isset($_POST['update'])=='jml_update'){
    $id = $_POST['id'];
    $data = mysqli_fetch_array(mysqli_query($con,"SELECT stok,jml_pinjam FROM tmp_peminjaman WHERE idtmp='$id'"));
    // echo json_encode($id);die;
    $jml = $_POST['jml'];
    if($data['stok']>=$jml){
        mysqli_query($con,"UPDATE tmp_peminjaman SET jml_pinjam='$jml' WHERE idtmp='$id'");
        echo json_encode($jml);
    }
    echo json_encode($data['jml_pinjam']);
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    mysqli_query($con, "DELETE FROM tmp_peminjaman WHERE idtmp='$id'")or die(mysqli_error($con));
    header('Location:../?pinjam');
}
?>