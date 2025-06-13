<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

$result = $koneksi->query("SELECT * FROM karyawan_absensi ORDER BY id DESC");
if (!$result) {
    die("Query error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Data Karyawan</h1>
        <a href="tambah_karyawan.php" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded">+ Tambah Data</a>
        <table class="w-full bg-white shadow rounded table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">NIP</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>JK</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Kota</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr class="text-center border-b">
                    <td class="p-2"><?= $row['NIP'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['umur'] ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['departemen'] ?></td>
                    <td><?= $row['jabatan'] ?></td>
                    <td><?= $row['kota_asal'] ?></td>
                    <td><?= $row['tanggal_absensi'] ?></td>
                    <td><?= $row['jam_masuk'] ?></td>
                    <td><?= $row['jam_pulang'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-600">Edit</a> |
                        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data?')" class="text-red-600">Hapus</a>
                    </td>
                </tr>
                <?php endwhile ?>
            </tbody>
        </table>
        <div class="mt-4">
            <a href="dashboard.php" class="text-blue-600">← Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
