<?php
session_start();
include "koneksi.php1";

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
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" class="bg-white p-6 rounded shadow-md w-80">
        <h2 class="text-xl mb-4 font-semibold text-center">Login</h2>
        <?php if(isset($error)): ?>
            <p class="text-red-500 mb-2"><?= $error ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required class="w-full p-2 mb-3 border rounded" />
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded" />
        <button type="submit" name="login" class="w-full bg-indigo-600 text-white p-2 rounded hover:bg-indigo-700">Masuk</button>
        <p class="text-center mt-4 text-sm">Belum punya akun? <a href="register.php" class="text-indigo-600 hover:underline">Daftar</a></p>
    </form>
</body>
</html>
