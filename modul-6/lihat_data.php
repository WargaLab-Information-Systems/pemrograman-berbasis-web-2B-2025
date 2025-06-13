<?php
session_start();
include_once 'koneksi.php';

// Cek autentikasi admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);

// Ambil data karyawan
$query = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Data Karyawan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
      <a href="dashboard_admin.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition mr-2">Dashboard</a>
      <a href="logout.php" class="bg-yellow-400 px-4 py-1 rounded-full text-black font-semibold hover:bg-yellow-300 transition">Logout</a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="p-6 flex-1 max-w-7xl mx-auto w-full">
    <h2 class="text-2xl font-bold text-orange-600 mb-6">Data Seluruh Karyawan</h2>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md p-4">
      <table class="min-w-full border border-gray-300 text-sm text-left">
        <thead class="bg-orange-100 text-gray-700">
          <tr>
            <th class="py-2 px-4 border">No</th>
            <th class="py-2 px-4 border">Nama</th>
            <th class="py-2 px-4 border">Email</th>
            <th class="py-2 px-4 border">Alamat</th>
            <th class="py-2 px-4 border">Tanggal Lahir</th>
            <th class="py-2 px-4 border">Jenis Kelamin</th>
            <th class="py-2 px-4 border">Pendidikan</th>
            <th class="py-2 px-4 border">No HP</th>
            <th class="py-2 px-4 border text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          if ($query && mysqli_num_rows($query) > 0) {
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) :
          ?>
            <tr class="hover:bg-yellow-50">
              <td class="py-2 px-4 border"><?= $no++ ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['nama']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['email']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['alamat']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['tanggal_lahir']) ?></td>
              <td class="py-2 px-4 border"><?= $data['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['pendidikan']) ?></td>
              <td class="py-2 px-4 border"><?= htmlspecialchars($data['no_hp']) ?></td>
              <td class="py-2 px-4 border text-center">
                <a href="edit_karyawan.php?id=<?= $data['id'] ?>" class="text-blue-600 hover:underline mr-3">Edit</a>
                <a href="hapus_karyawan.php?id=<?= $data['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
              </td>
            </tr>
          <?php
            endwhile;
          } else {
            echo '<tr><td colspan="9" class="text-center py-4 text-red-500">Data karyawan tidak ditemukan.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-gray-500 text-sm p-4 mt-auto">
    &copy; <?= date('Y') ?> Karyawanku. Admin Dashboard.
  </footer>

</body>
</html>
