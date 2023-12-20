<?php
include '../koneksi.php';
$id = $_GET['id']; // ID dari buku yang akan diupdate
$sql = "SELECT katalog.*, buku.*, kategori.* FROM katalog INNER JOIN kategori ON katalog.kategori_id=kategori.kategori_id INNER JOIN buku ON buku.buku_id=buku.buku_id HAVING buku.buku_id='$id'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
 $row = $result->fetch_array();
 ?>
 
 <?php echo "Judul : ".$row['judul']; ?><br>
 <?php echo "Pengarang : ".$row['pengarang'];?><br>
 <?php echo "Penerbit : ". $row['penerbit']; ?><br>
 <?php echo "Tahun Terbit : ". $row['tahun_terbit']; ?><br>
 <?php echo "ID Buku : ". $row['buku_id']; ?><br>
 <?php echo "Sinopsis : ". $row['sinopsis']; ?><br>
 <?php echo "Kategori : ". $row['nama_kategori']; ?><br>
 <a href="../katalog/"><button>kembali</button></a>
 </form>
 <?php
} else {
 echo "Data tidak ditemukan.";
}
$mysqli->close();
?>