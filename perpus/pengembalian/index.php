<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pengembalian</title>
    <style>
        /* styles.css */

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.return-list {
    margin: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.add-button {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 20px;
}

.add-button:hover {
    background-color: #45a049;
}

.return-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.return-table th, .return-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.return-table th {
    background-color: #4CAF50;
    color: white;
}

.return-table tr:hover {
    background-color: #f5f5f5;
}

.action-links a {
    text-decoration: none;
    padding: 6px 12px;
    background-color: #4CAF50;
    color: white;
    border-radius: 4px;
    margin-right: 5px;
}

.action-links a:hover {
    background-color: #45a049;
}

.show-all-button {
    margin-top: 10px;
}

    </style>
</head>
<body>
    <div class="return-list">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id GROUP BY pengembalian_id HAVING peminjaman_id='$id';";
        }else{
            $sql = "SELECT pengembalian.pengembalian_id, peminjaman.peminjaman_id, buku.judul, anggota.nama, pengembalian.tanggal_pengembalian, pengembalian.denda, pengembalian.status_pengembalian FROM `pengembalian` INNER JOIN `peminjaman` ON pengembalian.peminjaman_id=peminjaman.peminjaman_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id";
        }
        $result = $mysqli->query($sql);
        echo "<a href='create.php'><button class='add-button'>TAMBAH</button></a>";
        if ($result->num_rows > 0) {
            echo "<table class='return-table'>";
            echo "<tr><th>ID</th><th>Judul Buku</th><th>Nama Peminjam</th><th>Tanggal Kembali</th><th>Denda</th><th>Status</th><th>Action</th></tr>";
            while ($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>".$row["peminjaman_id"]."</td>";
                echo "<td>".$row["judul"]."</td>";
                echo "<td>".$row["nama"]."</td>";
                echo "<td>".$row["tanggal_pengembalian"]."</td>";
                echo "<td>".$row["denda"]."</td>";
                echo "<td>".$row["status_pengembalian"]."</td>";
                echo "<td class='action-links'><a href='update.php?id=".$row["pengembalian_id"]."'>Edit</a> | <a href='delete.php?id=".$row["pengembalian_id"]."'>Hapus</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data pengembalian.";
        }
        $mysqli->close();
        ?>
    </div>
</body>
</html>
