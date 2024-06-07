<?php
include '../lib/database.php';  // Include your database connection


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

// Insert new user into database
$sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

if ($stmt->execute()) {
    echo "Registration successful.";
    // Optionally redirect to login page or elsewhere
    header("Location: index.php");
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
