<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Anggota</title>
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

        form input {
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
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Anggota</h1>

        <?php
        include '../koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // your PHP code for updating data
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM anggota WHERE anggota_id=$id";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
        ?>
        <form action="update.php" method="POST">
            Nama: <input type="text" name="nama" value="<?php echo $row['nama']; ?>"><br>
            Alamat: <input type="text" name="alamat" value="<?php echo $row['alamat']; ?>"><br>
            Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
            Telepon: <input type="text" name="telepon" value="<?php echo $row['telepon']; ?>"><br>
            <input type="hidden" name="id" value="<?php echo $row['anggota_id']; ?>">
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
