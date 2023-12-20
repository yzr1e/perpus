<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku</title>
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

        form input,
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        form select {
            margin-bottom: 15px;
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
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Buku</h1>

        <?php
        include '../koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // your PHP code for updating data
        }

        $sql2 = "SELECT * FROM kategori";
        $id = $_GET['id']; // ID from the book to be updated
        $sql = "SELECT * FROM buku WHERE buku_id=$id";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
        ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['buku_id']; ?>">
            Judul: <input type="text" name="judul" value="<?php echo $row['judul']; ?>"><br>
            Pengarang: <input type="text" name="pengarang" value="<?php echo $row['pengarang']; ?>"><br>
            Penerbit: <input type="text" name="penerbit" value="<?php echo $row['penerbit']; ?>"><br>
            Tahun Terbit: <input type="text" name="tahun_terbit" value="<?php echo $row['tahun_terbit']; ?>"><br>
            Sinopsis: <textarea type="text" name="sinopsis"><?php echo $row['sinopsis']; ?></textarea><br>
            
            <?php 
            $result = $mysqli->query($sql2);
            
            if ($result->num_rows > 0) { ?>
                Kategori: <select name="kategori_id">
                    <?php while ($row = $result->fetch_array()) {; ?>
                        <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
                    <?php }?>
                </select>
            <?php }?>
            
            <input type="submit" value="Update">
        </form>
        <?php
        } else {
            echo "Data tidak ditemukan.";
        }
        $mysqli->close();
        ?>
    </div>
</body>
</html>
