<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: akun/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen p-8">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md text-center">
        <h1 class="text-3xl font-bold text-blue-700 mb-4">Selamat Datang, <?= $_SESSION['username'] ?>!</h1>
        <p class="text-gray-600 mb-6">Anda telah berhasil login ke sistem Manajemen Karyawan dan Absensi.</p>
        <div class="flex justify-center gap-4">
            <a href="karyawan/index.php" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Lihat Data Karyawan</a>
            <a href="akun/logout.php" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600">Logout</a>
        </div>
    </div>
</body>
</html>
