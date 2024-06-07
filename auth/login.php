<?php
session_start();
require '../vendor/autoload.php'; // Pastikan autoload.php benar lokasinya
require '../Models/Database.php'; // Pastikan lokasi Database.php benar

use Models\User;


$email = $_POST['email'];
$password = $_POST['password'];

// Menggunakan Eloquent untuk menemukan user
$user = User::where('email', $email)->first();

if ($user) {
    // Verify password
    if (password_verify($password, $user->password)) {
        // Set session variables
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['username'] = $user->username;
        $_SESSION['role'] = $user->role;
        // Redirect to dashboard or home page
        header("Location: /pw2024_tubes_233040003/index.php");
        exit;
    } else {
        echo "Invalid email or password";
    }
} else {
    echo "Invalid email or password";
}