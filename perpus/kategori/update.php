<?php
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $ID = $_POST['id'];
 $nama_kategori = $_POST['nama_kategori'];
 $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE kategori_id='$ID'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../kategori/"); 
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

$id = $_GET['id'];
$sql = "SELECT * FROM kategori WHERE kategori_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 Nama: <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>"><br>
 <input type="hidden" name="id" value="<?php echo $row['kategori_id']; ?>">
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>