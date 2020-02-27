<?php hakAkses(['super_user','administrator','user']);?>
<?php
error_reporting(0);
?>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?=$base_url;?>">Home</a></li>
    <li class="active">Kembalikan Buku</li>
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
            <form action="" method="post" enctype="multipart/form-data" id="cek-peminjaman">
                <div class="col-md-4" style="margin-bottom:15px;">
                    <div class="form-group">
                        <label class="control-label">Peminjam ID[Tab]</label>
                        <input type="text" class="form-control" name="peminjam_id" id="peminjam_id" autofocus>
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom:15px;">
                    <div class="form-group">
                        <label class="control-label">Kode Buku[Tab]</label>
                        <input type="text" class="form-control" name="kode_buku" id="kode_buku" readonly>
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom:15px;">
                    <!-- <button class="btn btn-success">Cari Data</button> -->
                </div>
            </form>
            <div class="panel panel-default">
                <div class="panel-body table-responsive">
                    <div class="row">
                        <form action="<?=$base_url;?>proses/kembalikan.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="peminjamID"
                                value="<?=$_GET['peminjamID'];?>">
                            <input type="hidden" class="form-control" name="kodeBuku" value="<?=$_GET['kodeBuku'];?>">
                            <!-- START DEFAULT DATATABLE -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>TGL KEMBALI</th>
                                        <th>PEMINJAM ID</th>
                                        <th>NAMA LENGKAP</th>
                                        <th width="110">COVER BUKU</th>
                                        <th>KODE BUKU</th>
                                        <th>JUDUL BUKU</th>
                                        <th>HARUS KEMBALI</th>
                                        <th>JML PINJAM</th>
                                        <th>TELAT(Hari)</th>
                                        <th width="100">DENDA(Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                $peminjamID = $_GET['peminjamID'];
                                $kodeBuku = $_GET['kodeBuku'];
                                $sql = "SELECT peminjaman.idpeminjaman,mahasiswa.nim,mahasiswa.nama_lengkap as mhs,dosen.nip,dosen.nama_lengkap as dsn,buku.idbuku,buku.cover_buku,buku.kode_buku,buku.judul_buku,peminjaman.tgl_kembali,peminjaman.jml_pinjam FROM peminjaman
                                LEFT JOIN mahasiswa ON mahasiswa.nim=peminjaman.peminjam_kode
                                LEFT JOIN dosen ON dosen.nip=peminjaman.peminjam_kode
                                LEFT JOIN buku ON buku.idbuku=peminjaman.buku_id 
                                WHERE peminjaman.peminjam_kode='$peminjamID' AND peminjaman.buku_kode='$kodeBuku'
                                ORDER BY peminjaman.idpeminjaman DESC";
                                $query = mysqli_query($con,$sql)or die(mysqli_error($con));
                                while($row = mysqli_fetch_array($query)):
                                ?>
                                    <tr>
                                        <td><?=date('Y-m-d');?></td>
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
                                            <?=hitungHari($row['tgl_kembali'],date('Y-m-d'))<0?0:hitungHari($row['tgl_kembali'],date('Y-m-d'));?>
                                        </td>
                                        <td>
                                            <?=hitungHari($row['tgl_kembali'],date('Y-m-d'))<0?0:number_format(hitungHari($row['tgl_kembali'],date('Y-m-d'))*1000,0,'','.');?>
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
                            <button type="submit" class="btn btn-info btn-lg pull-right" id="btn-ubah"
                                name="kembalikan"><i class="fa fa-save"></i>
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