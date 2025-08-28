<?php
session_start();
require 'db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    // cek user berdasarkan email
    $stmt = $conn->prepare('SELECT id, name, password, role FROM users WHERE email = ? LIMIT 1');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // verifikasi password
    if ($user && password_verify($pass, $user['password'])) {
        // simpan data penting ke session
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name']; // ← selalu pakai ini
        $_SESSION['role']      = $user['role'];

        // redirect sesuai role
        if ($user['role'] === 'admin') {
            header('Location: admin/admin.php');
        } else {
            header('Location: hukum.php');
        }
        exit;
    } else {
        $errors[] = 'Email atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="asset/brachmastra.png">
<title>Login - BRACHMASTRA</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center p-4">
  <div class="bg-white w-full max-w-md p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-center mb-4 text-blue-700">Login</h1>
    <?php if(!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
        <?php foreach($errors as $e): echo '<p>'.htmlspecialchars($e).'</p>'; endforeach; ?>
      </div>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
      </div>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Masuk</button>
      <p class="text-sm text-center mt-2">Belum punya akun? <a href="register.php" class="text-blue-600 hover:underline">Registrasi</a></p>
    </form>
  </div>
</div>
</body>
</html>
