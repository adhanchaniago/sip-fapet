<?php hakAkses(['super_user','administrator']);?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="user_name"]').val("");
        $('[name="user_fullname"]').val("");
        $('[name="user_telp"]').val("");
        $('[name="user_type"]').val("");
        $('#modal_add .modal-title').html('Add New Pengguna');
        $('#user_name').prop('readonly', false);
        $('#password').show();
        // $('#level').show();
        $('#btn-ubah').hide();
        $('#btn-add').show();
    } else {
        $('#modal_add .modal-title').html('Edit Pengguna');
        $('#user_name').prop('readonly', true);
        $('#password').hide();
        // $('#level').hide();
        $('#btn-add').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=$base_url;?>proses/view_user.php',
            dataType: 'json',
            success: function(data) {
                if (data.user_type == 'mahasiswa' || data.user_type == 'dosen' || data.user_type ==
                    'super_user') {
                    $('#level').prop('readonly', true);
                } else {
                    $('#level').prop('readonly', false);
                }
                $('[name="idusers"]').val(data.idusers);
                $('[name="user_name"]').val(data.user_name);
                $('[name="user_fullname"]').val(data.user_fullname);
                $('[name="user_telp"]').val(data.user_telp);
                $('[name="user_type"]').val(data.user_type);
            }
        });
    }
}

function ubah_password(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=$base_url;?>proses/view_user.php',
        dataType: 'json',
        success: function(data) {
            $('[name="idusers"]').val(data.idusers);
        }
    });
}
</script>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?=$base_url;?>">Home</a></li>
    <li><a href="#">Master</a></li>
    <li class="active">Dosen</li>
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
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Master Data Pengguna</h3>
                    <ul class="panel-controls">
                        <li data-toggle="tooltip" data-placement="top" title="Tambah Baru"><a href="#"
                                data-toggle="modal" data-target="#modal_add" onclick="submit('add')"><span
                                    class="fa fa-plus"></span></a></li>
                        <!-- <li><a href="#" data-toggle="modal" data-target="#modal_import"><span
                                    class="fa fa-upload"></span></a></li> -->
                        <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                href="<?=$base_url;?>?pengguna"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <!-- <th width="55"><i class="fa fa-edit"></i></th> -->
                                <th width="55"><i class="fa fa-key"></i></th>
                                <th>NAMA PENGGUNA</th>
                                <th>NO. TELP</th>
                                <th>USERNAME</th>
                                <th>LEVEL</th>
                                <th width="100">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $query = mysqli_query($con,"SELECT * FROM users ORDER BY idusers ASC")or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <!-- <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$row['idusers'];?>)"><i
                                            class="fa fa-edit"></i></a></td> -->
                                <td><a href="#modal_key" data-toggle="modal"
                                        onclick="ubah_password(<?=$row['idusers'];?>)"><i class="fa fa-key"></i></a>
                                </td>
                                <td><?=$row['user_fullname'];?></td>
                                <td><?=$row['user_telp'];?></td>
                                <td><?=$row['user_name'];?></td>
                                <td><?=$row['user_type']=='user'?'petugas':$row['user_type'];?></td>
                                <td>
                                    <?php if($row['user_type']!='super_user' && $row['user_name']!=$_SESSION['username']):?>

                                    <a href="<?=$base_url;?>proses/user.php?id=<?=$row['idusers'];?>&act=block"
                                        class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top"
                                        title="<?=($row['is_block']==0)?'Block':'Unblock';?>"><i
                                            class="fa fa-ban"></i></a>
                                    <a href="<?=$base_url;?>proses/user.php?id=<?=$row['idusers'];?>&act=delete"
                                        class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Hapus"><i class="fa fa-trash-o"></i>
                                    </a>
                                    <?php else:?>
                                    <span class="label label-info"><i class="fa fa-exclamation"></i> No Action</span>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>

</div>
<!-- PAGE CONTENT WRAPPER -->
<div class="modal" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/user.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Username<span style="color:red;">*</span></label>
                                <input type="hidden" class="form-control" name="idusers">
                                <input type="text" class="form-control" name="user_name" placeholder="ex: admin"
                                    id="user_name" autofocus required>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="user_fullname"
                                    placeholder="ex: Nurul Hikmah" required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="user_telp" placeholder="ex: 0852xxxxxxxx"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <label class="control-label">User Level<span style="color:red;">*</span></label>
                            <select class="form-control" name="user_type" id="level" required>
                                <option value="administrator">Administrator</option>
                                <option value="user">Petugas</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-4" style="margin-bottom:15px;" id="password">
                            <div class="form-group">
                                <label class="control-label">Password<span style="color:red;">*</span></label>
                                <input type="password" class="form-control" name="user_password" required>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info pull-right" id="btn-ubah" name="edit"><i
                            class="fa fa-save"></i>
                        Update &
                        Save</button>
                    <button type="submit" class="btn btn-info pull-right" id="btn-add" name="save"><i
                            class="fa fa-save"></i> Add
                        New &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modal_key" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/user.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead">Rubah Password</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:15px;">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idusers">
                                <input type="password" class="form-control" name="user_password"
                                    placeholder="New password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info pull-right" name="ubah_pass"><i class="fa fa-save"></i>
                        Update &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>