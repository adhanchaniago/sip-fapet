<?php hakAkses(['super_user','administrator','user']);?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Manajemen</a></li>
    <li class="active">Pengunjung</li>
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
                    <h3 class="panel-title">Manajemen Pengunjung</h3>
                    <ul class="panel-controls">
                        <!-- <li><span href="#"><span class="fa fa-plus"></span></span>
                        </li>
                        <li><a href="#"><span class="fa fa-trash-o"></span></a></li> -->
                        <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                href="<?=$base_url;?>?pengunjung"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th>TANGGAL</th>
                                <th>PENGUNJUNG ID</th>
                                <th>NAMA LENGKAP</th>
                                <th>STATUS</th>
                                <th>KETERANGAN</th>
                                <th width="90">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $query = mysqli_query($con,"SELECT * FROM pengunjung ORDER BY idpengunjung DESC")or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <td><?=$row['tanggal'];?></td>
                                <td><?=$row['pengunjung_kode'];?></td>
                                <td><?=$row['pengunjung_nama'];?></td>
                                <td><?=$row['pengunjung_status'];?></td>
                                <td><?=$row['pengunjung_ket'];?></td>
                                <td>
                                    <a href="<?=$base_url;?>proses/pengunjung.php?id=<?=$row['idpengunjung'];?>"
                                        class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Hapus"><i class="fa fa-trash-o"></i>
                                    </a>
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