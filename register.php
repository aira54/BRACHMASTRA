<?php
session_start();
require 'db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
    $stmt->bind_param("sss", $name, $email, $pass);

    if ($stmt->execute()) {
        // Ambil ID user yang baru dibuat
        $user_id = $stmt->insert_id;

        // Simpan ke session agar langsung login
        $_SESSION['user_id']   = $user_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['role']      = 'user';

        // Arahkan ke halaman utama
        header("Location: index.php");
        exit;
    } else {
        $errors[] = "Gagal registrasi, mungkin email sudah digunakan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<title>Register - BRACHMASTRA</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center p-4">
  <div class="bg-white w-full max-w-md p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-center mb-4 text-blue-700">Registrasi</h1>
    <?php if(!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        <?php foreach($errors as $e): echo '<p>'.htmlspecialchars($e).'</p>'; endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Nama</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
      </div>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Daftar</button>

      <p class="text-sm text-center mt-2">Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login</a></p>
    </form>
  </div>
</div>
</body>
</html>
