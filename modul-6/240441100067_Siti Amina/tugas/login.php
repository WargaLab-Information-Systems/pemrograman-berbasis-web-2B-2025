<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    $stmt = $koneksi->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password_input, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Login gagal: Username atau password salah');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form method="POST" class="bg-white p-6 rounded shadow-md w-80 space-y-4">
        <h2 class="text-xl font-bold">Login</h2>
        <input type="text" name="username" required placeholder="Username" class="w-full px-3 py-2 border rounded">
        <input type="password" name="password" required placeholder="Password" class="w-full px-3 py-2 border rounded">
        <button type="submit" class="w-full bg-blue-600 text-white px-3 py-2 rounded">Login</button>
        <p class="text-sm text-center">Belum punya akun? <a href="register.php" class="text-blue-600">Daftar</a></p>
    </form>
</body>
</html>
