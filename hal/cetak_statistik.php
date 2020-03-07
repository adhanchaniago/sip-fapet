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
    <title>Cetak Laporan Pengunjung</title>
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
            <h3>LAPORAN DATA STATISTIK PENGUNJUNG<h3>
        </center>
        <p style="text-align:right;width:95%;">Tanggal Cetak : <?= date('d M Y');?></p>
        <table class="table datatable table-bordered" width="90%" style="font-size:11pt;">
            <thead>
                <tr>
                    <th width="5">NO</th>
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
        <br>

    </div>
    <script type="text/javascript" src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
</body>

</html>

<script>
window.print();
</script>