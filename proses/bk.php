<?php
session_start();
include ('../config/connection.php');
include ('../config/fungsi.php');

if(isset($_POST['save'])){
    $kode_buku = 'BOOK'.rand();
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $kota_terbit = $_POST['kota_terbit'];
    $penerbit = $_POST['penerbit'];
    $tahun_buku = $_POST['tahun_buku'];
    $jml_hal = delMask($_POST['jml_hal']);
    $jml_buku = delMask($_POST['jml_buku']);
    $stok = delMask($_POST['jml_buku']);

    $cek = mysqli_query($con,"SELECT * FROM buku WHERE isbn='$isbn'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con,"INSERT INTO buku (idbuku, kode_buku, isbn, judul_buku, pengarang, kota_terbit, penerbit, tahun_buku, jml_hal, jml_buku, stok) VALUES ('','$kode_buku','$isbn','$judul_buku','$pengarang','$kota_terbit','$penerbit','$tahun_buku','$jml_hal','$jml_buku','$stok')") or die (mysqli_error($con));
        $msg = 'Berhasil menambahkan data buku';
    }else{
        $msg = 'Gagal menambahkan data buku';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?buku');
}
if(isset($_POST['edit'])){
    $id = $_POST['idbuku'];
    $isbn = $_POST['isbn'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $kota_terbit = $_POST['kota_terbit'];
    $penerbit = $_POST['penerbit'];
    $tahun_buku = $_POST['tahun_buku'];
    $jml_hal = delMask($_POST['jml_hal']);
    $jml_buku = delMask($_POST['jml_buku']);

    $update = mysqli_query($con,"UPDATE buku SET isbn='$isbn', judul_buku='$judul_buku', pengarang='$pengarang', kota_terbit='$kota_terbit', penerbit='$penerbit', tahun_buku='$tahun_buku', jml_hal='$jml_hal', jml_buku='$jml_buku' WHERE idbuku='$id'") or die (mysqli_error($con));
    if($update){
        $msg = 'Berhasil mengubah data buku';
    }else{
        $msg = 'Gagal menngubah data buku';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?buku');
}
if(isset($_POST['change_image'])){
    $id  = $_POST['idbuku'];
    $file       = $_FILES['file'];
    
    $filename    = $_FILES['file']['name'];
    $filetmp     = $_FILES['file']['tmp_name'];
    $filesize    = $_FILES['file']['size'];
    $filetype    = $_FILES['file']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    if($filename!=""){
        if (in_array($fileactext, $allowed)) {
            if ($filesize<51200000) {
                $filenew = "BOOK-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/buku/'.$filenew;
                $cek = mysqli_fetch_array(mysqli_query($con, "SELECT cover_buku FROM buku WHERE idbuku='$id'"))or die(mysqli_error($con));
                if($cek['cover_buku']!=''){
                    unlink('../uploads/buku/'.$cek['cover_buku']);
                }
                move_uploaded_file($filetmp, $filefolder);
                $query = mysqli_query($con, "UPDATE buku SET cover_buku='$filenew' WHERE idbuku='$id'") or die (mysqli_error($con));
                if ($query) {
                    $msg = "Anda berhasil mengubah cover buku";
                }else{
                    $msg = "Anda gagal mengubah cover buku";
                }
            }else{
                $msg = "Ukuran file yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format file yang anda upload tidak sesuai.";
        }
    }
    $_SESSION['msg']=$msg;
    header('Location:../?buku'); 
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    $cek = mysqli_fetch_array(mysqli_query($con, "SELECT cover_buku FROM buku WHERE idbuku='$id'"))or die(mysqli_error($con));
    if($cek['cover_buku']!=''){
        unlink('../uploads/buku/'.$cek['cover_buku']);
    }
    $query = mysqli_query($con, "DELETE FROM buku WHERE idbuku='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data buku berhasil dihapus";
    }else{
        $msg = "Data buku gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?buku');
}
?>