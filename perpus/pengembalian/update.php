<?php
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $peminjaman_id = $_POST['id'];
 $buku_id = $_POST['buku_id'];
 $anggota_id = $_POST['anggota_id'];
 $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
 $tanggal_kembali = $_POST['tanggal_kembali'];
 $sql = "UPDATE peminjaman SET buku_id='$buku_id', anggota_id='$anggota_id', tanggal_peminjaman='$tanggal_peminjaman', tanggal_kembali='$tanggal_kembali', status='dipinjam' WHERE peminjaman_id='$peminjaman_id'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../peminjaman"); // Redirect ke tampilan Read setelah berhasil edit data
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

$id = $_GET['id']; // ID dari buku yang akan diupdate
$sql = "SELECT * FROM peminjaman WHERE peminjaman.peminjaman_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 ID Buku: <input type="text" name="buku_id" value="<?php echo $row['buku_id']; ?>"><br>
 ID Peminjam: <input type="text" name="anggota_id" value="<?php echo $row['anggota_id'];?>"><br>
 Tanggal Peminjaman: <input type="date" name="tanggal_peminjaman" value="<?php echo $row['tanggal_peminjaman']; ?>"><br>
 Tanggal Kembali: <input type="date" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>"><br>
 <input type="hidden" name="id" value="<?php echo $row['peminjaman_id']; ?>">
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>