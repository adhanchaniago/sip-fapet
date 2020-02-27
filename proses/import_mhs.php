<?php
session_start();
include ('../config/connection.php');
$rows = explode("\n",$_POST['mhs']);
$success = 0;
$failed = 0;
$exist = 0;
foreach ($rows as $row) {
    $exp = explode("\t", $row);
    if (count($exp) != 7) continue;
    $nim = trim($exp[0]);
    $nama_lengkap = trim($exp[1]);
    $tempat_lahir = trim($exp[2]);
    $tanggal_lahir = trim($exp[3]);
    $jk = trim($exp[4]);
    $jenjang = trim($exp[5]);
    $program_studi = trim($exp[6]);
    $cek = mysqli_query($con,"SELECT * FROM mahasiswa WHERE nim='$nim'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con,"INSERT INTO mahasiswa (idmahasiswa, nim, nama_lengkap, tempat_lahir, tanggal_lahir, jk, jenjang, program_studi) VALUES ('','$nim','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$jenjang','$program_studi')") or die (mysqli_error($con));
        $insert?$success++:$failed;
    }else{
        $exist++;
    }
}
$_SESSION['msg'] = $success." Success. ".$failed." Failed. ".$exist." Exist.";
header('Location:../?mahasiswa');
?>