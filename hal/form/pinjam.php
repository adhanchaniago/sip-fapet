<?php hakAkses(['super_user','administrator','user']);?>
<?php
$id = $_SESSION['iduser'];
$query = mysqli_query($con,"SELECT * FROM users WHERE idusers='$id'")or die(mysqli_error($con));
$row = mysqli_fetch_array($query);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?=$base_url;?>">Home</a></li>
    <li class="active">Pinjam Buku</li>
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
        <!-- START JQUERY VALIDATION PLUGIN -->
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-4" style="margin-bottom:15px;">
                    <div class="form-group">
                        <label class="control-label">Scan ID/KODE</label>
                        <input type="text" class="form-control" name="scan_input" id="scan_input" autofocus>
                    </div>
                </div>
                <div class="col-md-8" style="margin-bottom:15px;">
                    <div class="form-group">
                        <label class="control-label">Cari Manual Ketik ID/KODE [Tab]</label>
                        <input type="text" class="form-control" name="input" id="input">
                    </div>
                </div>
            </form>
            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <div class="row">
                        <form action="<?=$base_url;?>proses/pinjam.php" method="post" enctype="multipart/form-data">
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
                            <!-- START DEFAULT DATATABLE -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="115">PEMINJAM ID</th>
                                        <th width="115">PEMINJAM NAMA</th>
                                        <th width="115">COVER BUKU</th>
                                        <th>KODE BUKU</th>
                                        <th>JUDUL BUKU</th>
                                        <th width="100">JML BUKU</th>
                                        <th width="100">JML STOK</th>
                                        <th width="100">JML PINJAM</th>
                                        <th width="50">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $n=1;
                                $sql = "SELECT mahasiswa.nama_lengkap AS m_peminjam, dosen.nama_lengkap AS d_peminjam,buku.idbuku,buku.cover_buku,buku.kode_buku,buku.judul_buku,buku.jml_hal,buku.jml_buku,detail_peminjaman.jml_pinjam FROM peminjaman 
                                LEFT JOIN detail_peminjaman ON peminjaman.idpeminjaman=detail_peminjaman.pinjam_id
                                LEFT JOIN buku ON buku.idbuku=detail_peminjaman.buku_id
                                LEFT JOIN mahasiswa ON peminjaman.peminjam_id=mahasiswa.nim
                                LEFT JOIN dosen ON peminjaman.peminjam_id=dosen.nip WHERE peminjaman.peminjam_id=201552003";
                                $query = mysqli_query($con,"SELECT * FROM tmp_peminjaman")or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=$row['peminjam_kode'];?></td>
                                        <td><?=$row['peminjam_nama'];?></td>
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
                                        <td><?=number_format($row['jml_buku'],0,'','.');?></td>
                                        <td><?=number_format($row['stok'],0,'','.');?></td>
                                        <td>
                                            <input type="text" class="form-control uang" id="<?=$row['idtmp'];?>"
                                                value="<?=number_format($row['jml_pinjam'],0,'','.');?>"
                                                onchange="update_jml(<?=$row['idtmp'];?>)">
                                        </td>
                                        <td>
                                            <a href="<?=$base_url;?>proses/add_to_cart.php?id=<?=$row['idtmp'];?>"
                                                class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                                title="Hapus"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php endwhile;?>
                                </tbody>
                            </table>
                            <!-- END DEFAULT DATATABLE -->
                            <!-- <div class="col-md-2" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Lulus<span style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" name="tanggal_lulus" class="form-control datepicker"
                                            data-date-format="yyyy-mm-dd" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">NIM<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control nim" name="nim" placeholder="ex: 201565001"
                                        value="<?=$row['user_name'];?>" required>
                                </div>
                            </div>
                            <div class="col-md-8" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Nama Lengkap<span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        placeholder="ex: Nurul Hikmah" value="<?=$row['user_fullname'];?>" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">File Skripsi<span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" name="file" required>
                                    <span class="help-block">Format file yang diizinkan *.pdf. Ukuran maksimal 5
                                        MB.</span>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom:15px;">
                                <div class="form-group">
                                    <label class="control-label">Abstrak<span style="color:red;">*</span></label>
                                    <textarea class="form-control" rows="20" name="abstrak"
                                        placeholder="Type your abstrak here..." required></textarea>
                                </div>
                            </div> -->
                            <a href="<?=$base_url;?>" class="btn btn-default pull-left"><i class="fa fa-reply"></i>
                                Cancel</a>
                            <button type="submit" class="btn btn-info btn-lg pull-right" id="btn-ubah" name="upload"><i
                                    class="fa fa-save"></i>
                                SIMPAN DATA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END JQUERY VALIDATION PLUGIN -->
</div>
</div>
<!-- PAGE CONTENT WRAPPER -->