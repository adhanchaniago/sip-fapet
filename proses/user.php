<?php
session_start();
include ('../config/connection.php');

if(isset($_POST['save'])){
    $user_name = $_POST['user_name'];
    $user_fullname = $_POST['user_fullname'];
    $user_telp = $_POST['user_telp'];
    $user_type = $_POST['user_type'];
    $user_password =password_hash('12345',PASSWORD_DEFAULT);

    $cek = mysqli_query($con,"SELECT * FROM users WHERE user_name='$user_name'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con,"INSERT INTO users (idusers, user_name, user_fullname, user_telp, user_type, user_password, is_active, is_block) VALUES ('','$user_name','$user_fullname','$user_telp','$user_type','$user_password',1,0)") or die (mysqli_error($con));
        $msg = 'Berhasil menambahkan data users';
    }else{
        $msg = 'Gagal menambahkan data users';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pengguna');
}
// if(isset($_POST['edit'])){
//     $id = $_POST['idusers'];
//     $user_name = $_POST['user_name'];
//     $user_fullname = $_POST['user_fullname'];
//     $user_telp = $_POST['user_telp'];
//     $user_type = $_POST['user_type'];

//     $update = mysqli_query($con,"UPDATE users SET user_name='$user_name', user_fullname='$user_fullname', user_telp='$user_telp', user_type='$user_type' WHERE idusers='$id'") or die (mysqli_error($con));
//     // var_dump($update);die;
//     if($update){
//         $msg = 'Berhasil mengubah data users';
//     }else{
//         $msg = 'Gagal mengubah data users';
//     }
//     $_SESSION['msg'] = $msg;
//     header('Location:../?pengguna');
// }
if(isset($_POST['ubah_pass'])){
    $id = $_POST['idusers'];
    $user_password =password_hash($_POST['user_password'],PASSWORD_DEFAULT);

    $update = mysqli_query($con,"UPDATE users SET user_password='$user_password' WHERE idusers='$id'") or die (mysqli_error($con));
    // var_dump($update);die;
    if($update){
        $msg = 'Berhasil mengubah password users';
    }else{
        $msg = 'Gagal mengubah password users';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pengguna');
}
if($_GET['act']=='delete' && isset($_GET['id'])!=""){
    // echo $_GET['act'];die;
    $id = $_GET['id'];
    $query = mysqli_query($con, "DELETE FROM users WHERE idusers='$id'")or die(mysqli_error($con));
    if ($query) {
        $msg = "Data users berhasil dihapus";
    }else{
        $msg = "Data users gagal dihapus";
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pengguna');
}
if($_GET['act']=='block' && isset($_GET['id'])!=""){
    // echo $_GET['act'];die;
    $id = $_GET['id'];
    $cek = mysqli_query($con,"SELECT is_block FROM users WHERE idusers='$id'")or die(mysqli_error($con));
    if(mysqli_fetch_array($cek)['is_block']==0){
        $update = mysqli_query($con,"UPDATE users SET is_block=1 WHERE idusers='$id'") or die (mysqli_error($con));
    }else{
        $update = mysqli_query($con,"UPDATE users SET is_block=0 WHERE idusers='$id'") or die (mysqli_error($con));
    }
    if($update){
        $msg = 'Berhasil memblokir atau membuka blokir user';
    }else{
        $msg = 'Gagal memblokir atau membuka blokir user';
    }
    $_SESSION['msg'] = $msg;
    header('Location:../?pengguna');
}
// if (isset($_GET['id'])!="") {
//     $id = $_GET['id'];
//     $_SESSION['msg'] = $msg;
//     header('Location:../?pengguna');
// }
?>