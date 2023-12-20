<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Katalog</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        form select,
        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        form input[type="number"] {
            width: calc(100% - 22px); /* Adjust for number input arrow */
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Katalog</h1>
        <?php
        include '../koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buku_id = $_POST['buku_id'];
            $kategori_id = $_POST['kategori_id'];
            $jumlah = $_POST['jumlah'];
            $sql = "INSERT INTO katalog (buku_id, kategori_id) VALUES ('$buku_id', '$kategori_id')";
            for ($i=0; $i < $jumlah; ) { 
                $mysqli->query($sql);
                $i++;
            }
            header("Location: ../katalog");
            $mysqli->close();
        }

        $sql = "SELECT buku.*, kategori.* FROM buku LEFT JOIN kategori ON buku.kategori_id=kategori.kategori_id";
        $result = $mysqli->query($sql);
        ?>
        <form action="create.php" method="POST">
            Buku: <?php 
            if ($result->num_rows > 0) {
                echo "<select name='buku_id'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["buku_id"]."'>".$row["judul"]." - ".$row["buku_id"]."</option>";
                }
                echo " </select>";
            } else {
                echo "Tidak ada data buku.";
            } ?><br>
            <?php 
            $sql = "SELECT * FROM kategori";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) { ?>
                Kategori: <select name="kategori_id">
                    <?php while($row = $result->fetch_array()) {; ?>
                        <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
                    <?php }?>
                </select>
            <?php }?><br>
            Jumlah: <input type="number" name="jumlah"><br>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
