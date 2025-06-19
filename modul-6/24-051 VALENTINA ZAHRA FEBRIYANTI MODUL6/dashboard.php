<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php1");
    exit;
}

include "koneksi.php";

// Ambil data karyawan dan absensi dari tabel karyawan_absensi
$result = $conn->query("SELECT * FROM karyawan_absensi ORDER BY nip ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-4">
    <div class="max-w-7xl mx-auto bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-indigo-600">Dashboard Karyawan & Absensi</h1>
            <div>
                <a href="add.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Data</a>
                <a href="logout.php" class="ml-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Logout</a>
            </div>
        </div>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-indigo-600 text-white">
                    <th class="border border-gray-300 px-3 py-2">NIP</th>
                    <th class="border border-gray-300 px-3 py-2">Nama</th>
                    <th class="border border-gray-300 px-3 py-2">Umur</th>
                    <th class="border border-gray-300 px-3 py-2">Jenis Kelamin</th>
                    <th class="border border-gray-300 px-3 py-2">Departemen</th>
                    <th class="border border-gray-300 px-3 py-2">Jabatan</th>
                    <th class="border border-gray-300 px-3 py-2">Kota Asal</th>
                    <th class="border border-gray-300 px-3 py-2">Tanggal Absensi</th>
                    <th class="border border-gray-300 px-3 py-2">Jam Masuk</th>
                    <th class="border border-gray-300 px-3 py-2">Jam Pulang</th>
                    <th class="border border-gray-300 px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="text-center border border-gray-300 hover:bg-indigo-50">
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['nip']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['umur']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['departemen']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['jabatan']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['kota_asal']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['tanggal_absensi']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['jam_masuk']) ?></td>
                            <td class="border border-gray-300 px-2 py-1"><?= htmlspecialchars($row['jam_pulang']) ?></td>
                            <td class="border border-gray-300 px-2 py-1">
                                <a href="edit.php?nip=<?= $row['nip'] ?>" class="text-indigo-600 hover:underline mr-2">Edit</a>
                                <a href="delete.php?nip=<?= $row['nip'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center p-4 text-gray-500">Belum ada data karyawan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
