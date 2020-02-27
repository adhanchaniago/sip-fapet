<?php hakAkses(['super_user','administrator','user']);?>
<script>
function submit(x) {
    $('#modal_date .modal-title').html('Perpanjang Peminjaman');

    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=$base_url;?>proses/view_peminjaman.php',
        dataType: 'json',
        success: function(data) {
            $('[name="idpeminjaman"]').val(data.idpeminjaman);
            $('[name="tgl_kembali"]').val(data.tgl_kembali);
        }
    });
}
</script>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Manajemen</a></li>
    <li class="active">Peminjaman</li>
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
                    <h3 class="panel-title">Manajemen Peminjaman</h3>
                    <ul class="panel-controls">
                        <!-- <li><span href="#"><span class="fa fa-plus"></span></span>
                        </li>
                        <li><a href="#"><span class="fa fa-trash-o"></span></a></li> -->
                        <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                href="<?=$base_url;?>?peminjaman"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <thead>
                            <tr>
                                <th width="60">NO</th>
                                <th width="55"><i class="fa fa-calendar-o"></i></th>
                                <th>PEMINJAM ID</th>
                                <th>NAMA LENGKAP</th>
                                <th width="110">COVER BUKU</th>
                                <th>KODE BUKU</th>
                                <th>JUDUL BUKU</th>
                                <th>HARUS KEMBALI</th>
                                <th>JML PINJAM</th>
                                <th width="100">STATUS</th>
                                <th width="80">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $sql = "SELECT peminjaman.idpeminjaman,mahasiswa.nim,mahasiswa.nama_lengkap as mhs,dosen.nip,dosen.nama_lengkap as dsn,buku.idbuku,buku.cover_buku,buku.kode_buku,buku.judul_buku,peminjaman.tgl_kembali,peminjaman.jml_pinjam FROM peminjaman
                            LEFT JOIN mahasiswa ON mahasiswa.nim=peminjaman.peminjam_kode
                            LEFT JOIN dosen ON dosen.nip=peminjaman.peminjam_kode
                            LEFT JOIN buku ON buku.idbuku=peminjaman.buku_id ORDER BY peminjaman.idpeminjaman DESC";
                            $query = mysqli_query($con,$sql)or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <td>
                                    <?php
                                    $idPeminjaman = $row['idpeminjaman'];
                                    $cek = mysqli_query($con,"SELECT peminjaman_id FROM pengembalian WHERE peminjaman_id='$idPeminjaman'");
                                    if(mysqli_num_rows($cek)==0):
                                    ?>
                                    <a href="#modal_date" data-toggle="modal"
                                        onclick="submit(<?=$row['idpeminjaman'];?>)"><i class="fa fa-calendar"
                                            data-toggle="tooltip" data-placement="top" title="Perpanjang"></i></a>
                                    <?php endif;?>
                                </td>
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
                                <td><?=$row['tgl_kembali'];?></td>
                                <td><?=$row['jml_pinjam'];?></td>
                                <td>
                                    <?php
                                    if(mysqli_num_rows($cek)==0):
                                    ?>
                                    <span class="label label-danger">Belum Kembali</span>
                                    <?php else:?>
                                    <span class="label label-info">Sudah Kembali</span>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php
                                    if(mysqli_num_rows($cek)==0):
                                    ?>
                                    <a href="<?=$base_url;?>proses/pinjam.php?id=<?=$row['idpeminjaman'];?>"
                                        class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Hapus"><i class="fa fa-trash-o"></i>
                                    </a>
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
<div class="modal" id="modal_date" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/pinjam.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Harus Kembali<span
                                            style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="hidden" name="idpeminjaman">
                                        <input type="text" name="tgl_kembali" class="form-control datepicker"
                                            data-date-format="yyyy-mm-dd" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info pull-right" name="edit"><i class="fa fa-save"></i>
                        Update &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>