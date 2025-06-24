<?php
require_once '../includes/auth.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../auth/login.php');
    exit();
}


global $pdo;
$stmt = $pdo->query("SELECT * FROM karyawan_absensi ORDER BY created_at DESC");
$karyawans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../includes/header.php'; ?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Data Karyawan & Absensi</h2>
        <a href="tambah_karyawan.php" class="text-sm font-semibold bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">Tambah Data</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 text-sm text-left border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">NIP</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Umur</th>
                    <th class="px-4 py-2 border">Jenis Kelamin</th>
                    <th class="px-4 py-2 border">Departemen</th>
                    <th class="px-4 py-2 border">Jabatan</th>
                    <th class="px-4 py-2 border">Kota Asal</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Jam Masuk</th>
                    <th class="px-4 py-2 border">Jam Pulang</th>
                    <th class="px-4 py-2 border text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($karyawans as $k): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($k['nip']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($k['nama']); ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['umur']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['jenis_kelamin']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['departemen']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['jabatan']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['kota_asal']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['tanggal_absensi']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['jam_masuk']; ?></td>
                        <td class="px-4 py-2 border"><?php echo $k['jam_pulang']; ?></td>
                        <td class="px-4 py-2 border text-center">
                            <a href="edit_karyawan.php?nip=<?= urlencode($k['nip']) ?>" class="text-blue-600 hover:text-blue-800">Edit</a> 
                            <a href="hapus_karyawan.php?nip=<?= urlencode($k['nip']) ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (count($karyawans) === 0): ?>
                    <tr>
                        <td colspan="11" class="px-4 py-3 text-center text-gray-500">Belum ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
