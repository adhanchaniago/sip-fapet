<?php
// session_start();
include ('../config/connection.php');
include ('../config/fungsi.php');
$nama_ketua = "KETUA PETERNAKAN";
$nip_ketua = "19860926 201505 1 001";
$param = $_GET['param'];
if($param=='all'){
    $query = mysqli_query($con, "SELECT * FROM dosen ORDER BY iddosen DESC")or die(mysqli_error($con));
}else{
    $query = mysqli_query($con, "SELECT * FROM dosen WHERE iddosen='$param'")or die(mysqli_error($con));
}
?>
<html>

<head>
    <style type="tetx/css">
        body{
            font-size:80pt;
        }
        </style>
    <title>Cetak Barcode Buku</title>
</head>

<body>

    <div>
        <?php $n=0; while ($row = mysqli_fetch_array($query)) : ?>
        <div
            style="width:100%;border:0px solid;height:auto;margin-bottom:15px;<?= $n++%4==0?'page-break-before:always;':'';?>">
            <table style="font-size:8pt;">
                <tr>
                    <td width="50%" style="border:0.5px solid;">
                        <table width="100%" style="font-size:8pt;">
                            <tr>
                                <td colspan="4" style="border-bottom:1.5px solid;text-align:center;">
                                    <img src="../assets/img/logo_instansi.png" alt="Logo Instansi"
                                        style="width:30px;height:30px;float:left;margin-right:0px;margin-bottom:2px;margin-left:5px;">
                                    KARTU ANGGOTA PERPUSTAKAAN <br>
                                    FAKULTAS PETERNAKAN
                                    <!-- <img src="../assets/img/logo_instansi.png" alt="Logo Instansi"
                                        style="width:30px;height:30px;float:left;margin-left:90%;margin-bottom:3px;margin-top:-32px;"> -->
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="6" width="10">
                                    <img src="../uploads/dosen/<?=$row['foto']!=''?$row['foto']:'default.jpg';?>"
                                        alt="<?=$row['foto'];?>" style="width:80px;height:95px;box-shadow:5px;">
                                </td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td width="5">:</td>
                                <td><?=$row['nip'];?></td>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>:</td>
                                <td><?=$row['nama_lengkap'];?></td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>:</td>
                                <td><?=$row['tempat_lahir'].', '.$row['tanggal_lahir'];?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><?=$row['jk']=='L'?'Laki-Laki':'Perempuan';?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?=$row['alamat'];?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3" style="text-align:center;">
                                    Teluk Bintuni, <?=date('d F Y');?>
                                    <br>
                                    <br>
                                    <!-- <img src="../assets/img/ttd1.png" alt="Tanda Tangan"
                                        style="width:70px;height:30px;"> -->
                                    <br>
                                    <u><?=$nama_ketua;?></u>
                                    <br>
                                    NIP. <?=$nip_ketua;?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" style="padding:15px;border:0.5px solid;">
                        <h3><u>Catatan :</u></h3>
                        <ol>
                            <li>Kartu Anggota ini harus dibawa setiap kunjungan, pinjaman, pengembalian keperpustakaan.
                            </li>
                            <li>Tanpa kartu anggota, kunjungan, pinjaman, pengembalian tidak dilayani.</li>
                            <li>Pengembalian lewat dari batas waktunya akan dikenakan denda.</li>
                            <li>Waktu pinjaman lamanya 7 hari dan dapat diperpanjang 7 hari lagi bila tidak ada yang
                                memesannya.
                            </li>
                        </ol>
                        <div style="text-align:center;">
                            <img alt="<?=$row['nip'];?>"
                                src="../config/barcode.php?size=30&text=<?=nip_format($row['nip']);?>&print=true" />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php endwhile;?>

    </div>
</body>

</html>

<script>
window.print();
</script>