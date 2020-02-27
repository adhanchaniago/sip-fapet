<?php
// session_start();
include ('../config/connection.php');
$param = $_GET['param'];
if($param=='all'){
    $query = mysqli_query($con, "SELECT * FROM buku ORDER BY idbuku DESC")or die(mysqli_error($con));
}else{
    $query = mysqli_query($con, "SELECT * FROM buku WHERE idbuku='$param'")or die(mysqli_error($con));
}
?>
<html>

<head>
    <style type="tetx/css">
        h2{ 
                padding:0px;
                margin:0px;
            }
            text{
                padding:0px;
                }
            td{
                text-align:center;
            }
        </style>
    <title>Cetak Barcode Buku</title>
</head>

<body>

    <div style="page-break-after:always;">
        <!-- <center>
            <br />
            <h3 style="line-height:5px;">SISTEM INFORMASI PERPUSTAKAAN</h3>
            <h3 style="line-height:5px;">FAKULTAS PETERNAKAN</h3>
            <h5 style="line-height:5px;"></h5>
            <p style="text-align:center;line-height:5px;margin-bottom:0px;margin-left:5px;font-size:10pt;">NPSN :

                &nbsp<i style="font-size:9pt;"></i>&nbsp
                NSM :
            </p>
            <hr style="border:1px solid">
            <hr style="border:0.5px solid;margin-top:-5px;">
            <h4>CETAK BARCODE BUKU<h4>
        </center> -->
        <?php while ($row = mysqli_fetch_array($query)) :?>
        <div
            style="border:0.5px solid;width:250px;padding:5px;float:left;margin:15px 15px 0px 0px;text-align:center;height:auto;font-size:11pt;">
            <?=$row['judul_buku'].'<br>';?>
            <img alt="<?=$row['kode_buku'];?>"
                src="../config/barcode.php?size=30&text=<?=$row['kode_buku'];?>&print=true" />
        </div>
        <?php endwhile;?>

    </div>
</body>

</html>

<script>
window.print();
</script>