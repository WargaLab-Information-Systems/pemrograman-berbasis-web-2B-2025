<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Selamat Datang di Website Manajemen Karyawan!</h1>
        <p>Halaman ini akan menampilkan dashboard atau halaman lainnya setelah login.</p>
        <a href="dashboard.php" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">Go to Dashboard</a>
    </div>
</body>
</html>
