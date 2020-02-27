<?php
session_start();
include ('../config/connection.php');

if(isset($_POST['save'])){
    $nim = $_POST['nim'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $jenjang = $_POST['jenjang'];
    $program_studi = $_POST['program_studi']=='Lainnya'?$_POST['other_program_studi']:$_POST['program_studi'];

    $foto       = $_FILES['foto'];
    $filename    = $_FILES['foto']['name'];
    $filetmp     = $_FILES['foto']['tmp_name'];
    $filesize    = $_FILES['foto']['size'];
    $filetype    = $_FILES['foto']['type'];
    $fileext     = explode('.', $filename);
    $fileactext  = strtolower(end($fileext));
    $allowed    = array('jpg','jpeg','png','gif','bmp');

    $cek = mysqli_query($con,"SELECT * FROM mahasiswa WHERE nim='$nim'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        if($filename!=""){
            if (in_array($fileactext, $allowed)) {
                if ($filesize<51200000) {
                    $filenew = $nim."-".$nama_lengkap."-".date('YmdHis').".".$fileactext;
                    $filefolder = '../uploads/mahasiswa/'.$filenew;
                    
                    move_uploaded_file($filetmp, $filefolder);
                    $insert = mysqli_query($con,"INSERT INTO mahasiswa (idmahasiswa, nim, nama_lengkap, tempat_lahir, tanggal_lahir, jk, jenjang, program_studi, foto) VALUES ('','$nim','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$jenjang','$program_studi','$filenew')") or die (mysqli_error($con));
                    $msg = 'Berhasil menambahkan data mahasiswa';
                }else{
                    $msg = "Ukuran foto yang anda upload terlalu besar.";
                }
            }else{
                $msg = "Format foto yang anda upload tidak sesuai.";
            }
        }else{
            $insert = mysqli_query($con,"INSERT INTO mahasiswa (idmahasiswa, nim, nama_lengkap, tempat_lahir, tanggal_lahir, jk, jenjang, program_studi) VALUES ('','$nim','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$jenjang','$program_studi')") or die (mysqli_error($con));
            $msg = 'Berhasil menambahkan data mahasiswa';
        }
    }else{
        $msg = 'Gagal menambahkan data mahasiswa';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?mahasiswa');
}
if(isset($_POST['edit'])){
    $id = $_POST['idmhs'];
    $nim = $_POST['nim'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $jenjang = $_POST['jenjang'];
    // $program_studi = $_POST['program_studi'];
    $program_studi = $_POST['program_studi']=='Lainnya'?$_POST['other_program_studi']:$_POST['program_studi'];

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
                $filenew = $nim."-".$nama_lengkap."-".date('YmdHis').".".$fileactext;
                $filefolder = '../uploads/mahasiswa/'.$filenew;
                
                $cek = mysqli_fetch_array(mysqli_query($con,"SELECT foto FROM mahasiswa WHERE idmahasiswa='$id'")) or die(mysqli_error($con));
                if($cek['foto']!=''){
                    unlink('../uploads/mahasiswa/'.$cek['foto']);
                }
                move_uploaded_file($filetmp, $filefolder);
                $update = mysqli_query($con,"UPDATE mahasiswa SET nim='$nim', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', jenjang='$jenjang', program_studi='$program_studi', foto='$filenew' WHERE idmahasiswa='$id'") or die (mysqli_error($con));
            }else{
                $msg = "Ukuran foto yang anda upload terlalu besar.";
            }
        }else{
            $msg = "Format foto yang anda upload tidak sesuai.";
        }
    }
    $update = mysqli_query($con,"UPDATE mahasiswa SET nim='$nim', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', jk='$jk', jenjang='$jenjang', program_studi='$program_studi' WHERE idmahasiswa='$id'") or die (mysqli_error($con));
    if($update){
        $msg = 'Berhasil mengubah data mahasiswa';
    }else{
        $msg = 'Gagal mengubah data mahasiswa';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?mahasiswa');
}
if (isset($_GET['id'])!="") {
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM mahasiswa WHERE idmahasiswa='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data mahasiswa berhasil dihapus";
    }else{
        $msg = "Data mahasiswa gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?mahasiswa');
}
?>