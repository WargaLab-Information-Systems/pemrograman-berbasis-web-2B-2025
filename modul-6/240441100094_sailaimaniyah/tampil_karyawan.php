<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM karyawan_absensi WHERE id=$id");
    header("Location: tampil_karyawan.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM karyawan_absensi ORDER BY tanggal_absensi DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Karyawan & Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

<div class="max-w-6xl mx-auto bg-white rounded shadow p-6 overflow-x-auto">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Data Karyawan & Absensi</h2>
    <div>
      <a href="input_karyawan.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mr-2">Tambah Data</a>
      <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
    </div>
  </div>

  <table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead>
      <tr class="bg-gray-200">
        <th class="border border-gray-300 px-3 py-2">NIP</th>
        <th class="border border-gray-300 px-3 py-2">Nama</th>
        <th class="border border-gray-300 px-3 py-2">Umur</th>
        <th class="border border-gray-300 px-3 py-2">Jenis Kelamin</th>
        <th class="border border-gray-300 px-3 py-2">Departemen</th>
        <th class="border border-gray-300 px-3 py-2">Jabatan</th>
        <th class="border border-gray-300 px-3 py-2">Kota Asal</th>
        <th class="border border-gray-300 px-3 py-2">Tanggal</th>
        <th class="border border-gray-300 px-3 py-2">Jam Masuk</th>
        <th class="border border-gray-300 px-3 py-2">Jam Pulang</th>
        <th class="border border-gray-300 px-3 py-2"></th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_assoc($result)) : ?>
      <tr class="hover:bg-gray-100">
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['nip']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['nama']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= $row['umur'] ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['departemen']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['jabatan']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= htmlspecialchars($row['kota_asal']) ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= $row['tanggal_absensi'] ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= $row['jam_masuk'] ?></td>
        <td class="border border-gray-300 px-3 py-2"><?= $row['jam_pulang'] ?></td>
        <td class="border border-gray-300 px-3 py-2">
          <a href="edit_karyawan.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline mr-2">Edit</a>
          <a href="tampil_karyawan.php?hapus=<?= $row['id'] ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
