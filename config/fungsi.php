<?php
function session_timeout(){
    //lama waktu 30 menit
    if(isset($_SESSION['LAST_ACTIVITY'])&&(time()-$_SESSION['LAST_ACTIVITY']>1800)){
        session_unset();
        session_destroy();
        header("Location:".$base_url."login.php");
    }$_SESSION['LAST_ACTIVITY']=time();
}
function delMask( $str ) {
    return (int)implode('',explode('.',$str));
}
function nip_format( $str ) {
    return (int)implode('',explode(' ',$str));
}
function hitungHari($x,$y){
    $awal = explode("-",$x);
    $akhir = explode("-",$y);
    $date1 = mktime(0, 0, 0, $awal[1],$awal[2],$awal[0]);
    $date2 = mktime(0, 0, 0, $akhir[1],$akhir[2],$akhir[0]);
    $result = ($date2-$date1)/(3600*24);
    return $result;
}
    
function hakAkses( array $a){
    $akses = $_SESSION['akses'];
    if(!in_array($akses,$a)){
        header('Location:?dashboard');
    }
}
function prodi(){
    //Penulisan harus di awali huruf kapital
    //Lainnya jangan di ubah
    return [
        'Nutrisi Teknologi Pakan Ternak',
        'Peternakan',
        'Budidaya Ternak',
        'Kesehatan Hewan',
        'Lainnya'
    ];
}
function hitung($table){
    include($_SERVER['DOCUMENT_ROOT'].'/sip-fapet/config/connection.php');
    $query = mysqli_query($con,"SELECT * FROM $table")or die (mysqli_error($con));
    return number_format(mysqli_num_rows($query));
}
// function viewLimit($text){
//     $string = strip_tags($text);
//     if(strlen($string) > 650){
//         //truncate string
//         $stringCut = substr($string, 0, 650);
//         $endPoint = strrpos($stringCut, ' ');
//         //if the string doesn't contain space any space then it will cut without word basis
//         $string = $endPoint?substr($stringCut, 0, $endPoint):substr($stringCut, 0);
//         // $string .= '...<a href="'.site_url('post/').$url.'">Read More</a>';
//     }
//     echo $string;
// }
?>