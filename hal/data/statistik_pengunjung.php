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