<?php
session_start();
include("koneksi.php");

$message = "";
$mode = $_GET['mode'] ?? 'login'; // nilai default login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // login
    if ($mode === 'login') {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Password salah.";
            }
        } else {
            $message = "Username tidak ditemukan.";
        }

        //register 
    } elseif ($mode === 'register') {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check) > 0) {
            $message = "Username sudah digunakan.";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')");
            if ($insert) {
                $message = "Registrasi berhasil. <a href='?mode=login' class='text-blue-600 underline'>Login di sini</a>";
            } else {
                $message = "Registrasi gagal: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $mode === 'login' ? 'Login' : 'Daftar' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6"><?= $mode === 'login' ? 'Login Pengguna' : 'Daftar Pengguna' ?></h2>

    <?php if ($message): ?>
        <div class="mb-4 p-3 <?= strpos($message, 'berhasil') ? 'text-green-700 bg-green-100 border-green-400' : 'text-red-700 bg-red-100 border-red-400' ?> rounded border">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" required
                   class="mt-1 w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-300">
        </div>
        <button type="submit"
                class="w-full <?= $mode === 'login' ? 'bg-blue-600 hover:bg-blue-700' : 'bg-green-600 hover:bg-green-700' ?> text-white py-2 px-4 rounded transition">
            <?= $mode === 'login' ? 'Login' : 'Daftar' ?>
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        <?php if ($mode === 'login'): ?>
            Belum punya akun? <a href="?mode=register" class="text-blue-600 hover:underline">Daftar</a>
        <?php else: ?>
            Sudah punya akun? <a href="?mode=login" class="text-blue-600 hover:underline">Login</a>
        <?php endif; ?>
    </p>
</div>
</body>
</html>
