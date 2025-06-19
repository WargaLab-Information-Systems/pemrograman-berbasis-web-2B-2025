<?php
session_start();
include "koneksi.php1";

if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek username sudah ada atau belum
    $cek = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $error = "Username sudah dipakai, silakan pilih yang lain.";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <form method="POST" class="bg-white p-6 rounded shadow-md w-80">
        <h2 class="text-xl mb-4 font-semibold text-center">Registrasi</h2>
        <?php if(isset($error)): ?>
            <p class="text-red-500 mb-2"><?= $error ?></p>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required class="w-full p-2 mb-3 border rounded" />
        <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded" />
        <button type="submit" name="register" class="w-full bg-indigo-600 text-white p-2 rounded hover:bg-indigo-700">Daftar</button>
        <p class="text-center mt-4 text-sm">Sudah punya akun? <a href="login.php" class="text-indigo-600 hover:underline">Login</a></p>
    </form>
</body>
</html>
