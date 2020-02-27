<?php hakAkses(['super_user','administrator','user']);?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Manajemen</a></li>
    <li class="active">Pengembalian</li>
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
                    <h3 class="panel-title">Manajemen Pengembalian</h3>
                    <ul class="panel-controls">
                        <!-- <li><span href="#"><span class="fa fa-plus"></span></span>
                        </li>
                        <li><a href="#"><span class="fa fa-trash-o"></span></a></li> -->
                        <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                href="<?=$base_url;?>?pengembalian"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th>TGL KEMBALI</th>
                                <th>PEMINJAM ID</th>
                                <th>NAMA LENGKAP</th>
                                <th width="110">COVER BUKU</th>
                                <th>KODE BUKU</th>
                                <th>JUDUL BUKU</th>
                                <th>JML KEMBALI</th>
                                <th>TELAT(Hari)</th>
                                <th>DENDA(Rp)</th>
                                <th width="100">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $sql = "SELECT pengembalian.idpengembalian,mahasiswa.nim,mahasiswa.nama_lengkap as mhs,dosen.nip,dosen.nama_lengkap as dsn,buku.idbuku,buku.cover_buku,buku.kode_buku,buku.judul_buku,pengembalian.tgl_kembali,pengembalian.jml_kembali,pengembalian.telat,pengembalian.denda FROM pengembalian
                            LEFT JOIN mahasiswa ON mahasiswa.nim=pengembalian.peminjam_kode
                            LEFT JOIN dosen ON dosen.nip=pengembalian.peminjam_kode
                            LEFT JOIN buku ON buku.idbuku=pengembalian.buku_id ORDER BY pengembalian.idpengembalian DESC";
                            $query = mysqli_query($con,$sql)or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <td><?=$row['tgl_kembali'];?></td>
                                <td><?=$row['nim']==null?$row['nip']:$row['nim'];?></td>
                                <td><?=$row['mhs']==null?$row['dsn']:$row['mhs'];?></td>
                                <td>
                                    <a href="#modal_image" data-toggle="modal"
                                        onclick="ubah_gambar(<?=$row['idbuku'];?>)">
                                        <img src="<?=$base_url;?>uploads/buku/<?=($row['cover_buku']!='')?$row['cover_buku']:'default.jpeg';?>"
                                            alt="<?=$row['cover_buku'];?>"
                                            style="width:60px;height:50px;border:1px dashed;">
                                    </a>
                                </td>
                                <td><?=$row['kode_buku'];?></td>
                                <td><?=$row['judul_buku'];?></td>
                                <td><?=$row['jml_kembali'];?></td>
                                <td><?=$row['telat'];?></td>
                                <td><?=number_format($row['denda'],0,'','.');?></td>
                                <td>
                                    <a href="<?=$base_url;?>proses/kembalikan.php?id=<?=$row['idpengembalian'];?>"
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