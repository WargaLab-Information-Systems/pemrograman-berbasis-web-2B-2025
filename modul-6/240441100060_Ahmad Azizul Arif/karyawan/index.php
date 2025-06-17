<?php
$host = 'localhost'; $db = 'manajemen_karyawan'; $user = 'root'; $pass = '';
$conn = new mysqli($host, $user, $pass, $db);

$result = $conn->query("SELECT * FROM karyawan_absensi");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Karyawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-blue-700 mb-6">Data Karyawan dan Absensi</h2>
        <div class="flex justify-between items-center mb-4">
    <a href="tambah.php" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 mr-2">Tambah Data</a>
    <a href="../akun/logout.php" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">Logout</a>
</div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border shadow-md rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-2 px-4">NIP</th>
                        <th class="py-2 px-4">Nama</th>
                        <th class="py-2 px-4">Umur</th>
                        <th class="py-2 px-4">JK</th>
                        <th class="py-2 px-4">Departemen</th>
                        <th class="py-2 px-4">Jabatan</th>
                        <th class="py-2 px-4">Kota</th>
                        <th class="py-2 px-4">Tanggal</th>
                        <th class="py-2 px-4">Masuk</th>
                        <th class="py-2 px-4">Pulang</th>
                        <th class="py-2 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="text-center border-t">
                            <td class="py-2 px-4"><?= $row['nip'] ?></td>
                            <td class="py-2 px-4"><?= $row['nama'] ?></td>
                            <td class="py-2 px-4"><?= $row['umur'] ?></td>
                            <td class="py-2 px-4"><?= $row['jenis_kelamin'] ?></td>
                            <td class="py-2 px-4"><?= $row['departemen'] ?></td>
                            <td class="py-2 px-4"><?= $row['jabatan'] ?></td>
                            <td class="py-2 px-4"><?= $row['kota_asal'] ?></td>
                            <td class="py-2 px-4"><?= $row['tanggal_absensi'] ?></td>
                            <td class="py-2 px-4"><?= $row['jam_masuk'] ?></td>
                            <td class="py-2 px-4"><?= $row['jam_pulang'] ?></td>
                            <td class="py-2 px-4">
                            <a href="edit.php?nip=<?= $row['nip'] ?>" class="text-yellow-600 hover:underline mr-2">Edit</a>
                            <a href="hapus.php?nip=<?= $row['nip'] ?>" onclick="return confirm('Hapus data ini?')" class="text-red-600 hover:underline">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
