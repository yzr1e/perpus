<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .book-list {
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
        }

        .add-button:hover {
            background-color: #45a049;
        }

        .book-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .book-table th, .book-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .book-table th {
            background-color: #4CAF50;
            color: white;
        }

        .book-table tr:hover {
            background-color: #f5f5f5;
        }

        .action-links a {
            text-decoration: none;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .action-links a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="book-list">
        <?php
        include '../koneksi.php';
        $sql = "SELECT buku.*, kategori.* FROM buku LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id";
        $result = $mysqli->query($sql);
        echo "<a href='create.php'><button class='add-button'>TAMBAH</button></a>";
        if ($result->num_rows > 0) {
            echo "<table class='book-table'>";
            echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Kategori</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["buku_id"]."</td>";
                echo "<td>".$row["judul"]."</td>";
                echo "<td>".$row["pengarang"]."</td>";
                echo "<td>".$row["penerbit"]."</td>";
                echo "<td>".$row["tahun_terbit"]."</td>";
                echo "<td>".$row["nama_kategori"]."</td>";
                echo "<td class='action-links'><a href='update.php?id=".$row["buku_id"]."'>Edit</a> | <a href='delete.php?id=".$row["buku_id"]."'>Hapus</a></td>";
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
