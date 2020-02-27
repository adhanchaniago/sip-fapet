<?php
session_start();
include ('../config/connection.php');
include ('../config/fungsi.php');

if(isset($_POST['save'])){
    $nip = nip_format($_POST['nip']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $telp = $_POST['jenjang'];
    $alamat = $_POST['alamat'];
    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    $cek = mysqli_query($con,"SELECT * FROM dosen WHERE nip='$nip'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        if($filename!=""){
            if (in_array($fileactext, $allowed)) {
                if ($filesize<51200000) {
                    $filenew = $nip."-".$nama_lengkap."-".date('YmdHis').".".$fileactext;
                    $filefolder = '../uploads/dosen/'.$filenew;
                    
                    move_uploaded_file($filetmp, $filefolder);
                    $insert = mysqli_query($con,"INSERT INTO dosen (iddosen, nip, nama_lengkap, tempat_lahir, tanggal_lahir, jk, telp, alamat, foto) VALUES ('','$nip','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$telp','$alamat','$filenew')") or die (mysqli_error($con));
                    $msg = 'Berhasil menambahkan data dosen';
                }else{
                    $msg = "Ukuran foto yang anda upload terlalu besar.";
                }
            }else{
                $msg = "Format foto yang anda upload tidak sesuai.";
            }
        }else{
            $insert = mysqli_query($con,"INSERT INTO dosen (iddosen, nip, nama_lengkap, tempat_lahir, tanggal_lahir, jk, telp, alamat) VALUES ('','$nip','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$telp','$alamat')") or die (mysqli_error($con));
            $msg = 'Berhasil menambahkan data dosen';
        }
    }else{
        $msg = 'Gagal menambahkan data dosen';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?dosen');
}
if(isset($_POST['edit'])){
    $id = $_POST['iddosen'];
    $nip = $_POST['nip'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    if($filename!=""){
        if (in_array($fileactext, $allowed)) {
            if ($filesize<51200000) {
                $filenew = $nip."-".$nama_lengkap."-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/dosen/'.$filenew;
                
                $cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto FROM dosen WHERE iddosen='$id'")) or die(mysqli_error($con));
                if($cek['foto']!=''){
                    unlink('../uploads/dosen/'.$cek['foto']);
                }
                move_uploaded_file($filetmp, $filefolder);
                $update = mysqli_query($con,"UPDATE dosen SET nip='$nip', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', telp='$telp', alamat='$alamat', foto='$filenew' WHERE iddosen='$id'") or die (mysqli_error($con));
            }else{
                $msg = "Ukuran foto yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format foto yang anda upload tidak sesuai.";
        }
    }
    $update = mysqli_query($con,"UPDATE dosen SET nip='$nip', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', telp='$telp', alamat='$alamat' WHERE iddosen='$id'") or die (mysqli_error($con));
    if($update){
        $msg = 'Berhasil mengubah data dosen';
    }else{
        $msg = 'Gagal mengubah data dosen';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?dosen');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM dosen WHERE iddosen='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data dosen berhasil dihapus";
    }else{
        $msg = "Data dosen gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?dosen');
}
?>