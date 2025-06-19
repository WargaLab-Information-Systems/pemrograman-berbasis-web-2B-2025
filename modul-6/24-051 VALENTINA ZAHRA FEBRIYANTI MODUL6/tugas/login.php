<?php
session_start();
include "koneksi1.php";

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-100 flex justify-center items-center h-screen">
    <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-80">
        <h2 class="text-2xl mb-4 font-bold text-center text-pink-600">Login</h2>
        <?php if(isset($error)): ?>
            <p class="text-rose-500 mb-3 text-sm text-center"><?= $error ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required
            class="w-full p-2 mb-3 border border-pink-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400" />
        <input type="password" name="password" placeholder="Password" required
            class="w-full p-2 mb-4 border border-pink-300 rounded focus:outline-none focus:ring-2 focus:ring-pink-400" />
        <button type="submit" name="login"
            class="w-full bg-pink-500 text-white p-2 rounded hover:bg-pink-600 transition">Masuk</button>
        <p class="text-center mt-4 text-sm">Belum punya akun?
            <a href="register.php" class="text-pink-600 hover:underline">Daftar</a>
        </p>
    </form>
</body>
</html>
