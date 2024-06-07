<?php
require '../vendor/autoload.php'; // Make sure autoload.php path is correct
require '../Models/Database.php'; // Make sure the Database.php path is correct

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

// Hash the password
$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

// Check if email already exists
$existing_user = User::where('email', $email)->first();
if ($existing_user) {
    echo "Email already exists.";
    exit();
}

// Insert new user into database using Eloquent
$user = new User();
$user->username = $username;
$user->email = $email;
$user->password = $hashed_password;
$user->role = $role;

if ($user->save()) {
    header("Location: /pw2024_tubes_233040003/index.php");
    exit();
} else {
    echo "Error: Could not register user.";
}
?>
