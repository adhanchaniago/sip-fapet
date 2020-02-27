<?php
    session_start();
    include ('config/connection.php');
    $base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url.= "://".$_SERVER['HTTP_HOST'];
    $base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

    if(isset($_POST['cek_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) && empty($password)){
            $msg = 'Harap isi username dan password';
        }else{
            $user = mysqli_query($con,"SELECT * FROM users WHERE user_name='$username'") or die(mysqli_error($con));
            if(mysqli_num_rows($user)!=0){
                $data = mysqli_fetch_array($user);
                if($data['is_active']==1){
                    if($data['is_block']==0){
                        if(password_verify($password,$data['user_password'])){
                            $_SESSION['iduser'] = $data['idusers'];
                            $_SESSION['username'] = $data['user_name'];
                            $_SESSION['fullname'] = $data['user_fullname'];
                            $_SESSION['akses'] = $data['user_type'];
                            header("Location:".$base_url);
                        }else{
                            $msg = 'Password anda salah';
                        }
                    }else{
                        $msg = 'Akun anda di blokir';
                    }
                }else{
                    $msg = 'Akun anda sudah tidak aktif';
                }
            }else{
                $msg = 'Username tidak terdaftar';
            }
        }
        $_SESSION['msg'] = $msg;
        // header("Location:".$base_url."login.php");
    }
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">

<head>
    <!-- META SECTION -->
    <title>SIP Fapet | Sistem Informasi Perputakaan Fakultas Peternakan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="<?=$base_url;?>assets/img/logo_instansi.png" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?=$base_url;?>assets/css/theme-blue.css" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>

    <div class="login-container">

        <div class="login-box animated fadeInDown">
            <div>
                <img src="<?=$base_url;?>assets/img/logo.png" alt="Logo"
                    style="width:40%;height:45px;margin-bottom:-1px;">
            </div>
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong style="font-size:12pt;">Informasi </strong> <br><?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
            <div class="login-body">
                <div class="login-title"><strong>Welcome</strong>, Please login</div>
                <form action="" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="username" placeholder="Username" autofocus />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="<?=$base_url;?>reset.php" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="cek_login" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="pull-left">
                    &copy; <?=date('Y');?> <b>SIP</b> Fapet
                </div>
                <div class="pull-right">
                    <p>Nunung Mappa Winda</p>
                </div>
            </div>
        </div>

    </div>
    <!-- START PLUGINS -->
    <script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=$base_url;?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- END PLUGINS -->
</body>

</html>