<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Anggota</title>
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
        
        .container h1 {
            align-items: center;
            justify-content: center;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Anggota</h1>
        <?php
        include '../koneksi.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $telepon = $_POST['telepon'];
            $sql = "INSERT INTO anggota (nama, alamat, email, telepon) VALUES ('$nama', '$alamat', '$email', '$telepon')";

            if ($mysqli->query($sql) === TRUE) {
                header("Location: ../anggota"); // Redirect to the Read view after successful data addition
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
            $mysqli->close();
        }
        ?>
        <form action="create.php" method="POST">
            Nama: <input type="text" name="nama"><br>
            Alamat: <input type="text" name="alamat"><br>
            Email: <input type="text" name="email"><br>
            Telepon: <input type="text" name="telepon"><br>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
