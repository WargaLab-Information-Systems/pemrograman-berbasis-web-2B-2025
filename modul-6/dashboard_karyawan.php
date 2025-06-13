<?php
session_start();

// Cek apakah user sudah login dan berperan sebagai karyawan
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];

// Include koneksi
require 'koneksi.php';

// Ambil data biodata berdasarkan username
$stmt = $conn->prepare("SELECT k.* FROM users u JOIN karyawan k ON u.id = k.user_id WHERE u.username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$biodata = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Karyawan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-800">
  <nav class="bg-orange-500 text-white p-4 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <div class="bg-yellow-500 rounded-full p-2">
        <img src="Asset/logo1.png" alt="Logo Karyawanku" class="w-8 h-8">
      </div>
      <span class="text-lg font-semibold">Karyawanku</span>
    </div>
    <div class="flex items-center gap-4">
      <span class="text-yellow-100">Halo, <?= htmlspecialchars($username) ?></span>
      <a href="logout.php" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-full">Logout</a>
    </div>
  </nav>

  <main class="max-w-5xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold mb-6 text-orange-600">Dashboard Karyawan</h2>

    <!-- Fitur Karyawan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      <a href="tambah_biodata.php" class="bg-white rounded-2xl shadow-md hover:shadow-lg p-6 border-l-4 border-green-500 transition group">
        <h3 class="text-lg font-semibold text-green-600 group-hover:underline">Tambah Biodata</h3>
        <p class="text-sm text-gray-600 mt-2">Isi data pribadi karyawan jika belum ada.</p>
      </a>
      <a href="absensi.php" class="bg-white rounded-2xl shadow-md hover:shadow-lg p-6 border-l-4 border-orange-500 transition group">
        <h3 class="text-lg font-semibold text-orange-500 group-hover:underline">Absensi</h3>
        <p class="text-sm text-gray-600 mt-2">Lakukan presensi kehadiran harian di sini.</p>
      </a>
      <a href="#biodata" class="bg-white rounded-2xl shadow-md hover:shadow-lg p-6 border-l-4 border-yellow-500 transition group">
        <h3 class="text-lg font-semibold text-yellow-600 group-hover:underline">Lihat Biodata</h3>
        <p class="text-sm text-gray-600 mt-2">Lihat data pribadi Anda yang tersimpan.</p>
      </a>
    </div>

    <!-- Biodata Pribadi -->
    <div id="biodata" class="bg-white p-6 rounded-2xl shadow border border-yellow-200">
      <h3 class="text-lg font-semibold text-orange-700 mb-4">Biodata Pribadi</h3>
      <?php if ($biodata): ?>
      <ul class="space-y-2">
        <li><span class="font-medium text-gray-600">NIP:</span> <?= htmlspecialchars($biodata['nip']) ?></li>
        <li><span class="font-medium text-gray-600">Nama:</span> <?= htmlspecialchars($biodata['nama']) ?></li>
        <li><span class="font-medium text-gray-600">Jabatan:</span> <?= htmlspecialchars($biodata['jabatan']) ?></li>
        <li><span class="font-medium text-gray-600">Alamat:</span> <?= htmlspecialchars($biodata['alamat']) ?></li>
        <li><span class="font-medium text-gray-600">No HP:</span> <?= htmlspecialchars($biodata['no_hp']) ?></li>
        <li><span class="font-medium text-gray-600">E Mail:</span> <?= htmlspecialchars($biodata['email']) ?></li>
        <li><span class="font-medium text-gray-600">Tempat lahir:</span> <?= htmlspecialchars($biodata['tempat_lahir']) ?></li>
        <li><span class="font-medium text-gray-600">Tanggal Lahir:</span> <?= htmlspecialchars($biodata['tanggal_lahir']) ?></li>
        <li><span class="font-medium text-gray-600">Jenis Kelamin:</span> <?= htmlspecialchars($biodata['jenis_kelamin']) ?></li>
        <li><span class="font-medium text-gray-600">Pendidikan terakhir:</span> <?= htmlspecialchars($biodata['pendidikan']) ?></li>
      </ul>
      <?php else: ?>
        <p class="text-sm text-gray-500">Biodata belum tersedia. Silakan isi melalui tombol <strong>Tambah Biodata</strong>.</p>
      <?php endif; ?>
    </div>
  </main>
</body>
</html>
