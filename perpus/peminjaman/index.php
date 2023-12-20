<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Peminjaman</title>
	<style>
		/* styles.css */

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.loan-list {
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

.loan-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.loan-table th, .loan-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.loan-table th {
    background-color: #4CAF50;
    color: white;
}

.loan-table tr:hover {
    background-color: #f5f5f5;
}

.return-link {
    text-decoration: none;
    padding: 6px 12px;
    background-color: #4CAF50;
    color: white;
    border-radius: 4px;
}

.return-link:hover {
    background-color: #45a049;
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

	</style>
</head>
<body>
    <div class="loan-list">
        <?php
        $sql = "SELECT peminjaman.peminjaman_id, buku.judul, anggota.nama, peminjaman.tanggal_peminjaman, peminjaman.tanggal_kembali, peminjaman.status FROM `peminjaman` INNER JOIN `buku` ON peminjaman.buku_id=buku.buku_id INNER JOIN `anggota` ON peminjaman.anggota_id=anggota.anggota_id";
        $result = $mysqli->query($sql);
        echo "<a href='create.php'><button class='add-button'>TAMBAH</button></a>";
        if ($result->num_rows > 0) {
            echo "<table class='loan-table'>";
            echo "<tr><th>ID</th><th>Judul</th><th>Nama Peminjam</th><th>Tanggal Peminjaman</th><th>Tanggal Kembali</th><th>Status</th><th>Action</th></tr>";
            while ($row = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>".$row["peminjaman_id"]."</td>";
                echo "<td>".$row["judul"]."</td>";
                echo "<td>".$row["nama"]."</td>";
                echo "<td>".$row["tanggal_peminjaman"]."</td>";
                echo "<td>".$row["tanggal_kembali"]."</td>";
                $status = $row["status"];
                echo  "<td>".$status."</td>";
                if ($status == "dipinjam") {
                    echo "<td><a class='return-link' href='kembali.php?id=".$row["peminjaman_id"]."'>Kembalikan</a></td>";
                }
                echo "<td class='action-links'><a href='update.php?id=".$row["peminjaman_id"]."'>Edit</a> | <a href='delete.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data peminjaman.";
        }
        $mysqli->close();
        ?>
    </div>
</body>
</html>
