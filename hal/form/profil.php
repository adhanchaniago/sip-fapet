<?php
$id = $_SESSION['iduser'];
$query = mysqli_query($con,"SELECT * FROM users WHERE idusers='$id'")or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?=$base_url;?>">Home</a></li>
    <li><a href="#">Pengaturan</a></li>
    <li class="active">Profil</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong style="font-size:12pt;">Informasi </strong> <br><?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
        </div>
        <form action="<?=$base_url;?>proses/pengaturan.php" method="post" enctype="multipart/form-data">
            <!-- START JQUERY VALIDATION PLUGIN -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="hidden" name="user_id" class="form-control"
                                            value="<?=$row['idusers'];?>">
                                        <input type="text" name="user_name" class="form-control"
                                            value="<?=$row['user_name'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Nama Lengkap<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="user_fullname"
                                        value="<?=$row['user_fullname'];?>" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Nomor Telepon<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="user_telp"
                                        value="<?=$row['user_telp'];?>" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Bio<span style="color:red;">*</span></label>
                                    <textarea class="form-control" rows="10" name="user_bio"
                                        placeholder="Type your bio here..." required><?=$row['user_bio'];?></textarea>
                                </div>
                            </div>
                            <a href="<?=$base_url;?>" class="btn btn-default pull-left"><i class="fa fa-reply"></i>
                                Cancel</a>
                            <button type="submit" class="btn btn-info pull-right" id="btn-ubah" name="profil"><i
                                    class="fa fa-save"></i>
                                Update &
                                Save</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- END JQUERY VALIDATION PLUGIN -->
    </form>
</div>
</div>
<!-- PAGE CONTENT WRAPPER -->