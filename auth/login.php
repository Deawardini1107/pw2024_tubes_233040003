<?php
session_start();
require '../vendor/autoload.php'; // Pastikan autoload.php benar lokasinya
require '../Models/Database.php'; // Pastikan lokasi Database.php benar

use Models\User;

// Collect post data
$username = $_POST['username'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$role = 'user';  // Default role

// Check if passwords match
if ($password1 !== $password2) {
    echo "Passwords do not match.";
    exit();
}

// Check if the email already exists
if (User::where('email', $email)->exists()) {
    echo "Email is already registered.";
    exit();
}

// Hash the password
$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

// Create new user
$user = new User();
$user->username = $username;
$user->email = $email;
$user->password = $hashed_password;
$user->role = $role;

if ($user->save()) {
    header("Location: /paradise/index.php");
    exit;
} else {
    echo "Error: Unable to register user.";
}
?>
