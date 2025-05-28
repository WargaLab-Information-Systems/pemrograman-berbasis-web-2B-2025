<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Simpan user ke database
    $stmt = $koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal: Username mungkin sudah ada.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form method="POST" class="bg-white p-6 rounded shadow-md w-80 space-y-4">
        <h2 class="text-xl font-bold">Registrasi</h2>
        <input type="text" name="username" required placeholder="Username" class="w-full px-3 py-2 border rounded">
        <input type="password" name="password" required placeholder="Password" class="w-full px-3 py-2 border rounded">
        <button type="submit" class="w-full bg-blue-500 text-white px-3 py-2 rounded">Daftar</button>
        <p class="text-sm text-center">Sudah punya akun? <a href="login.php" class="text-blue-600">Login</a></p>
    </form>
</body>
</html>
