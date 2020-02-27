<?php
session_start();
include ('../config/connection.php');
$rows = explode("\n",$_POST['dsn']);
$success = 0;
$failed = 0;
$exist = 0;
foreach ($rows as $row) {
    $exp = explode("\t", $row);
    if (count($exp) != 7) continue;
    $nip = trim($exp[0]);
    $nama_lengkap = trim($exp[1]);
    $tempat_lahir = trim($exp[2]);
    $tanggal_lahir = trim($exp[3]);
    $jk = trim($exp[4]);
    $telp = trim($exp[5]);
    $alamat = trim($exp[6]);
    $cek = mysqli_query($con,"SELECT * FROM dosen WHERE nip='$nip'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con,"INSERT INTO dosen (iddosen, nip, nama_lengkap, tempat_lahir, tanggal_lahir, jk, telp, alamat) VALUES ('','$nip','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jk','$telp','$alamat')") or die (mysqli_error($con));
        $insert?$success++:$failed;
    }else{
        $exist++;
    }
}
$_SESSION['msg'] = $success." Success. ".$failed." Failed. ".$exist." Exist.";
header('Location:../?dosen');
?>