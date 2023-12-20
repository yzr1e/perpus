<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        a:hover {
            background-color: #45a049;
        }

        .action-links a {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <h1>Daftar Anggota</h1>
    
    <?php
   include '../koneksi.php';
    $sql = "SELECT * FROM anggota";
    $result = $mysqli->query($sql);
    echo "<a href='create.php'><button class='add-button'>TAMBAH</button></a>";
    if ($result->num_rows > 0) {
        echo "<table class='member-table'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Email</th><th>Telepon</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["anggota_id"]."</td>";
            echo "<td>".$row["nama"]."</td>";
            echo "<td>".$row["alamat"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["telepon"]."</td>";
            echo "<td class='action-links'><a href='update.php?id=".$row["anggota_id"]."'>Edit</a> | <a href='delete.php?id=".$row["anggota_id"]."'>Hapus</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data anggota.";
    }
    $mysqli->close();
    ?>
</body></html>
