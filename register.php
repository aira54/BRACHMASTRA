<?php
session_start();
require 'db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass1 = $_POST['password'];
    $pass2 = $_POST['password_confirm'];

    if ($name === '' || $email === '' || $pass1 === '') {
        $errors[] = 'Semua field wajib diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }
    if ($pass1 !== $pass2) {
        $errors[] = 'Konfirmasi password tidak cocok.';
    }

    if (empty($errors)) {
        // Cek email sudah ada
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Email sudah terdaftar.';
        } else {
            $hash = password_hash($pass1, PASSWORD_BCRYPT);
            $insert = $conn->prepare('INSERT INTO users(name,email,password) VALUES(?,?,?)');
            $insert->bind_param('sss', $name, $email, $hash);
            if ($insert->execute()) {
                $_SESSION['user_id'] = $insert->insert_id;
                $_SESSION['user_name'] = $name;
                header('Location: index.php');
                exit;            
            } else {
                $errors[] = 'Gagal registrasi.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<title>Registrasi - BRACHMASTRA</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center p-4">
  <div class="bg-white w-full max-w-md p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-center mb-4 text-blue-700">Registrasi Akun</h1>
    <?php if(!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        <ul class="list-disc ml-5">
          <?php foreach($errors as $e): echo '<li>'.htmlspecialchars($e).'</li>'; endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
        <input type="text" name="name" class="w-full border rounded px-3 py-2" required value="<?= isset($name)?htmlspecialchars($name):'' ?>">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required value="<?= isset($email)?htmlspecialchars($email):'' ?>">
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirm" class="w-full border rounded px-3 py-2" required>
      </div>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Daftar</button>
      <p class="text-sm text-center mt-2">Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login</a></p>
    </form>
  </div>
</div>
</body>
</html>