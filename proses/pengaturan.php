<?php
session_start();
include ('../config/connection.php');

if(isset($_POST['profil'])){
    $id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_fullname = $_POST['user_fullname'];
    $user_telp = $_POST['user_telp'];
    $user_bio = $_POST['user_bio'];

    $query = mysqli_query($con,"UPDATE users SET user_name='$user_name',user_fullname='$user_fullname',user_telp='$user_telp',user_bio='$user_bio' WHERE idusers='$id'")or die (mysqli_error($con));
    if($query){
        $msg = 'Profil anda berhasil di update';
    }else{
        $msg = 'Profil anda gagal di update';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?profil');
}
if(isset($_POST['change'])){
    $id = $_POST['user_id'];
    $user_password =password_hash($_POST['password'],PASSWORD_DEFAULT);

    $query = mysqli_query($con,"UPDATE users SET user_password='$user_password' WHERE idusers='$id'")or die (mysqli_error($con));
    if($query){
        $msg = 'Password anda berhasil di ubah';
    }else{
        $msg = 'Password anda gagal di ubah';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?change_password');
}
// if(isset($_POST['umum'])){
//     $id = $_POST['id'];
//     $nama_instansi = $_POST['nama_instansi'];
//     $nama_ketua = $_POST['nama_ketua'];
//     $nip_ketua = $_POST['nip_ketua'];
//     $catatan = $_POST['catatan'];

//     $logo       = $_FILES['logo_instansi'];
//     $logoname    = $_FILES['logo_instansi']['name'];
//     $logotmp     = $_FILES['logo_instansi']['tmp_name'];
//     $logosize    = $_FILES['logo_instansi']['size'];
//     $logotype    = $_FILES['logo_instansi']['type'];
//     $logoext     = explode('.', $logoname);
//     $logoactext  = strtolower(end($logoext));
//     $allowed    = array('jpg','jpeg','png','gif','bmp');

//     if($logoname!=""){
//         if (in_array($logoactext, $allowed)) {
//             if ($logosize<51200000) {
//                 $logonew = "LOGO-".date('YmdHis').".".$logoactext;
//                 $logofolder = '../uploads/'.$logonew;
//                 move_uploaded_file($logotmp, $logofolder);
                    
//                 $query = mysqli_query($con, "UPDATE pengaturan SET logo_instansi='$logonew' WHERE id='$id'") or die (mysqli_error($con));
//             }else{
//                 $msg = "Ukuran file yang anda upload terlalu besar.";
//             }
//         }else{
//             $msg = "Format file yang anda upload tidak sesuai.";
//         }
//     }
//     $ttd       = $_FILES['ttd'];
//     $ttdname    = $_FILES['ttd']['name'];
//     $ttdtmp     = $_FILES['ttd']['tmp_name'];
//     $ttdsize    = $_FILES['ttd']['size'];
//     $ttdtype    = $_FILES['ttd']['type'];
//     $ttdext     = explode('.', $ttdname);
//     $ttdactext  = strtolower(end($ttdext));
//     $allowed    = array('png');

//     if($ttdname!=""){
//         if (in_array($ttdactext, $allowed)) {
//             if ($logosize<51200000) {
//                 $ttdnew = "TTD-".date('YmdHis').".".$ttdactext;
//                 $ttdfolder = '../uploads/'.$ttdnew;
//                 move_uploaded_file($ttdtmp, $ttdfolder);
                    
//                 $query = mysqli_query($con, "UPDATE pengaturan SET ttd='$ttdnew' WHERE id='$id'") or die (mysqli_error($con));
//             }else{
//                 $msg = "Ukuran file yang anda upload terlalu besar.";
//             }
//         }else{
//             $msg = "Format file yang anda upload tidak sesuai.";
//         }
//     }
//     $query = mysqli_query($con,"UPDATE pengaturan SET nama_instansi='$nama_instansi', nama_ketua='$nama_ketua', nip_ketua='$nip_ketua', catatan='$catatan' WHERE id='$id'")or die (mysqli_error($con));
//     if($query){
//         $msg = 'Pengaturan umum berhasil di update';
//     }else{
//         $msg = 'Pengaturan umum gagal di update';
//     }
//     $_SESSION['msg'] = $msg;
//     header('Location:../?umum');
// }

?>