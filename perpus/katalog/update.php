<?php
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $ID = $_POST['id'];
 $nama = $_POST['nama'];
 $alamat = $_POST['alamat'];
 $email = $_POST['email'];
 $telepon = $_POST['telepon'];
 $sql = "UPDATE anggota SET nama='$nama', alamat='$alamat', email='$email', telepon='$telepon' WHERE anggota_id='$ID'";

 if ($mysqli->query($sql) === TRUE) {
 header("Location: ../anggota"); 
 exit;
 } else {
 echo "Error: " . $sql . "<br>" . $mysqli->error;
 }
 $mysqli->close();
}

$id = $_GET['id'];
$sql = "SELECT * FROM anggota WHERE anggota_id=$id";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 <form action="update.php" method="POST">
 Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
 Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat'];
?>"><br>
 Emai;: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
 Telepon: <input type="text" name="telepon" value="<?php echo
$row['telepon']; ?>"><br>
 <input type="hidden" name="id" value="<?php echo $row['anggota_id']; ?>">
 <input type="submit" value="Update">
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>