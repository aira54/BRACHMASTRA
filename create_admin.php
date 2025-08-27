<?php
require 'db.php';

$name = "Administrator";
$email = "admin@brachmastra.com";
$passwordPlain = "barabarong";
$role = "admin";

// hash password
$hashedPassword = password_hash($passwordPlain, PASSWORD_DEFAULT);

// simpan ke database
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

if ($stmt->execute()) {
    echo "✅ Admin berhasil dibuat!";
} else {
    echo "❌ Error: " . $stmt->error;
}
