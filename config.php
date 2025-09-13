<?php
// URL dasar project
define("BASE_URL", "http://localhost/BRACHMASTRA/");

// Database
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "brachmastra");

// Koneksi DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Session start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
