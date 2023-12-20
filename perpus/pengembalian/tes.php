<?php
include '../koneksi.php';
$peminjaman_id = $_GET['id'];
$sql = "UPDATE peminjaman SET status='kembali' WHERE peminjaman_id='$peminjaman_id'";
$result = $mysqli->query("SELECT tanggal_kembali FROM peminjaman WHERE peminjaman_id='$peminjaman_id'");
$row = $result->fetch_assoc();
$tgl_kemb = $row['tanggal_kembali'];
$date_now = date("2023-12-07");

$tgl1 = strtotime("$tgl_kemb"); 
$tgl2 = strtotime("$date_now"); 

$jarak = $tgl2 - $tgl1;

$hari = $jarak / 60 / 60 / 24;


if ($hari >= 1) {
    $status = "terlambat";
    $denda = $hari * 5000;
}else{
    $status = "dikembalikan";
    $denda = 0;
}
echo $status;
echo $denda;