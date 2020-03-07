<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Statistik Pengunjung</li>
</ul>
<!-- END BREADCRUMB -->


<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Statistik Pengunjung</h3>
                    <ul class="panel-controls">
                        <li data-toggle="tooltip" data-placement="top" title="Cetak Laporan"><a
                                href="<?=$base_url;?>hal/cetak_statistik.php" target="_blank"><span
                                    class="fa fa-print"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th>PENGUNJUNG ID</th>
                                <th>NAMA LENGKAP</th>
                                <th>STATUS</th>
                                <th>JML KUNJUNGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $query = mysqli_query($con,"SELECT *,COUNT(`pengunjung_kode`) as jml FROM `pengunjung` GROUP BY `pengunjung_kode`")or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <td><?=$row['pengunjung_kode'];?></td>
                                <td><?=$row['pengunjung_nama'];?></td>
                                <td><?=$row['pengunjung_status'];?></td>
                                <td><?='<b>'.number_format($row['jml'],0,'','.').'</b> Kali Berkunjung';?></td>
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