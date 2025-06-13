<?php
session_start();
include_once 'koneksi.php';

// Cek apakah user sudah login dan berperan sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen flex flex-col">

  <!-- Header -->
  <header class="bg-orange-500 text-white p-4 shadow-md flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <div class="bg-yellow-500 rounded-full p-2">
        <img src="Asset/logo1.png" alt="Logo Karyawanku" class="w-8 h-8" />
      </div>
      <span class="text-lg font-semibold">Karyawanku</span>
    </div>
    <div>
      <span class="mr-4">Halo, <strong><?= $username ?></strong> (Admin)</span>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition">Logout</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="p-6 flex-1 max-w-4xl mx-auto w-full">
    <h2 class="text-2xl font-bold text-orange-600 mb-8">Dashboard Admin</h2>

    <!-- Menu Navigasi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <a href="lihat_data.php" class="bg-white rounded-2xl shadow-md hover:shadow-lg p-6 border-l-4 border-blue-500 transition group">
        <h3 class="text-lg font-semibold text-blue-600 group-hover:underline">Lihat Data Karyawan</h3>
        <p class="text-sm text-gray-600 mt-2">Tampilkan seluruh data karyawan yang terdaftar.</p>
      </a>
      <a href="lihat_absensi.php" class="bg-white rounded-2xl shadow-md hover:shadow-lg p-6 border-l-4 border-green-500 transition group">
        <h3 class="text-lg font-semibold text-green-600 group-hover:underline">Lihat Absensi Karyawan</h3>
        <p class="text-sm text-gray-600 mt-2">Pantau dan review catatan absensi karyawan.</p>
      </a>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Admin Dashboard.
  </footer>

</body>
</html>
