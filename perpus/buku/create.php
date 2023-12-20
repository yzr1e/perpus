<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
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
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        form textarea {
            resize: vertical;
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
        <h1>Tambah Buku</h1>
        <?php
        include '../koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $judul = $_POST['judul'];
            $pengarang = $_POST['pengarang'];
            $penerbit = $_POST['penerbit'];
            $tahun_terbit = $_POST['tahun_terbit'];
            $sinopsis = $_POST['sinopsis'];
            $kategori_id = $_POST['kategori_id'];
            $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, sinopsis, kategori_id) 
                    VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$sinopsis', '$kategori_id')";

            if ($mysqli->query($sql) === TRUE) {
                header("Location: ../buku"); // Redirect to the Read view after successful data addition
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }

        $sql = "SELECT * FROM kategori";
        $result = $mysqli->query($sql);
        ?>
        <form action="create.php" method="POST">
            Judul: <input type="text" name="judul"><br>
            Pengarang: <input type="text" name="pengarang"><br>
            Penerbit: <input type="text" name="penerbit"><br>
            Tahun Terbit: <input type="text" name="tahun_terbit"><br>
            Sinopsis: <textarea type="text" name="sinopsis"></textarea><br>
            <?php 
            if ($result->num_rows > 0) { ?>
                Kategori: <select name="kategori_id">
                    <?php while($row = $result->fetch_array()) {; ?>
                        <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
                    <?php }?>
                </select>
            <?php }?>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
