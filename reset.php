<?php
    session_start();
    include ('config/connection.php');
    $base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url.= "://".$_SERVER['HTTP_HOST'];
    $base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

    if(isset($_POST['reset'])){
        $username = $_POST['username'];
        $password =password_hash('12345',PASSWORD_DEFAULT);

        $update = mysqli_query($con,"UPDATE users SET user_password='$password' WHERE user_name='$username'") or die (mysqli_error($con));
        if($update){
            $msg = 'Password berhasil direset, password anda saat in <b>12345</b>';
        }else{
            $msg = 'Gagal mereset password anda';
        }
        $_SESSION['msg'] = $msg;
    }
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">

<head>
    <!-- META SECTION -->
    <title>SkripsiLibrary | Sistem Informasi Perputakaan Skripsi</title>
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
                    style="width:40%;height:45px;margin-bottom:-3px;">
            </div>
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong style="font-size:12pt;">Informasi </strong> <br><?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
            <div class="login-body">
                <div class="login-title"><strong>Reset</strong>, your password ?</div>
                <form action="" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="username" placeholder="Username" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="<?=$base_url;?>login.php" class="btn btn-link btn-block">Login Here</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="reset" class="btn btn-info btn-block">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="pull-left">
                    &copy; <?=date('Y');?> <b>Skripsi</b>Library
                </div>
                <div class="pull-right">
                    <p>Nurul Hikmah</p>
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