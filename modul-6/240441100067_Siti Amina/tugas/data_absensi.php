<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

$result = $koneksi->query("SELECT NIP, nama, tanggal_absensi, jam_masuk, jam_pulang FROM karyawan_absensi ORDER BY tanggal_absensi DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Rekap Data Absensi</h1>
        <table class="w-full bg-white border shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">NIP</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="text-center border-b">
                    <td class="p-2"><?= $row['NIP'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tanggal_absensi'] ?></td>
                    <td><?= $row['jam_masuk'] ?></td>
                    <td><?= $row['jam_pulang'] ?></td>
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
