<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "koneksi1.php";

// Ambil data karyawan dan absensi
$result = $conn->query("SELECT * FROM karyawan_absensi ORDER BY nip ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Manajemen Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 min-h-screen p-4 opacity-0 transition-opacity duration-700" id="mainBody">
    <div class="max-w-7xl mx-auto bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-pink-600">Dashboard Karyawan & Absensi</h1>
            <div>
                <a href="add.php" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600 transition duration-300">Tambah Data</a>
                <a href="logout.php" class="ml-4 bg-rose-500 text-white px-4 py-2 rounded hover:bg-rose-600 transition duration-300">Logout</a>
            </div>
        </div>

        <table class="w-full table-auto border-collapse border border-pink-300">
            <thead>
                <tr class="bg-pink-600 text-white">
                    <th class="border border-pink-300 px-3 py-2">ID</th>
                    <th class="border border-pink-300 px-3 py-2">NIP</th>
                    <th class="border border-pink-300 px-3 py-2">Nama</th>
                    <th class="border border-pink-300 px-3 py-2">Umur</th>
                    <th class="border border-pink-300 px-3 py-2">Jenis Kelamin</th>
                    <th class="border border-pink-300 px-3 py-2">Departemen</th>
                    <th class="border border-pink-300 px-3 py-2">Jabatan</th>
                    <th class="border border-pink-300 px-3 py-2">Kota Asal</th>
                    <th class="border border-pink-300 px-3 py-2">Tanggal Absensi</th>
                    <th class="border border-pink-300 px-3 py-2">Jam Masuk</th>
                    <th class="border border-pink-300 px-3 py-2">Jam Pulang</th>
                    <th class="border border-pink-300 px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="text-center border border-pink-300 hover:bg-pink-100 cursor-pointer transition-colors duration-300">
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['nip']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['nama']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['umur']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['departemen']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['jabatan']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['kota_asal']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['tanggal_absensi']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['jam_masuk']) ?></td>
                            <td class="border border-pink-300 px-2 py-1"><?= htmlspecialchars($row['jam_pulang']) ?></td>
                            <td class="border border-pink-300 px-2 py-1">
                                <a href="edit.php?id=<?= urlencode($row['id']) ?>" class="text-pink-600 hover:underline mr-2">Edit</a>
                                <a href="delete.php?id=<?= urlencode($row['id']) ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-rose-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" class="text-center p-4 text-pink-500">Belum ada data karyawan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript Tambahan -->
    <script>
    // Efek fade-in saat halaman dimuat
    window.addEventListener('load', () => {
        document.getElementById('mainBody').classList.remove('opacity-0');
        document.getElementById('mainBody').classList.add('opacity-100');
    });

    // Highlight baris saat diklik
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('click', () => {
            document.querySelectorAll('tbody tr').forEach(r => r.classList.remove('bg-yellow-100'));
            row.classList.add('bg-yellow-100');
        });
    });
    </script>
</body>
</html>
