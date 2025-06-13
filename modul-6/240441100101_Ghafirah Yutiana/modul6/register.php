<?php
include("koneksi.php");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah username sudah ada
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Username sudah digunakan.";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        if ($insert) {
            $message = "Registrasi berhasil. <a href='login.php' class='text-blue-600 underline'>Login di sini</a>";
        } else {
            $message = "Registrasi gagal: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Form Registrasi</h2>

    <?php if ($message): ?>
        <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded border border-blue-300">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" required
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full mt-1 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            Daftar
        </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
        Sudah punya akun?
        <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>
    </p>
</div>

</body>
</html>
