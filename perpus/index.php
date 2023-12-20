<?php
    include 'koneksi.php';

    // Start the session
    session_start();

    // Check if the user is not logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page
        header("Location: login.php");
        exit;
    }

    // Handle logout
    if (isset($_GET['logout'])) {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Perustakaan</title>
        <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        div {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>PERPUSTAKAAN</h1>

    <div style="text-align: center; margin-bottom: 20px; background-color: #f4f4f4; padding: 10px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <a href="?logout=1" style="text-decoration: none; color: #333; font-weight: bold; padding: 8px 16px; border: 1px solid #ddd; border-radius: 4px; background-color: #4CAF50; color: white;">Logout</a>
    </div>


    <div>
        <h2>Daftar Anggota</h2>
        
        <?php
        $sql = "SELECT * FROM anggota";
        $result = $mysqli->query($sql);
        echo "<a href='anggota/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th></tr>";
        while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["anggota_id"]."</td>";
        echo "<td>".$row["nama"]."</td>";
        echo "<td>".$row["alamat"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["telepon"]."</td>";
        }
        echo "</table>";
        } else {
        echo "Tidak ada data anggota.";
        }
        ?>
    </div>

    <div>
        <h2>Daftar Buku</h2>
        
        <?php
        $sql = "SELECT buku.*, kategori.* FROM buku LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id";
        $result = $mysqli->query($sql);
        echo "<a href='buku/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun
        Terbit</th><th>Kategori</th></tr>";
        while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["buku_id"]."</td>";
        echo "<td>".$row["judul"]."</td>";
        echo "<td>".$row["pengarang"]."</td>";
        echo "<td>".$row["penerbit"]."</td>";
        echo "<td>".$row["tahun_terbit"]."</td>";
        echo "<td>".$row["nama_kategori"]."</td>";
        echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "Tidak ada data buku.";
        }
        ?>
    </div>

    <div>
        <h2>Daftar Katalog</h2>
        
        <?php
        $sql = "SELECT katalog.katalog_id, katalog.buku_id, buku.buku_id, buku.judul, buku.pengarang, buku.penerbit, buku.tahun_terbit, kategori.nama_kategori FROM katalog INNER JOIN buku ON katalog.buku_id=buku.buku_id INNER JOIN kategori ON katalog.kategori_id=kategori.kategori_id";
        $result = $mysqli->query($sql);
        echo "<a href='katalog/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID Buku</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Nama Kategori</th></tr>";
        while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["buku_id"]."</td>";
        echo "<td>".$row["judul"]."</td>";
        echo "<td>".$row["pengarang"]."</td>";
        echo "<td>".$row["penerbit"]."</td>";
        echo "<td>".$row["tahun_terbit"]."</td>";
        echo "<td>".$row["nama_kategori"]."</td>";
        echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "Tidak ada data katalog.";
        }
        ?>
    </div>

    <div>
        <h2>Daftar Kategori</h2>
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_kategori = $_POST['nama_kategori'];
            $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
        
            if ($mysqli->query($sql) === TRUE) {
            header("Location: ../kategori"); // Redirect ke tampilan Read setelah berhasil tambah data
            exit;
            } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }

        $sql = "SELECT * FROM kategori";
        $result = $mysqli->query($sql);
        echo "<a href='kategori/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nama Kategori</th></tr>";
        while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["kategori_id"]."</td>";
        echo "<td>".$row["nama_kategori"]."</td>";
        echo "</tr>";
        }
        echo "<tr>";
        echo "</table>";
        } else {
        echo "Tidak ada data anggota.";
        }
        ?>
    </div>

    <div>
        <h2>Daftar Peminjaman</h2>

        <?php
        $sql = "SELECT peminjaman.peminjaman_id, buku.judul, anggota.nama, peminjaman.tanggal_peminjaman, peminjaman.tanggal_kembali, peminjaman.status FROM `peminjaman` INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id";
        $result = $mysqli->query($sql);
        echo "<a href='peminjaman/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Judul</th><th>Nama Peminjam</th><th>Tanggal Peminjaman</th><th>Tanggal Kembali</th><th>Status</th></tr>";
        while ($row = $result->fetch_array()) {
        echo "<tr>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["judul"]."</td>";
        echo "<td>".$row["nama"]."</td>";
        echo "<td>".$row["tanggal_peminjaman"]."</td>";
        echo "<td>".$row["tanggal_kembali"]."</td>";
        $status = $row["status"];
        echo  "<td>".$status."</td>";
        echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "Tidak ada data buku.";
        }
        ?>
    </div>

    <div>
        <h2>Daftar Pengembalian</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id GROUP BY pengembalian_id HAVING peminjaman_id='$id';";
        }else{
            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id";
        }

        $result = $mysqli->query($sql);
        echo "<a href='pengembalian/index.php'><button>ATUR</button></a>";
        if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Judul Buku</th><th>Nama Peminjam</th><th>Tanggal Kembali</th><th>Denda</th><th>Status</th></tr>";
        while ($row = $result->fetch_array()) {
        echo "<tr>";
        echo "<td>".$row["peminjaman_id"]."</td>";
        echo "<td>".$row["judul"]."</td>";
        echo "<td>".$row["nama"]."</td>";
        echo "<td>".$row["tanggal_pengembalian"]."</td>";
        echo "<td>".$row["denda"]."</td>";
        echo "<td>".$row["status_pengembalian"]."</td>";
        echo "</tr>";
        }
        echo "</table>";
        } else {
        echo "Tidak ada data buku.";
        }
        $mysqli->close();
        ?>
    </div>
    
</body>
</html>