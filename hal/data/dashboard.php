<?php
error_reporting(0);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <!-- <li><a href="#">Layouts</a></li> -->
    <!-- <li class="active">Navigation Top</li> -->
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2> Selamat datang, <b><?=$_SESSION['fullname'];?></b></h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'||$_SESSION['akses']=='user'||$_SESSION['akses']=='dosen'):?>
    <!-- START WIDGETS -->
    <div class="row">
        <div class="col-md-3">

            <!-- START WIDGET SLIDER -->
            <div class="widget widget-default widget-carousel">
                <div class="owl-carousel" id="owl-example">
                    <div>
                        <div class="widget-title">Total Buku</div>
                        <div class="widget-int"><?=hitung('buku');?></div>
                    </div>
                    <div>
                        <div class="widget-title">Total Peminjaman</div>
                        <!-- <div class="widget-subtitle">Visitors</div> -->
                        <div class="widget-int"><?=hitung('peminjaman');?></div>
                    </div>
                    <div>
                        <div class="widget-title">Total Pengembalian</div>
                        <div class="widget-int"><?=hitung('pengembalian');?></div>
                    </div>
                </div>
            </div>
            <!-- END WIDGET SLIDER -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET MESSAGES -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                <div class="widget-item-left">
                    <span class="fa fa-users"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=hitung('mahasiswa');?></div>
                    <div class="widget-title">Total Mahasiswa</div>
                    <!-- <div class="widget-subtitle">In your mailbox</div> -->
                </div>
            </div>
            <!-- END WIDGET MESSAGES -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET REGISTRED -->
            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                <div class="widget-item-left">
                    <span class="fa fa-user"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=hitung('pengunjung');?></div>
                    <div class="widget-title">Total Pengunjung</div>
                </div>
            </div>
            <!-- END WIDGET REGISTRED -->

        </div>
        <div class="col-md-3">

            <!-- START WIDGET CLOCK -->
            <div class="widget widget-info widget-padding-sm">
                <div class="widget-big-int plugin-clock">00:00</div>
                <div class="widget-subtitle plugin-date">Loading...</div>
                <!-- <div class="widget-buttons widget-c3">
                    <div class="col">
                        <a href="#"><span class="fa fa-clock-o"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-bell"></span></a>
                    </div>
                    <div class="col">
                        <a href="#"><span class="fa fa-calendar"></span></a>
                    </div>
                </div> -->
            </div>
            <!-- END WIDGET CLOCK -->

        </div>
    </div>
    <!-- END WIDGETS -->
    <?php endif;?>
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($_SESSION['msg'])):?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <strong style="font-size:12pt;">Informasi </strong> <br><?=$_SESSION['msg'];?>
            </div>
            <?php endif; unset($_SESSION['msg']);?>
            <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'||$_SESSION['akses']=='user'||$_SESSION['akses']=='dosen'):?>
            <!-- START DEFAULT DATATABLE -->

            <div class="col-md-12">
                <?php if($_SESSION['akses']=='super_user'||$_SESSION['akses']=='administrator'||$_SESSION['akses']=='user'):?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-4" style="margin-bottom:15px;">
                        <div class="form-group">
                            <label class="control-label">Scan ID/KODE</label>
                            <input type="text" class="form-control" name="scan_pengunjung" id="scan_pengunjung"
                                autofocus>
                        </div>
                    </div>
                    <div class="col-md-8" style="margin-bottom:15px;">
                        <div class="form-group">
                            <label class="control-label">Cari Manual Ketik ID/KODE [Tab]</label>
                            <input type="text" class="form-control" name="input_pengunjung" id="input_pengunjung">
                        </div>
                    </div>
                </form>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <form action="<?=$base_url;?>proses/pengunjung.php" method="post"
                                enctype="multipart/form-data">
                                <!-- <div class="col-md-4" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <label class="control-label">ID Peminjam</label>
                                        <input type="text" class="form-control" name="judul" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <label class="control-label">Nama Peminjam</label>
                                        <input type="text" class="form-control" name="judul" readonly>
                                    </div>
                                </div> -->
                                <div class="col-md-4" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <label class="control-label">Pengunjung ID<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control nim" name="pengunjung_id" required>
                                    </div>
                                </div>
                                <div class="col-md-8" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <label class="control-label">Nama Lengkap<span
                                                style="color:red;">*</span></label>
                                        <input type="text" class="form-control" name="nama_lengkap" required>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom:15px;">
                                    <div class="form-group">
                                        <label class="control-label">Keterangan<span style="color:red;">*</span></label>
                                        <textarea class="form-control" rows="10" name="ket"
                                            placeholder="Type your keterangan here..." required></textarea>
                                    </div>
                                </div>
                                <a href="<?=$base_url;?>" class="btn btn-default pull-left"><i
                                        class="fa fa-refresh"></i>
                                    Cancel</a>
                                <button type="submit" class="btn btn-info btn-lg pull-right" id="btn-ubah"
                                    name="add_pengunjung"><i class="fa fa-save"></i>
                                    SIMPAN DATA</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif;?>

                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pengunjung Hari Ini</h3>
                        <ul class="panel-controls">
                            <!-- <li><span href="#"><span class="fa fa-plus"></span></span>
                            </li>
                            <li><a href="#"><span class="fa fa-trash-o"></span></a></li> -->
                            <!-- <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                    href="<?=$base_url;?>?pengunjung"><span class="fa fa-refresh"></span></a></li> -->
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n=1;
                                $now = date('Y-m-d');
                                $query = mysqli_query($con,"SELECT * FROM pengunjung WHERE tanggal='$now' ORDER BY idpengunjung DESC")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                <tr>
                                    <td><?=$n++.'.';?></td>
                                    <td><?=$row['tanggal'];?></td>
                                    <td><?=$row['pengunjung_kode'];?></td>
                                    <td><?=$row['pengunjung_nama'];?></td>
                                    <td><?=$row['pengunjung_status'];?></td>
                                    <td><?=$row['pengunjung_ket'];?></td>
                                </tr>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
            </div>
            <!-- END DEFAULT DATATABLE -->
            <?php endif;?>
        </div>
    </div>

</div>
<!-- PAGE CONTENT WRAPPER -->