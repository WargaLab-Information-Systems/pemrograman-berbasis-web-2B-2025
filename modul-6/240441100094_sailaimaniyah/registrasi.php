<?php
session_start();
include 'koneksi.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek username sudah dipakai?
    $cek = mysqli_query($koneksi, "SELECT id FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$hash')");
        $_SESSION['msg'] = "Registrasi berhasil, silakan login.";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Registrasi - Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-6">
<div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6">Registrasi</h2>

    <?php if(isset($error)) : ?>
        <p class="mb-4 text-red-600"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" class="space-y-4" onsubmit="return validate()">
        <div>
            <label class="block mb-1 font-medium">Username</label>
            <input type="text" name="username" id="username" class="w-full border rounded px-3 py-2" required />
        </div>
        <div>
            <label class="block mb-1 font-medium">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2" required  />
        </div>
        <button type="submit" name="register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Daftar</button>
    </form>
    <p class="mt-4 text-sm text-gray-600">Sudah punya akun? <a href="login.php" class="text-blue-600 underline">Login di sini</a></p>
</div>

<script>
function validate() {
    const pw = document.getElementById('password').value;
    if (pw.length < 6) {
        alert('Password minimal 6 karakter');
        return false;
    }
    return true;
}
</script>
</body>
</html>
