<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username =$_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: tampil_karyawan.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login - Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
<div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6">Login</h2>

    <?php if(isset($_SESSION['msg'])): ?>
        <p class="mb-4 text-green-600"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></p>
    <?php endif; ?>

    <?php if(isset($error)) : ?>
        <p class="mb-4 text-red-600"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" class="w-full border rounded px-3 py-2" required />
        </div>
        <div>
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required />
        </div>
        <button type="submit" name="login" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Belum punya akun? <a href="registrasi.php" class="text-blue-600 underline">Daftar di sini</a></p>
</div>
</body>
</html>
