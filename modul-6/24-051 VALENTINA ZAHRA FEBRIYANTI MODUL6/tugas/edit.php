<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "koneksi1.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
} else {
    die("ID tidak ditemukan atau tidak valid di URL.");
}

$error = '';

$result = mysqli_query($conn, "SELECT * FROM karyawan_absensi WHERE id = $id");
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
$data = mysqli_fetch_assoc($result);
if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['submit'])) {
    $nip = htmlspecialchars($_POST['nip']);
    $nama = htmlspecialchars($_POST['nama']);
    $umur = (int)$_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = htmlspecialchars($_POST['departemen']);
    $jabatan = htmlspecialchars($_POST['jabatan']);
    $kota_asal = htmlspecialchars($_POST['kota_asal']);
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    if (!$nip || !$nama || !$umur || !$jenis_kelamin || !$departemen || !$jabatan || !$kota_asal || !$tanggal_absensi || !$jam_masuk || !$jam_pulang) {
        $error = "Semua field harus diisi!";
    } else {
        $stmt = $conn->prepare("UPDATE karyawan_absensi SET nip=?, nama=?, umur=?, jenis_kelamin=?, departemen=?, jabatan=?, kota_asal=?, tanggal_absensi=?, jam_masuk=?, jam_pulang=? WHERE id=?");
        $stmt->bind_param("ssisssssssi", $nip, $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal_absensi, $jam_masuk, $jam_pulang, $id);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Gagal memperbarui data: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Karyawan & Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-100 min-h-screen flex items-center justify-center">

    <div class="max-w-4xl w-full bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-pink-600">Edit Data Karyawan & Absensi</h2>

        <?php if ($error): ?>
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <tbody>
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 font-medium w-1/3">NIP</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="nip" value="<?= htmlspecialchars($data['nip']) ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300 bg-pink-50">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Nama</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Umur</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="number" name="umur" value="<?= htmlspecialchars($data['umur']) ?>" class="w-full p-2 border rounded" required min="18" max="100">
                        </td>
                    </tr>
                    <tr class="border border-gray-300 bg-pink-50">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Jenis Kelamin</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <select name="jenis_kelamin" class="w-full p-2 border rounded" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Departemen</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="departemen" value="<?= htmlspecialchars($data['departemen']) ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300 bg-pink-50">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Jabatan</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']) ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Kota Asal</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="text" name="kota_asal" value="<?= htmlspecialchars($data['kota_asal']) ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300 bg-pink-50">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Tanggal Absensi</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="date" name="tanggal_absensi" value="<?= $data['tanggal_absensi'] ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Jam Masuk</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="time" name="jam_masuk" value="<?= $data['jam_masuk'] ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                    <tr class="border border-gray-300 bg-pink-50">
                        <td class="border border-gray-300 px-4 py-2 font-medium">Jam Pulang</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <input type="time" name="jam_pulang" value="<?= $data['jam_pulang'] ?>" class="w-full p-2 border rounded" required>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 flex gap-4 justify-end">
                <button type="submit" name="submit" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700">Perbarui</button>
                <a href="dashboard.php" class="bg-pink-600 text-white px-6 py-2 rounded hover:bg-pink-700">← Kembali ke Dashboard</a>
                <a href="dashboard.php" class="px-6 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
