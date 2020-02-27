<?php hakAkses(['super_user','administrator','user']);?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="kode_buku"]').val("");
        $('[name="isbn"]').val("");
        $('[name="judul_buku"]').val("");
        $('[name="pengarang"]').val("");
        $('[name="kota_terbit"]').val("");
        $('[name="penerbit"]').val("");
        $('[name="tahun_buku"]').val("");
        $('[name="jml_hal"]').val("");
        $('[name="jml_buku"]').val("");
        $('#modal_add .modal-title').html('Add New Buku');
        $('#btn-ubah').hide();
        $('#btn-add').show();
    } else {
        $('#modal_add .modal-title').html('Edit Buku')
        $('#btn-add').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=$base_url;?>proses/view_bk.php',
            dataType: 'json',
            success: function(data) {
                $('[name="idbuku"]').val(data.idbuku);
                $('[name="kode_buku"]').val(data.kode_buku);
                $('[name="isbn"]').val(data.isbn);
                $('[name="judul_buku"]').val(data.judul_buku);
                $('[name="pengarang"]').val(data.pengarang);
                $('[name="kota_terbit"]').val(data.kota_terbit);
                $('[name="penerbit"]').val(data.penerbit);
                $('[name="tahun_buku"]').val(data.tahun_buku);
                $('[name="jml_hal"]').val(data.jml_hal);
                $('[name="jml_buku"]').val(data.jml_buku);
            }
        });
    }
}

function ubah_gambar(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=$base_url;?>proses/view_bk.php',
        dataType: 'json',
        success: function(data) {
            if (data.cover_buku != '') {
                var img = data.cover_buku
            } else {
                var img = 'default.jpeg'
            }
            var html = '<img src="<?=$base_url;?>uploads/buku/' + img +
                '" alt="' + data.cover_buku + '" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idbuku"]').val(data.idbuku);
        }
    });
    // if (x == 'ganti') {
    //     // var table = 'produk';
    //     // var id = $('[name="id"]').val();
    //     var action = '<?=$base_url; ?>category/editImgCategory';
    //     $('#form-ganti-gambar').attr('action', action).submit();
    // }
}
</script>
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?=$base_url;?>">Home</a></li>
    <li><a href="#">Master</a></li>
    <li class="active">Buku</li>
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
                    <h3 class="panel-title">Master Data Buku</h3>
                    <ul class="panel-controls">
                        <li data-toggle="tooltip" data-placement="top" title="Tambah Baru"><a href="#"
                                data-toggle="modal" data-target="#modal_add" onclick="submit('add')"><span
                                    class="fa fa-plus"></span></a></li>
                        <li data-toggle="tooltip" data-placement="top" title="Import Data"><a href="#"
                                data-toggle="modal" data-target="#modal_import"><span class="fa fa-upload"></span></a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Cetak Semua Barcode"><a
                                href="<?=$base_url;?>proses/barcode_bk.php?param=all" target="_blank"><span
                                    class="fa fa-barcode"></span></a>
                        </li>
                        <li data-toggle="tooltip" data-placement="top" title="Refresh"><a
                                href="<?=$base_url;?>?buku"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table datatable table-hover">
                        <span style="color:green;">* Klik gambar jika ingin merubah gambar</span>
                        <thead>
                            <tr>
                                <th width="65">NO</th>
                                <th width="55"><i class="fa fa-edit"></i></th>
                                <th width="115">COVER BUKU</th>
                                <th>KODE BUKU</th>
                                <th>ISBN</th>
                                <th>JUDUL BUKU</th>
                                <th>PENGARANG</th>
                                <th>KOTA TERBIT</th>
                                <th>PENERBIT</th>
                                <th>TAHUN BUKU</th>
                                <th>JML HAL</th>
                                <th>JML BUKU</th>
                                <th width="100">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n=1;
                            $query = mysqli_query($con,"SELECT * FROM buku ORDER BY idbuku DESC")or die(mysqli_error($con));
                            while($row = mysqli_fetch_array($query)):
                            ?>
                            <tr>
                                <td><?=$n++.'.';?></td>
                                <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$row['idbuku'];?>)"><i
                                            class="fa fa-edit"></i></a></td>
                                <td>
                                    <a href="#modal_image" data-toggle="modal"
                                        onclick="ubah_gambar(<?=$row['idbuku'];?>)">
                                        <img src="<?=$base_url;?>uploads/buku/<?=($row['cover_buku']!='')?$row['cover_buku']:'default.jpeg';?>"
                                            alt="<?=$row['cover_buku'];?>"
                                            style="width:60px;height:50px;border:1px dashed;">
                                    </a>
                                </td>
                                <td><?=$row['kode_buku'];?></td>
                                <td><?=$row['isbn'];?></td>
                                <td><?=$row['judul_buku'];?></td>
                                <td><?=$row['pengarang'];?></td>
                                <td><?=$row['kota_terbit'];?></td>
                                <td><?=$row['penerbit'];?></td>
                                <td><?=$row['tahun_buku'];?></td>
                                <td><?=number_format($row['jml_hal'],0,'','.');?></td>
                                <td><?=number_format($row['jml_buku'],0,'','.');?></td>
                                <td>
                                    <a href="<?=$base_url;?>proses/barcode_bk.php?param=<?=$row['idbuku'];?>"
                                        class="btn btn-xs btn-info" target="_blank" data-toggle="tooltip"
                                        data-placement="top" title="Cetak Barcode"><i class="fa fa-barcode"></i></a>
                                    <a href="<?=$base_url;?>proses/bk.php?id=<?=$row['idbuku'];?>"
                                        class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"
                                        title="Hapus"><i class="fa fa-trash-o"></i></a>
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
            <form action="<?=$base_url;?>proses/bk.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">ISBN</label>
                                <input type="hidden" class="form-control" name="idbuku">
                                <input type="text" class="form-control" name="isbn"
                                    placeholder="ex: ISBN-13, 978-3-16-148410-0">
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Judul Buku<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="judul_buku" placeholder="ex: Belajar HTML"
                                    autofocus required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Pengarang<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="pengarang"
                                    placeholder="ex: Nunung, ST, Nunung M. Wi, S.Pt" required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Kota Terbit<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="kota_terbit" placeholder="ex: Manokwari"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Penerbit<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="penerbit" placeholder="ex: Andi Publisher"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Tahun Buku<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="tahun_buku" placeholder="ex: 2015"
                                    required>
                            </div>
                        </div>
                        <!-- <div class="col-md-6" style="margin-bottom:15px;">
                            <label class="control-label">Jenis Kelamin<span style="color:red;">*</span></label>
                            <select class="form-control" name="jk" required>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div> -->
                        <div class="col-md-2" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Jumlah Halaman<span style="color:red;">*</span></label>
                                <input type="text" class="form-control uang" name="jml_hal" placeholder="ex: 1.000"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-2" style="margin-bottom:15px;">
                            <div class="form-group">
                                <label class="control-label">Jumlah Buku<span style="color:red;">*</span></label>
                                <input type="text" class="form-control uang" name="jml_buku" placeholder="ex: 1.000"
                                    required>
                            </div>
                        </div>
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
<div class="modal" id="modal_import" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=$base_url;?>proses/import_bk.php" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="largeModalHead">Import Buku</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom:15px;">
                            <h4>Panduan Import</h4>
                            <ol>
                                <li>Copy dan paste <strong>[JUDUL BUKU] [PENGARANG] [KOTA TERBIT] [PENERBIT] [TAHUN
                                        BUKU] [JUMLAH HAL] [JUMLAH BUKU]</strong> dari Ms. Excel pada Text Area
                                    dibawah.</li>
                                <li>Jika ada kolom yang kosong harap isi dengan tanda <strong>" - "</strong>.
                                    <strong>HARAP DI ISI SEMUA</strong></li>
                                <!-- <li>Kolom <strong>JENIS KELAMIN</strong> diisi huruf <strong>"L"</strong> jika Laki-Laki
                                    dan <strong>"P"</strong> jika Perempuan.</li> -->
                                <!-- <li>Kolom <strong>TANGGAL LAHIR</strong> diisi dengan format
                                    <strong>"YYYY-MM-DD"</strong>. Contoh :
                                    <strong>1991-03-15</strong></li> -->
                            </ol>
                            <div class="form-group">
                                <textarea class="form-control" rows="15" name="bk" placeholder="Paste here..."
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Import &
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ubah Gambar -->
<div class="modal fade" tabindex="-1" id="modal_image" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <form action="<?=$base_url;?>proses/bk.php" method="post" enctype="multipart/form-data" id="form-ganti-gambar">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Image</h4>
                </div>
                <div class="modal-body">
                    <div id="view_gambar" style="margin-bottom:15px;padding:15px;border:1px solid;">

                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="idbuku">
                        <input type="file" class="form-control" name="file">
                        <span>File format : <b>.jpg .jpeg .png .gif .bmp</b></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-flat" name="change_image">Update
                        Image</button>
                </div>
            </div>
        </form>
    </div>
</div>