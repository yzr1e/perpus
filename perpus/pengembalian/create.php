<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pengembalian</title>
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
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
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
        <h1>Tambah Pengembalian</h1>
        <?php
        include '../koneksi.php';
        $status = 'dipinjam';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $buku_id = $_POST['buku_id'];
            $anggota_id = $_POST['anggota_id'];
            $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
            $tanggal_kembali = $_POST['tanggal_kembali'];
            $sql = "INSERT INTO peminjaman (buku_id, anggota_id, tanggal_peminjaman, tanggal_kembali, status) VALUES ('$buku_id',
            '$anggota_id', '$tanggal_peminjaman', '$tanggal_kembali', '$status')";

            if ($mysqli->query($sql) === TRUE) {
                header("Location: ../peminjaman"); // Redirect to the Read view after successful data addition
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }
        ?>
        <form action="create.php" method="POST">
            ID Buku: <input type="text" name="buku_id"><br>
            ID Peminjam: <input type="text" name="anggota_id"><br>
            Tanggal Meminjam: <input type="date" name="tanggal_peminjaman"><br>
            Tanggal Kembali: <input type="date" name="tanggal_kembali"><br>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
