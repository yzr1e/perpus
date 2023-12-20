<?php

include 'koneksi.php';

session_start();

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function validateLogin($username, $password) {
    global $mysqli;

    // You should replace this with your actual user authentication logic
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        return true;
    } else {
        return false;
    }
}

function logoutUser() {
    session_unset();
    session_destroy();
}


// Redirect to the main page if the user is already logged in
if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validateLogin($username, $password)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form action="" method="POST">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
