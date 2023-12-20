<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kategori</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .category-list {
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

    .category-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .category-table th, .category-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .category-table th {
        background-color: #4CAF50;
        color: white;
    }

    .category-table tr:hover {
        background-color: #f5f5f5;
    }

    .category-form {
        margin-top: 20px;
    }

    .category-form input[type="text"] {
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .category-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .category-form input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>
<body>
    <div class="category-list">
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
        if ($result->num_rows > 0) {
            echo "<table class='category-table'>";
            echo "<tr><th>ID</th><th>Nama Kategori</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["kategori_id"]."</td>";
                echo "<td>".$row["nama_kategori"]."</td>";
                echo "<td><a href='update.php?id=".$row["kategori_id"]."'>Edit</a> | <a href='delete.php?id=".$row["kategori_id"]."'>Hapus</a></td>";
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td colspan=3 class='category-form'><form action='../kategori/' method='POST'><input type='text' name='nama_kategori' placeholder='Tambah kategori'><input type='submit' value='Tambah'></form></td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "Tidak ada data kategori.";
        }
        $mysqli->close();
        ?>
    </div>
</body>
</html>
