<?php
// session_start();
include ('../config/connection.php');
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" id="theme" href="../assets/css/theme-blue.css" />
    <style type="tetx/css">
        h2{ 
            padding:0px;
            margin:0px;
        }
        text{
            padding:0px;
        }
    </style>
    <title>Cetak Laporan Buku</title>
</head>

<body>

    <div style="page-break-after:always;">
        <center>
            <br />
            <!-- <img src="../assets/img/logo_instansi.png" width="70" style="float:left;margin-left:5px;margin-top:-5px">
            <h3 style="line-height:15px;font-size:16pt;margin-left:-15px;">UNIVERSITAS PAPUA</h3>
            <h4 style="line-height:15px;font-size:14pt;">FAKULTAS PETERNAKAN</h4>
            <h5 style="line-height:5px;"></h5>
            <hr style="border:1px solid;margin-top:35px;">
            <hr style="border:0.5px solid;margin-top:-15px;"> -->
            <h3>LAPORAN DATA BUKU<h3>
        </center>
        <p style="text-align:right;width:95%;">Tanggal Cetak : <?= date('d M Y');?></p>
        <table class="table datatable table-bordered" width="90%" style="font-size:11pt;">
            <thead>
                <tr>
                    <th width="20">NO</th>
                    <th width="80">COVER BUKU</th>
                    <th>KODE BUKU</th>
                    <th>ISBN</th>
                    <th>JUDUL BUKU</th>
                    <th>PENGARANG</th>
                    <th>KOTA TERBIT</th>
                    <th>PENERBIT</th>
                    <th>TAHUN BUKU</th>
                    <th>JML HAL</th>
                    <th>JML BUKU</th>
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
                    <td>
                        <a href="#modal_image" data-toggle="modal" onclick="ubah_gambar(<?=$row['idbuku'];?>)">
                            <img src="../uploads/buku/<?=($row['cover_buku']!='')?$row['cover_buku']:'default.jpeg';?>"
                                alt="<?=$row['cover_buku'];?>" style="width:60px;height:50px;border:1px dashed;">
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
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
        <br>

    </div>
    <script type="text/javascript" src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
</body>

</html>

<script>
window.print();
</script>