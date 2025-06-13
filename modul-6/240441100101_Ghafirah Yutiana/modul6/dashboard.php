<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Selamat datang, <span class="text-blue-600"><?php echo htmlspecialchars($_SESSION['username']); ?></span>!</h2>
        
        <div class="space-y-3 mt-6">
            <a href="absen.php" class="block w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition">Input Data Karyawan & Absensi</a>
            <a href="data.php" class="block w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Lihat Data Karyawan</a>
            <a href="login.php" class="block w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition">Logout</a>
        </div>
    </div>
</body>
</html>
