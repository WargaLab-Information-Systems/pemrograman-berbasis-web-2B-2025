<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="p-6 max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Selamat datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>

        <div class="space-y-2">
            <a href="data_karyawan.php" class="block p-3 bg-white shadow rounded hover:bg-gray-50">📋 Data Karyawan</a>
            <a href="data_absensi.php" class="block p-3 bg-white shadow rounded hover:bg-gray-50">🕒 Data Absensi</a>
            <a href="logout.php" class="block p-3 bg-red-100 text-red-600 rounded shadow hover:bg-red-200">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
