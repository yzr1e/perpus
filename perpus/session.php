<?php

session_start();

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

function validateLogin($username, $password) {
    // Add your authentication logic here
    // For demonstration purposes, using a simple check
    // You should replace this with your actual user authentication logic
    $validUser = ($username === 'admin' && $password === 'password');

    if ($validUser) {
        $_SESSION['user_id'] = 1; // You can store user details in the session
        return true;
    } else {
        return false;
    }
}

function logoutUser() {
    session_unset();
    session_destroy();
}

?>
